<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index</title>

    <style>
        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
            font-family:Arial, Helvetica, sans-serif;
        }

        body{
            background:linear-gradient(135deg,#6dd5ed,#2193b0);
            padding:40px;
        }

        .container{
            width:90%;
            max-width:1200px;
            margin:auto;
            background:#fff;
            border-radius:15px;
            box-shadow:0 10px 25px rgba(0,0,0,.2);
            padding:30px;
        }

        h1{
            text-align:center;
            color:#0d6efd;
            margin-bottom:25px;
        }

        table{
            width:100%;
            border-collapse:collapse;
            overflow:hidden;
            border-radius:10px;
        }

        thead{
            background:#0d6efd;
            color:white;
        }

        th,td{
            padding:15px;
            text-align:center;
            border:1px solid #ddd;
        }

        tbody tr:nth-child(even){
            background:#f8f9fa;
        }

        tbody tr:hover{
            background:#dbeafe;
            transition:.3s;
        }

        img{
            width:200px;
            height:100px;
            object-fit:cover;
            border-radius:10px;
            border:2px solid #ddd;
        }

        .btn-link{
            display:inline-block;
            margin-top:25px;
            padding:12px 25px;
            background:#198754;
            color:white;
            text-decoration:none;
            border-radius:8px;
            font-weight:bold;
            transition:.3s;
        }

        .btn-link:hover{
            background:#146c43;
        }
    </style>

</head>
<body>

<div class="container">

<h1>📋 รายการการจองห้องพัก</h1>

<?php
     include "action/connect.php";
       // ดึง ทั้งหมด จาก ตารางorders
      $sql = "SELECT * FROM orders";
      $result = mysqli_query($con,$sql);
      //ทดสอบ
      //var_dump($result);

?>

<table border="1">
    <thead>
       <tr>
           <th>รหัสรายการ</th>
           <th>ชื่อผู้เข้าพัก</th>
           <th>ชำระเงิน</th>
           <th>ประเภท</th>
           <th>ห้อง</th>
           <th>ภาพ</th>
       </tr>
    </thead>

    <tbody>
    <?php
        foreach($result as $order){
    ?>
        <tr>
            <td><?=$order["order_id"] ?></td>
            <td><?=$order["name"] ?></td>
            <td><?=$order["payment"] ?></td>
            <td><?=$order["usage_type"] ?></td>
            <td><?=$order["room_id"] ?></td>
            <td>
                <img
                src="<?=$order["image"] ?>"
                style="width:200px; height:100px">
            </td>
        </tr>

    <?php
        }
    ?>
    </tbody>

</table>

<a href="room.php" class="btn-link">🏨 ไปหน้า Room</a>

</div>

</body>
</html>