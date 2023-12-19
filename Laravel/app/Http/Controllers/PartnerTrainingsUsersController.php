<?php

namespace App\Http\Controllers;

use App\Partner_Trainings_Users;
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

        $partner_Trainings_Users = $partner_Trainings_Users->map(function ($partner_Trainings_User) {
            return $partner_Trainings_User
                ->setRelation('partner', $partner_Trainings_User->partner)
                ->setRelation('training', $partner_Trainings_User->training)
                ->setRelation('user', $partner_Trainings_User->user);
        });


        return view('external.index', compact('partner_Trainings_Users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Partner_Trainings_Users  $partner_Trainings_Users
     * @return \Illuminate\Http\Response
     */
    public function show(Partner_Trainings_Users $partner_Trainings_Users)
    {
        // Eager load the relations for this specific instance
        $partner_Trainings_Users->load('partner', 'training', 'user');

        return view('external.show', compact('partner_Trainings_Users'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Partner_Trainings_Users  $partner_Trainings_Users
     * @return \Illuminate\Http\Response
     */
    public function edit(Partner_Trainings_Users $partner_Trainings_Users)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Partner_Trainings_Users  $partner_Trainings_Users
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Partner_Trainings_Users $partner_Trainings_Users)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Partner_Trainings_Users  $partner_Trainings_Users
     * @return \Illuminate\Http\Response
     */
    public function destroy(Partner_Trainings_Users $partner_Trainings_Users)
    {
        //
    }
}
