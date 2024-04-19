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
    <script src="script.js"></script>


    <title>Shop</title>
    <style>
        .cart {
            position:fixed;
    top:300px;
    right:58px;
    display: inline-block;
    margin-right: 20px;
}
    .cart-icon {
    display: flex;
    align-items: center;
    text-decoration: none;
    color: #333;
}

.cimg {
    width: 100px;
    margin-right: 10px;
}

.cart-count {
    display: inline-block;
    position:fixed;
    top:327px;
    right: 100px;
    font-size: 14px;
    font-weight: bold;
    background-color: #4CAF50;
    color: #fff;
    padding: 4px 8px;
    border-radius: 50%;
    margin-left: 5px;
}
.procontainer {
	display: flex;
	flex-wrap: wrap;
    width:95%;
    margin:auto;
		}
.product {
	flex: 0 0 calc(20% - 20px);
	flex-basis: calc(20% - 20px);
	margin: 10px;
	box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
	border-radius: 5px;
	padding: 10px;
	text-align: center;
    transition: box-shadow 0.3s ease-in-out;
		}
        .product:hover {
			box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
		}
		.product img {
			max-width: 50%;
			height: 50%;
			margin-bottom: 10px;
		}
        #qty{
            width: 50px;
            margin-right: 20px;
        }
#thecart{
 width: 100px;
 color:aliceblue;
 background-color: blueviolet;
}
	</style>

</head>
<body>


    <?php 
    include 'header.php';
    ?>
    
    <div class="cart" >
    <a href="<?php if(isset($_SESSION['user'])){echo 'cart.php';} else{echo 'login.php';}?>" class="cart-icon">
        <img src="cart.png" alt="Cart Icon" class="cimg">
        <?php
        $c=new user();
        $count = isset($_SESSION['user']) ? $c->cart_num($_SESSION['user']['id']) : 0;
        echo "<span class='cart-count'>$count</span>";
        ?>
    </a>
        
</div>
 <?php 
 $types=array("eye", "lip", "face", "hair", "skincare");
  foreach($types as $type){
    echo "<div class='procontainer'>
    <h2 style='width:100%; margin:20px 0px 20px 0px; padding: 20px 20px 20px 60px;  background-color:#1a5d91; color:white; ' >".strtoupper($type)."</h2>";
    

    // Retrieve product information from database
    $sql = "SELECT * FROM products where type='$type'";
    $result = mysqli_query($con, $sql);

    // Display each product ina flex item with an add to cart form
    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            echo "<div class='product'>";
            echo "<img src='../admin/" . $row["imagepath"] . "'>";
            echo "<p><b>" . $row["brand"] . "</b>, ".$row["name"]."</p>";
            echo "<p>Price: $" . $row["price"] . "</p>";
            echo "<form action='add_cart.php' method='post'>";
            echo "<input type='hidden' name='pid' value='" . $row["pid"] . "'>";
            echo "Qty: <input type='number' id='qty' name='qty' min='1' value='1'>";
            echo "<input id='thecart' type='submit' name='add-to-cart' value='Add to Cart'>";
            echo "</form>";
            echo "</div>";
        }
    }
     else {
      echo "No products found.";
    }
echo "</div>";
  }
 ?>
 
    
<?php
include 'footer.php'; 
?>
</body>
</html>