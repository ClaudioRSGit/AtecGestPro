<?php

namespace App\Http\Controllers;

use App\Partner;
use App\ContactPartner;
use Illuminate\Http\Request;

class PartnerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $partners = Partner::all();
        return view('partners.create', compact('partners'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate(
            request(),
            [
                'name' => 'required',
                'description' => 'required',
                'address' => 'required',
            ]
        );

        $partner = Partner::create($request->only(['name', 'description', 'address']));

        // Adding contacts to the partner_contacts table
        $contacts = $request->input('contact_description');
        $values = $request->input('contact_value');

        if ($contacts && $values) {
            foreach ($contacts as $key => $contact) {
                ContactPartner::create([
                    'contact' => $values[$key],
                    'description' => $contact,
                    'partner_id' => $partner->id,
                ]);
            }
        }

        return redirect()->route('external.index')->with('success', 'Parceiro criado com sucesso');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Partner  $partner
     * @return \Illuminate\Http\Response
     */
    public function show(Partner $partner)
    {
        return view('partners.show', compact('partner'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Partner  $partner
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $partner = Partner::findOrFail($id);
        return view('partners.edit', compact('partner'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Partner  $partner
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Partner $partner)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:500',
            'address' => 'required|string|max:500',
        ]);

        $partner->update($request->only(['name', 'description', 'address']));

        // Update contacts
        $existingContactIds = $request->input('existing_contact_ids', []);
        $existingContactDescriptions = $request->input('existing_contact_descriptions', []);
        $existingContactValues = $request->input('existing_contact_values', []);

        foreach ($existingContactIds as $key => $existingContactId) {
            $existingContact = ContactPartner::find($existingContactId);
            $existingContact->update([
                'contact' => $existingContactValues[$key],
                'description' => $existingContactDescriptions[$key],
            ]);
        }

        // New contacts
        $newContactDescriptions = $request->input('new_contact_descriptions', []);
        $newContactValues = $request->input('new_contact_values', []);

        foreach ($newContactDescriptions as $key => $newContactDescription) {
            ContactPartner::create([
                'contact' => $newContactValues[$key],
                'description' => $newContactDescription,
                'partner_id' => $partner->id,
            ]);
        }

        return redirect()->route('external.index')->with('success', 'Parceiro atualizado com sucesso!');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Partner  $partner
     * @return \Illuminate\Http\Response
     */
    public function destroy(Partner $partner)
    {
        try {
            $partner->delete();
            return redirect()->route('external.index')->with('success', 'Parceiro excluído com sucesso!');
        } catch (\Exception $e) {
            return redirect()->route('external.index')->with('error', 'Erro ao excluir o Parceiro. Por favor, tente novamente.');
        }
    }

    public function massDelete(Request $request)
    {
        $request->validate([
            'partner_ids' => 'required|array',
            'partner_ids.*' => 'exists:partners,id', //all items inside array must exist
        ]);

        try {

            Partner::whereIn('id', $request->input('partner_ids'))->delete();
            return redirect()->back()->with('success', 'Parceiros selecionados excluídos com sucesso!');
        } catch (\Exception $e) {

            return redirect()->back()->with('error', 'Erro ao excluir Parceiros selecionados. Por favor, tente novamente.');
        }
    }
}
