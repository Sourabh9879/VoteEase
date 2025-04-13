@extends('layouts.app')

@section('title', 'Assign Candidates')

@section('content')
<div class="container">
    <div class="row mb-4">
        <div class="col-md-12">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <h2 class="mb-0"><i class="fas fa-users me-2"></i>Assign Candidates</h2>
                        <a href="{{ route('admin.elections.candidates', $election->id) }}" class="btn btn-outline-secondary">
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

    @if($unassignedCandidates->isEmpty())
    <div class="row">
        <div class="col-md-12">
            <div class="alert alert-info">
                All candidates have been assigned. <a href="{{ route('admin.candidates.create') }}" class="alert-link">Create a new candidate</a>.
            </div>
        </div>
    </div>
    @else
    <form action="{{ route('admin.elections.addCandidates', $election->id) }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-4">
                        <h4 class="mb-3">Available Candidates</h4>
                        <p class="text-muted mb-4">Select candidates to assign to this election</p>

                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead class="table-light">
                                    <tr>
                                        <th scope="col" width="50">
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" id="selectAll">
                                                <label class="form-check-label" for="selectAll"></label>
                                            </div>
                                        </th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Party</th>
                                        <th scope="col">Age</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($unassignedCandidates as $candidate)
                                    <tr>
                                        <td>
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" name="candidates[]" value="{{ $candidate->id }}" id="candidate{{ $candidate->id }}">
                                                <label class="form-check-label" for="candidate{{ $candidate->id }}"></label>
                                            </div>
                                        </td>
                                        <td>{{ $candidate->name }}</td>
                                        <td>{{ $candidate->party }}</td>
                                        <td>{{ $candidate->age }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="mt-4 text-end">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-plus me-2"></i>Assign Selected
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
    @endif
</div>

@endsection

@section('scripts')
<script>
    // Select all checkboxes
    document.getElementById('selectAll').addEventListener('change', function() {
        var checkboxes = document.querySelectorAll('input[name="candidates[]"]');
        checkboxes.forEach(function(checkbox) {
            checkbox.checked = document.getElementById('selectAll').checked;
        });
    });
</script>
@endsection 