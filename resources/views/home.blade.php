@extends('layouts.master')

@section('title', 'Home')

@section('content')
    <div class="content">
        <h2>Dashboard</h2>
        <div class="dashboard">
            <div class="card">
                <h3>Upcoming Tasks</h3>
                <ul class="task-list" id="upcoming-tasks">
                    <li class="task-item" data-id="1">Task 1 - Due tomorrow <div class="task-actions"><button onclick="editTask(1)">Edit</button><button onclick="deleteTask(1)">Delete</button></div></li>
                    <li class="task-item" data-id="2">Task 2 - Due next week <div class="task-actions"><button onclick="editTask(2)">Edit</button><button onclick="deleteTask(2)">Delete</button></div></li>
                </ul>
            </div>
            <div class="card">
                <h3>Overdue Tasks</h3>
                <ul class="task-list" id="overdue-tasks">
                    <li class="task-item" data-id="3">Task 3 - Overdue by 2 days <div class="task-actions"><button onclick="editTask(3)">Edit</button><button onclick="deleteTask(3)">Delete</button></div></li>
                </ul>
            </div>
            <div class="card">
                <h3>Completed Tasks</h3>
                <ul class="task-list" id="completed-tasks">
                    <li class="task-item" data-id="4">Task 4 - Completed yesterday <div class="task-actions"><button onclick="editTask(4)">Edit</button><button onclick="deleteTask(4)">Delete</button></div></li>
                </ul>
            </div>
        </div>
        <button onclick="showSection('add-task')">Add New Task</button>
    </div>
    <div id="add-task" class="section">
        <h2>Add/Edit Task</h2>
        <form>
            <div class="form-group">
                <label for="task-title">Title</label>
                <input type="text" id="task-title" name="title">
            </div>
            <div class="form-group">
                <label for="task-description">Description</label>
                <textarea id="task-description" name="description"></textarea>
            </div>
            <div class="form-group">
                <label for="task-image">Image</label>
                <input type="file" id="task-image" name="image">
            </div>
            <div class="form-group">
                <label for="due-date">Due Date</label>
                <input type="datetime-local" id="due-date" name="due_date">
            </div>
            <div class="form-group">
                <label for="reminder-time">Reminder Time</label>
                <input type="datetime-local" id="reminder-time" name="reminder_time">
            </div>
            <button type="submit">Save Task</button>
        </form>
    </div>
    <div id="sync" class="section">
        <h2>Account Synchronization</h2>
        <div class="sync-info">
            <p>Last sync: 2023-10-01 10:00 AM</p>
            <button onclick="syncNow()">Sync Now</button>
        </div>
        <div class="form-group">
            <label class="toggle">
                <input type="checkbox" id="auto-sync" checked>
                Enable Auto-Sync
            </label>
        </div>
        <h3>Connected Devices</h3>
        <ul class="device-list">
            <li class="device-item">Device 1 - iPhone <button>Remove</button></li>
            <li class="device-item">Device 2 - Android <button>Remove</button></li>
        </ul>
    </div>
    <div id="notifications" class="section">
        <h2>Notification Settings</h2>
        <div class="form-group">
            <label class="toggle">
                <input type="checkbox" id="email-notifications" checked>
                Email Notifications
            </label>
        </div>
        <div class="form-group">
            <label class="toggle">
                <input type="checkbox" id="push-notifications">
                Push Notifications
            </label>
        </div>
        <div class="form-group">
            <label for="reminder-frequency">Reminder Frequency</label>
            <select id="reminder-frequency">
                <option>Daily</option>
                <option>Weekly</option>
                <option>Hourly</option>
            </select>
        </div>
    </div>
    <div id="contact" class="section">
        <h2>Contact Us</h2>
        <form>
            <div class="form-group">
                <label for="contact-name">Name</label>
                <input type="text" id="contact-name" name="name">
            </div>
            <div class="form-group">
                <label for="contact-email">Email</label>
                <input type="email" id="contact-email" name="email">
            </div>
            <div class="form-group">
                <label for="contact-message">Message</label>
                <textarea id="contact-message" name="message"></textarea>
            </div>
            <button type="submit">Send Message</button>
        </form>
    </div>
    <div id="about" class="section">
        <h2>About Us</h2>
        <p>Welcome to Task Scheduler, your ultimate tool for managing tasks efficiently.</p>
        <p>This app helps you organize your tasks, set reminders, and sync across devices.</p>
        <h3>Developer</h3>
        <p>Developed by [Your Name] as part of the Task Scheduler project.</p>
    </div>
    <div id="logout" class="section">
        <div class="confirmation">
            <h2>Are you sure you want to log out?</h2>
            <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                @csrf
                <button type="submit">Yes</button>
            </form>
            <button onclick="showSection('dashboard')">No</button>
        </div>
    </div>

    <script>
        let tasks = {
            1: { title: 'Task 1', description: 'Description 1', due_date: '2023-10-02T10:00', reminder_time: '2023-10-01T09:00', status: 'upcoming' },
            2: { title: 'Task 2', description: 'Description 2', due_date: '2023-10-08T10:00', reminder_time: '2023-10-07T09:00', status: 'upcoming' },
            3: { title: 'Task 3', description: 'Description 3', due_date: '2023-09-28T10:00', reminder_time: '2023-09-27T09:00', status: 'overdue' },
            4: { title: 'Task 4', description: 'Description 4', due_date: '2023-09-29T10:00', reminder_time: '2023-09-28T09:00', status: 'completed' }
        };
        let editingTaskId = null;

        function toggleMenu() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('overlay');
            sidebar.classList.toggle('open');
            overlay.classList.toggle('active');
        }

        function switchSection(sectionId) {
            const sections = document.querySelectorAll('.section');
            sections.forEach(section => section.classList.remove('active'));
            document.getElementById(sectionId).classList.add('active');
        }

        function showSection(sectionId) {
            switchSection(sectionId);
            toggleMenu();
        }

        function editTask(id) {
            const task = tasks[id];
            if (task) {
                document.getElementById('task-title').value = task.title;
                document.getElementById('task-description').value = task.description;
                document.getElementById('due-date').value = task.due_date;
                document.getElementById('reminder-time').value = task.reminder_time;
                editingTaskId = id;
                switchSection('add-task');
            }
        }

        function deleteTask(id) {
            if (confirm('Are you sure you want to delete this task?')) {
                delete tasks[id];
                const taskItem = document.querySelector(`[data-id="${id}"]`);
                if (taskItem) {
                    taskItem.remove();
                }
            }
        }

        function saveTask() {
            const title = document.getElementById('task-title').value;
            const description = document.getElementById('task-description').value;
            const dueDate = document.getElementById('due-date').value;
            const reminderTime = document.getElementById('reminder-time').value;

            if (editingTaskId) {
                tasks[editingTaskId] = { title, description, due_date: dueDate, reminder_time: reminderTime, status: tasks[editingTaskId].status };
                updateTaskDisplay(editingTaskId);
                editingTaskId = null;
            } else {
                const newId = Date.now();
                tasks[newId] = { title, description, due_date: dueDate, reminder_time: reminderTime, status: 'upcoming' };
                addTaskToList(newId);
            }

            // Clear form
            document.getElementById('task-title').value = '';
            document.getElementById('task-description').value = '';
            document.getElementById('due-date').value = '';
            document.getElementById('reminder-time').value = '';

            showSection('dashboard');
        }

        function updateTaskDisplay(id) {
            const task = tasks[id];
            const taskItem = document.querySelector(`[data-id="${id}"]`);
            if (taskItem) {
                taskItem.firstChild.textContent = `${task.title} - Due ${new Date(task.due_date).toLocaleDateString()}`;
            }
        }

        function addTaskToList(id) {
            const task = tasks[id];
            const listId = task.status === 'upcoming' ? 'upcoming-tasks' : task.status === 'overdue' ? 'overdue-tasks' : 'completed-tasks';
            const list = document.getElementById(listId);
            const li = document.createElement('li');
            li.className = 'task-item';
            li.setAttribute('data-id', id);
            li.innerHTML = `${task.title} - Due ${new Date(task.due_date).toLocaleDateString()} <div class="task-actions"><button onclick="editTask(${id})">Edit</button><button onclick="deleteTask(${id})">Delete</button></div>`;
            list.appendChild(li);
        }

        // Attach save function to form
        document.querySelector('#add-task form').addEventListener('submit', function(e) {
            e.preventDefault();
            saveTask();
        });

        function syncNow() {
            alert('Syncing data...');
        }

        function logout() {
            alert('Logged out successfully!');
            window.location.href = '/login';
        }
    </script>
</body>
</html>
