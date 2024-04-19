<?php 
include 'db_con.php';
    session_start();
     
?>
<!doctype html>
<html>
    
    
    <header>
  <a href="index.php" class="logo"><img src="logo3.png"  alt="Logo"></a>
  <nav>
    <ul>
      <li><a href="index.php">Home</a></li>
      <li><a href="shop.php">Products</a></li>
      <?php
    if (isset($_SESSION["user"])) {
      $user = $_SESSION["user"];
      // Display user picture
      echo '<li> <a href=cart.php> Cart </a></li>';
      echo '<li> <a href=orders.php> Orders </a></li>';
      echo '<div class="user-info" onclick="toggleSubBar()" style="display:flex; flex-direction:row; align-items:center;">';
      
      echo '<img src="usericon.png" style="width:20px; height:20px;">';
      echo '<span style="color:rgb(11, 145, 255);"><b>' . $user["name"] . '</b></span>';
      

      echo '</div>';
      // Display sub bar
      echo '<div class="sub-bar" style="display: none;position: absolute; top: 100px; right: 10px; background-color: #B0E0E6; color: white; padding: 10px; width: 150px; align-items: center;" onmouseover="this.style.display:block;" style="display:none;">';
      echo "<ui>";
      echo '<li style="margin-bottom: 5px;"><a href="#">Account</a></li>';
      echo '<li><a href="logout.php">Logout</a></li>';
      echo "<ui>";
      echo '</div>';
    } else {
      // Display login button
      echo '<li><a href="login.php">Login</a></li>';
    }
  ?>
    </ul>
    <script>
  function toggleSubBar() {
    var subBar = document.querySelector(".sub-bar");
    if (subBar.style.display === "block") {
      subBar.style.display = "none";
    } else {
      subBar.style.display = "block";
    }
  }
</script>
  </nav>
  
</header>
<body>


    


    
    
