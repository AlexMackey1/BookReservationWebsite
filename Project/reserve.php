<?php 
   session_start();
   if(!isset($_SESSION['success']))
       {
           header("Location:Login.php");  
       }
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Alex's Library</title>
   <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="banner">
        <div class="navbar">
            <label class="logo">Alex's Library</label>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="categories.php">Categories</a></li>
                <li><a href="view.php">View Reserved Books</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </div>
        <?php
        require_once "database.php";
        if (isset($_GET['id'])) {
            $ISBN = $_GET['id'];
            $un = $_SESSION["un"];
            $date = date("Y-m-d");
            $sql = "INSERT INTO reservations (ISBN, Username, ReservedDate) VALUES ('$ISBN', '$un', '$date')";
            if ($conn->query($sql) === TRUE) {
                echo "<script>alert('New Reservation Added'); window.setTimeout(function(){ window.location.href = 'index.php'; }, 10);</script>";
                $sql = "UPDATE books SET Reserved = 'Y' WHERE ISBN = '$ISBN'";
                $conn->query($sql);
            } 
            else {
                echo "Error: Reservation could not be completed";
            }
        }
        ?>
    </div>
</body>
</html>
