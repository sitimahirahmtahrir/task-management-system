-- Create the database
CREATE DATABASE IF NOT EXISTS task_management;
USE task_management;

-- Create users table
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin', 'staff') NOT NULL
);

-- Create tasks table
CREATE TABLE IF NOT EXISTS tasks (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(100),
    description TEXT,
    status ENUM('pending', 'in-progress', 'completed') DEFAULT 'pending',
    assigned_to INT,
    FOREIGN KEY (assigned_to) REFERENCES users(id)
);

-- Insert an admin user
INSERT INTO users (username, password, role) VALUES ('admin', MD5('adminpassword'), 'admin');
