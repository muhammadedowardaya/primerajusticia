<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{

    public function index()
    {
        return view('auth.login');
    }

    public function authenticate(Request $request, User $user)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            session()->flash('berhasilLogin', 'pesan.berhasil("Login success!")');
            return redirect()->intended('/dashboard');
        }
        session()->flash('gagalLogin', 'pesan.gagal("Login failed!")');
        return redirect('/login');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}