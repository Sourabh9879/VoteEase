@extends('layouts.app')

@section('title', 'Edit Election')

@section('content')
<div class="container">
    <div class="row mb-4">
        <div class="col-md-12">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <h2 class="mb-0"><i class="fas fa-edit me-2"></i>Edit Election</h2>
                        <a href="{{ route('admin.elections.show', $election->id) }}" class="btn btn-outline-secondary">
                            <i class="fas fa-arrow-left me-2"></i>Back
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if($errors->any())
    <div class="row mb-4">
        <div class="col-md-12">
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
    @endif

    <div class="row">
        <div class="col-md-12">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    <form action="{{ route('admin.elections.update', $election->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-12 mb-4">
                                <label for="title" class="form-label">Election Title</label>
                                <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $election->title) }}" required>
                            </div>

                            <div class="col-md-12 mb-4">
                                <label for="description" class="form-label">Description</label>
                                <textarea class="form-control" id="description" name="description" rows="3">{{ old('description', $election->description) }}</textarea>
                            </div>

                            <div class="col-md-6 mb-4">
                                <label for="start_date" class="form-label">Start Date</label>
                                <input type="date" class="form-control" id="start_date" name="start_date" value="{{ old('start_date', $election->start_date->format('Y-m-d')) }}" required>
                            </div>

                            <div class="col-md-6 mb-4">
                                <label for="end_date" class="form-label">End Date</label>
                                <input type="date" class="form-control" id="end_date" name="end_date" value="{{ old('end_date', $election->end_date->format('Y-m-d')) }}" required>
                            </div>

                            <div class="col-md-12 mb-4">
                                <!-- Hidden input to ensure a value is sent when the checkbox is unchecked -->
                                <input type="hidden" name="is_active" value="0">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1" {{ old('is_active', $election->is_active) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="is_active">Active</label>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary">Update Election</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection