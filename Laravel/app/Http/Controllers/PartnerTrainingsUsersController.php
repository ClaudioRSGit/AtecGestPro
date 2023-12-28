<?php

namespace App\Http\Controllers;

use App\Material;
use App\Partner;
use App\Partner_Trainings_Users;
use App\Role;
use App\Role_User;
use App\Training;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PartnerTrainingsUsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $partner_Trainings_Users = Partner_Trainings_Users::with('partner', 'training', 'user')->get();
        $partners = Partner::with('partnerTrainingsUsers', 'partnerContacts')->get();

        return view('external.index', compact('partner_Trainings_Users', 'partners'));
    }


    public function show($id)
    {
        $partner_Trainings_User = Partner_Trainings_Users::with('partner', 'training', 'user')->findOrFail($id);

        return view('external.show', compact('partner_Trainings_User'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $partner_Trainings_Users = Partner_Trainings_Users::all();
        $role_users = Role_User::all();
        $partners=Partner::all();
        $users=User::all();
        $trainings=Training::all();

        $materials = DB::table('materials')->where('isInternal', '=', false)->get();



        return view('external.create', compact('partner_Trainings_Users', 'partners', 'users', 'trainings', "role_users", 'materials'));
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

        $partnerTrainingsUser = Partner_Trainings_Users::create($request->all());

        $materials = $request->input('materials', []);
        $materialQuantities = $request->input('material_quantities', []);

        foreach ($materials as $materialId) {
            $quantity = $materialQuantities[$materialId] ?? 1;

            $partnerTrainingsUser->Material_Training()->create([
                'material_id' => $materialId,
                'quantity' => $quantity,
            ]);
        }

        return redirect()->route('external.index')->with('success', 'Formação criada com sucesso');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Partner_Trainings_Users  $partner_Trainings_Users
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $partner_Trainings_Users = Partner_Trainings_Users::with('partner', 'training', 'user')->findOrFail($id);
        $role_users = Role_User::with('role', 'user')->get();
        $partners = Partner::all();
        $trainings = Training::all();
        $users = User::all();

        $selectedMaterials = $partner_Trainings_Users->Material_Training->pluck('material_id')->toArray();

        $materials = DB::table('materials')->where('isInternal', '=', false)->get();

        return view('external.edit', compact('partner_Trainings_Users', 'partners', 'trainings', 'users', 'role_users', 'materials', 'selectedMaterials'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Partner_Trainings_Users  $partner_Trainings_Users
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $partner_Trainings_Users = Partner_Trainings_Users::with('partner', 'training', 'user')->findOrFail($id);

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

        $partner_Trainings_Users->update($request->all());

        $materials = $request->input('materials', []);
        $materialQuantities = $request->input('material_quantities', []);

        $partner_Trainings_Users->Material_Training()->delete();

        foreach ($materials as $materialId) {
            $quantity = $materialQuantities[$materialId] ?? 1;

            $partner_Trainings_Users->Material_Training()->create([
                'material_id' => $materialId,
                'quantity' => $quantity,
            ]);
        }

        return redirect()->route('external.index')->with('success', 'Formação atualizada com sucesso');
    }






    public function destroy($id)
    {
        $partner_Trainings_User = Partner_Trainings_Users::findOrFail($id);
        $partner_Trainings_User->delete();

        return redirect()->route('external.index')->with('success', 'Formação eliminada com sucesso');
    }

}
