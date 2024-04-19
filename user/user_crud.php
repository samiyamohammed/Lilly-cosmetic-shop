<?php
class user{
private $servername="localhost";
private $username="root";
private $password="Cody@wise2001";
private $db_name="lily";
protected $con;
public $page;
public $id;

public function __construct()
{
    $this->con= mysqli_connect($this->servername, $this->username,$this->password, $this->db_name);

    if(!$this->con){
        die("error".mysqli_connect_error());
    }
}



public function add_to_cart($uid, $pid,$qty):bool{
 $sql="Insert into cart (uid, pid, qty) values ($uid, '$pid', $qty)";
 if (mysqli_query($this->con, $sql)){
    return true;
 }
 else return false;
}

public function cart_num($uid):int{
 $sql="select * from cart where uid=".$uid;
 $result= mysqli_query($this->con,$sql);
 return mysqli_num_rows($result);
}

public function qty_update($qty, $pid, $uid){
    $sql= "update cart set qty=".$qty." where uid=".$uid." and pid='".$pid."'";
    mysqli_query($this->con, $sql);
    }

public function remove_cart($pid, $uid){
    $sql= "delete from cart where uid=".$uid." and pid='".$pid."'";
    mysqli_query($this->con, $sql);
    
    }
public function place_order($uid, $address, $zipcode, $cardtype, $cardnumber, $amount, $expiry){
    $sql= "Insert into orders (uid, address, zipcode, cardtype, cardnumber, amount, expirydate) values (".$uid.", '".$address."', ".$zipcode.", '".$cardtype."', '".$cardnumber."', ".$amount.", '".$expiry."')";
    mysqli_query($this->con, $sql);
    }

public function display_orders($uid){
    $orders=array();
    $sql="select orders.oid, user.name, user.email, orders.address, orders.amount from user inner join  orders on user.id= orders.uid where uid=".$uid;
    $result=mysqli_query($this->con, $sql);
    if(mysqli_num_rows($result)>0){
        while($row=mysqli_fetch_assoc($result)){
            array_push($orders, $row);
        }
        return $orders;
    }
}
public function delete_cart($uid){
    $sql="delete from cart where uid=".$uid;
    mysqli_query($this->con, $sql);
}

public function get_order_maxid():int{
    $sql="select MAX(oid) from orders";
    $result=mysqli_query($this->con, $sql);
    $row=mysqli_fetch_assoc($result);
    return $row['MAX(oid)'];
}

public function get_cart($uid){
    $cart= array();
  $sql="select * from cart where uid=".$uid;
  $result= mysqli_query($this->con, $sql);
  while($row=mysqli_fetch_assoc($result)){
    array_push($cart, $row);
  }
  return $cart;
}

public function add_order_items($pid, $oid, $qty){
    $sql="Insert into orderitems (oid, pid, qty) values (".$oid.", '".$pid."', ".$qty.")";
    mysqli_query($this->con, $sql);
}

public function display_ordered_items($oid){
    $orderitems=array();
    $sql="SELECT *
    FROM orders
    INNER JOIN orderitems
    ON orders.oid = orderitems.oid
    INNER JOIN products
    ON products.pid = orderitems.pid where orders.oid=".$oid;
    $result= mysqli_query($this->con, $sql);
    while($row=mysqli_fetch_assoc($result)){
      array_push($orderitems, $row);
    }
    return $orderitems;

}

}
?>