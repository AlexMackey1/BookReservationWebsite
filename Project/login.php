<?php 
   session_start();
?>

<?php   
   require_once "database.php";
   
   if (isset($_POST['Username']) && isset($_POST['Password'])) {
       $un = $_POST['Username'];
       $pw = $_POST['Password'];
   
       $sql = "SELECT Username, Password FROM users WHERE Username = '$un' AND Password = '$pw'";
       $result = $conn->query($sql);
   
       if ($result !== false && $result->num_rows > 0) {
           $_SESSION["un"] = $un;
           $_SESSION["success"] = "Login Successful";
           header('Location: index.php');
           exit();
       } else {
           $_SESSION["Error"] = "Incorrect username or password. Please try again";
           header('Location: login.php');
           exit();
       }
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
        if (isset($_SESSION["Error"])) {
            echo("<script>alert('".$_SESSION["Error"]."')</script>");
            unset($_SESSION["Error"]);
         }
      ?>
         
      <div class="login-container">
         <form method="post">
            <h2>User Login</h2>
            <div class ="form-group">
               <label for="username">Username: </label>
               <input type="text" class="form-control" name="Username" required>
            </div>
            <div class="form-group">
               <label for="password">Password: </label>
               <input type="password" class="form-control" name="Password" required>
            </div>
            <input type="submit" class="button" value="Login">
            <p>New User?<a href="register.php"> Register here</a></p>
         </form>
      </div>
   </div>       
</body>
</html>