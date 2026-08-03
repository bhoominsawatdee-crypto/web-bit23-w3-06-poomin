<?php

$id = $_GET["id"];

include "connect.php";

      $sql = "DELETE FROM orders WHERE order_id = '$id'";

      $result = mysqli_query($con,$sql);

      if(!$result){
        echo "Error";
      }else{
        header("location: ../manage_order.php");
        exit;
      }