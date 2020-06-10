<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function loginScreen()
    {
        return view('web.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (auth()->attempt($credentials)) {
            // Authentication passed...
            return redirect()->route('web.index');
        }

        return view('web.login');

    }

    public function registerScreen()
    {
        return view('web.register');
    }

    public function register(Request $request)
    {
        $User = new User;
        $user = $User->store($request);
        if ($user->status() === 200):
            auth()->attempt(['email' => $request->email, 'password' => $request->password]);
            return redirect()->route('web.index');
        endif;
    }

    public function logout()
    {
        auth()->logout();
        return redirect()->route('web.login');
    }
}
