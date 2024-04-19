<?php
include 'crud.php';
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="try.css">
</head>
<body>
<?php
include 'dashboard.php';
?>

<div class="mid">
<div class="top">
    <p>DASHBOARD</p>
    
</div>
<p id="welcome"> Welcome <?php if (isset($_SESSION['admin'])){echo " ".$_SESSION['admin']." !";} ?> </p>
    <div class="main">
      <div class="boxes">
        <div > Total Earning <br><img src="moneyicon.png" class="imgsicon"> </div>
        
        <div class="ins"> <?php $all= new producttable(); echo number_format($all->total_earnings(),2)." ETB" ;?>  </div>
    </div>
      <div class="boxes">
        <div > Total orders <br> <img src="carticon.png" class="imgsicon"></div> 
        <div class="ins"> <?php $all= new producttable(); echo $all->total_orders();?></div>
    </div>
      <div class="boxes"> 
        <div >Total Customers <br><img src="usericon.png" class="imgsicon">  </div>
        <div class="ins"> <?php $all= new producttable(); echo $all->total_customers();?>  </div>
     </div>
    </div>
    <div id="line">Today's Report</div>
    <div class="today">
    <div class="todaybox">Orders : <span id="spans"><?php $new_orders= new producttable(); echo $new_orders->total_new_orders();?></span></div>
    <div class="todaybox">Earnings : <span id="spans"><?php $new_earning= new producttable(); echo number_format($new_earning->total_new_earnings(),2)." ETB";?></span></div>
    <div class="todaybox">New Customers : <span id="spans"><?php $new_user= new producttable(); echo $new_user->total_new_user();?></span></div>
    </div>
    <div><?php include 'footer.php';?></div>
    
    </div>

</body>
</html>