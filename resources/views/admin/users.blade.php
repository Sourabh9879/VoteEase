@extends('layouts.app')

@section('title', 'Manage Users - Voting System')

@section('content')
<div class="container">
    <div class="row mb-4">
        <div class="col-md-12">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    <h2 class="mb-3"><i class="fas fa-users me-2"></i>Manage Users</h2>
                    <p class="text-muted">
                        View and manage registered voters in the system.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table mb-0">
                    <thead class="table-light">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Aadhar Number</th>
                            <th scope="col">Voting Status</th>
                            <th scope="col">Registered On</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($users->isEmpty())
                        <tr>
                            <td colspan="5" class="text-center py-4">
                                <p>No users found.</p>
                            </td>
                        </tr>
                        @else
                            @foreach($users as $index => $user)
                            @php
                                // Mask the Aadhar number for privacy (show only last 4 digits)
                                $maskedAadhar = substr($user->aadhar_number, 0, 8);
                                $maskedAadhar = str_repeat('X', 8) . substr($user->aadhar_number, 8);
                                
                                // Format the Aadhar number for display (XXXX-XXXX-NNNN)
                                $formattedAadhar = substr($maskedAadhar, 0, 4) . '-' . substr($maskedAadhar, 4, 4) . '-' . substr($maskedAadhar, 8, 4);
                                
                                // Format the date
                                $createdDate = date('Y-m-d', strtotime($user->created_at));
                            @endphp
                            <tr>
                                <th scope="row">{{ $index + 1 }}</th>
                                <td>{{ $user->name }}</td>
                                <td>{{ $formattedAadhar }}</td>
                                <td>
                                    <span class="badge {{ $user->is_voted ? 'bg-success' : 'bg-warning' }}">
                                        {{ $user->is_voted ? 'Voted' : 'Not Voted' }}
                                    </span>
                                </td>
                                <td>{{ $createdDate }}</td>
                            </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- User Details Modal -->
<div class="modal fade" id="userDetailsModal" tabindex="-1" aria-labelledby="userDetailsModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="userDetailsModalLabel">User Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="userDetailsContent">
                <!-- User details will be loaded here via JavaScript -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        // Add click event to rows to show user details
        $('.user-row').click(function() {
            const userId = $(this).data('user-id');
            
            // Make AJAX call to get user details
            $.ajax({
                url: '/admin/users/' + userId,
                type: 'GET',
                success: function(user) {
                    // Format the Aadhar number for privacy
                    const maskedAadhar = user.aadhar_number.substring(0, 8).replace(/\d/g, 'X') + user.aadhar_number.substring(8);
                    const formattedAadhar = `${maskedAadhar.substring(0, 4)}-${maskedAadhar.substring(4, 8)}-${maskedAadhar.substring(8, 12)}`;
                    
                    // Format dates
                    const createdDate = new Date(user.created_at).toLocaleString();
                    const updatedDate = new Date(user.updated_at).toLocaleString();
                    
                    // Set modal content
                    $('#userDetailsContent').html(`
                        <div class="text-center mb-4">
                            <div class="display-1 text-primary">
                                <i class="fas fa-user-circle"></i>
                            </div>
                            <h4 class="mt-2">${user.name}</h4>
                            <span class="badge ${user.role === 'admin' ? 'bg-danger' : 'bg-primary'}">${user.role}</span>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label fw-bold">Aadhar Number</label>
                            <p class="form-control">${formattedAadhar}</p>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label fw-bold">Voting Status</label>
                            <p class="form-control ${user.is_voted ? 'text-success' : 'text-warning'}">${user.is_voted ? 'Voted' : 'Not Voted'}</p>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label fw-bold">Registration Date</label>
                            <p class="form-control">${createdDate}</p>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label fw-bold">Last Updated</label>
                            <p class="form-control">${updatedDate}</p>
                        </div>
                    `);
                    
                    // Show modal
                    $('#userDetailsModal').modal('show');
                },
                error: function(xhr) {
                    alert('Failed to load user details. Please try again later.');
                }
            });
        });
    });
</script>
@endsection 