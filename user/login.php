<?php 
include 'db_con.php';

// Define variables and set to empty values
$emailErr = $passwordErr = "";
$email = $password = "";

if (isset($_POST['submit'])) {
  // Validate email
  if (empty($_POST["email"])) {
    $emailErr = "Email is required";
  } else {
    $email = test_input($_POST["email"]);
    // Check if email is valid
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $emailErr = "Invalid email format";
    }
  }
  
  // Validate password
  if (empty($_POST["password"])) {
    $passwordErr = "Password is required";
  } else {
    $password = test_input($_POST["password"]);
    // You can add more complex password validation rules here, e.g. minimum length, must contain a number, etc.
  }

  if($emailErr==''&& $passwordErr==''){
    $query = "SELECT * FROM user WHERE email = '$email' AND password = '$password'";
    $result = mysqli_query($con, $query);
    if (mysqli_num_rows($result) == 1) {
        $row= mysqli_fetch_assoc($result);
        session_start();
        $_SESSION['user']=$row;
        header('Location:/lily/user/weew.php');
      
    }
    else{
        $passwordErr = "Incorrect password";

    }
  }
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css">

    <title>Login</title>
    <style>
        .theform {
  width: 500px;
  margin: auto;
  padding: 20px;
  border: 1px solid #ccc;
  border-radius: 5px;
  box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
}

.theform input[type="email"],
.theform input[type="password"],
.theform input[type="submit"] {
  display: block;
  width: 90%;
  margin-bottom: 10px;
  padding: 10px;
  border: 1px solid #ccc;
  border-radius: 5px;
}

.theform input[type="submit"] {
  background-color:darkcyan;
  color: #fff;
  border: none;
  cursor: pointer;
}

.theform input[type="submit"]:hover {
  background-color: #3e8e41;
}
span{
    color:red;
}
    </style>
</head>

<body>
    <?php include 'header.php'?>

    <form class="theform" method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">
  <h2 align="center">Login</h2>
  Email: <input type="email" name="email" >
  <span class="error"><?php echo $emailErr;?></span><br>
  Password: <input type="password" name="password" >
  <span class="error"><?php echo $passwordErr;?></span><br>
  <input type="submit" name="submit" value="Submit">
  <a href="register.php"> Create an Account?</a>
</form> 

    <?php include 'footer.php'?>
</body>
</html>