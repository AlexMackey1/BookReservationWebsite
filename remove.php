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
        if (isset($_GET['id'])) {
            require_once "database.php";
            $ISBN = $conn->real_escape_string($_GET['id']);
            $sqlDelete = "DELETE FROM reservations WHERE ISBN = '$ISBN'";
            if ($conn->query($sqlDelete) === TRUE) {
                echo "Record deleted successfully.";
                $sqlUpdate = "UPDATE books SET Reserved = 'N' WHERE ISBN = '$ISBN'";
                if ($conn->query($sqlUpdate) !== TRUE) {
                    echo "Error updating record: " . $conn->error;
                }
            } else {
                echo "Error deleting record: " . $conn->error;
            }
            $conn->close();
            header("Location: view.php");
            exit();
        }
        ?>
    </div>
</body>
</html>