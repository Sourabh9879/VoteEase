@extends('layouts.app')

@section('title', $election->title)

@section('content')
<div class="container">
    <div class="row mb-4">
        <div class="col-md-12">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <h2 class="mb-0"><i class="fas fa-vote-yea me-2"></i>{{ $election->title }}</h2>
                        <a href="{{ route('user.elections') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-arrow-left me-2"></i>Back
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-md-12">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    <div class="row">
                        <div class="col-md-8">
                            <h4 class="mb-3">About This Election</h4>
                            <p>{{ $election->description }}</p>
                            
                            <div class="mb-4">
                                <h5 class="mb-2">Election Period</h5>
                                <p>
                                    <i class="far fa-calendar-alt me-2 text-primary"></i>
                                    {{ $election->start_date->format('F d, Y') }} - {{ $election->end_date->format('F d, Y') }}
                                </p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="alert {{ $election->end_date->isPast() ? 'alert-secondary' : 'alert-info' }}">
                                <h5>Status</h5>
                                <p class="mb-0">
                                    @if($election->end_date->isPast())
                                        <i class="fas fa-clock me-2"></i>This election has ended
                                    @elseif($election->start_date->isFuture())
                                        <i class="fas fa-clock me-2"></i>Coming soon
                                    @else
                                        <i class="fas fa-vote-yea me-2"></i>Open for voting
                                    @endif
                                </p>
                            </div>
                            
                            <div class="alert alert-light border mt-3">
                                <h5>Candidates</h5>
                                <p class="mb-0">{{ $candidates->count() }} candidates</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-md-12">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    <h4 class="mb-4"><i class="fas fa-users me-2"></i>Candidates</h4>
                    
                    @if($candidates->isEmpty())
                    <div class="text-center py-5">
                        <div class="display-1 text-muted mb-4">
                            <i class="fas fa-user-slash"></i>
                        </div>
                        <h4>No Candidates</h4>
                        <p class="text-muted">There are currently no candidates in this election.</p>
                    </div>
                    @else
                    <div class="row row-cols-1 row-cols-md-2 g-4">
                        @foreach($candidates as $candidate)
                        <div class="col">
                            <div class="card h-100">
                                <div class="card-body">
                                    <div class="d-flex align-items-center mb-3">
                                        <div class="flex-shrink-0 rounded-circle bg-primary bg-opacity-10 p-3 me-3">
                                            <i class="fas fa-user fa-2x text-primary"></i>
                                        </div>
                                        <div>
                                            <h5 class="card-title mb-0">{{ $candidate->name }}</h5>
                                            <p class="text-muted small mb-0">{{ $candidate->party }}</p>
                                        </div>
                                    </div>
                                   
                                    
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span class="badge bg-light text-dark">
                                            Age: {{ $candidate->age }}
                                        </span>
                                        
                                        <form action="{{ route('user.vote.candidate', $candidate->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-primary" 
                                                {{ Auth::user()->is_voted ? 'disabled' : '' }}>
                                                <i class="fas fa-vote-yea me-2"></i>Vote
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 