<?php
session_start();
if(isset($_SESSION['user_id'])){
    if($_SESSION['role'] =="admin"){
        echo '<p style="color: green; font-size: 20px; font-weight: bold;">Welcome to 👤 Admin Dashboard </p>';

    }else{
        header("Location: ../dashboard.php");
    }
}
else{
    header("Location: ../login.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        /* ====== General Reset ====== */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            display: flex;
            min-height: 100vh;
            background-color: #f4f6f9;
        }

        /* ====== Sidebar ====== */
        .adminnavbar {
            width: 240px;
            background: linear-gradient(180deg, #4CAF50, #2E7D32);
            color: white;
            display: flex;
            flex-direction: column;
            padding: 25px 15px;
            box-shadow: 4px 0 15px rgba(0, 0, 0, 0.2);
            border-radius: 0 15px 15px 0;
        }

        .adminnavbar h2 {
            font-size: 20px;
            text-align: center;
            text-transform: uppercase;
            letter-spacing: 1px;
            border-bottom: 2px solid rgba(255, 255, 255, 0.3);
            padding-bottom: 10px;
            margin-bottom: 25px;
        }

        .adminnavbar ul {
            list-style: none;
            width: 100%;
        }

        .adminnavbar ul li {
            margin: 15px 0;
        }

        .adminnavbar ul li a {
            display: block;
            padding: 12px 18px;
            color: white;
            text-decoration: none;
            border-radius: 8px;
            transition: all 0.3s ease;
            font-weight: 500;
        }

        .adminnavbar ul li a:hover {
            background-color: rgba(255, 255, 255, 0.2);
            transform: translateX(5px);
        }

        /* ====== Main Content ====== */
        .content {
            flex-grow: 1;
            padding: 40px;
        }

        .welcome {
            text-align: center;
            font-size: 24px;
            color: #2E7D32;
            margin-bottom: 30px;
        }

        /* ====== Logout Button ====== */
        .logout-btn {
            margin-top: auto;
            padding: 12px 20px;
            background-color: #f44336;
            color: white;
            text-align: center;
            border-radius: 8px;
            text-decoration: none;
            font-weight: bold;
            transition: background-color 0.3s ease;
        }

        .logout-btn:hover {
            background-color: #d32f2f;
        }

        /* ====== Responsive Design ====== */
        @media (max-width: 768px) {
            body {
                flex-direction: column;
            }

            .adminnavbar {
                width: 100%;
                flex-direction: row;
                justify-content: space-around;
                border-radius: 0;
                box-shadow: none;
            }

            .adminnavbar ul {
                display: flex;
                justify-content: space-around;
                width: 100%;
            }

            .logout-btn {
                margin: 10px auto;
            }
        }
        .logout {
            position: absolute;       /* Fixes it to the top-right corner */
            top: 20px;
            right: 30px;
            padding: 10px 18px;
            background-color: #f44336;  /* Red button */
            color: white;
            text-decoration: none;
            font-weight: bold;
            border-radius: 8px;         /* Rounded corners */
            box-shadow: 0 4px 8px rgba(0,0,0,0.2);  /* Subtle shadow */
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        .logout:hover {
            background-color: #d32f2f;  /* Darker red on hover */
            transform: translateY(-2px); /* Slight lift effect */
            cursor: pointer;
        }

    </style>
</head>
<body>
    <nav class="adminnavbar">
        <ul>
            <li><a href="view_transactions.php">View Transactions</a></li>
            <li><a href="manage_user.php">Manage User</a></li>
            <li><a href="add_book.php"> Add Book</a></li>
            
            <li><a href="update_transactions.php">Update Transaction</a></li>
        </ul>
    </nav>
    <a class="logout" href ="../logout.php">Log out</a>
</body>
</html>