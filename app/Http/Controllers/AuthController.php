<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    //Register
    public function Register()
    {

    }

    //Login
    public function Login(Request $request)
    {
        // Validate the request
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

         // Check the user credentials
         $user = User::where('name', $request->username)->first();
        //  dd(Hash::check($request->password, $user->password));

         if ($user && Hash::check($request->password, $user->password)) {
            // Credentials are correct, log the user in
            Auth::login($user, $request->remember);

            // Redirect to the dashboard
            return redirect()->intended('dashboard');
        }



        // Authentication failed, redirect back with error
        return redirect()->route('login')->withErrors([
            'wrong_credential' => 'The provided credentials do not match our records.',
        ])->withInput($request->except('password'));



        // Authentication failed, redirect back with error
        return back()->withErrors([
            'username' => 'The provided credentials do not match our records.',
        ])->withInput($request->except('password'));

    }

    // Dashboard
    public function Dashboard()
    {

    }

    public function profile()
    {

    }

    public function logout()
    {

    }

}
