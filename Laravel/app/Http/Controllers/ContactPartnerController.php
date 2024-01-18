<?php

namespace App\Http\Controllers;

use App\ContactPartner;
use App\Partner;
use Illuminate\Http\Request;

class ContactPartnerController extends Controller
{
    public function destroy(ContactPartner $partner_contact )
    {
        $partnerId = $partner_contact->partner_id;

        $partner = Partner::find($partnerId);

        $partner->update(['updated_at' => now()]);

        try {
            $partner_contact->delete();

            return response()->json(['success' => 'Contacto excluído com sucesso!']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erro ao excluir o Contacto. Por favor, tente novamente.'], 500);
        }
    }
}
