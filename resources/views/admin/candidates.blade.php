@extends('layouts.app')

@section('title', 'Manage Candidates - Voting System')

@section('content')
<div class="container">
    <div class="row mb-4">
        <div class="col-md-12">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <h2 class="mb-0"><i class="fas fa-user-tag me-2"></i>Manage Candidates</h2>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addCandidateModal">
                            <i class="fas fa-plus me-2"></i>Add Candidate
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="candidates-container">
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
                                    <p>No candidates found. Please add a candidate.</p>
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
                                        <a href="{{ route('admin.candidates.edit', $candidate->id) }}" class="btn btn-sm btn-outline-primary me-1">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <button type="button" class="btn btn-sm btn-outline-danger" onclick="deleteCandidate('{{ $candidate->id }}', '{{ $candidate->name }}')">
                                            <i class="fas fa-trash"></i>
                                        </button>
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

<!-- Add Candidate Modal -->
<div class="modal fade" id="addCandidateModal" tabindex="-1" aria-labelledby="addCandidateModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addCandidateModalLabel">Add New Candidate</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('admin.candidates.add') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name" required maxlength="20">
                    </div>
                    <div class="mb-3">
                        <label for="party" class="form-label">Party</label>
                        <input type="text" class="form-control" id="party" name="party" required maxlength="20">
                    </div>
                    <div class="mb-3">
                        <label for="age" class="form-label">Age</label>
                        <input type="number" class="form-control" id="age" name="age" required min="18">
                        <div class="form-text">Age must be 18 or older.</div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save Candidate</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteCandidateModal" tabindex="-1" aria-labelledby="deleteCandidateModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteCandidateModalLabel">Confirm Deletion</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete candidate <strong id="delete-candidate-name"></strong>?</p>
                <p class="text-danger">This action cannot be undone!</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <form id="delete-form" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete Candidate</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    function deleteCandidate(id, name) {
        // Set form action
        document.getElementById('delete-form').action = '{{ url("/admin/candidates") }}/' + id;
        
        // Set candidate name
        document.getElementById('delete-candidate-name').textContent = name;
        
        // Show modal
        var modal = new bootstrap.Modal(document.getElementById('deleteCandidateModal'));
        modal.show();
    }
</script>
@endsection 