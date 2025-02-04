<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    function signup(Request $request){
        
        $request->validate([
            'name' => 'required|string|max:15',
            'aadhar_number' => 'required|numeric|digits:12|unique:users',
            'password' => 'required|string|min:8',
        ],[
            'aadhar_number.required' => 'Aadhar number is required.',
            'aadhar_number.numeric' => 'Aadhar number must be a numeric value.',
            'aadhar_number.digits' => 'Aadhar number must be exactly 12 digits.',
            'aadhar_number.unique' => 'This Aadhar number is already registered.',
            'password.min' => 'Password must me minimum 8 characters.',
        ]);

        $user = User::create([
            'name' => $request->name,
            'aadhar_number' => $request->aadhar_number,
            'password' => Hash::make($request->password),
        ]);

        return response()->json(['user' => $user], 201);
   
    }

    function login(Request $request){

        $request->validate([
            'aadhar_number' => 'required|numeric|digits:12',
            'password' => 'required|string|min:8',
        ],[
            'aadhar_number.required' => 'Aadhar number is required.',
            'aadhar_number.numeric' => 'Aadhar number must be a numeric value.',
            'aadhar_number.digits' => 'Aadhar number must be exactly 12 digits.',
            'password.min' => 'Password must me minimum 8 characters.',
        ]);

        $user = User::where('aadhar_number',$request->aadhar_number)->first();
        if($user && Hash::check($request->password, $user->password)){
            $success = $user->createToken('API Token')->plainTextToken;
            return ["user"=> $user,"token"=>$success , "msg"=>"You logged in successfully"];
        }else{
            return ['result'=>"User Not Found Register first"];
        }
    }

    function logout(Request $request){

        $user = $request->user();
        $user->tokens()->delete(); 
        
        return ["user"=>$user, "msg"=>"you logged out successfully"];
    
    }
}
