<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Http\Requests\PasswordChangeRequest;

class PasswordChangeController extends Controller
{
    public function showChangeForm($username)
    {
        $user = User::where('username', $username)->first();

        if (!$user || !Hash::check('temporary', $user->password)) {
            abort(403, 'Ação nao autorizada!');
        }

        return view('login.passwordChange', ['username' => $username, 'user' => $user]);
    }

    public function updatePassword(PasswordChangeRequest $request, $username)
    {
        $user = User::where('username', $username)->first();

        if (!$user || !Hash::check('temporary', $user->password)) {
            abort(403, 'Ação nao autorizada!');
        }

        $user->password = Hash::make($request->input('password'));
        $user->save();

        return redirect()->route('login')->with('success', 'Password atualizada com sucesso!');
    }
}
