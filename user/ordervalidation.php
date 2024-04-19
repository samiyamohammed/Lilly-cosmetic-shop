<?php
session_start();
include 'user_crud.php';
if (isset($_POST['submit'])){
    $order= new user();
    $order->place_order($_SESSION['user']['id'], $_POST['shipping_address'], $_POST['shipping_zip'], $_POST['card_type'], $_POST['card_number'], floatval($_POST['total_amount']), $_POST['card_expiry']);
    $carts=$order->get_cart($_SESSION['user']['id']);
    $order_id= $order->get_order_maxid();
    foreach($carts as $cart){
        $order->add_order_items($cart['pid'], $order_id, $cart['qty']);
    }
    $order->delete_cart($_SESSION['user']['id']);
    header('Location:/lily/user/orders.php');
}
?>