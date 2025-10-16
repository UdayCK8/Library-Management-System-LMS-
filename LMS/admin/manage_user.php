<?php
session_start();
if(isset($_SESSION['user_id'])){
    if($_SESSION['role'] =="admin"){
        include "../db.php";
$sql ="select id,name,email,role from users where role ='user'";
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
      
        /* ===== Body ===== */
       /* Body & Container */
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #f0f4f8, #e8f0f2);
            margin: 0;
            padding: 20px;
        }

        .table-container {
            max-width: 1000px;
            margin: auto;
            background-color: #fff;
            border-radius: 15px;
            padding: 20px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        }

        /* Table */
        table {
            width: 100%;
            border-collapse: collapse;
        }

        /* Header */
        thead th {
            background: linear-gradient(90deg, #0f2027, #203a43, #2c5364);
            color: #fff;
            padding: 14px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            border-bottom: 2px solid #0f2027;
        }

        /* Body Cells */
        tbody td {
            padding: 12px;
            text-align: center;
            color: #333;
            border-bottom: 1px solid #ddd;
        }

        /* Alternating rows */
        tbody tr:nth-child(even) {
            background-color: #f5f5f5;
        }

        /* Hover row */
        tbody tr:hover {
            background-color: #d1d1d1;
            transition: background-color 0.3s ease;
        }

        /* Premium Buttons */
        .link {
            text-decoration: none;
            background-color: #1a73e8;
            color: white;
            padding: 6px 14px;
            border-radius: 8px;
            font-weight: bold;
            display: inline-block;
            transition: all 0.3s ease;
        }

        .link:hover {
            background-color: #155ab6;
            transform: scale(1.05);
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
        }

        /* Responsive */
        @media (max-width: 768px) {
            table, thead, tbody, th, td, tr { display: block; }
            thead { display: none; }
            tbody tr { margin-bottom: 15px; border: 1px solid #ddd; border-radius: 10px; overflow: hidden; background-color: #fff; padding: 10px; }
            tbody td { display: flex; justify-content: space-between; padding: 10px; text-align: left; }
            tbody td:last-child { border-bottom: 0; }
            tbody td::before { font-weight: bold; content: attr(data-label); }
        }

    </style>

</head>
<body>
   <table >
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Role</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php 
        while($row= mysqli_fetch_assoc($result)){
    
        
        ?>
        <tr>
            <td><?php echo "{$row['id']}" ?></td>
            <td><?php echo "{$row['name']}" ?></td>
            <td><?php echo "{$row['email']}" ?></td>
            <td><?php echo "{$row['role']}" ?></td>
            <td>
  <a class="link" href="deleteuser.php?user_id=<?php echo $row['id']; ?>">Delete User</a>
</td>

        </tr>
    <?php } ?>
    </tbody>
</table> 
</body>
</html>