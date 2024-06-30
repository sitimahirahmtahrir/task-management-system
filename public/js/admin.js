document.getElementById('taskManagementLink').addEventListener('click', function(event) {
    event.preventDefault();
    document.getElementById('taskManagementSection').style.display = 'block';
    document.getElementById('userManagementSection').style.display = 'none';
});

document.getElementById('userManagementLink').addEventListener('click', function(event) {
    event.preventDefault();
    document.getElementById('taskManagementSection').style.display = 'none';
    document.getElementById('userManagementSection').style.display = 'block';
});

// Fetch tasks and populate the task list
function fetchTasks() {
    fetch('api/tasks.php')
        .then(response => response.json())
        .then(data => {
            const tasksList = document.getElementById('tasksList');
            tasksList.innerHTML = '';
            data.tasks.forEach(task => {
                const taskItem = document.createElement('div');
                taskItem.innerText = `${task.title} - ${task.status}`;
                tasksList.appendChild(taskItem);
            });
        })
        .catch(error => console.error('Error fetching tasks:', error));
}

// Fetch users and populate the user list for task assignment
function fetchUsers() {
    fetch('api/users.php')
        .then(response => response.json())
        .then(data => {
            const assignedToSelect = document.getElementById('assignedTo');
            assignedToSelect.innerHTML = '';
            data.users.forEach(user => {
                const userOption = document.createElement('option');
                userOption.value = user.id;
                userOption.text = user.username;
                assignedToSelect.appendChild(userOption);
            });
        })
        .catch(error => console.error('Error fetching users:', error));
}

document.getElementById('createTaskForm').addEventListener('submit', function(event) {
    event.preventDefault();
    
    const taskTitle = document.getElementById('taskTitle').value;
    const taskDescription = document.getElementById('taskDescription').value;
    const assignedTo = document.getElementById('assignedTo').value;

    fetch('api/create_task.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ title: taskTitle, description: taskDescription, assigned_to: assignedTo })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('Task created successfully.');
            fetchTasks(); // Refresh the task list
        } else {
            alert('Error creating task: ' + data.error);
        }
    })
    .catch(error => console.error('Error:', error));
});

// Initial fetch to populate tasks and users
fetchTasks();
fetchUsers();
