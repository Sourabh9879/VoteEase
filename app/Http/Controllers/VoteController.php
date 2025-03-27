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
        try {
            $candidate = Candidate::findOrFail($id);
            $user = Auth::user();

            // Check if the user has already voted
            if ($user->is_voted) {
                return redirect()->back()->with('error', 'You have already cast your vote. Each voter can only vote once.');
            }

            // Create vote record
            $vote = new Vote();
            $vote->user_id = $user->id;
            $vote->candidate_id = $candidate->id;
            $vote->save();

            // Update candidate vote count
            $candidate->increment('vote_count');

            // Update user's voting status
            $user->is_voted = true;
            $user->save();

            return redirect()->back()->with('success', "Thank you for voting! Your vote for {$candidate->name} has been recorded successfully.");

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while processing your vote. Please try again.');
        }
    }
}
