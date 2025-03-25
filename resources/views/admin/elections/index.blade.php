@extends('layouts.app')

@section('title', 'Manage Elections - Voting System')

@section('content')
<div class="container">
    <div class="row mb-4">
        <div class="col-md-12">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <h2 class="mb-0"><i class="fas fa-vote-yea me-2"></i>Manage Elections</h2>
                        <a href="{{ route('admin.elections.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus me-2"></i>Create New Election
                        </a>
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
                                    <th scope="col">Title</th>
                                    <th scope="col">Date Range</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Candidates</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($elections->isEmpty())
                                <tr>
                                    <td colspan="6" class="text-center py-4">
                                        <p>No elections found. Please create an election.</p>
                                    </td>
                                </tr>
                                @else
                                    @foreach($elections as $index => $election)
                                    <tr>
                                        <th scope="row">{{ $index + 1 }}</th>
                                        <td>{{ $election->title }}</td>
                                        <td>{{ $election->start_date->format('M d') }} - {{ $election->end_date->format('M d, Y') }}</td>
                                        <td>
                                            <span class="badge {{ $election->is_active ? 'bg-success' : 'bg-secondary' }}">
                                                {{ $election->is_active ? 'Active' : 'Inactive' }}
                                            </span>
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.elections.candidates', $election->id) }}" class="btn btn-sm btn-outline-primary">
                                                {{ $election->candidates->count() }} Candidates
                                            </a>
                                        </td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('admin.elections.show', $election->id) }}" class="btn btn-sm btn-outline-info me-1">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="{{ route('admin.elections.edit', $election->id) }}" class="btn btn-sm btn-outline-primary me-1">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <a href="{{ route('admin.elections.assign', $election->id) }}" class="btn btn-sm btn-outline-success me-1">
                                                    <i class="fas fa-user-tag"></i>
                                                </a>
                                                <button type="button" class="btn btn-sm btn-outline-danger" onclick="deleteElection('{{ $election->id }}', '{{ $election->title }}')">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </div>
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

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteElectionModal" tabindex="-1" aria-labelledby="deleteElectionModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteElectionModalLabel">Confirm Deletion</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete the election <strong id="delete-election-name"></strong>?</p>
                <p class="text-danger">This action cannot be undone!</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <form id="delete-form" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete Election</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    function deleteElection(id, title) {
        // Set form action
        document.getElementById('delete-form').action = '{{ url("/admin/elections") }}/' + id;
        
        // Set election title
        document.getElementById('delete-election-name').textContent = title;
        
        // Show modal
        var modal = new bootstrap.Modal(document.getElementById('deleteElectionModal'));
        modal.show();
    }
</script>
@endsection 