@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4>Task Details</h4>
                <div class="btn-group">
                    <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                    <a href="{{ route('tasks.index') }}" class="btn btn-secondary btn-sm">Back to List</a>
                </div>
            </div>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <strong>Title:</strong>
                        <p class="fs-5">{{ $task->title }}</p>
                    </div>
                    <div class="col-md-6">
                        <strong>Status:</strong>
                        <p>
                            <span class="badge 
                                @if($task->status == 'completed') bg-success
                                @elseif($task->status == 'in_progress') bg-warning
                                @else bg-secondary @endif">
                                {{ ucfirst($task->status) }}
                            </span>
                        </p>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <strong>Priority:</strong>
                        <p>
                            <span class="badge 
                                @if($task->priority == 1) bg-success
                                @elseif($task->priority == 2) bg-warning
                                @else bg-danger @endif">
                                {{ $task->priority }}
                            </span>
                        </p>
                    </div>
                    <div class="col-md-6">
                        <strong>Due Date:</strong>
                        <p>{{ $task->due_date ? $task->due_date->format('F d, Y') : 'Not set' }}</p>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-12">
                        <strong>Description:</strong>
                        <p>{{ $task->description ?: 'No description provided' }}</p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <strong>Assigned To:</strong>
                        <p>{{ $task->assignedUser->name ?? 'Unassigned' }}</p>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-12">
                        <strong>Created:</strong> {{ $task->created_at->format('M d, Y H:i') }}<br>
                        <strong>Last Updated:</strong> {{ $task->updated_at->format('M d, Y H:i') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection