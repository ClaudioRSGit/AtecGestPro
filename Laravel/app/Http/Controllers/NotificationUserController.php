<?php

namespace App\Http\Controllers;

use App\NotificationUser;
use Illuminate\Http\Request;

class NotificationUserController extends Controller
{
    public function readAll()
    {
        try {
            NotificationUser::where('user_id', auth()->id())->update(['isRead' => true]);
            return back()->with('success', 'Todas as notificações foram marcadas como lidas.');
        } catch (\Exception $e) {
            return back()->with('error', 'Não foi possível marcar as notificações como lidas. Erro: ' . $e->getMessage());
        }
    }
}
