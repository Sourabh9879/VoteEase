@extends('layouts.app')

@section('title', 'Election Results - Voting System')

@section('styles')
<style>
    .card {
        transition: none !important;
        transform: none !important;
    }
    .card:hover {
        transform: none !important;
    }
</style>
@endsection

@section('content')
<div class="container">
    <div class="row mb-4">
        <div class="col-md-12">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <h2 class="mb-0"><i class="fas fa-chart-bar me-2"></i>Election Results</h2>
                        <div>
                            <a href="{{ route('admin.results') }}" class="btn btn-outline-primary me-2">
                                <i class="fas fa-sync-alt me-1"></i> Refresh
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="results-container">
        <!-- Summary Cards -->
        <div class="row mb-4">
            <div class="col-md-4 mb-4">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0 rounded-circle bg-primary bg-opacity-10 p-3">
                                <i class="fas fa-users fa-2x text-primary"></i>
                            </div>
                            <div class="ms-3">
                                <h5 class="card-title">Total Voters</h5>
                                <h3 class="mb-0">{{ $voters }}</h3>
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
                                <i class="fas fa-vote-yea fa-2x text-success"></i>
                            </div>
                            <div class="ms-3">
                                <h5 class="card-title">Total Votes Cast</h5>
                                <h3 class="mb-0">{{ $votesCast }}</h3>
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
                                <i class="fas fa-poll fa-2x text-warning"></i>
                            </div>
                            <div class="ms-3">
                                <h5 class="card-title">Voter Turnout</h5>
                                <h3 class="mb-0">{{ $votesCast }} of {{ $voters }}</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Detailed Results -->
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-4">
                        <h4 class="card-title mb-4">Detailed Results</h4>
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead class="table-light">
                                    <tr>
                                        <th scope="col">Rank</th>
                                        <th scope="col">Candidate</th>
                                        <th scope="col">Party</th>
                                        <th scope="col">Votes</th>
                                        <th scope="col">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if($candidates->isEmpty())
                                    <tr>
                                        <td colspan="5" class="text-center py-4">
                                            <p>No voting data available yet.</p>
                                        </td>
                                    </tr>
                                    @else
                                        @foreach($candidates as $index => $candidate)
                                        <tr>
                                            <th scope="row">{{ $index + 1 }}</th>
                                            <td>{{ $candidate->name }}</td>
                                            <td>{{ $candidate->party }}</td>
                                            <td>{{ $candidate->vote_count }}</td>
                                            <td>
                                                @if($index === 0 && $candidate->vote_count > 0)
                                                    <span class="badge bg-success">Leading</span>
                                                @elseif($candidate->vote_count > 0)
                                                    <span class="badge bg-primary">Active</span>
                                                @else
                                                    <span class="badge bg-secondary">No votes</span>
                                                @endif
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
</div>
@endsection 