<?php 
include 'user_crud.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css">

    <title>Orders</title>
    <style>
    table {
  border-collapse: collapse;
  width: 80%;
  margin-top: 50px;
}

td, th {
  border: hidden;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: #f2f2f2;
}
.the_button{
    width:100px;
    height:30px;
    font-size: larger;
    background-color: blueviolet;
    color:aliceblue;

}
    </style>

</head>
<body>
<?php 
    include 'header.php';
    ?>
   
    <h2 style="width:100%; margin:20px 0px 20px 0px; padding: 20px 20px 20px 60px;  background-color:#1a5d91; color:white; " > VIEW : <?php if (isset($_POST['view'])){echo "ORDER ID: ". $_POST['orderid'];}?></h2>
    <?php 
    $orders=array();
    $values= new user();
    $orders= $values->display_ordered_items($_POST['orderid']);
    $total=0;
    if(count($orders)>0):?>
       <table>
        <tr>
            <td></td>
            <td>Product Name</td>
            <td>Brand</td>
            <td>Price</td>
            <td>Quantity</td>
            <td>Subtotal</td>

        </tr>
        <?php foreach($orders as $row): 
         $pid = $row['pid'];
         $qty = $row['qty'];
         $subtotal = $row['price'] * $qty;
         $total += $subtotal;
            ?>
            <tr>
                <td ><img  width='50px' height= '50px' src='../admin/<?php echo $row['imagepath']?>'></td>
                <td><?php echo $row['name']?></td>
                <td><?php echo $row['brand']?></td>
                <td><?php echo number_format($row['price'],2)." ETB"?></td>
                <td><?php echo $qty?></td>
                <td><?php echo number_format($subtotal,2)." ETB"?></td>
                
            </tr>
        <?php endforeach ?>
        <tr><td class='thetotal' colspan='5' style='text-align:right'>Total:</td><?php echo "<td>" . number_format($total, 2) . " ETB</td>";?></tr>
        <tr><td style="border:hidden; " align="right" class='thetotal' colspan='6' style='text-align:right'><a href="orders.php"><button class="the_button">Back</button></a></td></tr>
       </table>
       <?php endif ?>
       
</body>
</html>