<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;

class Candidate extends Model
{
    use HasFactory, Notifiable, HasApiTokens;

    protected $fillable = [
        'name', 'party', 'age', 'vote_count', 'election_id', 'description'
    ];

    /**
     * Get the election that owns the candidate.
     */
    public function election()
    {
        return $this->belongsTo(Election::class);
    }

    /**
     * Get the votes for the candidate.
     */
    public function votes()
    {
        return $this->hasMany(Vote::class);
    }
}
