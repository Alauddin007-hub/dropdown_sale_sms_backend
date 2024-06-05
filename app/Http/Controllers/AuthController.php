<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    // Show the registration form
    public function index()
    {
        return view('backend.auth.register');
    }

    // Handle the registration request
    public function registration(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email|max:255',
            'password' => 'required|string|min:6|confirmed',
        ]);

        // Create a new user instance
        $user = new User;
        $user->name = trim($request->name);
        $user->email = trim($request->email);
        $user->password = Hash::make($request->password);
        $user->user_type = $request->user_type ?? 3; // Assuming 3 is for Normal User by default
        $user->remember_token = Str::random(50);
        $user->save();

        // Redirect to home with success message
        return redirect('/')->with('success', 'User Registration Successful');
    }

    // Show the login form
    public function create()
    {
        return view('backend.auth.login');
    }

    // Handle the login request
    public function login(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);

        // Attempt to authenticate the user
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password], true))
        {
            // Redirect based on user type
            switch (Auth::user()->user_type_id) {
                case 1:
                    // Super Admin
                    return redirect()->route('dashboard');
                case 2:
                    // Admin
                    return redirect()->route('dashboard');
                case 3:
                    // Normal User
                    return redirect()->route('dashboard');
                default:
                    // Unknown user type, log out and show error
                    Auth::logout();
                    return redirect('/')->with('error', 'User type not recognized. Please contact support.');
            }
        }
        else
        {
            // Authentication failed, redirect back with error message
            return redirect()->back()->with('error', 'Incorrect credentials. Please try again.');
        }
    }

    // Show the forgot password form
    public function forgot()
    {
        return view('backend.auth.forgot_password');
    }

    // Handle the logout request
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
