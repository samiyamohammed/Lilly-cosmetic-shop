<?php
include 'crud.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title> 
    <link rel="stylesheet" type="text/css" href="try.css">
    <style> 
            table {
  border-collapse: collapse;
  width: 1000px;
  margin-top: 50px;
}

td, th {
  border: 1px solid #ddd;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: #f2f2f2;
}
    </style>
</head>
<body>
<?php
include 'dashboard.php';
?>

<div class="mid">
<div class="top">
    <p>ORDERS</p>
</div>
<div>
    <h3>Order-ID: <?php echo $_POST['view']?></h3>
<?php 
    $orders=array();
    $values= new producttable();
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
       
</div>
</div>
</body>
</html>