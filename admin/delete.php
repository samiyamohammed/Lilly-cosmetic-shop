<?php
include 'crud.php';

if (isset($_GET["id"])){
    $id = $_GET["id"];
    $delete= new producttable();
    $delete-> delete($id);
    

    header('Location:/lily/admin/admin_products.php');
}
     
?>