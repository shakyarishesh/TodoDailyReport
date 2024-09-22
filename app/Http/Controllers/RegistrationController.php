<?php

namespace App\Http\Controllers;

use App\Models\Register;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegistrationController extends Controller
{
    public function register(Request $request)
    {
        $reg = Register::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        if ($reg) {

            return redirect('/');
        } else {

            return view('register', ['message' => 'Registration Failed']);
        }
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Check if the email exists in the Register table
        $email = Register::where('email', $request->email)->first();

        if (!$email) {
            return view('login', ['message' => 'Email does not exist.']);
        }

        // Verify the password
        if (!password_verify($request->password, $email->password)) {
            return view('login', ['message' => 'Incorrect password.']);
        }

        // Successful login
        session()->put('login', $request->email);

        // Check if user exists in the User table
        $user = User::where('email', $request->email)->first();

        if ($user === null) {
            // Create a new user in the User table
            User::create([
                'name' => $email->first_name . " " . $email->last_name,
                'email' => $request->email,
                'password' => $email->password,  // Make sure this is hashed before saving!
            ]);
        }

        return redirect('/list');
    }
}
