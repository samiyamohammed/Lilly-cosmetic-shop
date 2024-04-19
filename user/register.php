<?php
include 'db_con.php';
function test_input($data){
    $data=trim($data);
    $data=stripslashes($data);
    $data=htmlspecialchars($data);
    return $data;
  }
$nameerr=$passworderr=$emailerr=$mediaerr=$gendererr=$dateerr=$phoneerr='';
$media_val=array(0,0,0);

if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
            if(empty( $_POST['name'])){
                $nameerr='please eneter your name';
            }
            else{
                $username = test_input($_POST['name']);
                if(!preg_match("/^[a-zA-Z-'\s]*$/",$username)){
                    $nameerr="only letters, whitespace and apostrophe is allowed (')";
                }
            }
            if(empty( $_POST['password'] )){
                $passworderr='please eneter your password';
            }
            else{
                $password = test_input($_POST['password']);
                if(strlen($password)<8){
                    $passworderr="needs to be at least 8 characters";

                }
                elseif (!preg_match("/[a-z]/",$password)) {
                    $passworderr= "needs to have at least one small character";
                    
                }
                elseif (!preg_match("/[A-Z]/",$password)) {
                    $passworderr= "needs to have at least one capital character";
                    
                }
                elseif (!preg_match("/[0-9]/",$password)) {
                    $passworderr= "needs to have at least one number";
                    
                }
                
            }
            if(empty( $_POST['mail'])){
                $emailerr='please eneter your email address';
            }
            else{
            $email=test_input($_POST['mail']);

            if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                $emailerr= "email address is not in correcr format";
            }
            
            else{
                $sql= "select * from user where email='$email'";
            $result=mysqli_query($con,$sql);
                if (mysqli_num_rows($result) > 0) {
                    $emailErr = "There is already an account with this email.";
            }
                  

            }
            }
            if(empty( $_POST['gender'])){
                $gendererr='gender not selected';
            }
            else{
            $gender=test_input($_POST['gender']);
            }
            if(empty( $_POST['checkbox'])){
                $media=array('','','');
            }
            else{
                $media = $_POST["checkbox"];
                for($i=0;$i<count($media);$i++){
                    if(isset($media[$i])){
                        $media_val[$i]=1;
                    }
                }
            }
            if(empty($_POST['date'])){
                $dateerr= 'please enter date of birth';
            }
            else{
                $date= test_input($_POST['date']);
            }
       
            if(empty($_POST['phone'])){
                $phoneerr='please enter phone number';
            }
            else{
            $phone=test_input($_POST['phone']);
            $phone_initial=test_input($_POST['phone_initial']);
            if(!preg_match("/^[0-9]*.{8,}$/",$phone)){
                $phoneerr="phone number is not correct length. please enter value that follows after +2519/+2517 ";
            }
            else{
                $phone_val=$phone_initial.$phone;
            }
            }
     

    
  

        if($nameerr==''&&$passworderr==''&&$emailerr==''&&$mediaerr==''&&$gendererr==''&&$dateerr==''&&$phoneerr==''){
        $qu="INSERT INTO user (name,password,email,gender,dob,phone,email_com, twitter_com, instagram_com) VALUES
        ('$username','$password','$email','$gender','$date','$phone_val','$media_val[0]','$media_val[1]','$media_val[2]')";
        mysqli_query($con,$qu);
        echo "<script>alert('Registered Successfully')</script>";
        
        unset($_POST['name'],$_POST['password'],$_POST['phone'],$_POST['phone_initial']
        ,$_POST['date'],$_POST['gender'],$_POST['mail']);
        // header('location:/newlili/view/trial.html');
        // change the location

        }
    
    else{
        // header('location:signup2.php'); 
        // change the location
    }
    
 
    
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <link rel="stylesheet" type="text/css" href="style.css">

    <style>
        /* General styling */
/* General styling */
body {
  font-family: Arial, sans-serif;
  font-size: 16px;
  line-height: 1.5;
  margin: 0;
  padding: 0;
}

