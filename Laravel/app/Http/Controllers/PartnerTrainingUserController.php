<?php

namespace App\Http\Controllers;

use App\Material;
use App\Partner;
use App\PartnerTrainingUser;
use App\Role;

use App\Training;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PartnerTrainingUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $partner_Training_Users = PartnerTrainingUser::with('partner', 'training', 'user')->get();

        $partners = Partner::with('partnerTrainingUsers', 'contactPartner')->get();

        $trainings = Training::all();

        return view('external.index', compact('partner_Training_Users', 'partners', 'trainings'));
    }


    public function show($id)
    {

        $partner_Training_Users = PartnerTrainingUser::with('partner', 'training', 'user', 'materials')->findOrFail($id);



        return view('external.show', compact('partner_Training_Users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $partner_Training_Users = PartnerTrainingUser::all();
        //$role_users = Role_User::all();
        $partners=Partner::all();
        $users=User::all();
        $trainings=Training::all();

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
            'end_date' => 'required',
        ]);

        $partnerTrainingUser = PartnerTrainingUser::create($request->all());

        $materials = $request->input('materials', []);
        $materialQuantities = $request->input('material_quantities', []);


        if (strtotime($request->start_date) > strtotime($request->end_date)) {
            return redirect()->back()->withErrors(['end_date' => 'End date must be after or equal to start date']);
        }

        foreach ($materials as $materialId) {
            $quantity = $materialQuantities[$materialId] ?? 1;

            $partnerTrainingUser->Material_Training()->create([
                'material_id' => $materialId,
                'quantity' => $quantity,
            ]);

            $material = Material::find($materialId);

            if ($material) {
                $material->decrement('quantity', $quantity);
            }
        }

        return redirect()->route('external.index')->with('success', 'Formação criada com sucesso');
    }


    public function edit($id)
    {
        $partner_Training_Users = PartnerTrainingUser::with('partner', 'training', 'user',  'materials')->findOrFail($id);

        $partners = Partner::all();
        $trainings = Training::all();
        $users = User::all();



        //$materials = Material::where('isInternal', '=', false)->get();

        $materials = Material::with('partnerTrainingUsers')->where('isInternal', false)->get();
        //dd($materials)      ;

        return view('external.edit', compact('partner_Training_Users', 'partners', 'trainings', 'users',   'materials' ));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PartnerTrainingUsers  $partner_Training_Users
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $partner_Training_Users = PartnerTrainingUser::with('partner', 'training', 'user')->findOrFail($id);

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
        $partner_Training_Users->update($request->all());

        $selectedMaterials = $request->input('materials');
        $materialQuantities = $request->input('material_quantities');
        if ($selectedMaterials) {
            foreach ($selectedMaterials as $materialId) {
                $quantity = $materialQuantities[$materialId] ?? 1;

                $partner_Training_Users->materials()->syncWithoutDetaching([
                    $materialId => ['quantity' => $quantity],
                ]);

                $material = Material::find($materialId);

                if ($material) {
                    $material->decrement('quantity', $quantity);
                }
            }
        }

//        $partner_Training_Users->materials()->detach();
//
//        foreach ($request['material_quantities'] as $materialId => $quantity) {
//            $partner_Training_Users->materials()->attach($materialId, ['quantity' => $quantity]);
//
//        }
       // dd($partner_Training_Users->materials()->attach($materialId, ['quantity' => $quantity]));





        return redirect()->route('external.index')->with('success', 'Formação atualizada com sucesso');
    }






    public function destroy($id)
    {
        $partnerTrainingUser = PartnerTrainingUser::findOrFail($id);


        $materialTrainings = $partnerTrainingUser->Material_Training;


        foreach ($materialTrainings as $materialTraining) {
            $material = $materialTraining->material;
            $material->quantity += $materialTraining->quantity;
            $material->save();
        }

        $partnerTrainingUser->Material_Training()->delete();

        $partnerTrainingUser->delete();

        return redirect()->route('external.index')->with('success', 'Formação eliminada com sucesso');
    }



    public function massDelete(Request $request)
    {



        $request->validate([
            'ptu_ids' => 'required|array',
            'ptu_ids.*' => 'exists:partner__training__users,id',]);

        //dd($request->all());
        try {
            PartnerTrainingUser::whereIn('id', $request->input('ptu_ids'))->delete();

            return redirect()->back()->with('success', 'Formações selecionadas excluídas com sucesso!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Erro ao excluir Formações selecionadas. Por favor, tente novamente.');
        }
    }



}
