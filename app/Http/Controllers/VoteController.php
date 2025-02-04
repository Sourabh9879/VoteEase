<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Candidate;
use App\Models\Vote;
use App\Models\User;

class VoteController extends Controller
{
    public function getVoteCount()
    {
        $candidates = Candidate::all(['id', 'name', 'vote_count']);
        return response()->json($candidates);
    }

    public function voteCandidate(Request $request, $id)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
        ]);

        $user = User::find($request->user_id);

        if ($user->role === 'admin') {
            return response()->json(['message' => 'Admin cannot vote.'], 403);
        }

        if ($user->is_voted) {
            return response()->json(['message' => 'User has already voted.'], 400);
        }

        $candidate = Candidate::find($id);

        Vote::create([
            'user_id' => $request->user_id,
            'candidate_id' => $id,
        ]);

        $candidate->increment('vote_count');
        $user->is_voted = true;
        $user->save();

        return response()->json(['message' => 'Vote successfully.']);
    }
}
