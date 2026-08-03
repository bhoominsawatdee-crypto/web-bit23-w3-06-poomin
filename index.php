<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>รายการการจองห้องพัก - Hotel Booking System</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background: linear-gradient(135deg, #6dd5ed, #2193b0);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* -------------------------------------------
           1. NAVBAR STYLE
        ------------------------------------------- */
        .navbar {
            background-color: #0d6efd;
            padding: 15px 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
        }

        .navbar .logo {
            color: #ffffff;
            font-size: 22px;
            font-weight: bold;
            text-decoration: none;
        }

        .navbar ul {
            list-style: none;
            display: flex;
            gap: 15px;
        }

        .navbar a {
            color: #ffffff;
            text-decoration: none;
            font-weight: bold;
            padding: 8px 16px;
            border-radius: 6px;
            transition: 0.3s;
        }

        .navbar a:hover, .navbar a.active {
            background-color: rgba(255, 255, 255, 0.25);
        }

        /* -------------------------------------------
           2. CONTENT STYLE
        ------------------------------------------- */
        .main-content {
            flex: 1;
            padding: 40px 20px;
        }

        .container {
            width: 90%;
            max-width: 1200px;
            margin: auto;
            background: #ffffff;
            border-radius: 15px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
            padding: 35px;
        }

        .header-section {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
            border-bottom: 2px solid #eef2f6;
            padding-bottom: 15px;
        }

        h1 {
            color: #0d6efd;
            font-size: 24px;
        }

        /* Button Styles */
        .btn {
            display: inline-block;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 8px;
            font-weight: bold;
            transition: 0.3s;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .btn-manage {
            background-color: #0d6efd;
            color: #ffffff;
        }

        .btn-manage:hover {
            background-color: #0b5ed7;
            transform: translateY(-2px);
        }

        /* Table Styles */
        table {
            width: 100%;
            border-collapse: collapse;
            overflow: hidden;
            border-radius: 10px;
        }

        thead {
            background: #0d6efd;
            color: white;
        }

        th, td {
            padding: 15px;
            text-align: center;
            border-bottom: 1px solid #eef2f6;
        }

        tbody tr:nth-child(even) {
            background: #f8f9fa;
        }

        tbody tr:hover {
            background: #dbeafe;
            transition: .3s;
        }

        .room-img {
            width: 160px;
            height: 90px;
            object-fit: cover;
            border-radius: 8px;
            border: 2px solid #e0e0e0;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }

        /* -------------------------------------------
           3. FOOTER STYLE
        ------------------------------------------- */
        .footer {
            background: #111827;
            color: #9ca3af;
            text-align: center;
            padding: 20px;
            margin-top: auto;
            font-size: 14px;
        }
    </style>
</head>
<body>

    <!-- 1. NAVBAR -->
    <nav class="navbar">
        <a href="index.php" class="logo">🏨 MANROOD06</a>
        <ul>
            <li><a href="index.php" class="active">📋 ข้อมูลการเข้าพัก</a></li>
            <li><a href="room.php">🏨 ข้อมูลห้องพัก</a></li>
            <li><a href="manage_order.php">⚙️ จัดการการจอง</a></li>
        </ul>
    </nav>

    <!-- 2. CONTENT -->
    <main class="main-content">
        <div class="container">
            
            <div class="header-section">
                <h1>📋 รายการข้อมูลการเข้าพัก</h1>
                <!-- ปุ่มลิงก์เชื่อมไปยัง manage_order.php -->
                <a href="manage_order.php" class="btn btn-manage">⚙️ ไปหน้าจัดการการเข้าพัก</a>
            </div>

            <?php
                include "action/connect.php";
                $sql = "SELECT * FROM orders";
                $result = mysqli_query($con, $sql);
            ?>

            <table>
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
                <?php foreach($result as $order) { ?>
                    <tr>
                        <td><?=$order["order_id"] ?></td>
                        <td><?=$order["name"] ?></td>
                        <td><?=$order["payment"] ?></td>
                        <td><?=$order["usage_type"] ?></td>
                        <td><?=$order["room_id"] ?></td>
                        <td>
                            <img src="<?=$order["image"] ?>" alt="รูปห้องพัก" class="room-img">
                        </td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>

        </div>
    </main>

    <!-- 3. FOOTER -->
    <footer class="footer">
        <p>&copy; <?=date('Y')?> poomin sawatdee bit2/3 E-TECH</p>
    </footer>

</body>
</html>