@extends('layouts.master')

@section('title', 'Home')

@section('content')
    <div class="page-container">
        <!-- Professional Header Section -->
        <div class="page-header">
            <div class="header-content">
                <div>
                    <h1 class="page-title">Task Dashboard</h1>
                    <p class="page-subtitle">Manage your tasks efficiently and stay organized</p>
                </div>
                <a href="#" class="add-button" onclick="showSection('add-task')">Add New Task</a>
            </div>
        </div>

        <!-- Content Card for Tasks -->
        <div class="content-card">
            <div class="dashboard">
                <div class="task-section">
                    <h3>Upcoming Tasks</h3>
                    <ul class="task-list" id="upcoming-tasks">
                        <div id="no-upcoming-tasks" style="display: block; text-align: center; color: #6b7280; padding: 1rem;">No tasks added yet.</div>
                    </ul>
                </div>
                <div class="task-section">
                    <h3>Overdue Tasks</h3>
                    <ul class="task-list" id="overdue-tasks">
                        <div id="no-overdue-tasks" style="display: block; text-align: center; color: #6b7280; padding: 1rem;">No tasks added yet.</div>
                    </ul>
                </div>
                <div class="task-section">
                    <h3>Completed Tasks</h3>
                    <ul class="task-list" id="completed-tasks">
                        <div id="no-completed-tasks" style="display: block; text-align: center; color: #6b7280; padding: 1rem;">No tasks added yet.</div>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Add/Edit Task Section -->
        <div id="add-task" class="content-card" style="display:none; margin-top: 2rem;">
            <h2 class="card-title">Add/Edit Task</h2>
            <form>
                <div class="form-group">
                    <label for="task-title">Title</label>
                    <input type="text" id="task-title" name="title" class="form-input">
                </div>
                <div class="form-group">
                    <label for="task-description">Description</label>
                    <textarea id="task-description" name="description" class="form-input"></textarea>
                </div>
                <div class="form-group">
                    <label for="task-image">Image</label>
                    <input type="file" id="task-image" name="image" class="form-input">
                </div>
                <div class="form-group">
                    <label for="due-date">Due Date</label>
                    <input type="datetime-local" id="due-date" name="due_date" class="form-input">
                </div>
                <div class="form-group">
                    <label for="reminder-time">Reminder Time</label>
                    <input type="datetime-local" id="reminder-time" name="reminder_time" class="form-input">
                </div>
                <button type="submit" class="btn-primary">Save Task</button>
            </form>
        </div>
    </div>
@endsection

