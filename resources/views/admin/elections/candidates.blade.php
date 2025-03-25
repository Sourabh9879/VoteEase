@extends('layouts.app')

@section('title', 'Election Candidates - Voting System')

@section('content')
<div class="container">
    <div class="row mb-4">
        <div class="col-md-12">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <h2 class="mb-0"><i class="fas fa-user-tag me-2"></i>Election Candidates</h2>
                        <div>
                            <a href="{{ route('admin.elections.assign', $election->id) }}" class="btn btn-success me-2">
                                <i class="fas fa-plus me-2"></i>Assign Candidates
                            </a>
                            <a href="{{ route('admin.elections.show', $election->id) }}" class="btn btn-outline-secondary">
                                <i class="fas fa-arrow-left me-2"></i>Back
                            </a>
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
                    <h3 class="mb-3">{{ $election->title }}</h3>
                    <div class="d-flex justify-content-between align-items-center">
                        <p class="text-muted mb-0">
                            {{ $election->start_date->format('M d, Y') }} - {{ $election->end_date->format('M d, Y') }}
                        </p>
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
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Party</th>
                                    <th scope="col">Age</th>
                                    <th scope="col">Votes</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($candidates->isEmpty())
                                <tr>
                                    <td colspan="6" class="text-center py-4">
                                        <p>No candidates assigned to this election.</p>
                                        <a href="{{ route('admin.elections.assign', $election->id) }}" class="btn btn-sm btn-primary">
                                            <i class="fas fa-plus me-2"></i>Assign Candidates
                                        </a>
                                    </td>
                                </tr>
                                @else
                                    @foreach($candidates as $index => $candidate)
                                    <tr>
                                        <th scope="row">{{ $index + 1 }}</th>
                                        <td>{{ $candidate->name }}</td>
                                        <td>{{ $candidate->party }}</td>
                                        <td>{{ $candidate->age }}</td>
                                        <td>{{ $candidate->vote_count ?? 0 }}</td>
                                        <td>
                                            <a href="{{ route('admin.candidates.edit', $candidate->id) }}" class="btn btn-sm btn-outline-primary">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 