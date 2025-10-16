<?php
session_start();
include "../db.php";

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}

// Only admin can access
if ($_SESSION['role'] !== "admin") {
    header("Location: ../dashboard.php");
    exit();
}

// Get transaction ID safely
$transaction_id = isset($_GET['transaction_id']) ? $_GET['transaction_id'] : null;
if (!$transaction_id) {
    header("Location: view_transactions.php");

    exit();
}

// Handle form submission
if (isset($_POST['submit'])) {
    $rdate = $_POST['rdate'];
    $status = $_POST['status'];

    // Update both return_date and status
    $sql = "UPDATE transactions SET return_date = '$rdate', status = '$status' WHERE id = '$transaction_id'";
    $result = mysqli_query($conn, $sql);

    if (!$result) {
        echo "Error updating transaction: " . mysqli_error($conn);
    } else {
        header("Location: view_transactions.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Transaction</title>
</head>
<body>
    <h3>Update Transaction</h3>
    <form action="update_transactions.php?transaction_id=<?php echo $transaction_id; ?>" method="POST">
        <label>Return Date:</label>
        <input type="date" name="rdate" required>

        <label>Status:</label>
        <select name="status">
            <option value="borrowed">borrowed</option>
            <option value="returned">returned</option>
        </select>

        <input type="submit" name="submit" value="Update">
    </form>
</body>

</html>
