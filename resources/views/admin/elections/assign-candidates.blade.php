@extends('layouts.app')

@section('title', 'Assign Candidates')

@section('content')
<div class="container">
    <div class="row mb-4">
        <div class="col-md-12">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <h2 class="mb-0"><i class="fas fa-user-tag me-2"></i>Assign Candidates</h2>
                        <a href="{{ route('admin.elections.candidates', $election->id) }}" class="btn btn-outline-secondary">
                            <i class="fas fa-arrow-left me-2"></i>Back to Candidates
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
                    <h3 class="mb-3">{{ $election->title }}</h3>
                    <p class="text-muted">
                        {{ $election->start_date->format('M d, Y') }} - {{ $election->end_date->format('M d, Y') }}
                    </p>
                    
                    <div class="mb-3">
                        <span class="badge {{ $election->is_active ? 'bg-success' : 'bg-secondary' }}">
                            {{ $election->is_active ? 'Active' : 'Inactive' }}
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <div class="row">
        <div class="col-md-12">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    <form action="{{ route('admin.elections.assign.post', $election->id) }}" method="POST">
                        @csrf
                        
                        <div class="mb-4">
                            <h5 class="border-bottom pb-2 mb-3">Select Candidates</h5>
                            <p class="text-muted mb-3">Check the candidates that you want to assign to this election.</p>
                            
                            @if($candidates->isEmpty())
                                <div class="alert alert-info">
                                    <i class="fas fa-info-circle me-2"></i>No candidates available to assign. Please create candidates first.
                                </div>
                                <div class="mt-3">
                                    <a href="{{ route('admin.candidates') }}" class="btn btn-primary">
                                        <i class="fas fa-plus me-2"></i>Create Candidates
                                    </a>
                                </div>
                            @else
                                <div class="row row-cols-1 row-cols-md-2 g-4">
                                    @foreach($candidates as $candidate)
                                        <div class="col">
                                            <div class="card h-100 {{ in_array($candidate->id, $assignedCandidates) ? 'border-primary' : '' }}">
                                                <div class="card-body">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" name="candidates[]" 
                                                            value="{{ $candidate->id }}" id="candidate-{{ $candidate->id }}"
                                                            {{ in_array($candidate->id, $assignedCandidates) ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="candidate-{{ $candidate->id }}">
                                                            <h5 class="card-title">{{ $candidate->name }}</h5>
                                                        </label>
                                                    </div>
                                                    <p class="card-text">
                                                        <strong>Party:</strong> {{ $candidate->party }}<br>
                                                        <strong>Age:</strong> {{ $candidate->age }}
                                                    </p>
                                                    <p class="card-text small text-muted">
                                                        {{ \Illuminate\Support\Str::limit($candidate->description, 100) }}
                                                    </p>
                                                </div>
                                                <div class="card-footer bg-transparent">
                                                    <small class="text-muted">
                                                        @if($candidate->election_id && $candidate->election_id != $election->id)
                                                            <span class="text-danger">Assigned to another election</span>
                                                        @elseif(in_array($candidate->id, $assignedCandidates))
                                                            <span class="text-primary">Currently assigned to this election</span>
                                                        @else
                                                            <span class="text-success">Available</span>
                                                        @endif
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                
                                <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
                                    <a href="{{ route('admin.elections.candidates', $election->id) }}" class="btn btn-outline-secondary me-md-2">Cancel</a>
                                    <button type="submit" class="btn btn-primary">Save Assignments</button>
                                </div>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 