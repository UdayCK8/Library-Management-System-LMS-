<?php  
session_start();
include "../db.php";
if(isset($_SESSION['user_id'])){
    if($_SESSION['role'] =="admin"){
        $sql ="select * from transactions";
        $result =mysqli_query($conn,$sql);
        if(!$result){
            echo"error!:{$conn->error}";
        }
        else{

        }

    }else{
        header("Location:../dashboard.php");
        exit();
    }
}else{
     header("Location:../login.php");
     exit();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library</title>
    <style type ="text/css">
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #e0f7fa, #e8f0f2); /* soft gradient background */
            margin: 0;
            padding: 20px;
        }

        h1 {
            text-align: center;
            color: #0d47a1; /* deep blue for premium feel */
            margin-bottom: 30px;
            font-size: 2rem;
            letter-spacing: 1px;
        }

        /* Table container */
        .table-container {
            max-width: 1000px;
            margin: auto;
            overflow-x: auto;
            background-color: #fff;
            padding: 25px;
            border-radius: 20px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.15);
        }

        /* Table styling */
        table {
            width: 100%;
            border-collapse: collapse;
        }

        /* Header */
        thead th {
            background: linear-gradient(90deg, #0d47a1, #1976d2); /* deep blue gradient */
            color: #fff;
            padding: 14px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            border-bottom: 3px solid #0b3c91;
            text-align: center;
            border-radius: 8px 8px 0 0;
        }

        /* Table Body */
        tbody td {
            padding: 12px;
            text-align: center;
            color: #212121;
            border-bottom: 1px solid #ddd;
        }

        /* Alternating Rows */
        tbody tr:nth-child(even) {
            background-color: #f1f8e9; /* light green tint */
        }

        /* Hover Effect */
        tbody tr:hover {
            background-color: #dcedc8; /* brighter green on hover */
            transform: scale(1.01);
            transition: all 0.2s ease;
        }

        /* Action Buttons */
        .update, .delete {
            text-decoration: none;
            padding: 8px 16px;
            border-radius: 10px;
            color: #fff;
            font-weight: bold;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        /* Update button */
        .update {
            background: linear-gradient(90deg, #43a047, #66bb6a); /* premium green gradient */
        }

        .update:hover {
            background: linear-gradient(90deg, #2e7d32, #43a047);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
        }

        /* Delete button */
        .delete {
            background: linear-gradient(90deg, #e53935, #ef5350); /* premium red gradient */
        }

        .delete:hover {
            background: linear-gradient(90deg, #b71c1c, #e53935);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
        }

        /* Responsive */
        @media (max-width: 768px) {
            table, thead, tbody, th, td, tr {
                display: block;
            }

            thead {
                display: none; /* hide headers */
            }

            tbody tr {
                margin-bottom: 15px;
                border: 1px solid #ddd;
                border-radius: 12px;
                overflow: hidden;
                background-color: #fff;
                padding: 10px;
            }

            tbody td {
                display: flex;
                justify-content: space-between;
                padding: 10px;
                text-align: left;
                border-bottom: 1px solid #eee;
            }

            tbody td:last-child {
                border-bottom: 0;
            }

            tbody td::before {
                font-weight: bold;
                content: attr(data-label);
            }
        }
    </style>

</head>
<body>
   <table >
    <thead>
        <tr>
            <th>user id</th>
            <th>book id</th>
            <th>issue date</th>
            <th>return date</th>
            <th>status</th>
            <th>Action</th>
            <th>action</th>
        </tr>
    </thead>
    <tbody>
        <?php 
        while($row= mysqli_fetch_assoc($result)){
    
        
        ?>
        <tr>
            <td><?php echo "{$row['user_id']}" ?></td>
            <td><?php echo "{$row['book_id']}" ?></td>
            <td><?php echo "{$row['issue_date']}" ?></td>
            <td><?php echo "{$row['return_date']}"?></td>
            <td><?php echo "{$row['status']}"?></td>
            <td><a  class="update" href="update_transactions.php?transaction_id=<?php echo $row['id']; ?>">Update</a></td>
            <td><a class="delete" href="delete_transactions.php?transaction_id=<?php echo $row['id'] ?>">Delete</a></td>
        </tr>
    <?php } ?>
    </tbody>
</table> 
</body>
</html>