<?php
session_start();

// Check if user is already logged in, redirect to dashboard
if(isset($_SESSION['username'])) {
    header("Location: dashboard.php");
    exit();
}

// PHP logic for handling form submission and showing error will go here
$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // 1. Get username and password from $_POST
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    // 2. Connect to DB - Using port 3307 and login_project database
    $conn = mysqli_connect("localhost:3307", "root", "", "login_project");
    
    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    
    // 3. Prepare a query to select user by username
    $sql = "SELECT username, password_hash FROM users WHERE username = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $username);
    
    // 4. Execute query and get result
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    
    // 5. If user exists, get the stored password_hash
    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        $stored_hash = $row['password_hash'];
        
        // 6. Use password_verify() to check if submitted password matches the hash
        if (password_verify($password, $stored_hash)) {
            // 7. If it matches:
            // - Set $_SESSION['username'] = $username;
            $_SESSION['username'] = $username;
            
            // - Redirect to dashboard.php
            header("Location: dashboard.php");
            exit();
        } else {
            // 8. Else, set error message
            $error = "Invalid username or password.";
        }
    } else {
        // 8. User doesn't exist
        $error = "Invalid username or password.";
    }
    
    // Close statement and connection
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #ffc0d3 0%, #ffb3c6 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
            padding: 20px;
        }
        
        .login-container {
            background: white;
            padding: 45px 40px;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
            width: 100%;
            max-width: 420px;
        }
        
        h2 {
            text-align: center;
            color: #ff69b4;
            margin-bottom: 35px;
            font-size: 28px;
            font-weight: 600;
        }
        
        .error {
            background: #fee2e2;
            color: #dc2626;
            padding: 12px;
            border-radius: 6px;
            margin-bottom: 20px;
            text-align: center;
            border: 1px solid #fecaca;
            font-size: 14px;
        }
        
        label {
            display: block;
            margin-bottom: 8px;
            color: #374151;
            font-weight: 600;
            font-size: 14px;
        }
        
        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 12px 15px;
            margin-bottom: 20px;
            border: 2px solid #e5e7eb;
            border-radius: 8px;
            box-sizing: border-box;
            font-size: 15px;
            transition: all 0.3s ease;
        }
        
        input[type="text"]:focus,
        input[type="password"]:focus {
            outline: none;
            border-color: #ff69b4;
            box-shadow: 0 0 0 3px rgba(255, 105, 180, 0.1);
        }
        
        input[type="submit"] {
            width: 100%;
            padding: 14px;
            background: #ff69b4;
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 16px;
            font-weight: bold;
            transition: all 0.3s ease;
            margin-top: 10px;
        }
        
        input[type="submit"]:hover {
            background: #ff1493;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(255, 105, 180, 0.3);
        }
        
        input[type="submit"]:active {
            transform: translateY(0);
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Login</h2>
        
        <?php if(!empty($error)) echo "<p class='error'>$error</p>"; ?>
        
        <form method="POST" action="">
            <label for="username">Username:</label>
            <input type="text" name="username" id="username" required>
            
            <label for="password">Password:</label>
            <input type="password" name="password" id="password" required>
            
            <input type="submit" value="Login">
        </form>
    </div>
</body>
</html>
