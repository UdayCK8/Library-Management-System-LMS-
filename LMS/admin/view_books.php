
<?php
session_start();
if(isset($_SESSION['user_id'])){
    if($_SESSION['role'] =="admin"){
        include "../db.php";
$sql ="select * from books";
$result =mysqli_query($conn,$sql);
if(!$result){
    echo"error!:{$result->error}";
}
else{

}

}else{
   header("Location:../dashboard.php");
}
}
else{
    header("Location:../login.php");
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
            background: linear-gradient(135deg, #f0f4f8, #e8f0f2);
            margin: 0;
            padding: 20px;
        }

        h1 {
            text-align: center;
            color: #1b5e20;
            margin-bottom: 30px;
        }

        .table-container {
            max-width: 1000px;
            margin: auto;
            overflow-x: auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        }

        /* ===== Table Styling ===== */
        table {
            width: 100%;
            border-collapse: collapse;
        }

        /* ===== Table Header ===== */
        thead th {
            background: linear-gradient(90deg, #0f2027, #203a43, #2c5364); /* premium dark gradient */
            color: #fff;
            padding: 14px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            border-bottom: 3px solid #0f2027;
            text-align: center;
        }

        /* ===== Table Body ===== */
        tbody td {
            padding: 12px;
            text-align: center;
            color: #333;
            border-bottom: 1px solid #ddd;
            vertical-align: middle;
        }

        /* ===== Alternating Rows ===== */
        tbody tr:nth-child(even) {
            background-color: #f5f5f5;
        }

        /* ===== Hover Effect ===== */
        tbody tr:hover {
            background-color: #e0f2f1;
            transform: scale(1.01);
            transition: all 0.2s ease;
        }

        /* ===== Book Images ===== */
        tbody img {
            width: 80px;
            height: auto;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        }

        /* ===== Responsive ===== */
        @media (max-width: 768px) {
            table, thead, tbody, th, td, tr {
                display: block;
            }

            thead {
                display: none; /* hide header on mobile */
            }

            tbody tr {
                margin-bottom: 15px;
                border: 1px solid #ddd;
                border-radius: 10px;
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

            tbody img {
                width: 60px;
            }
        }
    </style>
</head>
<body>
   <table >
    <thead>
        <tr>
            <th>Title</th>
            <th>author</th>
            <th>ISBN</th>
            <th>Image</th>
            <th>Quantity</th>
        </tr>
    </thead>
    <tbody>
        <?php 
        while($row= mysqli_fetch_assoc($result)){
    
        
        ?>
        <tr>
            <td><?php echo "{$row['title']}" ?></td>
            <td><?php echo "{$row['author']}" ?></td>
            <td><?php echo "{$row['isbn']}" ?></td>
            <td><img src="../image/<?php echo $row['image']; ?>" width="100"></td>

            <td><?php echo "{$row['quantity']}" ?></td>
        </tr>
    <?php } ?>
    </tbody>
</table> 
</body>
</html>