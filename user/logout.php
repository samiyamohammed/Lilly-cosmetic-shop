<?php
session_start();
session_unset();
session_destroy();
header('Location:/lily/user/shop.php');
?>