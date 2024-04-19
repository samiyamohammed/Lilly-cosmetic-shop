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
    <?php 
    $orders=array();
    $values= new producttable();
    $orders= $values->display_all_orders();
    if(count($orders)>0):?>
       <table>
        <tr>
            <td>OrderID</td>
            <td>Name</td>
            <td>Email</td>
            <td>Address</td>
            <td>Ordered Date</td>
            <td>Amount</td>
            <td></td>
        </tr>
        <?php foreach($orders as $order):?>
            <tr>
                <td><?php echo $order['oid']?></td>
                <td><?php echo $order['name']?></td>
                <td><?php echo $order['email']?></td>
                <td><?php echo $order['address']?></td>
                <td><?php echo date('Y-m-d',strtotime($order['date']))?></td>
                <td><?php echo number_format($order['amount'],2)." ETB"?></td>
                <td><form action="view.php" method="post"><input type="hidden" name="orderid" value="<?php echo $order['oid']?>"> <input type="submit" name="view" value="View"> </form></td>
            </tr>
        <?php endforeach ?>
       </table>
       <?php endif ?>
</div>
</div>
</body>
</html>