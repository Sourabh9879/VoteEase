<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Election extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'start_date',
        'end_date',
        'is_active'
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'is_active' => 'boolean',
    ];

    /**
     * Get the candidates for the election.
     */
    public function candidates()
    {
        return $this->hasMany(Candidate::class);
    }
    
    /**
     * Get all votes related to this election through candidates.
     */
    public function votes()
    {
        return $this->hasManyThrough(Vote::class, Candidate::class);
    }
} 