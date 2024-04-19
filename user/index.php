<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css">

    <title>Document</title>
<style>
    .about {
    position: absolute;
    top:300px;
    left:200px;
    margin: auto;
    padding: 20px;
    width: 30%;
    max-width: 1200px;
    text-align: center;
    z-index: 2;
    
}

.about h2 {
    font-size: 36px;
    font-weight: bold;
    margin: 0 0 20px;
    color:brown;
}

.about p {
    font-size: 18px;
    margin: 0 0 20px;
    color:azure;
}

.about button {
    display: block;
    margin: 0 auto;
    padding: 10px 20px;
    font-size: 18px;
    font-weight: bold;
    color: #fff;
    background-color:brown;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}
   * {
    box-sizing: border-box;
}

.slideshow-container {
    position: relative;
    margin: auto;
    width: 80%;
    height: 500px;
    overflow: hidden;
}

.mySlides {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    display: none;
}

.mySlides img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    border-radius: 10px;
}

.prev, .next {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    font-size: 40px;
    font-weight: bold;
    padding: 10px;
    cursor: pointer;
    z-index: 1;
}

.prev {
    left: 0;
}

.next {
    right: 0;
}

.slide-in {
    animation-name: slide-in;
    animation-duration: 1.5s;
    animation-timing-function: ease-out;
}

.slide-out {
    animation-name: slide-out;
    animation-duration: 1.5s;
    animation-timing-function: ease-out;
}

@keyframes slide-in {
    0% {
        left: -100%;
    }
    100% {
        left: 0;
    }
}

@keyframes slide-out {
    0% {
        left: 0;
    }
    100% {
        left: 100%;
    }
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
.new{
    display: flex;
    flex-flow: row;
    width:100%;
    margin:auto;
    justify-content: space-around;
}


.video-container {
    position: relative;
    margin: auto;
    width: 100%;
    height: 300px;
    overflow: hidden;
}

video {
    width: 100%;
    height: 90%;
    margin:auto;
    object-fit:cover;
    border-radius: 8px;
}
.items{
    width:390px;
    
}
.titles{
    width:100%; 
    margin:50px 0px 50px 0px; 
    padding: 20px 20px 20px 60px;  
    background-color:#1a5d91; 
    color:white;
}
</style>
</head>
<body>
<?php include 'header.php'; ?>
<div class="about">
        <h2>About Us</h2>
        <p>We are a team of passionate developers dedicated to creating beautiful and functional websites.</p>
        <a href="aboutus.php"><button>Read More</button></a>
</div>
<div class="slideshow-container">
		<div class="mySlides">
			<img src="profile1.jpg">
		</div>
		<div class="mySlides">
			<img src="profile2.jpg">
		</div>
		<div class="mySlides">
			<img src="profile3.jpg">
		</div>
       
</div>

	<script src="slideshow.js"></script>

<h2 class="titles"  >BEST SELLERS</h2>
    <?php 
    echo "<div class='procontainer'>";

    $bests= array("P002", "P003", "P004");
     foreach($bests as $best){
    $sql = "SELECT * FROM products where pid='$best'";
    $result = mysqli_query($con, $sql);

    if (mysqli_num_rows($result) > 0) {
        $row=mysqli_fetch_assoc($result);
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
echo "</div>";

    ?>
<h2 class="titles"  >NEW PRODUCT</h2>

<div class="new">
    <div class="items" class="video-container">
        <video src="video.mp4" controls></video>
    </div>
    <div class="items">
        <h3>FENTY GLOW BOMB HEAT </h3>
        <p>Fenty GLOSS BOMB HEAT is a glossy lip luminizer that provides a warm, peachy-coral shade with a high-shine finish. This lip gloss is formulated with shea butter and vitamin E to nourish and hydrate your lips, leaving them soft and smooth. The non-sticky formula glides on easily and stays put for hours, giving you a perfect pout that's always ready to shine. 
            ORDER NOW.</p>
    </div>
    <div class="items" class='procontainer'>
        <?php
    $sql = "SELECT * FROM products where pid='P003'";
    $result = mysqli_query($con, $sql);

    if (mysqli_num_rows($result) > 0) {
        $row=mysqli_fetch_assoc($result);
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
            ?>
    </div>
</div>

    
    <?php include 'footer.php'; ?>
</body>
</html>