<?php
include "db.php";
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    // Check if email already exists
    $checkQuery = "SELECT * FROM users WHERE email = '$email'";
    $checkResult = mysqli_query($conn, $checkQuery);

    if (mysqli_num_rows($checkResult) > 0) {
        echo "<script>alert('This email is already registered!');</script>";
    } else {
        $sql = "INSERT INTO users (name, email, password, role) VALUES ('$name', '$email', '$password', '$role')";
        $result = mysqli_query($conn, $sql);

        if ($result) {
            echo "<script>alert('You have registered successfully!'); window.location.href='login.php';</script>";
            exit();
        }
        else {
            echo "<script>alert('Error: " . $conn->error . "');</script>";
        }
    }

    // Redirect to clear POST data (important)
    echo "<script>window.location.href='register.php';</script>";
}


?>
<!DOCTYPE html>
<html>
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library</title>
    <style>
        /* ===== Reset ===== */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        /* ===== Body ===== */
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background: linear-gradient(135deg, #2E8B57, #3CB371, #66CDAA);
            background-size: 200% 200%;
            animation: gradientMove 6s ease infinite;
        }

        @keyframes gradientMove {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        /* ===== Registration Box ===== */
        .register {
            background-color: #ffffff;
            padding: 45px 35px;
            border-radius: 20px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.15);
            width: 90%;
            max-width: 400px;
            text-align: center;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .register:hover {
            transform: translateY(-6px);
            box-shadow: 0 14px 30px rgba(0,0,0,0.2);
        }

        /* ===== Title ===== */
        .register h2 {
            color: #2E8B57;
            margin-bottom: 25px;
            font-size: 24px;
            font-weight: 700;
        }

        /* ===== Form Inputs ===== */
        .register input {
            width: 100%;
            padding: 14px;
            margin: 12px 0;
            border: 1px solid #ddd;
            border-radius: 10px;
            font-size: 16px;
            background-color: #f9f9f9;
            transition: all 0.3s ease;
        }

        .register input:focus {
            outline: none;
            border-color: #2E8B57;
            background-color: #fff;
            box-shadow: 0 0 8px rgba(46,139,87,0.4);
        }

        /* ===== Submit Button ===== */
        .register button {
            width: 100%;
            background: linear-gradient(90deg, #2E8B57, #3CB371);
            color: white;
            border: none;
            padding: 14px;
            border-radius: 10px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .register button:hover {
            background: linear-gradient(90deg, #3CB371, #2E8B57);
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(46,139,87,0.3);
        }

        /* ===== Link (Login redirect) ===== */
        .register a {
            display: inline-block;
            margin-top: 15px;
            color: #2E8B57;
            font-weight: 500;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .register a:hover {
            color: #1b5e20;
            text-decoration: underline;
        }

        /* ===== Responsive ===== */
        @media (max-width: 480px) {
            .register {
                padding: 30px 20px;
            }

            .register input, .register button {
                font-size: 15px;
                padding: 12px;
            }
        }


    </style>
</head>
<body>
    <div class = "register">
        <form action ="register.php" method ="POST">
           <input type="text" name ="name" placeholder="Enter your Name"><br><br>
           <input type="email" name ="email" placeholder="Enter your Email"><br><br>
           <input type="password" name ="password" placeholder="Enter your Password"><br><br>
           <input type="text" name ="role" value ="user" hidden><br><br>
           <button type ="submit">sign-up</button><br><br>
        </form>

    </div>
    
</body>
</html>