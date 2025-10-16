<?php
include "db.php";

session_start();

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id']; // Missing '$' before variable
} else {
    header("Location: login.php"); // Incorrect quotes removed
    exit();
}
?>
<?php

if(isset($_SESSION['user_id'])){
    if($_SESSION['role'] =="user"){
        echo '<p style="color: green; font-size: 20px; font-weight: bold;">👤 You are User</p>';


    }else{
        header("Location: admin/dashboard.php");
    }
}
else{
    header("Location: login.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library Dashboard</title>
    <style>
        body {
            margin: 0;
            font-family: "Segoe UI", Arial, sans-serif;
            background-color: #f5f7fa;
        }

        /* Header Container */
        header {
            background: linear-gradient(135deg, #3b82f6, #60a5fa);
            color: white;
            padding: 20px 30px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
            border-bottom-left-radius: 10px;
            border-bottom-right-radius: 10px;
        }

        /* Top text - user info */
        .user-label {
            font-size: 20px;
            font-weight: 600;
            margin-bottom: 15px;
            display: block;
        }

        /* Bottom row container (Request + Logout) */
        .actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        /* Common button styles */
        .check, .logout {
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 6px;
            font-weight: bold;
            transition: all 0.3s ease;
            box-shadow: 0 3px 6px rgba(0,0,0,0.2);
        }

        /* Request button */
        .check {
            background-color: #22c55e;
            color: white;
        }

        .check:hover {
            background-color: #16a34a;
            transform: translateY(-2px);
        }

        /* Logout button */
        .logout {
            background-color: #ef4444;
            color: white;
        }

        .logout:hover {
            background-color: #dc2626;
            transform: translateY(-2px);
        }

        /* Responsive design */
        @media (max-width: 600px) {
            .actions {
                flex-direction: column;
                align-items: stretch;
                gap: 10px;
            }

            .check, .logout {
                text-align: center;
            }
        }
    </style>
</head>
<body>
    <header>
        <!-- Top line -->
        <span class="user-label">Read. Learn. Grow. Your journey starts here.</span>

        <!-- Second line: request left, logout right -->
        <div class="actions">
            <a class="check" href="requestcheck.php">🔄 Request Update</a>
            <a class="logout" href="logout.php">🚪 Log Out</a>
        </div>
    </header>
</body>
</html>
