@extends('layouts.app')

@section('title', 'Admin Dashboard - Voting System')

@section('content')
<div class="container">
    <div class="row mb-4">
        <div class="col-md-12">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    <h2 class="mb-3"><i class="fas fa-tachometer-alt me-2"></i>Admin Dashboard</h2>
                    <p class="text-muted">
                        Welcome to the admin panel. Manage candidates, view users, and monitor voting results.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Summary Cards -->
        <div class="col-md-4 mb-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0 rounded-circle bg-primary bg-opacity-10 p-3">
                            <i class="fas fa-users fa-2x text-primary"></i>
                        </div>
                        <div class="ms-3">
                            <h5 class="card-title">Total Users</h5>
                            <h3 class="mb-0" id="total-users">{{ $totalUsers }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0 rounded-circle bg-success bg-opacity-10 p-3">
                            <i class="fas fa-user-check fa-2x text-success"></i>
                        </div>
                        <div class="ms-3">
                            <h5 class="card-title">Users Voted</h5>
                            <h3 class="mb-0" id="users-voted">{{ $usersVoted }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0 rounded-circle bg-warning bg-opacity-10 p-3">
                            <i class="fas fa-user-tag fa-2x text-warning"></i>
                        </div>
                        <div class="ms-3">
                            <h5 class="card-title">Candidates</h5>
                            <h3 class="mb-0" id="total-candidates">{{ $totalCandidates }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Quick Actions -->
        <div class="col-md-6 mb-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body p-4">
                    <h4 class="card-title mb-4">Quick Actions</h4>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <a href="{{ url('admin/candidates') }}" class="btn btn-primary d-block py-3">
                                <i class="fas fa-user-tag me-2"></i>Manage Candidates
                            </a>
                        </div>
                        <div class="col-md-6">
                            <a href="{{ url('admin/users') }}" class="btn btn-secondary d-block py-3">
                                <i class="fas fa-users me-2"></i>View Users
                            </a>
                        </div>
                        <div class="col-md-6 mt-3">
                            <a href="{{ url('admin/elections') }}" class="btn btn-warning d-block py-3 text-white">
                                <i class="fas fa-vote-yea me-2"></i>Manage Elections
                            </a>
                        </div>
                        <div class="col-md-6 mt-3">
                            <a href="{{ url('admin/results') }}" class="btn btn-success d-block py-3">
                                <i class="fas fa-chart-bar me-2"></i>View Results
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Voting Statistics -->
        <div class="col-md-6 mb-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body p-4">
                    <h4 class="card-title mb-4">Voting Statistics</h4>
                    <div>
                        <div class="mb-4">
                            <h5 class="mb-3">Voter Participation</h5>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="fw-bold">{{ $usersVoted }} of {{ $totalUsers }} users have voted</span>
                            </div>
                        </div>
                        <div class="mb-3">
                            <h5 class="mb-3">Leading Candidate</h5>
                            <div>
                                <div class="d-flex align-items-center mb-2">
                                    <div class="flex-shrink-0 rounded-circle bg-primary bg-opacity-10 p-2 me-3">
                                    </div>
                                    <div>
                                        <h5 class="mb-0">
                                            @if($leadingCandidate)
                                                {{ $leadingCandidate->name }}
                                            @else
                                                No votes yet
                                            @endif
                                        </h5>
                                        <small class="text-muted">
                                            @if($leadingCandidate && isset($leadingCandidate->party))
                                                {{ $leadingCandidate->party }}
                                            @endif
                                        </small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 