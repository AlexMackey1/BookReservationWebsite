<?php
   session_start();
?>

<?php
   require_once "database.php";

   if ( isset($_POST['Username']) && isset($_POST['Password'])  && isset($_POST['ConPassword'])
      && isset($_POST['FirstName']) && isset($_POST['Surname']) && isset($_POST['AddressLine1'])
      && isset($_POST['AddressLine2']) && isset($_POST['City']) && isset($_POST['Telephone']) && isset($_POST['Mobile'])){
      $un = $_POST['Username'];
      $pw = $_POST['Password'];
      $cpw = $_POST['ConPassword'];

      if ($pw != $cpw) {
         $_SESSION["Error"] = "Passwords do not match";
         header('Location: register.php');
         exit();
      }

      if (strlen($pw) != 6){
         $_SESSION["Error"] = "Passwords must be 6 charachters in length";
         header('Location: register.php');
         exit();
      }

      $fn = $_POST['FirstName'];
      $sn = $_POST['Surname'];
      $ad1 = $_POST['AddressLine1'];
      $ad2 = $_POST['AddressLine2'];
      $city = $_POST['City'];
      $tel = $_POST['Telephone'];

      if(is_numeric($tel) == FALSE){
         $_SESSION["Error"] = "Telephone number must be fully numeric";
         header('Location: register.php');
         exit();
      }

      $mob = $_POST['Mobile'];

      if(strlen($mob) != 10){
         $_SESSION["Error"] = "Mobile number must be 10 charachters in length";
         header('Location: register.php');
         exit();
      }

      if(is_numeric($mob) == FALSE){
         $_SESSION["Error"] = "Mobile number must be fully numeric";
         header('Location: register.php');
         exit();
      }

      $sql = "INSERT INTO users (Username, Password, FirstName, Surname, AddressLine1, AddressLine2, City, Telephone, Mobile) 
            VALUES ('$un', '$pw', '$fn', '$sn', '$ad1', '$ad2', '$city', '$tel', '$mob')";

      if ($conn->query($sql) == TRUE){
         echo '<script>alert("New user registered successfully");</script>';
         header('Location: login.php');
      }

      else{
         echo "Error: " . $sql . "<br>" . "$conn->error";
      }

      $conn->close();

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
   <div class="banner-register">
      <div class="navbar">
         <label class="logo">Alex's Library</label>
         <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="#">Categories</a></li>
            <li><a href="view.php">View Reserved Books</a></li>
            <li><a href="login.php">Login</a></li>
            <li><a href="logout.php ">Logout</a></li>
         </ul>
      </div>

      <?php
         if (isset($_SESSION["Error"])) {
            echo("<script>alert('".$_SESSION["Error"]."')</script>");
            unset($_SESSION["Error"]);
         }
      ?>

      <div class="register-container">
         <form method="post">
            <h2>Registration</h2>
            <div class ="form-group">
               <label for="Username">Username: </label>
               <input type="text" class="form-control" name="Username" required>
            </div>
            <div class="form-group">
               <label for="Password">Password: </label>
               <input type="password" class="form-control" name="Password" placeholder="Must be 6 charachters" required>
            </div>
            <div class="form-group">
               <label for="ConPassword">Confirm Password: </label>
               <input type="password" class="form-control" name="ConPassword" placeholder="Must be 6 charachters" required>
            </div>
            <div class ="form-group">
               <label for="FirstName">First Name: </label>
               <input type="text" class="form-control" name="FirstName" required>
            </div>
            <div class ="form-group">
               <label for="Surname">Surname: </label>
               <input type="text" class="form-control" name="Surname" required>
            </div>
            <div class ="form-group">
               <label for="AddressLine1">Address Line 1: </label>
               <input type="text" class="form-control" name="AddressLine1" required>
            </div>
            <div class ="form-group">
               <label for="AddressLine2">Address Line 2: </label>
               <input type="text" class="form-control" name="AddressLine2" required>
            </div>
            <div class ="form-group">
               <label for="City">City:</label>
               <input type="text" class="form-control" name="City" required>
            </div>
            <div class ="form-group">
               <label for="Telephone">Telephone Number: </label>
               <input type="text" class="form-control" name="Telephone" required>
            </div>
            <div class ="form-group">
               <label for="Mobile">Mobile Number: </label>
               <input type="text" class="form-control" name="Mobile" placeholder="Mobile phone numbers must 10 numbers in length" required>
            </div>
            <input type="submit" class="button" value="Register">
         </form>
      </div>
   </div>
</body>
</html>
