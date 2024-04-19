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
    include 'header.php';
    ?>

    <h2 style="width:100%; margin:20px 0px 20px 0px; padding: 20px 20px 20px 60px;  background-color:#1a5d91; color:white; " > Orders </h2>
    <?php 
    $orders=array();
    $values= new user();
    $orders= $values->display_orders($_SESSION['user']['id']);
    if(count($orders)>0):?>
       <table>
        <tr>
            <td>OrderID</td>
            <td>Name</td>
            <td>Email</td>
            <td>Address</td>
            <td>Amount</td>
            <td></td>
        </tr>
        <?php foreach($orders as $order):?>
            <tr>
                <td><?php echo $order['oid']?></td>
                <td><?php echo $order['name']?></td>
                <td><?php echo $order['email']?></td>
                <td><?php echo $order['address']?></td>
                <td><?php echo number_format($order['amount'],2)." ETB"?></td>
                <td><form action="view.php" method="post"><input type="hidden" name="orderid" value="<?php echo $order['oid']?>"> <input type="submit" name="view" value="View"> </form></td>
            </tr>
        <?php endforeach ?>
       </table>
       <?php endif ?>
   


    <?php 
    include 'footer.php';
    ?>
</body>
</html>