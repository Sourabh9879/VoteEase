@extends('layouts.app')

@section('title', 'Dashboard - Voting System')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 mb-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center">
                        <div class="display-1 text-primary me-4">
                            <i class="fas fa-user-circle"></i>
                        </div>
                        <div>
                            <h2 class="mb-1">Welcome, {{ auth()->user()->name }}</h2>
                            <p class="text-muted mb-0">Aadhar Number: {{ substr_replace(auth()->user()->aadhar_number, 'XXXX-XXXX-', 0, 8) }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 mb-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body p-4">
                    <h3 class="card-title">Voting Status</h3>
                    <div class="mt-4 text-center">
                        @if(auth()->user()->is_voted)
                            <div class="display-1 text-success mb-3">
                                <i class="fas fa-check-circle"></i>
                            </div>
                            <h5 class="text-success">You have already voted</h5>
                            <p class="text-muted">Thank you for participating in the election</p>
                        @else
                            <div class="display-1 text-warning mb-3">
                                <i class="fas fa-exclamation-circle"></i>
                            </div>
                            <h5 class="text-warning">You have not voted yet</h5>
                            <p class="text-muted mb-4">Please cast your vote to participate in the election</p>
                            <a href="{{ route('user.elections') }}" class="btn btn-primary">
                                <i class="fas fa-vote-yea me-2"></i>Cast Your Vote
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 mb-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body p-4">
                    <h3 class="card-title">Election Information</h3>
                    <div class="mt-3">
                        <div class="d-flex align-items-center mb-3">
                            <div class="display-6 text-primary me-3">
                                <i class="fas fa-info-circle"></i>
                            </div>
                            <div>
                                <h5 class="mb-0">Active Elections</h5>
                                <p class="text-muted mb-0">View all current elections</p>
                            </div>
                        </div>
                        
                     
                        <div class="d-flex align-items-center">
                            <div class="display-6 text-primary me-3">
                                <i class="fas fa-chart-pie"></i>
                            </div>
                            <div>
                                <h5 class="mb-0">Results</h5>
                                <p class="text-muted mb-0">View current election results</p>
                            </div>
                        </div>
                        
                        <div class="mt-4 d-flex">
                            <a href="{{ route('user.elections') }}" class="btn btn-outline-primary me-2">
                                <i class="fas fa-vote-yea me-2"></i>View Elections
                            </a>
                            <a href="{{ route('user.results') }}" class="btn btn-outline-success">
                                <i class="fas fa-chart-bar me-2"></i>View Results
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 