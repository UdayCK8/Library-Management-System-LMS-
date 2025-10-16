<?php
session_start();
include "db.php";

if(isset($_GET['book_id'])){
    $book_id = $_GET['book_id'];
} else {
    die("No book selected!");
}

if(isset($_SESSION['user_id'])){
    $user_id = $_SESSION['user_id'];

    if($_SESSION['role'] == "user"){
        // Insert transaction
        $sql = "INSERT INTO transactions (user_id, book_id, issue_date, status)
                VALUES ('$user_id', '$book_id', CURDATE(), 'borrowed')";
        $result = mysqli_query($conn, $sql);

        if($result){
            // Optionally update book quantity
            $sql2 = "UPDATE books SET quantity = quantity - 1 WHERE id = '$book_id'";
            $result2 = mysqli_query($conn, $sql2);

            if($result2){
                echo '<p class="alert-success">✔ Your request has been sent to the librarian! <a  class="go" href="index.php">Go back</a></p>';

            } else {
                echo "Error updating quantity: {$conn->error}";
            }

        } else {
            echo "Error creating transaction: {$conn->error}";
        }

    } else {
        header("Location: admin/dashboard.php");
        exit();
    }

} else {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .alert-success {
            background: linear-gradient(135deg, #43a047, #66bb6a); /* premium green gradient */
            color: #fff;
            padding: 20px 25px;
            border-radius: 12px;
            font-weight: 600;
            font-size: 16px;
            text-align: center;
            box-shadow: 0 8px 20px rgba(0,0,0,0.2);
            max-width: 600px;
            margin: 40px auto;
            animation: fadeIn 0.5s ease-out;
        }

        /* ===== Go Back Button ===== */
        .go {
            display: inline-block; /* puts it on next line */
            margin-top: 20px;      /* spacing below alert */
            background: #fff;
            color: #43a047;
            padding: 12px 24px;
            border-radius: 10px;
            font-weight: bold;
            text-decoration: none;
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
            transition: all 0.3s ease;
        }

        .go:hover {
            background: #f1f1f1;
            transform: translateY(-3px) scale(1.05);
            cursor: pointer;
        }

        /* ===== Fade-in animation ===== */
        @keyframes fadeIn {
            0% {opacity: 0; transform: translateY(-20px);}
            100% {opacity: 1; transform: translateY(0);}
        }
    </style>
</head>

</html>
