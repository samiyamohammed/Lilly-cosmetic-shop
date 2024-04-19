<?php
include 'db_con.php';
include 'crud.php';

session_start();

$new_pid= $new_type= $new_name=$new_brand=$new_price="";
if (isset($_GET["id"])){
    $id = $_GET["id"];
    $search= new producttable();
    $product=$search-> search($id);
}

?>

<?php
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
// Check if the form has been submitted
if(isset($_POST['update'])) {

    $new_pid= test_input($_POST['new_pid']);
    $new_type= test_input($_POST['new_type']);
    $new_name= test_input($_POST['new_name']);
    $new_brand= test_input($_POST['new_brand']);
    $new_price= test_input($_POST['new_price']);
    
    // Check if an image has been uploaded
    if(isset($_FILES['new_image'])) {
        
        // Get the file type
        $imageType = $_FILES['new_image']['type'];
        
        // Check if the file type is a valid image
        if($imageType != 'image/jpeg' && $imageType != 'image/png' && $imageType != 'image/gif') {
            $error = "Invalid image type. Please upload a JPEG, PNG, or GIF.";
        }
        
        // Get the file size
        $imageSize = $_FILES['new_image']['size'];
        
        // Check if the file size is within the allowed limit (in bytes)
        $maxSize = 1000000; // 1 MB
        if($imageSize > $maxSize) {
            $error = "File size is too large. Please upload an image smaller than 1 MB.";
        }
        
        // If the file type and size are valid, move the uploaded file to a permanent location
        if(!isset($error)) {
            $targetPath = "uploads/" . basename($_FILES['new_image']['name']);
            move_uploaded_file($_FILES['new_image']['tmp_name'], $targetPath);
            $success = "Image uploaded successfully!";
            

            $update= new producttable();
$update->update($new_pid, $new_type, $new_name, $new_brand, $new_price, $targetPath);
header('Location:/lily/admin/admin_products.php');
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
        margin:30px 30px 30px 30px;
	    align-items: center;
	    background-color: white;
	    padding: 20px;
	    border-radius: 5px;
	    
        width:50%;
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
	    background-color: #4CAF50;
	    color: #fff;
	  }
	  
	  tr:hover {
	    background-color: #f5f5f5;
	  }
      .middle{
        width: 1100px;
      }
      .formcontainer{
        width:1100px;
      }
	</style>
</head>
<body>
<?php include 'dashboard.php'?>
<div class="mid">
<div class="top">
    <p>PRODUCTS</p>    
</div>
<div class="formcontainer">
<form action="update.php" method="post" enctype="multipart/form-data">
          <h2>PRODUCT UPDATE</h2>
	      <label for="pid">Product ID:</label>
	      <input type="text" name="new_pid" id="pid" placeholder="Product ID" value="<?php echo $product['pid']?>" readonly><br>
	      
	      <label for="type">Product Type:</label>
	      <select name="new_type" id="type" required>
	        <option value="">Select type</option>
	        <option value="eye" <?php if($product['type']=="eye"){echo "selected";} ?>>Eye </option>
	        <option value="face" <?php if($product['type']=="face"){echo "selected";} ?>>Face</option>
	        <option value="lip" <?php if($product['type']=="lip"){echo "selected";} ?>>Lip</option>
	        <option value="hair" <?php if($product['type']=="hair"){echo "selected";} ?>>Hair</option>
	        <option value="skincare" <?php if($product['type']=="skincare"){echo "selected";} ?>>Skin Care</option>
	      </select><br>
	      
	      <label for="name">Product Name:</label>
	      <input type="text" name="new_name" id="name" value="<?php echo $product['name']?>" required><br>
	      
	      <label for="brand">Product Brand:</label>
	      <input type="text" name="new_brand" id="brand" placeholder="Brand" value="<?php echo $product['brand']?>"required><br>
	      
	      <label for="price">Product Price:</label>
	      <input type="text" name="new_price" id="price" placeholder="Price" value="<?php echo $product['price']?>"required><br>
	      
	      <label for="image">Product Image:</label>
	      <input type="file" name="new_image" id="image" required><br>
	      
	      <?php
	        // Display any error or success messages
	        if(isset($error)) {
	            echo "<p style='color:red;'>$error</p>";
	        }
	        if(isset($success)) {
	            echo "<p style='color:green;'>$success</p>";
	        }
	      ?>
	      
	      <input type="submit" value="Update" name="update">
	    </form> 
</div>
</div>
</body>
</html>