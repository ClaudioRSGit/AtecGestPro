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

class PartnerTrainingUserController extends Controller
{


    public function index(Request $request)
    {

//      dd($request->all());
        $searchPtu = $request->input('ptu');
        $searchP = $request->input('p');
        $searchT = $request->input('t');

        $activeTabContext = 1;


//        switch ($activeTabContext) {
//            case '1':
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
//                break;
//            case 'partnersTable':

                if ($searchP) {
                    $partners = Partner::with('partnerTrainingUsers', 'contactPartner')
                        ->where('name', 'like', "%$searchP%")
                        ->paginate(5);
                } else {
                    $partners = Partner::with('partnerTrainingUsers', 'contactPartner')->paginate(5);
                }
//                break;
//            case 'trainingsTable':
                if ($searchT) {
                    $trainings = Training::where('name', 'like', "%$searchT%")->paginate(5);
                } else {
                    $trainings = Training::with('partnerTrainingUsers')->paginate(5);
                }
//                break;
//        }

        return view('external.index', compact('partner_Training_Users', 'partners', 'trainings'));
    }


    public function updateTab(Request $request)
    {
        dd($request->all());
        $activeTab = $request->input('activeTab');

        // Add your logic here to handle the active tab update
        // For example, you can store it in the session

        session(['activeTab' => $activeTab]);

        return response()->json(['message' => 'Active tab updated successfully']);
    }

    private function determineActiveTabContext()
    {

        return 'pagination';
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
        $users = User::all();
        $trainings = Training::all();

        $materials = DB::table('materials')->where('isInternal', '=', false)->get();


        return view('external.create', compact('partner_Training_Users', 'partners', 'users', 'trainings', 'materials'));
    }


    public function store(Request $request)
    {
        $this->validate(request(), [
            'partner_id' => 'required',
            'training_id' => 'required',
            'user_id' => 'required',
            'start_date' => 'required',
            'end_date' => 'required|after_or_equal:start_date',
        ]);

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
        $users = User::all();


        $materials = Material::with('partnerTrainingUsers')->where('isInternal', false)->get();
        return view('external.edit', compact('partner_Training_Users', 'partners', 'trainings', 'users', 'materials'));
    }


    public function update(Request $request, $id)
    {

        $partner_Training_User = PartnerTrainingUser::with('partner', 'training', 'user', 'materials')->findOrFail($id);
        $this->validate($request, [
            'partner_id' => 'required',
            'training_id' => 'required',
            'user_id' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        if (strtotime($request->start_date) > strtotime($request->end_date)) {
            return redirect()->back()->withErrors(['end_date' => 'End date must be after or equal to start date']);
        }
        //dd($request->all())  ;
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


    public function massDelete(Request $request)
    {
        $request->validate([
            'ptu_ids' => 'required|array',
            'ptu_ids.*' => 'exists:partner_training_users,id',
        ]);

        try {
            $partnerTrainingUsers = PartnerTrainingUser::whereIn('id', $request->input('ptu_ids'))->get();

            foreach ($partnerTrainingUsers as $partnerTrainingUser) {
                $materials = $partnerTrainingUser->materials;

                foreach ($materials as $material) {
                    $quantity = $material->pivot->quantity ?? 0;

                    $material->increment('quantity', $quantity);
                }

                MaterialPartnerTrainingUser::where('partner_training_user_id', $partnerTrainingUser->id)->delete();
            }

            // Delete PartnerTrainingUsers
            PartnerTrainingUser::whereIn('id', $request->input('ptu_ids'))->delete();

            return redirect()->back()->with('success', 'Formações selecionadas excluídas com sucesso!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Erro ao excluir Formações selecionadas. Por favor, tente novamente.');
        }
    }


}
