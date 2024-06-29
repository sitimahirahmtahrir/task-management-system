document.addEventListener('DOMContentLoaded', function() {
    const taskManagementLink = document.getElementById('taskManagementLink');
    const userManagementLink = document.getElementById('userManagementLink');
    const taskManagementSection = document.getElementById('taskManagementSection');
    const userManagementSection = document.getElementById('userManagementSection');
    const createTaskButton = document.getElementById('createTaskButton');
    const createUserButton = document.getElementById('createUserButton');

    taskManagementLink.addEventListener('click', function() {
        taskManagementSection.style.display = 'block';
        userManagementSection.style.display = 'none';
    });

    userManagementLink.addEventListener('click', function() {
        taskManagementSection.style.display = 'none';
        userManagementSection.style.display = 'block';
    });

    // Example function to fetch tasks from the backend
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

    // Example function to fetch users from the backend
    function fetchUsers() {
        fetch('api/users.php')
            .then(response => response.json())
            .then(data => {
                const usersList = document.getElementById('usersList');
                usersList.innerHTML = '';
                data.users.forEach(user => {
                    const userItem = document.createElement('div');
                    userItem.innerText = `${user.username} - ${user.role}`;
                    usersList.appendChild(userItem);
                });
            })
            .catch(error => console.error('Error fetching users:', error));
    }

    createTaskButton.addEventListener('click', function() {
        // Logic for creating a new task
        console.log('Create task button clicked');
    });

    createUserButton.addEventListener('click', function() {
        // Logic for creating a new user
        console.log('Create user button clicked');
    });

    // Initial fetch to populate lists
    fetchTasks();
    fetchUsers();
});
