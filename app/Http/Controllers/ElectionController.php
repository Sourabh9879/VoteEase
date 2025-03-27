<?php

namespace App\Http\Controllers;

use App\Models\Election;
use App\Models\Candidate;
use Illuminate\Http\Request;

class ElectionController extends Controller
{
    /**
     * Display a listing of the elections.
     */
    public function index()
    {
        $elections = Election::all();
        return view('admin.elections.index', compact('elections'));
    }

    /**
     * Show the form for creating a new election.
     */
    public function create()
    {
        return view('admin.elections.create');
    }

    /**
     * Store a newly created election in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'is_active' => 'boolean',
        ]);

        $election = Election::create($request->all());

        return redirect()->route('admin.elections.index')
            ->with('success', 'Election created successfully.');
    }

    /**
     * Display the specified election.
     */
    public function show($id)
    {
        $election = Election::findOrFail($id);
        return view('admin.elections.show', compact('election'));
    }

    /**
     * Show the form for editing the specified election.
     */
    public function edit($id)
    {
        $election = Election::findOrFail($id);
        return view('admin.elections.edit', compact('election'));
    }

    /**
     * Update the specified election in storage.
     */
    public function update(Request $request, $id)
    {
        $election = Election::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'is_active' => 'boolean',
        ]);

        $election->update($request->all());

        return redirect()->route('admin.elections.index')
            ->with('success', 'Election updated successfully.');
    }

    /**
     * Remove the specified election from storage.
     */
    public function destroy($id)
    {
        $election = Election::findOrFail($id);
        $election->delete();

        return redirect()->route('admin.elections.index')
            ->with('success', 'Election deleted successfully.');
    }
    
    /**
     * Display the candidates associated with the election.
     */
    public function showCandidates($id)
    {
        $election = Election::findOrFail($id);
        $candidates = $election->candidates;
        return view('admin.elections.candidates', compact('election', 'candidates'));
    }
    
    /**
     * Show the form for assigning candidates to an election.
     */
    public function assignCandidatesForm($id)
    {
        $election = Election::findOrFail($id);
        $candidates = Candidate::where('election_id', null)
            ->orWhere('election_id', $election->id)
            ->get();
        $assignedCandidates = $election->candidates->pluck('id')->toArray();
        
        return view('admin.elections.assign-candidates', compact('election', 'candidates', 'assignedCandidates'));
    }
    
    /**
     * Assign candidates to an election.
     */
    public function assignCandidates(Request $request, $id)
    {
        $election = Election::findOrFail($id);

        $request->validate([
            'candidates' => 'array',
            'candidates.*' => 'exists:candidates,id',
        ]);
        
        // First, remove all candidates from this election
        Candidate::where('election_id', $election->id)
            ->update(['election_id' => null]);
        
        // Then assign the selected candidates to this election
        if ($request->has('candidates')) {
            Candidate::whereIn('id', $request->candidates)
                ->update(['election_id' => $election->id]);
        }
        
        return redirect()->route('admin.elections.candidates', $election->id)
            ->with('success', 'Candidates assigned successfully.');
    }
    
    /**
     * Show elections for users.
     */
    public function userViewElections()
    {
        $elections = Election::where('is_active', true)
            ->orderBy('start_date', 'desc')
            ->get();
            
        return view('user.elections', compact('elections'));
    }
    
    /**
     * Show election details for users.
     */
    public function userViewElection($id)
    {
        $election = Election::findOrFail($id);
        $candidates = $election->candidates;
        return view('user.election-details', compact('election', 'candidates'));
    }
}
