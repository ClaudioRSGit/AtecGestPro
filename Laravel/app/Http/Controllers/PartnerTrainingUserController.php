<?php

namespace App\Http\Controllers;

use App\Material;
use App\MaterialPartnerTrainingUser;
use App\Partner;
use App\PartnerTrainingUser;
use App\Training;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\PartnerTrainingUserRequest;

class PartnerTrainingUserController extends Controller
{


    public function index(Request $request)
    {



        $searchPtu = $request->input('ptu');
        $searchP = $request->input('p');
        $searchT = $request->input('t');




                if ($searchPtu) {
                    $partner_Training_Users = PartnerTrainingUser::with('partner', 'training', 'user')
                        ->whereHas('partner', function ($query) use ($searchPtu) {
                            $query->where('name', 'like', "%$searchPtu%");
                        })
                        ->orWhereHas('training', function ($query) use ($searchPtu) {
                            $query->where('name', 'like', "%$searchPtu%");
                        })
                        ->orWhereHas('user', function ($query) use ($searchPtu) {
                            $query->where('name', 'like', "%$searchPtu%");
                        })->paginate(5);
                } else {
                    $partner_Training_Users = PartnerTrainingUser::with('partner', 'training', 'user')->paginate(5);
                }


                if ($searchP) {
                    $partners = Partner::with('partnerTrainingUsers', 'contactPartner')
                        ->where('name', 'like', "%$searchP%")
                        ->paginate(5);
                } else {
                    $partners = Partner::with('partnerTrainingUsers', 'contactPartner')->paginate(5);
                }

                if ($searchT) {
                    $trainings = Training::where('name', 'like', "%$searchT%")->paginate(5);
                } else {
                    $trainings = Training::with('partnerTrainingUsers')->paginate(5);
                }


        return view('external.index', compact('partner_Training_Users', 'partners', 'trainings'));
    }

    public function show($id)
    {

        $partner_Training_Users = PartnerTrainingUser::with('partner', 'training', 'user', 'materials')->findOrFail($id);

        return view('external.show', compact('partner_Training_Users'));
    }


    public function create()
    {
        $partner_Training_Users = PartnerTrainingUser::all();
        $partners = Partner::all();
        $users = User::all()->where('name', '!=', 'Fila de Espera');
        $trainings = Training::all();

        $materials = DB::table('materials')->where('isInternal', '=', false)->get();


        return view('external.create', compact('partner_Training_Users', 'partners', 'users', 'trainings', 'materials'));
    }


    public function store(PartnerTrainingUserRequest $request)
    {
        $partnerTrainingUser = PartnerTrainingUser::create([
            'partner_id' => $request->input('partner_id'),
            'training_id' => $request->input('training_id'),
            'user_id' => $request->input('user_id'),
            'start_date' => $request->input('start_date'),
            'end_date' => $request->input('end_date')]);

        $materials = $request->input('materials', []);
        $materialQuantities = $request->input('material_quantities', []);


        foreach ($materials as $materialId) {
            $quantity = $materialQuantities[$materialId] ?? 1;
            $material = Material::find($materialId);


            $partnerTrainingUser->materials()->attach($materialId, ['quantity' => $quantity]);


            if ($material) {
                $material->decrement('quantity', $quantity);
            }
        }

        return redirect()->route('external.index')->with('success', 'Formação criada com sucesso');
    }


    public function edit($id)
    {
        $partner_Training_Users = PartnerTrainingUser::with('partner', 'training', 'user', 'materials')->findOrFail($id);
        $partners = Partner::all();
        $trainings = Training::all();
        $users = User::all()->where('name', '!=', 'Fila de Espera');


        $materials = Material::with('partnerTrainingUsers')->where('isInternal', false)->get();
        return view('external.edit', compact('partner_Training_Users', 'partners', 'trainings', 'users', 'materials'));
    }


    public function update(PartnerTrainingUserRequest $request, $id)
    {

        $partner_Training_User = PartnerTrainingUser::with('partner', 'training', 'user', 'materials')->findOrFail($id);

        if (strtotime($request->start_date) > strtotime($request->end_date)) {
            return redirect()->back()->withErrors(['end_date' => 'End date must be after or equal to start date']);
        }

        $partner_Training_User->update($request->all());
        $partner_Training_User = PartnerTrainingUser::with('materials')->findOrFail($id);

        $selectedMaterials = $request->input('materials');
        $materialQuantities = $request->input('material_quantities');

        if ($selectedMaterials) {
            foreach ($selectedMaterials as $materialId) {
                $quantityInserted = $materialQuantities[$materialId] ?? 1;
                $currentQuantity = $partner_Training_User->materials->where('id', $materialId)->first()->pivot->quantity ?? 0;
                $quantityDecreased = $currentQuantity > $quantityInserted;
                $stock = $partner_Training_User->materials->where('id', $materialId)->first()->quantity ?? 0;
                $stockTotal = $stock + $currentQuantity;


                if ($quantityInserted > 0) {
                    $partner_Training_User->materials()->syncWithoutDetaching([

                        $materialId => ['quantity' => $quantityInserted],
                    ]);
                } else {
                    $partner_Training_User->materials()->detach($materialId);
                }

                $material = Material::find($materialId);


                $material->quantity = $stockTotal - $quantityInserted;
                $material->save();
            }
        }

        return redirect()->route('external.index')->with('success', 'Formação atualizada com sucesso');
    }


    public function destroy($id)
    {

        $partnerTrainingUser = PartnerTrainingUser::find($id);

        if (!$partnerTrainingUser) {
            return redirect()->route('partner-training-users.index')->with('error', 'PartnerTrainingUser not found.');
        }

        $materials = $partnerTrainingUser->materials;

        MaterialPartnerTrainingUser::where('partner_training_user_id', $partnerTrainingUser->id)->delete();

        foreach ($materials as $material) {
            $material->increment('quantity', $material->pivot->quantity);
        }

        $partnerTrainingUser->delete();

        return redirect()->route('external.index')->with('success', 'Formação eliminada com sucesso');
    }


}
