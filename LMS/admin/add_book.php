
<?php
session_start();
if(isset($_SESSION['user_id'])){
    if($_SESSION['role'] =="admin"){

      if($_SERVER['REQUEST_METHOD'] == "POST"){
        $title = $_POST['title'];
        $author = $_POST['author'];
        $isbn = $_POST['isbn'];
        $image = $_FILES['image']['name'];
        $quantity = $_POST['quantity'];

       include "../db.php";
       $sql = "insert into books(title,author,isbn,image,quantity) 
        values('$title','$author','$isbn','$image','$quantity')";
       $result = mysqli_query($conn, $sql);
       if(!$result){
         echo"Error!:{$conn->error}";
         }else{
         $image_location = $_FILES['image']['tmp_name'];
         $upload_location = "../image/";
         move_uploaded_file($image_location, $upload_location.$image);
         echo"book added suceessfully";
    
        }
    }
  }

  
}
else {
  header("Location:../login.php");
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library</title>
    
    <style type="text/css">
     .admin{
     display: flex;
     justify-content: center;
     margin-top: 150px;
     }
       .admin input{
        padding: 20px;
        margin: 5px;
        border:none ;
        border-bottom: 2px solid blue;
      }
      .admin button{
        padding: 20px;
       
        margin: 5px;
        border-radius: 2px;
       background-color:lightskyblue;

      }
      .file{
        border: none!important;
        width:100%;
      }
    </style>
</head>
<body>
    <div class="admin">
        <form action="add_book.php" method="POST" enctype="multipart/form-data">
            <input type="text" name="title" placeholder=" Book Title"><br><br>
            <input type="text" name="author"placeholder="Author"><br><br>
            <input type="text" name="isbn"placeholder="ISBN"><br><br>
            <input class="file" type="file" name="image"placeholder="Image"><br><br>
            <input type="text" name="quantity"placeholder="Quantity"><br><br>
            <button type="submit"> Add Book</button>
        </form>
    </div>
    
</body>
</html>