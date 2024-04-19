<?php 
session_start();
include 'user_crud.php';
if (isset($_POST['update'])){
   $update= new user();
   $update->qty_update($_POST['qty'], $_POST['pid'], $_SESSION['user']['id']);
   header('Location:/lily/user/cart.php');  
   
}
if (isset($_POST['remove'])){
    $remove= new user();
    $remove->remove_cart($_POST['pid'], $_SESSION['user']['id']);
    header('Location:/lily/user/cart.php');  
    
 }

?>
