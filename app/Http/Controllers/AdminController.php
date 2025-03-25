<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Candidate;
use App\Models\Vote;

class AdminController extends Controller
{
    /**
     * Display the admin dashboard with all necessary data.
     *
     * @return \Illuminate\Http\Response
     */
    public function dashboard()
    {
        // Get all users
        $users = User::all();
        $totalUsers = $users->count();
        $usersVoted = $users->where('is_voted', true)->count();
        
        // Get all candidates with vote count
        $candidates = Candidate::all();
        $totalCandidates = $candidates->count();
        
        // Calculate voter participation
        $voterParticipationPercentage = 0;
        if ($totalUsers > 0) {
            $voterParticipationPercentage = number_format(($usersVoted / $totalUsers) * 100, 1);
        }
        
        // Get leading candidate
        $leadingCandidate = null;
        $leadingCandidateVotes = 0;
        $leadingCandidatePercentage = 0;
        
        if ($candidates->isNotEmpty()) {
            $leadingCandidate = $candidates->sortByDesc('vote_count')->first();
            $leadingCandidateVotes = $leadingCandidate->vote_count;
            
            $totalVotes = $candidates->sum('vote_count');
            if ($totalVotes > 0) {
                $leadingCandidatePercentage = number_format(($leadingCandidateVotes / $totalVotes) * 100, 1);
            }
        }
        
        return view('admin.dashboard', compact(
            'totalUsers',
            'usersVoted',
            'totalCandidates',
            'voterParticipationPercentage',
            'leadingCandidate',
            'leadingCandidateVotes',
            'leadingCandidatePercentage'
        ));
    }

    /**
     * Export election results.
     *
     * @return \Illuminate\Http\Response
     */
  
} 