@push('styles')
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<style>
    body {
        font-family: 'Inter', sans-serif !important;
        background-color: #f8fafc !important;
        color: #1e293b !important;
        margin: 0 !important;
        padding: 0 !important;
    }

    main {
        min-height: calc(100vh - 140px) !important;
    }

    .page-container {
        max-width: 1200px !important;
        margin: 0 auto !important;
        padding: 2rem 2rem !important;
    }

    .page-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%) !important;
        border-radius: 16px !important;
        padding: 2rem !important;
        margin-bottom: 2rem !important;
        box-shadow: 0 10px 25px rgba(102, 126, 234, 0.15) !important;
        position: relative !important;
        overflow: hidden !important;
    }

    .page-header::before {
        content: '' !important;
        position: absolute !important;
        top: 0 !important;
        left: 0 !important;
        right: 0 !important;
        bottom: 0 !important;
        background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="25" cy="25" r="1" fill="white" opacity="0.1"/><circle cx="75" cy="75" r="1" fill="white" opacity="0.1"/><circle cx="50" cy="10" r="0.5" fill="white" opacity="0.1"/><circle cx="10" cy="60" r="0.5" fill="white" opacity="0.1"/><circle cx="90" cy="40" r="0.5" fill="white" opacity="0.1"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>') !important;
        opacity: 0.3 !important;
    }

    .header-content {
        position: relative !important;
        z-index: 1 !important;
        display: flex !important;
        justify-content: space-between !important;
        align-items: center !important;
        flex-wrap: wrap !important;
        gap: 1.5rem !important;
    }

    .page-title {
        color: white !important;
        font-size: 2.5rem !important;
        font-weight: 700 !important;
        margin: 0 !important;
        text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1) !important;
    }

    .page-subtitle {
        color: rgba(255, 255, 255, 0.9) !important;
        font-size: 1.1rem !important;
        font-weight: 400 !important;
        margin: 0.5rem 0 0 0 !important;
    }

    .add-button {
        background: rgba(255, 255, 255, 0.2) !important;
        backdrop-filter: blur(10px) !important;
        border: 1px solid rgba(255, 255, 255, 0.3) !important;
        color: white !important;
        padding: 0.875rem 2rem !important;
        border-radius: 12px !important;
        text-decoration: none !important;
        font-weight: 600 !important;
        font-size: 1rem !important;
        transition: all 0.3s ease !important;
        display: inline-flex !important;
        align-items: center !important;
        gap: 0.5rem !important;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1) !important;
    }

    .add-button:hover {
        background: rgba(255, 255, 255, 0.3) !important;
        transform: translateY(-2px) !important;
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15) !important;
        color: white !important;
    }

    .add-button::before {
        content: '+' !important;
        font-size: 1.2rem !important;
        font-weight: 700 !important;
    }

    .content-card {
        background: white !important;
        border-radius: 16px !important;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05) !important;
        border: 1px solid #e2e8f0 !important;
        overflow: hidden !important;
        padding: 2rem;
    }

    .dashboard {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 1.5rem;
    }

    .task-section {
        background-color: #f8fafc;
        border-radius: 12px;
        padding: 1.5rem;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.03);
        border: 1px solid #e2e8f0;
    }

    .task-section h3 {
        font-size: 1.25rem;
        color: #334155;
        margin-top: 0;
        margin-bottom: 1rem;
        border-bottom: 1px solid #e2e8f0;
        padding-bottom: 0.75rem;
    }

    .task-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .task-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 0.75rem 0;
        border-bottom: 1px solid #f1f5f9;
        color: #475569;
    }

    .task-item:last-child {
        border-bottom: none;
    }

    .task-actions button {
        background-color: #e2e8f0;
        border: none;
        padding: 0.4rem 0.8rem;
        border-radius: 6px;
        cursor: pointer;
        font-size: 0.85rem;
        margin-left: 0.5rem;
        transition: background-color 0.2s ease;
    }

    .task-actions button:hover {
        background-color: #cbd5e1;
    }

    .card-title {
        font-size: 1.5rem;
        color: #1e293b;
        margin-top: 0;
        margin-bottom: 1.5rem;
        padding-bottom: 0.75rem;
        border-bottom: 1px solid #e2e8f0;
    }

    .form-group {
        margin-bottom: 1.25rem;
    }

    .form-group label {
        display: block;
        font-size: 0.9rem;
        color: #475569;
        margin-bottom: 0.5rem;
        font-weight: 500;
    }

    .form-input {
        width: 100%;
        padding: 0.75rem 1rem;
        border: 1px solid #cbd5e1;
        border-radius: 8px;
        font-size: 1rem;
        color: #334155;
        transition: border-color 0.2s ease, box-shadow 0.2s ease;
    }

    .form-input:focus {
        outline: none;
        border-color: #667eea;
        box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.2);
    }

    .form-input[type="file"] {
        padding: 0.5rem 1rem;
    }

    .btn-primary {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 0.75rem 1.5rem;
        border-radius: 8px;
        border: none;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        font-size: 1rem;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    }

    .btn-primary:hover {
        opacity: 0.9;
        transform: translateY(-1px);
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
    }

    /* Hide Home button on its own page */
    .main-header .auth-section a.nav-link[href="{{ url('/home') }}"] {
        display: none !important;
    }

    @media (max-width: 768px) {
        .page-container {
            padding: 1rem !important;
        }

        .page-header {
            padding: 2rem !important;
        }

        .header-content {
            flex-direction: column !important;
            text-align: center !important;
        }

        .page-title {
            font-size: 2rem !important;
        }

        .content-card {
            padding: 1.5rem;
        }

        .task-section {
            padding: 1rem;
        }
    }
</style>
@endpush

