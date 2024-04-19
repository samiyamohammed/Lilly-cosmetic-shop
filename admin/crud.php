<?php


class producttable{

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

    if(isset($_GET['[page'])){
        $page=$_GET['[page'];
    }
    else{
        $page=1;
    }

  
   

}
public function fetchdata(){
    $sql="SELECT * from products";
    $result= mysqli_query($this->con,$sql);
    $users= mysqli_fetch_all($result, MYSQLI_ASSOC); 

     foreach($users as $user){
        echo "<tr>";
        echo "<td>" . $user['pid'] . "</td>";
        echo "<td>" . $user['type'] . "</td>";
        echo "<td>" . $user['name'] . "</td>";
        echo "<td>" . $user['brand'] . "</td>";
        echo "<td>" . $user['price'] . "</td>";
        echo "<td>";
        echo "<a href='update.php?id=" . $user['pid'] . "'><button style='width:100px;
        background-color: blueviolet;color:beige;'>Update</button></a>";
        echo " / ";
        echo "<a href='delete.php?id=" . $user['pid'] . "' onclick='return confirm(\"Are you sure you want to delete this user?\")'><button style='width:100px;
        background-color: blueviolet;color:beige;'>Delete</button></a>";
        echo "</td>";
        echo "</tr>";
    }
    
}
 function add($pid, $type,$name,$brand,$price,$path){
    $sql="insert into products(pid, type, name, brand, price, imagepath) values ('$pid','$type','$name','$brand','$price','$path')";
      if(mysqli_query($this->con,$sql)==true){
        echo "new record inserted successfully";
      } 
      else{
        echo "Error : ". $sql."<br>". mysqli_connect_error($this->con);
      }
 }

 function update($pid, $type,$name,$brand,$price,$path){
    $sql="update products set type='".$type."', name='".$name."', brand='".$brand."', price='".$price."', imagepath='".$path."' where pid='".$pid."'";
    mysqli_query($this->con, $sql);
 }

 public function delete($pid){
    $sql="DELETE from products where pid='".$pid."'";
    if(mysqli_query($this->con,$sql)==true){
        echo "Record Deleted Successfully";
    }
    else{
        echo "Error Deleting the record". mysqli_connect_error($this->con);
    }
}
public function search($pid){
    $sql="select * from products where pid='".$pid."'";
    $result=mysqli_query($this->con, $sql);
    $row=mysqli_fetch_assoc($result);
  return $row;
}
public function total_customers():int{
  $sql= "Select * from user";
  $result=mysqli_query($this->con, $sql);
  return mysqli_num_rows($result);
}

public function total_new_user():int{
    $sql= "select * from user where date(date)= current_date();";
    $result=mysqli_query($this->con, $sql);
    return mysqli_num_rows($result);
}
public function total_orders():int{
    $sql= "Select * from orders";
    $result=mysqli_query($this->con, $sql);
    return mysqli_num_rows($result);
  }
public function total_new_orders():int{
    $sql= "select * from orders where date(date)= current_date();";
    $result=mysqli_query($this->con, $sql);
    return mysqli_num_rows($result);
}

public function total_earnings():int{
    $sql= "SELECT SUM(amount) FROM orders;";
    $result=mysqli_query($this->con, $sql);
    $row= mysqli_fetch_assoc($result);
    return $row['SUM(amount)'];
  }
  public function total_new_earnings():int{
    $sql= "SELECT SUM(amount) FROM orders where date(date)= current_date();";
    $result=mysqli_query($this->con, $sql);
    if (mysqli_num_rows($result)>0){
        $row= mysqli_fetch_assoc($result);
    return $row['SUM(amount)'];
    }
    else{
        return 0;
    }
    
}
public function display_all_orders(){
    $orders=array();
    $sql="select orders.oid, user.name, user.email, orders.address,orders.date, orders.amount from user inner join  orders on user.id= orders.uid ";
    $result=mysqli_query($this->con, $sql);
    if(mysqli_num_rows($result)>0){
        while($row=mysqli_fetch_assoc($result)){
            array_push($orders, $row);
        }
        return $orders;
    }
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