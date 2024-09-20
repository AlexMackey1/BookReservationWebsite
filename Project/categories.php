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
        <div>
            <?php
                require_once "database.php";
                $sql = "SELECT CategoryID, CategoryDescription FROM categories ORDER BY CategoryDescription";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    echo '<form method="post" class="category-form">';
                    echo '<label for="bookCategory"><h2>Search by category:</h2></label>';
                    echo '<select name="Category">';
                    echo '<option value="">Select a category</option>';
                    while($row = $result->fetch_assoc()) {
                        echo '<option value="' . $row['CategoryID'] . '">' . $row['CategoryDescription'] . '</option>';
                    }
                    echo '</select>';
                    echo '<input type="submit" value="Search">';
                    echo '</form>';
                    if(isset($_POST['Category']) && ($_POST['Category'] !== "")) {
                        $cat = $_POST['Category'];
                        $sql = "SELECT * FROM books WHERE Category = $cat";
                        $result = $conn->query($sql);
                        if($result->num_rows > 0){
                            echo "<table class='center' border = '1'>";
                            echo "<thead>";
                            echo "<tr><td>"."ISBN".
                            "</td><td>"."BookTitle".
                            "</td><td>" ."Author".
                            "</td><td>" ."Edition".
                            "</td><td>" ."Year".
                            "</td><td>" ."CategoryID".
                            "</td><td>" ."Reserved".
                            "</td></tr>\n";
                            echo "</thead>\n";
                            while($row = $result->fetch_assoc()){
                                echo "<tr style='color: white;'><td>";
                                echo($row["ISBN"]);
                                echo ("</td><td>");
                                echo($row["BookTitle"]);
                                echo ("</td><td>");
                                echo($row["Author"]);
                                echo ("</td><td>");
                                echo($row["Edition"]);
                                echo ("</td><td>");
                                echo($row["Year"]);
                                echo ("</td><td>");
                                echo($row["Category"]);
                                echo ("</td><td>");
                                echo($row["Reserved"]);
                                echo ("</td><td>");
                                if($row["Reserved"] == 'N'){
                                   echo('<a href="reserve.php?id='.htmlentities($row["ISBN"]).'">Reserve</a>');
                                }
                                else{
                                   echo("<p>Already Reserved</p>");
                                }
                             }
                             echo "</table>";
                         }
                         else{
                            echo '<div class="errorMessage">';
                            echo "0 results";
                            echo '</div>';
                         }
                    }
                }
                else {
                    echo "Error: " . $sql . "<br>" . "$conn->error";
                }
                $conn->close()
            ?>
        </div>
    </div>
</body>
</html>
