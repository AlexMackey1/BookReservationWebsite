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
            $un = $_SESSION["un"];
            require_once "database.php";
            $sql = "SELECT reservations.ISBN, reservations.Username, reservations.ReservedDate, books.BookTitle 
            FROM reservations 
            JOIN books ON reservations.ISBN = books.ISBN 
            WHERE reservations.Username = '$un'";
            $result = $conn->query($sql);
            if($result->num_rows > 0){
               echo "<table class='center' border = '1'>";
               echo "<thead>";
               echo "<tr><td>"."ISBN".
               "</td><td>"."BookTitle".
               "</td><td>"."Username".
               "</td><td>" ."ReservedDate".
               "</td></tr>\n";
               echo "</thead>\n";
               while($row = $result->fetch_assoc()){
                  echo ("<tr><td>");
                  echo($row["ISBN"]);
                  echo ("</td><td>");
                  echo($row["BookTitle"]);
                  echo ("</td><td>");
                  echo($row["Username"]);
                  echo ("</td><td>");
                  echo($row["ReservedDate"]);
                  echo ("</td><td>");
                  echo('<a href="remove.php?id='.htmlentities($row["ISBN"]).'">Remove Reservation</a>');
               }
            echo "</table>";
            }
            else{
               echo "0 results";
            }

            $conn->close()
         ?>
   </div>
</body>
</html>