@push('scripts')
    <script>
        let tasks = {};
        let editingTaskId = null;

        function showSection(sectionId) {
            document.querySelectorAll('.content-card').forEach(card => {
                if (card.id === sectionId) {
                    card.style.display = 'block';
                } else if (card.classList.contains('dashboard')) {
                    card.style.display = sectionId === 'dashboard' ? 'block' : 'none';
                } else {
                    card.style.display = 'none';
                }
            });

            if (sectionId === 'add-task') {
                document.querySelector('.page-header .add-button').style.display = 'none';
            } else {
                document.querySelector('.page-header .add-button').style.display = 'inline-flex';
            }
        }

        function editTask(id) {
            const task = tasks[id];
            if (task) {
                document.getElementById('task-title').value = task.title;
                document.getElementById('task-description').value = task.description;
                document.getElementById('due-date').value = task.due_date;
                document.getElementById('reminder-time').value = task.reminder_time;
                editingTaskId = id;
                showSection('add-task');
            }
        }

        function deleteTask(id) {
            if (confirm('Are you sure you want to delete this task?')) {
                delete tasks[id];
                updateTaskLists(); // Refresh task lists after deletion
            }
        }

        function saveTask() {
            const title = document.getElementById('task-title').value;
            const description = document.getElementById('task-description').value;
            const dueDate = document.getElementById('due-date').value;
            const reminderTime = document.getElementById('reminder-time').value;

            if (editingTaskId) {
                tasks[editingTaskId] = { title, description, due_date: dueDate, reminder_time: reminderTime, status: tasks[editingTaskId].status };
                editingTaskId = null;
            } else {
                const newId = Date.now();
                tasks[newId] = { title, description, due_date: dueDate, reminder_time: reminderTime, status: 'upcoming' };
            }

            // Clear form
            document.getElementById('task-title').value = '';
            document.getElementById('task-description').value = '';
            document.getElementById('due-date').value = '';
            document.getElementById('reminder-time').value = '';

            updateTaskLists(); // Refresh task lists after saving
            showSection('dashboard');
        }

        function updateTaskLists() {
            const upcomingList = document.getElementById('upcoming-tasks');
            const overdueList = document.getElementById('overdue-tasks');
            const completedList = document.getElementById('completed-tasks');

            // Clear only task items, keep "no tasks" message
            upcomingList.querySelectorAll('.task-item').forEach(item => item.remove());
            overdueList.querySelectorAll('.task-item').forEach(item => item.remove());
            completedList.querySelectorAll('.task-item').forEach(item => item.remove());

            let hasUpcoming = false;
            let hasOverdue = false;
            let hasCompleted = false;

            for (const id in tasks) {
                const task = tasks[id];
                const li = document.createElement('li');
                li.className = 'task-item';
                li.setAttribute('data-id', id);
                li.innerHTML = `
                    <span>${task.title} - Due ${new Date(task.due_date).toLocaleDateString()}</span>
                    <div class="task-actions">
                        <button onclick="editTask(${id})">Edit</button>
                        <button onclick="deleteTask(${id})">Delete</button>
                    </div>
                `;

                if (task.status === 'upcoming') {
                    upcomingList.appendChild(li);
                    hasUpcoming = true;
                } else if (task.status === 'overdue') {
                    overdueList.appendChild(li);
                    hasOverdue = true;
                } else if (task.status === 'completed') {
                    completedList.appendChild(li);
                    hasCompleted = true;
                }
            }

            document.getElementById('no-upcoming-tasks').style.display = hasUpcoming ? 'none' : 'block';
            document.getElementById('no-overdue-tasks').style.display = hasOverdue ? 'none' : 'block';
            document.getElementById('no-completed-tasks').style.display = hasCompleted ? 'none' : 'block';
        }

        // Attach save function to form
        document.querySelector('#add-task form').addEventListener('submit', function(e) {
            e.preventDefault();
            saveTask();
        });

        // Initial display
        document.addEventListener('DOMContentLoaded', () => {
            console.log('Script executed!');
            updateTaskLists(); // Call updateTaskLists on page load
            showSection('dashboard');
        });
    </script>
@endpush
