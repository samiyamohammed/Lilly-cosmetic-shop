<?php
session_start();
include 'db_con.php';
$err="";
if (isset($_POST['submit'])) {
    // Retrieve the email and password from the form
    $email = $_POST['email'];
    $password = $_POST['password'];
  
    // Prepare a SQL query to check if the email and password are valid
    $sql = "SELECT * FROM admin WHERE email='$email' AND password='$password'";
    $result = mysqli_query($con, $sql);

    if ($result) {
      // Check if the email and password match a user in the database
      if (mysqli_num_rows($result) == 1) {
        // Login successful
        $_SESSION['admin'] = "Anna";
        header("Location: try.php");
      } else {
        // Login failed
        $err= "Invalid email or password. Please try again.";
      }
    } else {
      echo "Error: " . mysqli_error($con);
    }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Login</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<div class="adminLogin">  
  <div class="topcontainer">
    <img src="logo3.png" class="tops" style="height:50px; width:110px">
    <p class="tops">LILY COSMETICS</p>
  </div>

<div class="formcontainer">
    <h1>Admin Login</h1>
    <form action="admin_login.php" method="POST">
      <label for="email">Email:</label>
      <input type="email" name="email" required><br><br>
      <label for="password">Password:</label>
      <input type="password" name="password" required><br>
      <span style="color:red"><?php echo $err?></span><br><br>
      <button type="submit" name="submit">Login</button>
    </form>
  </div>
</div>
</body>
</html>



