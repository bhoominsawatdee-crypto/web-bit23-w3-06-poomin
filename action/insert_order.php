<?php
$name = $_POST["name"];
$payment = $_POST["payment"];
$usage_type = $_POST["usage_type"];
$image = $_POST["image"];
$room_id = $_POST["room_id"];

include "connect.php";

      $sql = "INSERT INTO `orders`
      ( `name`, `payment`, `usage_type`, `room_id`, `image`) 
      VALUES 
      ('$name','$payment','$usage_type','$room_id','$image')";

      $result = mysqli_query($con,$sql);

      if(!$result){
        echo "Error";
      }else{
        header("location: ../index.php");
        exit;
      }