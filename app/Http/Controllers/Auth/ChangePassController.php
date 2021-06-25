<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ChangePassController extends Controller
{
    public function showForm() {
        return view('auth.passwords.changepass');
    }

    public function updatePass() {
        request()->validate([
            'current_password' => 'current_password|required',
            'new_password' => 'string|min:8|required',
        ]);

        $user = auth()->user();
        $user->password = \Hash::make(request('new_password'));
        $user->save();

        return back()->with('message', 'Password succesfully updated!');
    }
}
