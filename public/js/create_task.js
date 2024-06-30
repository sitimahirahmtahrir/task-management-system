document.getElementById('createUserForm').addEventListener('submit', function(event) {
    event.preventDefault();
    
    const username = document.getElementById('username').value;
    const email = document.getElementById('email').value;
    const password = document.getElementById('password').value;
    const role = document.getElementById('role').value;

    fetch('api/create_user.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ username, email, password, role })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('User created successfully.');
            window.location.href = 'admin_dashboard.html';
        } else {
            alert('Error creating user: ' + data.error);
        }
    })
    .catch(error => console.error('Error:', error));
});
