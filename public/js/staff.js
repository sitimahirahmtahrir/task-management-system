document.getElementById('taskDashboardLink').addEventListener('click', function(event) {
    event.preventDefault();
    document.getElementById('taskDashboardSection').style.display = 'block';
    document.getElementById('profileManagementSection').style.display = 'none';
});

document.getElementById('profileManagementLink').addEventListener('click', function(event) {
    event.preventDefault();
    document.getElementById('taskDashboardSection').style.display = 'none';
    document.getElementById('profileManagementSection').style.display = 'block';
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

document.getElementById('profileForm').addEventListener('submit', function(event) {
    event.preventDefault();
    
    const username = document.getElementById('username').value;
    const email = document.getElementById('email').value;
    const password = document.getElementById('password').value;

    fetch('api/update_profile.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ username, email, password })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('Profile updated successfully.');
        } else {
            alert('Error updating profile: ' + data.error);
        }
    })
    .catch(error => console.error('Error:', error));
});

// Initial fetch to populate tasks
fetchTasks();
