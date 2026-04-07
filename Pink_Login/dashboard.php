<?php
session_start();

// Check if user is not logged in, redirect to login page
if(!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #ffe4f0 0%, #ffd6e8 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
            padding: 20px;
        }
        
        .dashboard-container {
            background: white;
            padding: 60px 50px;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            text-align: center;
            max-width: 550px;
            width: 100%;
        }
        
        h2 {
            color: #ff69b4;
            margin-bottom: 25px;
            font-size: 36px;
            font-weight: 600;
        }
        
        .welcome {
            color: #ff69b4;
            font-size: 22px;
            margin-bottom: 12px;
            font-weight: 500;
        }
        
        .success-message {
            color: #6b7280;
            margin-bottom: 35px;
            font-size: 16px;
            line-height: 1.5;
        }
        
        .logout-btn {
            display: inline-block;
            padding: 14px 40px;
            background: #ff69b4;
            color: white;
            text-decoration: none;
            border-radius: 8px;
            font-weight: bold;
            font-size: 16px;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .logout-btn:hover {
            background: #ff1493;
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(255, 105, 180, 0.3);
        }
        
        .logout-btn:active {
            transform: translateY(0);
        }
    </style>
</head>
<body>
    <div class="dashboard-container">
        <h2>Dashboard</h2>
        <p class="welcome">Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</p>
        <p class="success-message">You have successfully logged in.</p>
        <a href="logout.php" class="logout-btn">Logout</a>
    </div>
</body>
</html>
