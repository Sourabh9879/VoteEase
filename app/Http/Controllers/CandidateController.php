<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Candidate;
use App\Models\Vote;
use App\Models\User;

class CandidateController extends Controller
{
   function showCandidate(){
    $candidates = Candidate::all();
    return response()->json($candidates);
   }

   function addCandidate(Request $request){
         $request->validate([
            'name'=> 'required|string|max:20',
            'party'=> 'required|string|max:20',
            'age'=> 'required|integer|min:18',
         ],[
            'name.required' => 'Name is required.',
            'party.required' => 'Party name is required.',
            'age.required' => 'Party name is required.',
            'age.min' => 'age can not be less than 18.',
            'age.integer' => 'age can be only in number.',
        ]);

        $candidate = Candidate::create($request->all());
        return response()->json($candidate);
   }

   function updateCandidate(Request $request, $id){
    $request->validate([
        'name' => 'sometimes|required|string|max:20',
        'party' => 'sometimes|required|string|max:20',
        'age' => 'sometimes|required|integer|min:18',
    ],[
        'name.required' => 'Name is required.',
        'party.required' => 'Party name is required.',
        'age.required' => 'Party name is required.',
        'age.min' => 'age can not be less than 18.',
        'age.integer' => 'age can be only in number.',
    ]);

    $candidate = Candidate::find($id);
    if($candidate){
        if ($request->has('name')) {
            $candidate->name = $request->name;
        }
        if ($request->has('party')) {
            $candidate->party = $request->party;
        }
        if ($request->has('age')) {
            $candidate->age = $request->age;
        }
        $result = $candidate->save();
        return response()->json($candidate);
    }
    return response()->json(['msg' => 'Candidate updation failed'], 404);
}

      function deleteCandidate($id){
         $candidate = Candidate::find($id);
         if($candidate->delete()){
         return response()->json(['message'=>'candidate deleted successfully']);
         }
         return response()->json(['message'=>'candidate deletion failed']);
      }

   
}
