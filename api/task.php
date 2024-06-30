<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Task Management System</title>
    <link rel="stylesheet" href="css/styles.css">
    <script defer src="js/admin.js"></script>
</head>
<body>
    <!-- Include the header -->
    <div class="header">
        <h1>TASK MANAGEMENT SYSTEM</h1>
        <div class="hamburger-menu" onclick="toggleMenu()">
            <div></div>
            <div></div>
            <div></div>
        </div>
        <div class="menu" id="menu">
            <a href="#" id="taskManagementLink">Task Management</a>
            <a href="#" id="userManagementLink">User Management</a>
            <a href="#" onclick="logout()">Logout</a>
        </div>
    </div>

    <div class="dashboard-container">
        <h1>Admin Dashboard</h1>
        <div id="taskManagementSection" class="dashboard-content">
            <h2>Task Management</h2>
            <a href="create_task.html" class="btn">Create Task</a>
            <table id="tasksTable">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Status</th>
                        <th>Due Date</th>
                        <th>Assigned To</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Task rows will be populated here -->
                </tbody>
            </table>
        </div>
        <div id="userManagementSection" class="dashboard-content" style="display: none;">
            <h2>User Management</h2>
            <a href="create_user.html" class="btn">Create User</a>
            <table id="usersTable">
                <thead>
                    <tr>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- User rows will be populated here -->
                </tbody>
            </table>
        </div>
    </div>

    <script>
        function toggleMenu() {
            var menu = document.getElementById('menu');
            if (menu.style.display === 'block') {
                menu.style.display = 'none';
            } else {
                menu.style.display = 'block';
            }
        }

        function logout() {
            window.location.href = 'login.html';
        }

        // Fetch tasks and populate the task table
        function fetchTasks() {
            fetch('api/tasks.php')
                .then(response => response.json())
                .then(data => {
                    const tasksTableBody = document.getElementById('tasksTable').getElementsByTagName('tbody')[0];
                    tasksTableBody.innerHTML = '';
                    data.tasks.forEach(task => {
                        const row = tasksTableBody.insertRow();
                        row.insertCell(0).innerText = task.title;
                        row.insertCell(1).innerText = task.status;
                        row.insertCell(2).innerText = task.due_date;
                        row.insertCell(3).innerText = task.assigned_to;
                        const actionsCell = row.insertCell(4);
                        actionsCell.innerHTML = `
                            <button onclick="editTask(${task.id})">Edit</button>
                            <button onclick="deleteTask(${task.id})">Delete</button>
                        `;
                    });
                })
                .catch(error => console.error('Error fetching tasks:', error));
        }

        // Fetch users and populate the user table
        function fetchUsers() {
            fetch('api/users.php')
                .then(response => response.json())
                .then(data => {
                    const usersTableBody = document.getElementById('usersTable').getElementsByTagName('tbody')[0];
                    usersTableBody.innerHTML = '';
                    data.users.forEach(user => {
                        const row = usersTableBody.insertRow();
                        row.insertCell(0).innerText = user.username;
                        row.insertCell(1).innerText = user.email;
                        row.insertCell(2).innerText = user.role;
                        const actionsCell = row.insertCell(3);
                        actionsCell.innerHTML = `
                            <button onclick="editUser(${user.id})">Edit</button>
                            <button onclick="deleteUser(${user.id})">Delete</button>
                        `;
                    });
                })
                .catch(error => console.error('Error fetching users:', error));
        }

        document.getElementById('taskManagementLink').addEventListener('click', function(event) {
            event.preventDefault();
            document.getElementById('taskManagementSection').style.display = 'block';
            document.getElementById('userManagementSection').style.display = 'none';
            fetchTasks();
        });

        document.getElementById('userManagementLink').addEventListener('click', function(event) {
            event.preventDefault();
            document.getElementById('taskManagementSection').style.display = 'none';
            document.getElementById('userManagementSection').style.display = 'block';
            fetchUsers();
        });

        // Initial fetch to populate tasks and users
        fetchTasks();
        fetchUsers();

        // Refresh the task and user lists every 30 seconds for real-time updates
        setInterval(fetchTasks, 30000);
        setInterval(fetchUsers, 30000);

        // Function to edit a task
        function editTask(taskId) {
            window.location.href = `edit_task.html?task_id=${taskId}`;
        }

        // Function to delete a task
        function deleteTask(taskId) {
            if (confirm('Are you sure you want to delete this task?')) {
                fetch(`api/delete_task.php?id=${taskId}`, { method: 'DELETE' })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            alert('Task deleted successfully.');
                            fetchTasks();
                        } else {
                            alert('Error deleting task: ' + data.error);
                        }
                    })
                    .catch(error => console.error('Error:', error));
            }
        }

        // Function to edit a user
        function editUser(userId) {
            window.location.href = `edit_user.html?user_id=${userId}`;
        }

        // Function to delete a user
        function deleteUser(userId) {
            if (confirm('Are you sure you want to delete this user?')) {
                fetch(`api/delete_user.php?id=${userId}`, { method: 'DELETE' })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            alert('User deleted successfully.');
                            fetchUsers();
                        } else {
                            alert('Error deleting user: ' + data.error);
                        }
                    })
                    .catch(error => console.error('Error:', error));
            }
        }
    </script>
</body>
</html>
