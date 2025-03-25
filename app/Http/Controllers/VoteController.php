<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Candidate;
use App\Models\Vote;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class VoteController extends Controller
{
    public function getVoteCount()
    {
        $candidates = Candidate::all(['id', 'name', 'party', 'vote_count']);
        
        // Get user data for calculating turnout
        $users = User::all();
        $voters = $users->where('role', 'voter')->count();
        $votesCast = $users->where('is_voted', true)->count();
        $turnoutPercentage = $voters > 0 ? number_format(($votesCast / $voters * 100), 1) : '0.0';
        
        // Sort candidates by vote count (descending)
        $candidates = $candidates->sortByDesc('vote_count');
        
        // Calculate total votes from candidates
        $totalVotes = $candidates->sum('vote_count');
        
        return view('admin.results', compact(
            'candidates',
            'voters',
            'votesCast',
            'turnoutPercentage',
            'totalVotes'
        ));
    }

    public function voteCandidate($id)
    {
        $candidate = Candidate::findOrFail($id);

        // Check if the user has already voted
        $hasVoted = Vote::where('user_id', Auth::id())->exists();
        if ($hasVoted) {
            return redirect()->back()->with('error', 'You have already voted.');
        }

        $vote = new Vote();
        $vote->user_id = Auth::id();
        $vote->candidate_id = $candidate->id;
        $vote->save();

        $candidate->increment('vote_count');

        return redirect()->back()->with('success', 'Your vote has been cast successfully.');
    }
}
