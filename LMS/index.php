<?php
session_start();
include "db.php";

$sql = "SELECT * FROM books";
$result = mysqli_query($conn, $sql);

if (!$result) {
    echo "Error: {$conn->error}";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library</title>
    <style type="text/css">
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* ===== Body ===== */
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f0f4f7; /* soft premium background */
            color: #333;
        }

        /* ===== Header ===== */
        header.indexheader {
            position: fixed;
            top: 0;
            width: 100%;
            background: linear-gradient(135deg, #0D47A1, #1976D2); /* premium deep blue gradient */
            padding: 20px 40px;
            color: white;
            box-shadow: 0 6px 15px rgba(0,0,0,0.2);
            z-index: 1000;
        }

        header.indexheader ul {
            list-style: none;
            display: flex;
            justify-content: flex-end;
            gap: 25px;
        }

        header.indexheader a {
            color: white;
            text-decoration: none;
            font-weight: bold;
            transition: color 0.3s ease;
        }

        header.indexheader a:hover {
            color: #FFD700; /* premium gold on hover */
            text-decoration: underline;
        }

        /* ===== Section ===== */
        .indexsection {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 25px;
            padding: 140px 20px 100px 20px; /* top padding for fixed header */
        }

        /* ===== Book Cards ===== */
        .indexsection div {
            width: 220px;
            background: linear-gradient(145deg, #ffffff, #e3f2fd); /* subtle premium gradient */
            border-radius: 15px;
            padding: 15px;
            text-align: center;
            box-shadow: 0 10px 25px rgba(0,0,0,0.15);
            transition: transform 0.3s ease, box-shadow 0.3s ease, background 0.3s ease;
        }

        .indexsection div:hover {
            transform: translateY(-7px);
            box-shadow: 0 15px 30px rgba(0,0,0,0.25);
            background: linear-gradient(145deg, #bbdefb, #e3f2fd);
        }

        /* ===== Book Images ===== */
        .indexsection img {
            width: 100%;
            height: auto;
            border-radius: 12px;
            margin-bottom: 10px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
        }

        /* ===== Book Info ===== */
        .indexsection p {
            margin: 5px 0;
            font-size: 14px;
            font-weight: 500;
        }

        /* ===== Borrow Button ===== */
        .indexsection a {
            display: inline-block;
            margin-top: 10px;
            padding: 10px 18px;
            background: linear-gradient(90deg, #FF6F00, #FFA000); /* premium orange-gold */
            color: white;
            text-decoration: none;
            border-radius: 12px;
            font-weight: bold;
            transition: background 0.3s ease, transform 0.2s ease;
        }

        .indexsection a:hover {
            background: linear-gradient(90deg, #FFA000, #FF6F00);
            transform: translateY(-2px);
        }

        /* ===== Footer ===== */
        footer {
            background: linear-gradient(135deg, #0D47A1, #1976D2);
            color: white;
            padding: 15px;
            text-align: center;
            position: fixed;
            bottom: 0;
            width: 100%;
            box-shadow: 0 -6px 15px rgba(0,0,0,0.2);
        }

        /* ===== Responsive ===== */
        @media (max-width: 768px) {
            .indexsection div {
                width: 45%;
            }
        }

        @media (max-width: 480px) {
            header.indexheader ul {
                flex-direction: column;
                align-items: center;
                gap: 10px;
            }
            .indexsection div {
                width: 90%;
            }
        }
  

        .dash {
            top:10px;
            display: inline-block;
            padding: 10px 20px;
            background: linear-gradient(135deg, #59be5bff, #0e3217ff); /* premium green gradient */
            color: white;
            font-weight: bold;
            text-decoration: none;
            border-radius: 12px;
            box-shadow: 0 6px 15px rgba(0,0,0,0.2);
            transition: transform 0.2s ease, box-shadow 0.2s ease, background 0.3s ease;
        }

        .dash:hover {
            background: linear-gradient(135deg, #0E3217FF, #59BE5BFF);
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.3);
        }
    
        .img {
            width: 30px;              /* tiny logo size */
            height: 30px;             /* maintain square */
            border-radius: 50%;       /* circular logo */
            object-fit: cover;        /* ensures image fills the circle */
            margin-right: 10px;       /* spacing from text or links */
            box-shadow: 0 4px 8px rgba(0,0,0,0.2); /* subtle shadow for depth */
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .img:hover {
            transform: scale(1.1);    /* slightly enlarge on hover */
            box-shadow: 0 6px 15px rgba(0,0,0,0.3);
            cursor: pointer;
        }
        .style {
            color: white;
            font-weight: bold;
        }
        
        .c {
            background-color: orange;   /* primary blue */
            color: white;                /* white text */
            border: none;                /* no border */
            padding: 10px 20px;          /* spacing inside button */
            border-radius: 8px;          /* smooth corners */
            font-size: 16px;             /* readable size */
            font-weight: bold;           /* bold text */
            cursor: pointer;             /* pointer on hover */
            transition: background 0.3s ease, transform 0.2s ease;
        }

        /* Hover effect */
        .c:hover {
            background-color: #d2dde9ff;   /* darker blue on hover */
            transform: scale(1.05);      /* slight zoom effect */
        }
    </style>
</head>
<body>
    <header class="indexheader">
        <img  class="img" src="image/59b2ced628f1d66bb1959d71e40250d4.jpg" >
        <p class="style" >Library Management System (LMS)</p>
        <nav>
            <ul>
                <?php if(!isset($_SESSION['user_id'])) { ?>
                    <li><a class="c" href="login.php">Login</a></li>
                    <li><a class="c" href="register.php">Sign up</a></li>
                <?php } else { ?>
                    <li><a class="dash" href="dashboard.php">Dashboard</a></li>
                    
                    
                <?php } ?>
            </ul>
        </nav>
    </header>

    <section class="indexsection">
        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
            <div>
                <img src="image/<?php echo htmlspecialchars($row['image']); ?>" alt="Book Image">
                <p><strong>Book Title:</strong> <?php echo htmlspecialchars($row['title']); ?></p>
                <p><strong>Author:</strong> <?php echo htmlspecialchars($row['author']); ?></p>
                <p><strong>ISBN:</strong> <?php echo htmlspecialchars($row['isbn']); ?></p>
                <p><strong>Quantity:</strong> <?php echo htmlspecialchars($row['quantity']); ?></p>
                <a href="borrow.php?book_id=<?php echo $row['id']; ?>">Borrow</a>
            </div>
        <?php } ?>
    </section>

    <footer>
        <p>© Code Library Management System</p>
    </footer>
</body>
</html>