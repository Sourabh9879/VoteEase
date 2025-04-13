<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'candidate_id'
    ];
    
    /**
     * Get the user that owns the vote.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    /**
     * Get the candidate that owns the vote.
     */
    public function candidate()
    {
        return $this->belongsTo(Candidate::class);
    }
}
