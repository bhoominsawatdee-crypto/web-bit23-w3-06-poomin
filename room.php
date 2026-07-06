<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Room List</title>

    <style>
        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
            font-family: Arial, Helvetica, sans-serif;
        }

        body{
            background:#f4f7fb;
            padding:40px;
        }

        .container{
            width:90%;
            max-width:1200px;
            margin:auto;
            background:#fff;
            padding:30px;
            border-radius:12px;
            box-shadow:0 5px 15px rgba(0,0,0,.15);
        }

        h1{
            text-align:center;
            color:#2c3e50;
            margin-bottom:25px;
        }

        table{
            width:100%;
            border-collapse:collapse;
            text-align:center;
        }

        thead{
            background:#3498db;
            color:yellow;
        }

        thead th{
            padding:15px;
        }

        tbody td{
            padding:15px;
            border-bottom:1px solid #ddd;
        }

        tbody tr:nth-child(even){
            background:#f8f9fa;
        }

        tbody tr:hover{
            background:#d6ecff;
            transition:.3s;
        }

        img{
            width:180px;
            height:120px;
            object-fit:cover;
            border-radius:10px;
            border:2px solid #ddd;
        }

        .back{
            display:inline-block;
            margin-top:25px;
            padding:12px 25px;
            background:#27ae60;
            color:white;
            text-decoration:none;
            border-radius:8px;
            transition:.3s;
        }

        .back:hover{
            background:#219150;
        }
    </style>
</head>

<body>

<div class="container">

    <h1>รายการห้องพัก (Room List)</h1>

    <?php
        include "action/connect.php";

        // ดึงทั้งหมดจากตาราง orders
        $sql = "SELECT * FROM rooms";
        $result = mysqli_query($con,$sql);

        // ทดสอบ
        // var_dump($result);
    ?>

    <table border="1">
        <thead>
            <tr>
                <th>รหัสห้อง</th>
                <th>smoke</th>
                <th>ประเภทอ่าง</th>
                <th>ราคา</th>
                
            </tr>
        </thead>

        <tbody>
            <?php
                foreach($result as $order){
            ?>
            <tr>
                <td><?=$order["room_id"]?></td>
                <td><?=$order["smoke"]?></td>
                <td><?=$order["bathtub"]?></td>
                <td><?=$order["price"]?></td>

            </tr>
            <?php
                }
            ?>
        </tbody>
    </table>

    <a href="index.php" class="back">← กลับไปหน้า Orders</a>

</div>

</body>
</html>