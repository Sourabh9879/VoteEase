@extends('layouts.app')

@section('title', 'Vote for Candidates - Voting System')

@section('content')
<div class="container">
    <div class="row mb-4">
        <div class="col-md-12">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    <h2 class="mb-3"><i class="fas fa-vote-yea me-2"></i>Vote for Candidates</h2>
                    <p class="text-muted">
                        Cast your vote for your preferred candidate. Remember, you can only vote once.
                    </p>
                    @if(auth()->user()->is_voted)
                        <div class="alert alert-info mb-0">
                            <i class="fas fa-info-circle me-2"></i>You have already cast your vote. Thank you for participating!
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        @if($candidates->isEmpty())
            <div class="col-md-12">
                <div class="alert alert-info">
                    <i class="fas fa-info-circle me-2"></i>No candidates are available for voting at this time.
                </div>
            </div>
        @else
            @foreach($candidates as $candidate)
                <div class="col-md-4 mb-4">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body p-4">
                            <div class="text-center mb-3">
                                <div class="rounded-circle bg-primary bg-opacity-10 p-3 d-inline-block">
                                    <i class="fas fa-user fa-2x text-primary"></i>
                                </div>
                                <h4 class="mt-3">{{ $candidate->name }}</h4>
                                <p class="text-muted">{{ $candidate->party }}</p>
                            </div>
                            <div class="d-grid">
                                @if(auth()->user()->is_voted)
                                    <button class="btn btn-secondary" disabled>
                                        <i class="fas fa-check-circle me-2"></i>Already Voted
                                    </button>
                                @else
                                    <form action="{{ route('user.vote.candidate', $candidate->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to vote for {{ $candidate->name }}? This action cannot be undone.');">
                                        @csrf
                                        <button type="submit" class="btn btn-primary w-100">
                                            <i class="fas fa-vote-yea me-2"></i>Vote for {{ $candidate->name }}
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
</div>
@endsection 