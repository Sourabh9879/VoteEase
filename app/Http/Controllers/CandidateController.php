<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Candidate;

class CandidateController extends Controller
{
    public function showCandidate()
    {
        $candidates = Candidate::all();
        return view('user.candidates', compact('candidates')); // Render a view for candidates
    }

    public function manageCandidate()
    {
        $candidates = Candidate::all();
        return view('admin.candidates', compact('candidates'));
    }

    public function editCandidate($id)
    {
        $candidate = Candidate::findOrFail($id);
        return view('admin.candidate-edit', compact('candidate'));
    }

    public function addCandidate(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'party' => 'required|string|max:255',
            'age' => 'required|integer|min:18',
        ]);

        $candidate = new Candidate();
        $candidate->name = $request->name;
        $candidate->party = $request->party;
        $candidate->age = $request->age;
        $candidate->save();

        return redirect()->route('admin.candidates')->with('success', 'Candidate added successfully.');
    }

    public function updateCandidate(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'party' => 'required|string|max:255',
            'age' => 'required|integer|min:18',
        ]);

        $candidate = Candidate::findOrFail($id);
        $candidate->name = $request->name;
        $candidate->party = $request->party;
        $candidate->age = $request->age;
        $candidate->save();

        return redirect()->route('admin.candidates')->with('success', 'Candidate updated successfully.');
    }

    public function deleteCandidate($id)
    {
        $candidate = Candidate::findOrFail($id);
        $candidate->delete();

        return redirect()->route('admin.candidates')->with('success', 'Candidate deleted successfully.');
    }
}
