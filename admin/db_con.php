<?php

$ip="localhost";
$username="root";
$password="Cody@wise2001";
$dbname="lily";

$con=new mysqli($ip,$username,$password,$dbname);
if ($con->connect_error)
    echo "Error Exist", $con->connect_error;
else
echo "";
?>