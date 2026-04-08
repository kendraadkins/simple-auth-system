# Secure Login System (PHP + MySQL)

## Overview

This project is a simple secure login system built using PHP and MySQL. It demonstrates user authentication, session management, and secure password handling using hashing techniques.

The system allows users to log in, access a protected dashboard, and securely log out.

## Features

- User authentication with username and password  
- Secure password storage using hashing  
- Session-based login system  
- Protected dashboard (only accessible when logged in)  
- Error handling for invalid login attempts  
- Clean and responsive UI design  

## Technologies Used

- PHP  
- MySQL  
- HTML / CSS  
- XAMPP / Localhost environment  

## Project Structure

- login.php – Handles user login, authentication, and form processing  
- dashboard.php – Protected page accessible only after login  
- logout.php – Ends session and logs user out  
- hash.php – Generates hashed passwords for secure storage  

## How It Works

1. User enters username and password in login.php  
2. The system connects to a MySQL database  
3. A prepared SQL statement retrieves the stored password hash  
4. password_verify() is used to compare the entered password with the stored hash  
5. If valid:
   - A session is created  
   - User is redirected to the dashboard  
6. If invalid:
   - An error message is displayed  

## Security Features

- Passwords are securely hashed using password_hash()  
- Login verification uses password_verify()  
- Prepared statements prevent SQL injection  
- Sessions are used to protect authenticated routes  
- Direct access to dashboard is blocked without login  

## Setup Instructions

1. Install XAMPP (or similar local server)  
2. Start Apache and MySQL  

3. Run the following SQL in phpMyAdmin or MySQL:

```sql
CREATE DATABASE login_project;

USE login_project;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    password_hash VARCHAR(255) NOT NULL
);

4. Generate a password hash:
php hash.php

5. Insert a test user into the database (copy the generated hash)
6. Open in browser:
http://localhost/login.php
