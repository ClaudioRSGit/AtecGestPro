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


//dd($request->all());
        $searchPtu = $request->input('ptu');
//        dd($searchPtu);
        $searchP = $request->input('p');
        $searchT = $request->input('t');


        $ptuQuery = PartnerTrainingUser::with('partner', 'training', 'user');

        if ($searchPtu) {
            $ptuQuery = PartnerTrainingUser::with('partner', 'training', 'user')
                ->whereHas('partner', function ($query) use ($searchPtu) {
                    $query->where('name', 'like', "%$searchPtu%");
                })
                ->orWhereHas('training', function ($query) use ($searchPtu) {
                    $query->where('name', 'like', "%$searchPtu%");
                })
                ->orWhereHas('user', function ($query) use ($searchPtu) {
                    $query->where('name', 'like', "%$searchPtu%");
                });
        } else {
            $ptuQuery = PartnerTrainingUser::with('partner', 'training', 'user');
        }


        if ($searchP) {
            $partnersQuery = Partner::with('partnerTrainingUsers', 'contactPartner')
                ->where('name', 'like', "%$searchP%");
        } else {
            $partnersQuery = Partner::with('partnerTrainingUsers', 'contactPartner');
        }

        if ($searchT) {
            $trainingsQuery = Training::where('name', 'like', "%$searchT%");
        } else {
            $trainingsQuery = Training::with('partnerTrainingUsers');
        }

        $partner_Training_Users = $ptuQuery->paginate(5, ['*'], 'ptuPage')->withQueryString();
        $partners = $partnersQuery->paginate(5, ['*'], 'pPage')->withQueryString();
        $trainings = $trainingsQuery->paginate(5, ['*'], 'tPage')->withQueryString();

        return view('external.index', compact('partner_Training_Users', 'partners', 'trainings', 'searchPtu', 'searchP', 'searchT'));
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
        $users = User::all()->where('name', '!=', 'Fila de Espera')->where('name', '!=', 'Utilizador Padrao');
        $trainings = Training::all();

        $materials = DB::table('materials')->where('isInternal', '=', false)->whereNull('deleted_at')->get();

        return view('external.create', compact('partner_Training_Users', 'partners', 'users', 'trainings', 'materials'));
    }


    public function store(PartnerTrainingUserRequest $request)
    {
        try {
            $partnerTrainingUser = PartnerTrainingUser::create([
                'partner_id' => $request->input('partner_id'),
                'training_id' => $request->input('training_id'),
                'user_id' => $request->input('user_id'),
                'start_date' => $request->input('start_date'),
                'end_date' => $request->input('end_date')
            ]);

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

            return redirect()->route('external.index')->with('success', 'Formação externa criada com sucesso');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Erro ao criar a formação formação externa. Por favor, tente novamente.');
        }
    }

    public function edit($id)
    {
        $partner_Training_Users = PartnerTrainingUser::with('partner', 'training', 'user', 'materials')->findOrFail($id);
        $partners = Partner::all();
        $trainings = Training::all();
        $users = User::all()->where('name', '!=', 'Fila de Espera')->where('name', '!=', 'Utilizador Padrao');


        $materials = Material::with('partnerTrainingUsers')->where('isInternal', false)->whereNull('deleted_at')->get();
        return view('external.edit', compact('partner_Training_Users', 'partners', 'trainings', 'users', 'materials'));
    }


    public function update(PartnerTrainingUserRequest $request, $id)
    {
        try {
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
                    $quantityInserted = $materialQuantities[$materialId] ?? 1; //allocated training amount + difference

                    $currentQuantity = $partner_Training_User->materials->where('id', $materialId)->first()->pivot->quantity ?? 0;//allocated training amount

                    $quantityDiference = ($quantityInserted - $currentQuantity);//"difference between the allocated training amount and the entered amount
                    $stock = Material::find($materialId)->quantity;//product stock

                    if ($quantityInserted != 0) {
                        $partner_Training_User->materials()->syncWithoutDetaching([
                            $materialId => ['quantity' => $quantityInserted],
                        ]);
                    } else {
                        $partner_Training_User->materials()->detach($materialId);
                    }

                    $material = Material::find($materialId);
                    $material->quantity = $stock - $quantityDiference;
                    $material->save();
                }
            }

            return redirect()->route('external.show', $partner_Training_User->id)->with('success', 'Formação atualizada com sucesso');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Erro ao atualizar a formação. Por favor, tente novamente.');
        }
    }

    public function destroy($id)
    {
        try {
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
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Erro ao eliminar a formação. Por favor, tente novamente.');
        }
    }
}
