<?php
session_start();
if(isset($_SESSION['user'])){
  header('Location:/lily/user/login.php');
}
else{
    header('Location:/lily/user/cart.php');
}
?>