h1 {
  margin-bottom: 1rem;
}

/* Form styling */
form {
  margin: 1rem auto;
  max-width: 500px;
  background-color: #fff;
  border-radius: 8px;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
  padding: 2rem;
}

label {
/* display: block; */
  margin-top: 1rem;
}

input[type="text"],
input[type="password"],
input[type="email"],
input[type="date"],
input[type="tel"],
select {
  /* display: block; */
  width: 90%;
  padding: 0.5rem;
  border: 1px solid #ccc;
  border-radius: 4px;
  margin-top: 0.5rem;
}

input[type="checkbox"] {
  margin-right: 0.5rem;
}

input[type="submit"] {
  /* display: block; */
  width:150px;
  margin-top: 1rem;
  padding: 0.5rem 1rem;
  background-color: #4CAF50;
  color: #fff;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}

input[type="submit"]:hover {
  background-color: #3e8e41;
}

.error {
  color: red;
}
    </style>
</head>
<body>
    <?php include 'header.php';?>
    
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <h1>Registration Form</h1>
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" value="<?php echo isset($_POST['name']) ? $_POST['name'] : ''; ?>">
        <span class="error"><?php echo $nameerr; ?></span>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password">
        <span class="error"><?php echo $passworderr; ?></span>

        <label for="mail">Email:</label>
        <input type="email" id="mail" name="mail" value="<?php echo isset($_POST['mail']) ? $_POST['mail'] : ''; ?>">
        <span class="error"><?php echo $emailerr; ?></span>

        <label for="gender">Gender:</label>
        <select id="gender" name="gender">
            <option value="" <?php if(empty($_POST['gender'])) echo 'selected'; ?>>Select Gender</option>
            <option value="male" <?php if(isset($_POST['gender']) && $_POST['gender'] == 'male') echo 'selected'; ?>>Male</option>
            <option value="female" <?php if(isset($_POST['gender']) && $_POST['gender'] == 'female') echo 'selected'; ?>>Female</option>
            
        </select>
        <span class="error"><?php echo $gendererr; ?></span>

        <label for="checkbox">Social Media:</label>
        <input type="checkbox" id="social1" name="checkbox[]" value="instagram" <?php if(isset($_POST['checkbox']) && in_array('instagram', $_POST['checkbox'])) echo 'checked'; ?>>

        <label for="social1">Instagram</label>
        <input type="checkbox" id="social2" name="checkbox[]" value="twitter" <?php if(isset($_POST['checkbox']) && in_array('twitter', $_POST['checkbox'])) echo 'checked'; ?>>

        <label for="social2">Twitter</label>
        <input type="checkbox" id="social3" name="checkbox[]" value="email" <?php if(isset($_POST['checkbox']) && in_array('email', $_POST['checkbox'])) echo 'checked'; ?>>
        <label for="social3">Email</label>
        <span class="error"><?php echo $mediaerr; ?></span>

        <label for="date">Date of Birth:</label>
        <input type="date" id="date" name="date" value="<?php echo isset($_POST['date']) ? $_POST['date'] : ''; ?>">
        <span class="error"><?php echo $dateerr; ?></span>

        <label for="phone_initial">Phone Number:</label>
        <select id="phone_initial" name="phone_initial">
            <option value="2519" <?php if(isset($_POST['phone_initial']) && $_POST['phone_initial'] == '2519') echo 'selected'; ?>>+251 9</option>
            <option value="2517" <?php if(isset($_POST['phone_initial']) && $_POST['phone_initial'] == '2517') echo 'selected'; ?>>+251 7</option>
        </select>
        <input type="tel" id="phone" name="phone" value="<?php echo isset($_POST['phone']) ? $_POST['phone'] : ''; ?>">
        <span class="error"><?php echo $phoneerr; ?></span>

        <input type="submit" value="Submit"> <br>
        <a href= "login.php"> Login </a>
    </form>
    <?php include 'footer.php';?>

</body>
</html>
