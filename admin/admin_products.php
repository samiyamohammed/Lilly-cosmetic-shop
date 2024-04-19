<?php
include 'db_con.php';
include 'crud.php';

session_start();
$pid= $type= $name=$brand=$price="";

?>

<?php
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
// Check if the form has been submitted
if(isset($_POST['submit'])) {

    $pid= test_input($_POST['pid']);
    $type= test_input($_POST['type']);
    $name= test_input($_POST['name']);
    $brand= test_input($_POST['brand']);
    $price= test_input($_POST['price']);
    
    // Check if an image has been uploaded
    if(isset($_FILES['image'])) {
        
        // Get the file type
        $imageType = $_FILES['image']['type'];
        
        // Check if the file type is a valid image
        if($imageType != 'image/jpeg' && $imageType != 'image/png' && $imageType != 'image/gif') {
            $error = "Invalid image type. Please upload a JPEG, PNG, or GIF.";
        }
        
        // Get the file size
        $imageSize = $_FILES['image']['size'];
        
        // Check if the file size is within the allowed limit (in bytes)
        $maxSize = 1000000; // 1 MB
        if($imageSize > $maxSize) {
            $error = "File size is too large. Please upload an image smaller than 1 MB.";
        }
        
        // If the file type and size are valid, move the uploaded file to a permanent location
        if(!isset($error)) {
            $targetPath = "uploads/" . basename($_FILES['image']['name']);
            move_uploaded_file($_FILES['image']['tmp_name'], $targetPath);
            $success = "Image uploaded successfully!";

            $add= new producttable();
            $add->add($pid, $type,$name,$brand,$price,$targetPath);

        }
    } else {
        $error = "Please upload an image.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="try.css">
    <script src="script.js"></script>

    <title>Products</title>
	<style>
	  body {
	    font-family: Arial, sans-serif;
	    background-color: #f2f2f2;
	  }
	  
	  h2 {
	    font-size: 24px;
	    margin-bottom: 20px;
	  }
	  
	  form {
	    margin-top: 20px;
	    align-items: center;
	    background-color: white;
	    padding: 20px;
	    border-radius: 5px;
	    
        width:99%;
	  }
	  
	  label {
	    margin-bottom: 10px;
	    /* font-weight: bold; */
	  }
	  
	  input[type="text"], select {
	    width: 40%;
	    padding: 10px;
	    margin-bottom: 20px;
	    /* border: none; */
	    border-radius: 5px;
	    box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
	    font-size: 16px;
	  }
	  
	  input[type="file"] {
	    margin-bottom: 20px;
	  }
	  
	  input[type="submit"] {
	    background-color:blueviolet;
		width:150px;
	    color: #fff;
	    padding: 10px 20px;
	    border: none;
	    border-radius: 5px;
	    font-size: 16px;
	    cursor: pointer;
	    transition: background-color 0.3s ease-in-out;
	  }
	  
	  input[type="submit"]:hover {
	    background-color:aquamarine;
	  }
	  
	  p {
	    margin-bottom: 20px;
	  }

      table {
	    border-collapse: collapse;
	    width: 100%;
	    margin-bottom: 20px;
	  }
	  
	  th, td {
	    text-align: left;
	    padding: 8px;
	    border-bottom: 1px solid #ddd;
	  }
	  
	  th {
	    background-color:cadetblue;
	    color: #fff;
	  }
	  
	  tr:hover {
	    background-color: #f5f5f5;
	  }
      .middle{
        width: 1100px;
      }
	  
	</style>
</head>
<body>
<?php include 'dashboard.php'?>
<div class="mid">
<div class="top">
    <p>PRODUCTS</p>    
</div>
<div class="middle">
<div >
      <h3> Product Insertion </h3>
	    <form  action="admin_products.php" method="post" enctype="multipart/form-data">
            <div class="main">
            <div>
            <label for="pid">Product ID:</label>
	      <input type="text" name="pid" id="pid" placeholder="Product ID" required><br>
	      
	      <label for="type">Product Type:</label>
	      <select name="type" id="type" required>
	        <option value="" >Select type</option>
	        <option value="eye">Eye</option>
	        <option value="face">Face</option>
	        <option value="lip">Lip</option>
	        <option value="hair">Hair</option>
	        <option value="skincare">Skin Care</option>
	      </select><br>
    </div>
    <div>
	      <label for="name">Product Name:</label>
	      <input type="text" name="name" id="name" placeholder="Name" required ><br>
	      
	      <label for="brand">Product Brand:</label>
	      <input type="text" name="brand" id="brand" placeholder="Brand"  required><br>
            </div>
            <div>
            <label for="price">Product Price:</label>
	      <input type="text" name="price" id="price" placeholder="Price"  required><br>
	      
	      <label for="image">Product Image:</label>
	      <input type="file" name="image" id="image" required><br>
	      
	      <?php
	        // Display any error or success messages
	        if(isset($error)) {
	            echo "<p style='color:red;'>$error</p>";
	        }
	        if(isset($success)) {
	            echo "<p style='color:green;'>$success</p>";
	        }
	      ?>
	      </div>
        </div>
		<div align="center">
		<input  type="submit" value="Insert" name="submit">
		</div>
	      
	      
            
	    </form> 
	</div>
	<h2 style="width:100%; margin:20px 0px 20px 0px; padding: 20px 20px 20px 60px;  background-color:#1a5d91; color:white; " > PRODUCTS</h2>
<div class="table" style="margin:20px;">
    
<table>
      <tr>
        <th>Product ID</th>
        <th>Type</th>
        <th>Name</th>
        <th>Brand</th>
        <th>Price</th>
        <th>Operation</th>
      </tr>
      <?php $read = new producttable(); $read->fetchdata();?>
    </table>

    <br>

    
</div>
</div>




</div>
</body>
</html>


