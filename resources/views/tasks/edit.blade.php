@extends('layouts.master')

@section('title', 'Edit Task - Task Scheduler')

@section('content')
<div class="edit-task-container">
    <div class="row justify-content-center">
        <div class="col-12 col-md-10 col-lg-8 col-xl-6">
            <!-- Header Section -->
            <div class="text-center mb-5">
                <div class="header-icon">
                    <i class="fas fa-edit"></i>
                </div>
                <h1 class="page-title">Edit Task</h1>
                <p class="page-subtitle">Update the task details below</p>
            </div>

            <!-- Form Card -->
            <div class="card task-form-card">
                <div class="card-body">
                    <form action="{{ route('tasks.update', $task->id) }}" method="POST" class="needs-validation" novalidate>
                        @csrf
                        @method('PUT')
                        
                        <!-- Basic Information Section -->
                        <div class="form-section mb-5">
                            <div class="section-header">
                                <i class="fas fa-pencil-alt section-icon"></i>
                                <h3 class="section-title">Basic Information</h3>
                            </div>
                            
                            <!-- Title Field -->
                            <div class="form-group">
                                <label for="title" class="form-label">
                                    <i class="fas fa-heading input-icon"></i>
                                    Task Title <span class="required-star">*</span>
                                </label>
                                <input type="text" class="form-control form-control-lg @error('title') is-invalid @enderror" 
                                       id="title" name="title" value="{{ old('title', $task->title) }}" 
                                       placeholder="Enter a clear and descriptive task title" required>
                                @error('title')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Description Field -->
                            <div class="form-group">
                                <label for="description" class="form-label">
                                    <i class="fas fa-align-left input-icon"></i>
                                    Description
                                </label>
                                <textarea class="form-control @error('description') is-invalid @enderror" 
                                          id="description" name="description" rows="4"
                                          placeholder="Provide detailed information about this task...">{{ old('description', $task->description) }}</textarea>
                                @error('description')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Task Details Section -->
                        <div class="form-section mb-5">
                            <div class="section-header">
                                <i class="fas fa-cog section-icon"></i>
                                <h3 class="section-title">Task Details</h3>
                            </div>
                            
                            <div class="row">
                                <!-- Status Field -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="status" class="form-label">
                                            <i class="fas fa-tasks input-icon"></i>
                                            Status <span class="required-star">*</span>
                                        </label>
                                        <select class="form-select @error('status') is-invalid @enderror" id="status" name="status" required>
                                            <option value="">Select task status</option>
                                            <option value="pending" {{ old('status', $task->status) == 'pending' ? 'selected' : '' }}>⏳ Pending</option>
                                            <option value="in_progress" {{ old('status', $task->status) == 'in_progress' ? 'selected' : '' }}>🔄 In Progress</option>
                                            <option value="completed" {{ old('status', $task->status) == 'completed' ? 'selected' : '' }}>✅ Completed</option>
                                        </select>
                                        @error('status')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Priority Field -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="priority" class="form-label">
                                            <i class="fas fa-flag input-icon"></i>
                                            Priority <span class="required-star">*</span>
                                        </label>
                                        <select class="form-select @error('priority') is-invalid @enderror" id="priority" name="priority" required>
                                            <option value="">Select priority level</option>
                                            <option value="1" {{ old('priority', $task->priority) == '1' ? 'selected' : '' }}>🟢 Low Priority</option>
                                            <option value="2" {{ old('priority', $task->priority) == '2' ? 'selected' : '' }}>🟡 Medium Priority</option>
                                            <option value="3" {{ old('priority', $task->priority) == '3' ? 'selected' : '' }}>🔴 High Priority</option>
                                        </select>
                                        @error('priority')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Due Date Field -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="due_date" class="form-label">
                                            <i class="fas fa-calendar-day input-icon"></i>
                                            Due Date
                                        </label>
                                        <input type="date" class="form-control @error('due_date') is-invalid @enderror" 
                                               id="due_date" name="due_date" value="{{ old('due_date', $task->due_date ? $task->due_date->format('Y-m-d') : '') }}"
                                               min="{{ date('Y-m-d') }}">
                                        @error('due_date')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Assign To Field -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="assigned_to" class="form-label">
                                            <i class="fas fa-user-friends input-icon"></i>
                                            Assign To
                                        </label>
                                        <select class="form-select @error('assigned_to') is-invalid @enderror" id="assigned_to" name="assigned_to">
                                            <option value="">Select team member</option>
                                            @foreach($users as $user)
                                                <option value="{{ $user->id }}" {{ old('assigned_to', $task->assigned_to) == $user->id ? 'selected' : '' }}>
                                                    👤 {{ $user->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('assigned_to')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="form-actions">
                            <div class="action-buttons">
                                <a href="{{ route('tasks.index') }}" class="btn btn-cancel">
                                    <i class="fas fa-arrow-left me-2"></i>
                                    Back to Tasks
                                </a>
                                <button type="submit" class="btn btn-update">
                                    <i class="fas fa-save me-2"></i>
                                    Update Task
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Font Awesome for Icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

<style>
    .edit-task-container {
        width: 100%;
        min-height: calc(100vh - 140px);
        display: flex;
        align-items: center;
        padding: 2rem 1rem;
    }

    .row.justify-content-center {
        width: 100%;
        margin: 0 auto;
    }

    .col-12.col-md-10.col-lg-8.col-xl-6 {
        margin: 0 auto;
        float: none;
    }

    .page-title {
        font-size: 2.5rem;
        font-weight: 800;
        background: linear-gradient(135deg, #4f46e5, #7c3aed);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        margin-bottom: 0.5rem;
    }

    .page-subtitle {
        font-size: 1.2rem;
        color: #6b7280;
        font-weight: 400;
        margin-bottom: 0;
    }

    .header-icon {
        font-size: 4rem;
        color: #4f46e5;
        margin-bottom: 1rem;
    }

    .task-form-card {
        background: #ffffff;
        border: none;
        border-radius: 20px;
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.08);
        overflow: hidden;
        width: 100%;
        margin: 0 auto;
    }

    .card-body {
        padding: 2.5rem;
    }

    .form-section {
        margin-bottom: 2.5rem;
    }

    .section-header {
        display: flex;
        align-items: center;
        margin-bottom: 2rem;
        padding: 1rem 1.5rem;
        background: linear-gradient(135deg, #f8fafc, #f1f5f9);
        border-radius: 12px;
        border-left: 4px solid #4f46e5;
    }

    .section-icon {
        font-size: 1.5rem;
        color: #4f46e5;
        margin-right: 1rem;
    }

    .section-title {
        font-size: 1.4rem;
        font-weight: 700;
        color: #1f2937;
        margin: 0;
    }

    .form-group {
        margin-bottom: 1.5rem;
    }

    .form-label {
        display: flex;
        align-items: center;
        color: #374151;
        font-weight: 600;
        font-size: 1rem;
        margin-bottom: 0.75rem;
    }

    .input-icon {
        color: #4f46e5;
        margin-right: 0.75rem;
        font-size: 1rem;
        width: 20px;
        text-align: center;
    }

    .required-star {
        color: #ef4444;
        margin-left: 0.25rem;
    }

    .form-control, .form-select {
        border: 2px solid #e5e7eb;
        border-radius: 12px;
        padding: 1rem 1.25rem;
        font-size: 1rem;
        transition: all 0.3s ease;
        background: #ffffff;
        width: 100%;
    }

    .form-control-lg {
        padding: 1.25rem 1.5rem;
        font-size: 1.1rem;
    }

    .form-control:focus, .form-select:focus {
        border-color: #4f46e5;
        box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
        transform: translateY(-2px);
    }

    .form-actions {
        margin-top: 2rem;
        padding-top: 2rem;
        border-top: 1px solid #f1f5f9;
    }

    .action-buttons {
        display: flex;
        gap: 1rem;
        justify-content: center;
    }

    .btn {
        border-radius: 12px;
        padding: 1rem 2rem;
        font-weight: 600;
        font-size: 1.1rem;
        transition: all 0.3s ease;
        border: 2px solid transparent;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 160px;
    }

    .btn-update {
        background: linear-gradient(135deg, #10b981, #34d399);
        color: white;
        border: none;
    }

    .btn-update:hover {
        transform: translateY(-3px);
        box-shadow: 0 15px 30px rgba(16, 185, 129, 0.3);
        color: white;
        text-decoration: none;
    }

    .btn-cancel {
        background: transparent;
        border: 2px solid #6b7280;
        color: #6b7280;
    }

    .btn-cancel:hover {
        background: #6b7280;
        color: white;
        transform: translateY(-2px);
        text-decoration: none;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .edit-task-container {
            padding: 1rem;
            align-items: flex-start;
        }

        .page-title {
            font-size: 2rem;
        }

        .page-subtitle {
            font-size: 1rem;
        }

        .card-body {
            padding: 1.5rem;
        }

        .action-buttons {
            flex-direction: column;
        }

        .btn {
            width: 100%;
            min-width: auto;
        }

        .header-icon {
            font-size: 3rem;
        }
    }

    @media (max-width: 576px) {
        .section-header {
            flex-direction: column;
            text-align: center;
            gap: 0.5rem;
        }

        .section-icon {
            margin-right: 0;
        }
    }
</style>
@endsection