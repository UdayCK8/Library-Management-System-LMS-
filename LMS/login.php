<?php
session_start();
include "db.php";

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);

        if ($row['password'] == $password) {
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['role'] = $row['role'];
            
            header("Location: index.php");
            exit();
        } else {
            echo "<p style='color:red;'>Invalid password!</p>";
        }
    } else {
        echo "<p style='color:red;'> Email not found!</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login Page</title>
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
    background: linear-gradient(135deg, #2E8B57, #3CB371, #66CDAA);
    background-size: 200% 200%;
    animation: gradientMove 6s ease infinite;
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
}

@keyframes gradientMove {
    0% { background-position: 0% 50%; }
    50% { background-position: 100% 50%; }
    100% { background-position: 0% 50%; }
}

/* ===== Login Card ===== */
.register {
    background: #ffffff;
    padding: 45px 35px;
    border-radius: 20px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.15);
    text-align: center;
    max-width: 400px;
    width: 90%;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.register:hover {
    transform: translateY(-6px);
    box-shadow: 0 14px 30px rgba(0,0,0,0.2);
}

/* ===== Logo ===== */
.Logo {
    width: 120px;
    height: auto;
    margin-bottom: 25px;
    border-radius: 20%;
    box-shadow: 0 4px 15px rgba(0,0,0,0.2);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.Logo:hover {
    transform: scale(1.1);
    box-shadow: 0 6px 20px rgba(0,0,0,0.25);
}

/* ===== Inputs ===== */
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

/* ===== Buttons ===== */
.register button {
    width: 100%;
    padding: 14px;
    margin-top: 15px;
    border: none;
    border-radius: 10px;
    font-size: 16px;
    font-weight: 600;
    cursor: pointer;
    color: #fff;
    background: linear-gradient(90deg, #2E8B57, #3CB371);
    transition: all 0.3s ease;
}

.register button:hover {
    background: linear-gradient(90deg, #3CB371, #2E8B57);
    transform: translateY(-2px);
    box-shadow: 0 6px 15px rgba(46,139,87,0.3);
}

/* ===== Secondary Button (Signup) ===== */
.register a button {
    background: linear-gradient(90deg, #6C63FF, #7B68EE);
    color: #fff;
}

.register a button:hover {
    background: linear-gradient(90deg, #7B68EE, #6C63FF);
    box-shadow: 0 6px 15px rgba(108,99,255,0.3);
}

/* ===== Error Message ===== */
.error {
    color: #d9534f;
    background: #fdecea;
    border: 1px solid #f5c6cb;
    padding: 10px;
    border-radius: 8px;
    margin-bottom: 15px;
    font-size: 15px;
}

/* ===== Responsive ===== */
@media (max-width: 480px) {
    .register {
        padding: 30px 20px;
    }

    .Logo {
        width: 90px;
    }

    .register input, .register button {
        font-size: 15px;
        padding: 12px;
    }
}
</style>
</head>
<body>

<?php include "heading.php"; ?>

<div class="register">
    <?php if (!empty($error)) { echo "<div class='error'>{$error}</div>"; } ?>
    
    <form action="login.php" method="POST">
        <a href="index.php">
        <img class="Logo" src="image/59b2ced628f1d66bb1959d71e40250d4.jpg" alt="book logo"></a>
        <input type="email" name="email" placeholder="Enter your Email" required>
        <input type="password" name="password" placeholder="Enter your Password" required>
        <button type="submit" name="login">Login</button>
        <a href="register.php" style="text-decoration:none;">
        <button type="button">Signup</button>
    </form>
    
    </a>
</div>

</body>
</html>

 





