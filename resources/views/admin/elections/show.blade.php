@extends('layouts.app')

@section('title', 'Election Details - Voting System')

@section('content')
<div class="container">
    <div class="row mb-4">
        <div class="col-md-12">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <h2 class="mb-0"><i class="fas fa-vote-yea me-2"></i>Election Details</h2>
                        <a href="{{ route('admin.elections.index') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-arrow-left me-2"></i>Back
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    <h3 class="card-title mb-4">{{ $election->title }}</h3>
                    
                    <div class="mb-4">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h5>Election Information</h5>
                            <span class="badge {{ $election->is_active ? 'bg-success' : 'bg-secondary' }}">
                                {{ $election->is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </div>
                        
                        <div class="row mb-3">
                            <div class="col-md-3 fw-bold">Duration:</div>
                            <div class="col-md-9">
                                {{ $election->start_date->format('M d, Y') }} - {{ $election->end_date->format('M d, Y') }}
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <div class="col-md-3 fw-bold">Description:</div>
                            <div class="col-md-9">
                                {{ $election->description }}
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <div class="col-md-3 fw-bold">Candidates:</div>
                            <div class="col-md-9">
                                <a href="{{ route('admin.elections.candidates', $election->id) }}" class="btn btn-sm btn-outline-primary">
                                    {{ $election->candidates->count() }} Candidates
                                </a>
                            </div>
                        </div>
                    </div>
                    
                    <div class="d-flex justify-content-between mt-4">
                        <a href="{{ route('admin.elections.edit', $election->id) }}" class="btn btn-primary">
                            <i class="fas fa-edit me-2"></i>Edit
                        </a>
                        <a href="{{ route('admin.elections.assign', $election->id) }}" class="btn btn-success">
                            <i class="fas fa-user-tag me-2"></i>Assign Candidates
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 