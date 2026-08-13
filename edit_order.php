<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>แก้ไขข้อมูลการจอง - Edit Order</title>
    <!-- นำเข้า Google Font (Prompt) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Prompt:wght@300;400;500;600&display=swap" rel="stylesheet">

    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Prompt', sans-serif;
        }

        body {
            /* พื้นหลังสีฟ้าพาสเทลนุ่มนวล */
            background: linear-gradient(135deg, #e0f2fe 0%, #bae6fd 100%);
            color: #0f172a;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .card {
            width: 100%;
            max-width: 480px;
            background-color: #ffffff;
            padding: 36px 32px;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(2, 132, 199, 0.12);
        }

        .card-header {
            text-align: center;
            margin-bottom: 28px;
        }

        .card-header .icon-box {
            width: 56px;
            height: 56px;
            background-color: #e0f2fe;
            color: #0284c7;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 12px auto;
            font-size: 22px;
            font-weight: 600;
        }

        .card-header h2 {
            font-size: 22px;
            font-weight: 600;
            color: #0369a1;
        }

        .card-header p {
            font-size: 13px;
            color: #64748b;
            margin-top: 4px;
        }

        .badge-id {
            display: inline-block;
            background-color: #e0f2fe;
            color: #0369a1;
            font-size: 12px;
            font-weight: 600;
            padding: 2px 8px;
            border-radius: 6px;
            margin-left: 4px;
        }

        .form-group {
            margin-bottom: 18px;
        }

        label {
            display: block;
            font-size: 14px;
            font-weight: 500;
            color: #334155;
            margin-bottom: 6px;
        }

        input[type="text"],
        select {
            width: 100%;
            padding: 12px 16px;
            font-size: 14px;
            color: #0f172a;
            background-color: #f8fafc;
            border: 1.5px solid #cbd5e1;
            border-radius: 10px;
            outline: none;
            transition: all 0.2s ease-in-out;
        }

        /* เอฟเฟกต์ตอนกดคลิกที่ช่องกรอก */
        input[type="text"]:focus,
        select:focus {
            border-color: #0284c7;
            background-color: #ffffff;
            box-shadow: 0 0 0 4px rgba(2, 132, 199, 0.15);
        }

        /* ปุ่มบันทึกการแก้ไขโทนสีฟ้าเข้ม */
        .btn-submit {
            width: 100%;
            padding: 13px;
            font-size: 16px;
            font-weight: 600;
            color: #ffffff;
            background-color: #0284c7;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            transition: all 0.2s ease-in-out;
            margin-top: 10px;
            box-shadow: 0 4px 12px rgba(2, 132, 199, 0.25);
        }

        .btn-submit:hover {
            background-color: #0369a1;
            box-shadow: 0 6px 16px rgba(2, 132, 199, 0.35);
        }

        .btn-submit:active {
            transform: scale(0.98);
        }
    </style>
</head>
<body>

<?php
$id = $_GET["id"];

include "action/connect.php";

      $sql = "SELECT * FROM orders WHERE order_id = '$id' ";

      $result = mysqli_query($con,$sql);

      $order = mysqli_fetch_assoc($result);

     // var_dump($result)
?>

<div class="card">
    <div class="card-header">
        <div class="icon-box">✏️</div>
        <h2>แก้ไขข้อมูลการจอง <span class="badge-id">ID: <?= $order["order_id"]?></span></h2>
        <p>ปรับเปลี่ยนรายละเอียดการเข้าพักและข้อมูลห้องพัก</p>
    </div>

    <form action="action/update_order.php" method="post">

        <div class="form-group">
            <label for="name">ชื่อผู้เข้าพัก</label>
            <input type="text" id="name" name="name" value="<?= $order["name"]?>" required>
        </div>

        <div class="form-group">
            <label for="payment">การจ่ายเงิน</label>
            <input type="text" id="payment" name="payment" value="<?= $order["payment"]?>" required>
        </div>

        <div class="form-group">
            <label for="usage_type">ประเภทการใช้งาน</label>
            <input type="text" id="usage_type" name="usage_type" value="<?= $order["usage_type"]?>" required>
        </div>

        <div class="form-group">
            <label for="image">ภาพผู้เข้าพัก</label>
            <input type="text" id="image" name="image" value="<?= $order["image"]?>">
        </div>

        <?php
         include "action/connect.php";
        
          $sql = "SELECT * FROM rooms";

          $result = mysqli_query($con,$sql);
        
        ?>

        <div class="form-group">
            <label for="room_id">เลือกห้องพัก</label>
            <select name="room_id" id="room_id" required>
                <?php
                    foreach($result as $room){
                       // ตรวจสอบห้องเดิมเพื่อใส่ attribute selected ให้ถูกต้อง
                       $selected = ($order['room_id'] == $room['room_id']) ? 'selected' : '';
                       ?>
                         <option value="<?=$room["room_id"]?>" <?=$selected?>>
                            <?=$room["room_id"]."_". $room["price"]."บาท"?>
                         </option>
                       <?php
                    }
                ?>
            </select>
        </div>

        <input type="hidden" name="order_id" value="<?= $order["order_id"]?>">

        <button type="submit" class="btn-submit">อัปเดตข้อมูล</button>

    </form>
</div>

</body>
</html>