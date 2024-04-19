
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Cart Checkout Information Form</title>

    <style>
        form{
            width:60%;
            margin:auto;
			padding:20px;
        }
		legend{
			color:brown;
			font-size: larger;
		}
		label{
			color:darkblue;
			margin-left:30px;
		}
		input{
			margin-left:20px;
		}
		input[type="submit"]{
			margin-left: 300px;
			background-color: cadetblue;
			color:azure;
			font-size: larger;
			width: 150px;
			height: 40px;
			border-radius: 5px;
			border:hidden;
		}
		input[type="submit"]:hover{
			background-color:darkcyan;
			border:hidden;

		}
		#amountlbl{
			font-weight: bolder;
			color:indigo;
		}

		fieldset{
			
			font-family: Arial, Helvetica, sans-serif;
			border: solid gray;
			border-radius: 10px;
			background-color:rgb(235, 252, 252);
			padding:20px;
			margin-bottom: 20px;;
		}
    </style>

</head>
<body>
<?php include 'header.php';

if(isset($_POST['place_order'])){
   $total_amount=$_POST['amount']; 
}else{
    $total_amount=0;
}

?>


<h2 style='width:100%; margin:20px 0px 20px 0px; padding: 20px 20px 20px 60px;  background-color:#1a5d91; color:white; ' >CART CHECKOUT INFORMATION</h2>";

<form action="ordervalidation.php" method="post">
    <fieldset>
        <legend>Shipping Information</legend>
        <label for="shipping_name">Full Name:</label>
        <input type="text" id="shipping_name" name="shipping_name" value="<?php echo $_SESSION['user']['name']?>" readonly><br><br>

        <label for="shipping_email">Email:</label>
        <input type="email" id="shipping_email" name="shipping_email" value="<?php echo $_SESSION['user']['email']?>" required readonly><br><br>

        <label for="shipping_phone">Phone Number:</label>
        <input type="tel" id="shipping_phone" name="shipping_phone"  value="+<?php echo $_SESSION['user']['phone']?>" readonly><br><br>

        <label for="shipping_address">Address:</label>
        <textarea id="shipping_address" name="shipping_address" rows="3" required></textarea><br><br>
        
        <label for="shipping_zip">Zip Code:</label>
        <input type="text" id="shipping_zip" name="shipping_zip" required pattern="[0-9]{5}(-[0-9]{4})?"><br><br>
    </fieldset>

    <fieldset>
        <legend>Payment Information</legend>
        <label for="card_type">Card Type:</label>
        <select id="card_type" name="card_type" required>
            <option value="visa">Visa</option>
            <option value="mastercard">Mastercard</option>
        </select><br><br>

        <label for="card_number">Card Number:</label>
        <input type="text" id="card_number" name="card_number" required pattern="[0-9]{16}"><br><br>

        <label for="card_expiry">Card Expiry Date:</label>
        <input type="month" id="card_expiry" name="card_expiry" min="<?= date('Y-m') ?>" required><br><br>
        <label id="amountlbl">AMOUNT:</label> <input type="text" name="total_amount" value="<?php echo $total_amount?>" readonly>

    </fieldset>

    <input type="submit" name="submit" value="Submit">
</form>


</body>
</html>