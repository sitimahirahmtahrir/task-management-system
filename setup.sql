-- Create the database if it doesn't exist
CREATE DATABASE IF NOT EXISTS task_management;
USE task_management;

-- Drop existing tables if they exist to avoid conflicts
DROP TABLE IF EXISTS tasks;
DROP TABLE IF EXISTS registration_requests;
DROP TABLE IF EXISTS users;

-- Create users table
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    role ENUM('admin', 'staff') NOT NULL
);

-- Create tasks table
CREATE TABLE tasks (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(100) NOT NULL,
    description TEXT NOT NULL,
    due_date DATE NOT NULL,
    status ENUM('pending', 'in-progress', 'completed') DEFAULT 'pending',
    assigned_to INT,
    FOREIGN KEY (assigned_to) REFERENCES users(id)
);

-- Create registration_requests table
CREATE TABLE registration_requests (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(100) UNIQUE NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Insert an admin user
INSERT INTO users (username, password, email, role) VALUES ('admin', MD5('adminpassword'), 'admin@example.com', 'admin');

-- Insert a sample staff user
INSERT INTO users (username, password, email, role) VALUES ('staff', MD5('staffpassword'), 'staff@example.com', 'staff');
