<?php  
session_start();
include "../db.php";

if (isset($_SESSION['user_id'])) {

    // Check if the logged-in user is an admin
    if ($_SESSION['role'] == "admin") {

        // Check if user_id is passed in the URL
        $user_id = isset($_GET['user_id']) ? $_GET['user_id'] : null;
        if (!$user_id) {
            die("Error: user_id not provided!");
        }

        // Delete user query
        $sql = "DELETE FROM users WHERE id = '$user_id'";
        $result = mysqli_query($conn, $sql);

        if (!$result) {
            echo "Error: " . mysqli_error($conn);
        } else {
            header("Location: manage_user.php");
            exit();
        }

    } else {
        // If logged-in user is not admin
        header("Location: ../dashboard.php");
        exit();
    }

} else {
    // If no user is logged in
    header("Location: ../login.php");
    exit();
}
?>
