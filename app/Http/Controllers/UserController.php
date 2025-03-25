<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'aadhar_number' => 'required|numeric|digits:12|unique:users',
            'password' => 'required|string|min:8',
        ]);

        $user = User::create([
            'name' => $request->name,
            'aadhar_number' => $request->aadhar_number,
            'password' => Hash::make($request->password),
        ]);

        return redirect('/login')->with('success', 'Registration successful');
    }

    public function login(Request $request)
    {
        $request->validate([
            'aadhar_number' => 'required|numeric|digits:12',
            'password' => 'required|string|min:8',
        ], [
            'aadhar_number.required' => 'Aadhar number is required.',
            'aadhar_number.numeric' => 'Aadhar number must be a numeric value.',
            'aadhar_number.digits' => 'Aadhar number must be exactly 12 digits.',
            'password.min' => 'Password must be at least 8 characters.',
        ]);

        $credentials = $request->only('aadhar_number', 'password');

        if (Auth::attempt($credentials)) {
            
            // Redirect based on user role
            if (Auth::user()->role === 'admin') {
                return redirect()->route('admin.dashboard')->with('success', 'Login successful.');
            } else {
                return redirect()->route('user.dashboard')->with('success', 'Login successful.');
            }
        }

        return redirect()->back()->with('error', 'Invalid credentials. Please try again.');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login')->with('success', 'Logged out successfully.');
    }

    public function showUser()
    {
        $users = User::where('role','voter')->get();
        return view('admin.users', compact('users'));
    }
    
}
