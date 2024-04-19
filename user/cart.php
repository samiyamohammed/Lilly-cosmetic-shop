<?php
include 'db_con.php';
include 'user_crud.php';


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css">

    <title>Cart</title>
    <style>
       .cart_table{
        margin: auto;
        width: 800px;
       }
       .inputs{
        width:100px;
        background-color: blueviolet;
        color:beige;
       }
       .inputs:hover{
        background-color: blue;
       }
       .inputqty{
        width:60px;
        margin-right: 10px;
       }
       .orderbtn{
        background-color: #1a5d91;
        width: 200px;
       }
       .thetotal{
        font-size: larger;
        font-weight: bolder;
        color:#1a5d91;
       }
    </style>
</head>
<body>
    
<?php 
    include 'header.php';
    ?>

    <h2 style="width:100%; margin:20px 0px 20px 0px; padding: 20px 20px 20px 60px;  background-color:#1a5d91; color:white; " > CART </h2>

   <div class="carting">
   <?php
  $total = 0;
  $sql= "select * from products inner join cart on products.pid=cart.pid where uid=".$_SESSION['user']['id'];
  $result=mysqli_query($con,$sql);
  if(mysqli_num_rows($result)==0){
    echo "Cart is empty.";
  }
  if(mysqli_num_rows($result)>0):?>
  
    <table class="cart_table">
    <tr><th></th><th>Product</th><th>Price</th><th>Quantity</th><th>Subtotal</th><th>Actions</th></tr>
    
 <?php
  while ($row = mysqli_fetch_assoc($result)) {
    $pid = $row['pid'];
    $qty = $row['qty'];
    $subtotal = $row['price'] * $qty;
    $total += $subtotal;
    echo "<tr>";
    echo "<td><img width='50px' height= '50px' src='../admin/" . $row["imagepath"] . "'></td>";
    echo "<td>" . $row['name'] . "</td>";
    echo "<td>" . $row['price'] . "ETB</td>";
    echo "<td><form action='validate.php' method='post'>";
    echo "<input type='hidden' name='pid' value='$pid'>";
    echo "<input class='inputqty' type='number' name='qty' value='$qty' min='1'>";
    echo "<input class='inputs' type='submit' name='update' value='Update'>";
    echo "</form></td>";
    echo "<td>" . number_format($subtotal, 2) . " ETB</td>";
    echo "<td><form action='validate.php' method='post'>";
    echo "<input type='hidden' name='pid' value='$pid'>";
    echo "<input class='inputs' type='submit' name='remove'value='Remove'>";
    echo "</form></td>";
    echo "</tr>";
}
?>

<tr><td class='thetotal' colspan='5' style='text-align:right'>Total:</td><?php echo "<td>" . number_format($total, 2) . " ETB</td><td></td>";?></tr>
<tr><td  colspan='6' style='text-align:right'>
<form action="ordercart.php" method="post">
    <input type="hidden" name="amount" value="<?php echo number_format($total,2)?>">
    <input type="submit" value="Place Order" name="place_order">
</form>

</td></tr>


</table>
<?php endif?>
    </div>
</body>
</html>