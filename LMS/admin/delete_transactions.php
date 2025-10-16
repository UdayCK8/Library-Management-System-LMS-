<?php  
session_start();
include "../db.php";
if(isset($_SESSION['user_id'])){

    if($_SESSION['role'] =="admin"){
        $transaction_id = isset($_GET['transaction_id']) ? $_GET['transaction_id'] : null;
        if (!$transaction_id) {
            die("Error: transaction_id not provided!");
        }
        $sql ="delete  from transactions  where id = '$transaction_id'";
        $result = mysqli_query($conn,$sql);
        if(!$result){
            echo "Error: " . mysqli_error($conn);

        }
        else{
          header("Location:view_transactions.php");
            exit();

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