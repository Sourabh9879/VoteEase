@extends('layouts.app')

@section('title', 'Available Elections - Voting System')

@section('content')
<div class="container">
    <div class="row mb-4">
        <div class="col-md-12">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    <h2 class="mb-3"><i class="fas fa-vote-yea me-2"></i>Available Elections</h2>
                    <p class="text-muted">
                        View all active election campaigns and cast your vote.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        @if($elections->isEmpty())
        <div class="col-md-12">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4 text-center">
                    <div class="py-5">
                        <div class="display-1 text-muted mb-4">
                            <i class="fas fa-info-circle"></i>
                        </div>
                        <h4>No Active Elections</h4>
                        <p class="text-muted">There are currently no active elections available for voting.</p>
                    </div>
                </div>
            </div>
        </div>
        @else
            @foreach($elections as $election)
            <div class="col-md-6 mb-4">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center mb-3">
                            <div class="flex-shrink-0 rounded-circle bg-primary bg-opacity-10 p-3 me-3">
                                <i class="fas fa-vote-yea fa-2x text-primary"></i>
                            </div>
                            <div>
                                <h4 class="card-title mb-0">{{ $election->title }}</h4>
                                <p class="text-muted small mb-0">
                                    {{ $election->start_date->format('M d') }} - {{ $election->end_date->format('M d, Y') }}
                                </p>
                            </div>
                        </div>
                        
                        <p class="card-text mb-4">
                            {{ \Illuminate\Support\Str::limit($election->description, 150) }}
                        </p>
                        
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <span class="badge bg-info">
                                    {{ $election->candidates->count() }} Candidates
                                </span>
                            </div>
                            <a href="{{ route('user.elections.view', $election->id) }}" class="btn btn-primary">
                                View Details
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        @endif
    </div>
</div>
@endsection 