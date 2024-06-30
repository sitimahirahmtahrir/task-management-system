document.getElementById('loginForm').addEventListener('submit', function(event) {
    event.preventDefault();
    
    const username = document.getElementById('username').value;
    const password = document.getElementById('password').value;

    fetch('api/login.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ username, password })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            if (data.role === 'admin') {
                window.location.href = 'admin_dashboard.html';
            } else {
                window.location.href = 'staff_dashboard.html';
            }
        } else {
            document.getElementById('error-message').style.display = 'block';
        }
    })
    .catch(error => console.error('Error:', error));
});

document.getElementById('forgotPasswordLink').addEventListener('click', function(event) {
    event.preventDefault();
    document.querySelector('.login-container').style.display = 'none';
    document.querySelector('.forgot-password-container').style.display = 'block';
});

document.getElementById('registerLink').addEventListener('click', function(event) {
    event.preventDefault();
    document.querySelector('.login-container').style.display = 'none';
    document.querySelector('.register-container').style.display = 'block';
});

document.getElementById('backToLoginFromForgot').addEventListener('click', function(event) {
    event.preventDefault();
    document.querySelector('.forgot-password-container').style.display = 'none';
    document.querySelector('.login-container').style.display = 'block';
});

document.getElementById('backToLoginFromRegister').addEventListener('click', function(event) {
    event.preventDefault();
    document.querySelector('.register-container').style.display = 'none';
    document.querySelector('.login-container').style.display = 'block';
});

document.getElementById('forgotPasswordForm').addEventListener('submit', function(event) {
    event.preventDefault();
    
    const email = document.getElementById('forgotEmail').value;

    fetch('api/forgot_password.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ email })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('A default password has been sent to your email.');
            document.querySelector('.forgot-password-container').style.display = 'none';
            document.querySelector('.login-container').style.display = 'block';
        } else {
            alert('Error: ' + data.error);
        }
    })
    .catch(error => console.error('Error:', error));
});

document.getElementById('registerForm').addEventListener('submit', function(event) {
    event.preventDefault();
    
    const email = document.getElementById('registerEmail').value;

    fetch('api/register.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ email })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('Your registration request has been sent to the admin.');
            document.querySelector('.register-container').style.display = 'none';
            document.querySelector('.login-container').style.display = 'block';
        } else {
            alert('Error: ' + data.error);
        }
    })
    .catch(error => console.error('Error:', error));
});
