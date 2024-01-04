<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Partner_contact;

class PartnerContactController extends Controller
{
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Partner_contact  $partner_contact
     * @return \Illuminate\Http\Response
     */
    public function destroy(Partner_contact $partner_contact)
    {
        try {
            $partner_contact->delete();
            return response()->json(['success' => 'Contacto excluído com sucesso!']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erro ao excluir o Contacto. Por favor, tente novamente.'], 500);
        }
    }
}
