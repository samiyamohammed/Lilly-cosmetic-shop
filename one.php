<!DOCTYPE html>
<html>
<head>
	<title>Product List</title>
	<style>
		.container {
			display: flex;
			flex-wrap: wrap;
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
	</style>
</head>
<body>
	<div class="container">
		<?php
		// Connect to MySQL database
		$servername = "localhost";
		$username = "root";
		$password = "Cody@wise2001";
		$dbname = "lily";

		$conn = mysqli_connect($servername, $username, $password, $dbname);

		// Check connection
		if (!$conn) {
		  die("Connection failed: " . mysqli_connect_error());
		}

		// Retrieve product information from database
		$sql = "SELECT * FROM products";
		$result = mysqli_query($conn, $sql);

		// Display each product in a flex item
		if (mysqli_num_rows($result) > 0) {
		  while($row = mysqli_fetch_assoc($result)) {
		    echo "<div class='product'>";
		    echo "<img src='admin/" . $row["imagepath"] . "'>";
		    echo "<p><b>" . $row["brand"] . "</b>, ".$row["name"]."</p>";
		    echo "<p>Price: $" . $row["price"] . "</p>";
		    echo "</div>";
		  }
		} else {
		  echo "No products found.";
		}

		// Close database connection
		mysqli_close($conn);
		?>
	</div>
</body>
</html>