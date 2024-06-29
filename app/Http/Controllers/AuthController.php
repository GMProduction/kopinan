<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index()
    {
        if (request()->method() == 'POST') {

            request()->validate(
                [
                    'username' => 'required|string|exists:users,username',
                    'password' => 'required|min:8',
                ],
                [
                    "username.required" => "Username Harus di isi",
                    "username.exists" => "Username tidak terdaftar",
                    "password.required" => "Password harus di isi",
                    "password.min" => "Password tidak boleh kurang dari 8 karakter",
                ]
            );

            if (Auth::attempt(['username' => request('username'), 'password' => request('password')])) {
                if (\auth()->user()->role != 'admin') {
                    Auth::logout();

                    return redirect()->back()->withInput()->withErrors(
                        [
                            'username' => 'Akun anda tidak aktif',
                        ]
                    );
                }
//                    if (Auth::user()->role == 'dinkes') {
//                        return redirect('/admin');
//                    }
                request()->session()->regenerate();

                return redirect()->route('user');
            }

            return redirect()->back()->withInput()->withErrors(
                [
                    'password' => 'Password salah.',
                ]
            );

        }

        return view('login');
    }

    public function logout()
    {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect('/');
    }

}
