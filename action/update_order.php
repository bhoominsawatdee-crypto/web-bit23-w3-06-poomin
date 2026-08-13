<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

$name = $_POST["name"];
$payment = $_POST["payment"];
$usage_type = $_POST["usage_type"];
$image = $_POST["image"];
$room_id = $_POST["room_id"];
$order_id = $_POST['order_id'];

include "connect.php";

     $sql = "UPDATE `orders`
       SET 
       `name`='$name',
       `payment`='$payment',
       `usage_type`='$usage_type',
       `room_id`='$room_id',
       `image`='$image'
        WHERE order_id = '$order_id'";

        echo $sql;

      $result = mysqli_query($con,$sql);

      if(!$result){
        echo "Error";
      }else{
        header("location: ../manage_order.php");
        exit;
      }