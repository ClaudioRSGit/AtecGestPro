<?php

namespace App\Http\Controllers;

use App\Partner;
use App\Partner_Trainings_Users;
use App\Training;
use App\User;
use Illuminate\Http\Request;

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

    public function showPartner(Partner $partner)
    {
        return view('external.showPartner', compact('partner'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $partner_Trainings_Users = Partner_Trainings_Users::all();
        $partners=Partner::all();
        $users=User::all();
        $trainings=Training::all();
        return view('external.create', compact('partner_Trainings_Users', 'partners', 'users', 'trainings'));
    }

    public function createPartner()
    {
        $partners=Partner::all();
        return view('external.createPartner', compact('partners'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate(request(),
            [

                    'partner_id' => 'required',
                    'training_id' => 'required',
                    'user_id' => 'required',
                    'start_date' => 'required',
                    'end_date' => 'required',


            ]);
        Partner_Trainings_Users::create($request->all());
        return redirect()->route('external.index')->with('success','Formação criada com sucesso');
    }

    public function storePartner(Request $request)
    {
        $this->validate(request(),
            [

                    'name' => 'required',
                    'description' => 'required',
                    'address' => 'required',
            ]);
        Partner_Trainings_Users::createPartner($request->all());
        return redirect()->route('external.index')->with('success','Parceiro criado com sucesso');
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
        $partners = Partner::all();
        $trainings = Training::all();
        $users = User::all();
        return view('external.edit', compact('partner_Trainings_Users', 'partners', 'trainings', 'users'));
    }

    public function editPartner($id)
    {
        $partner = Partner::findOrFail($id);
        return view('external.editPartner', compact('partner'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Partner_Trainings_Users  $partner_Trainings_Users
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $id)
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

        return redirect()->route('external.index')->with('success', 'Formação atualizada com sucesso');
    }



    public function destroy($id)
    {
        $partner_Trainings_User = Partner_Trainings_Users::findOrFail($id);
        $partner_Trainings_User->delete();

        return redirect()->route('external.index')->with('success', 'Formação eliminada com sucesso');
    }

}
