<?php
include 'user_crud.php';
session_start();
if(isset($_POST['add-to-cart'])){
  $add= new user();
  if ($add->add_to_cart($_SESSION['user']['id'], $_POST['pid'], $_POST['qty'])==true){
    echo "<script>alert('Inserted')</script>";
  }
  header('Location:/lily/user/shop.php');
}
?>