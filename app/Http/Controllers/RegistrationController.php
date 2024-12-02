<?php

namespace App\Http\Controllers;

use App\Models\Register;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegistrationController extends Controller
{
    // public function register(Request $request)
    // {
    //     try {
    //         $validate_data = $request->validate([
    //             'first_name' => 'required|string',
    //             'last_name' => 'required|string',
    //             'email' => 'required|email|unique:registers',
    //             'password' => 'required|min:8',
    //             'password_confirmation' => 'required|same:password'
    //         ]);
            
    //         $validate_data['password'] = Hash::make($request->password);
    //         $reg = Register::create($validate_data);

    //         if ($request->expectsJson()) {
    //             return response()->json([
    //                 'success' => true,
    //                 'message' => 'User created successfully',
    //                 'data' => $reg,
    //             ]);
    //         } else {
    //             return redirect('/list')->with('success', 'User created successfully');
    //         }
    //     } catch (\Exception $e) {
    //         if ($request->expectsJson()) {
    //             return response()->json([
    //                 'success' => false,
    //                 'error' => 'Registration failed. Please try again.',
    //                 'details' => $e->getMessage(),
    //             ], 500);
    //         } else {
    //             return redirect('/')->with('error', 'Registration failed. Please try again.');
    //         }
    //     }
    // }


    public function register(Request $request)
    {
        try {
            $validate_data = $request->validate([
                'first_name' => 'required|string',
                'last_name' => 'required|string',
                'email' => 'required|email|unique:registers',
                'password' => 'required|min:4',
                'password_confirmation' => 'required|same:password'
            ]);
            
            $validate_data['password'] = Hash::make($request->password);
            $validate_data['name'] = $validate_data['first_name'] . " " . $validate_data['last_name'];
            
            $user = User::create($validate_data);

            if ($request->expectsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'User created successfully',
                    'data' => $user,
                ]);
            } else {
                return redirect('/list')->with('success', 'User created successfully');
            }
        } catch (\Exception $e) {
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'error' => 'Registration failed. Please try again.',
                    'details' => $e->getMessage(),
                ], 500);
            } else {
                return redirect('/')->with('error', 'Registration failed. Please try again.');
            }
        }
    }

    public function login(Request $request)
    {
        $validate_data = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Check if the email exists in the Register table
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            if ($request->expectsJson()) {
                return response()->json(['error' => 'Email does not exist']);
            } else {
                return view('login', ['message' => 'Email does not exist.']);
            }
        }

        if (!Auth::attempt($validate_data)) {
            if ($request->expectsJson()) {

                return response()->json([
                    'success' => false,
                    'error' => 'Incorrect Credentials'
                ]);
            } else {
                return view('login', ['message' => 'Incorrect password.']);
            }
        }

        $token = $user->createToken('access_token')->plainTextToken;
        // Verify the password
        // if (!password_verify($request->password, $email->password)) {
        //     return view('login', ['message' => 'Incorrect password.']);
        // }

        // Successful login
        session()->put('login', $request->email);

       

        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'access_token' => $token,
                'token_type' => 'bearer'
            ]);
        } else {
            return redirect('/list');
        }
    }

    public function logout()
    {
        Auth::logout();
        session()->invalidate();
        return redirect()->route('login');
    }
}
