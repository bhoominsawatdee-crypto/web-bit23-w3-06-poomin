<?php
include "action/connect.php";

// ดึงข้อมูลทั้งหมดจากตาราง rooms
$sql = "SELECT * FROM rooms";
$result = mysqli_query($con, $sql);
?>
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>รายการห้องพัก - MANROOD06</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background: linear-gradient(135deg, #1e3c72 0%, #2a5298 50%, #6dd5ed 100%);
            background-attachment: fixed;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            color: #333333;
        }

        /* -------------------------------------------
           1. NAVBAR STYLE
        ------------------------------------------- */
        .navbar {
            background: rgba(13, 110, 253, 0.95);
            backdrop-filter: blur(10px);
            padding: 15px 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .navbar .brand {
            color: #ffffff;
            font-size: 22px;
            font-weight: 700;
            text-decoration: none;
            letter-spacing: 0.5px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .navbar ul {
            list-style: none;
            display: flex;
            gap: 12px;
        }

        .navbar a {
            color: #e0e0e0;
            text-decoration: none;
            font-weight: 600;
            padding: 10px 18px;
            border-radius: 8px;
            transition: all 0.3s ease;
            font-size: 15px;
        }

        .navbar a:hover {
            color: #ffffff;
            background-color: rgba(255, 255, 255, 0.2);
            transform: translateY(-1px);
        }

        .navbar a.active {
            color: #ffffff;
            background-color: rgba(255, 255, 255, 0.25);
            box-shadow: inset 0 0 0 1px rgba(255, 255, 255, 0.3);
        }

        /* -------------------------------------------
           2. MAIN CONTENT STYLE
        ------------------------------------------- */
        .main-content {
            flex: 1;
            padding: 40px 20px;
            display: flex;
            align-items: flex-start;
        }

        .container {
            width: 100%;
            max-width: 1100px;
            margin: auto;
            background: #ffffff;
            border-radius: 16px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.25);
            padding: 35px;
            overflow: hidden;
        }

        .header-section {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #eef2f6;
            padding-bottom: 20px;
            flex-wrap: wrap;
            gap: 15px;
        }

        h1 {
            color: #0d6efd;
            font-size: 24px;
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        /* Table Style */
        .table-responsive {
            width: 100%;
            overflow-x: auto;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            overflow: hidden;
            background-color: #ffffff;
        }

        thead {
            background: linear-gradient(90deg, #0d6efd 0%, #0b5ed7 100%);
            color: #ffffff;
        }

        th {
            padding: 16px 20px;
            font-size: 15px;
            font-weight: 600;
            letter-spacing: 0.5px;
            text-align: center;
            white-space: nowrap;
        }

        td {
            padding: 16px 20px;
            text-align: center;
            border-bottom: 1px solid #edf2f7;
            color: #4a5568;
            font-size: 15px;
            vertical-align: middle;
        }

        tbody tr {
            transition: all 0.2s ease;
        }

        tbody tr:nth-child(even) {
            background-color: #f8fafc;
        }

        tbody tr:hover {
            background-color: #eef6ff;
            transform: scale(1.002);
        }

        /* Buttons */
        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 8px;
            font-weight: 600;
            font-size: 14px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .btn-secondary {
            background-color: #6c757d;
            color: #ffffff;
        }

        .btn-secondary:hover {
            background-color: #5a6268;
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(108, 117, 125, 0.3);
        }

        /* Badge สำหรับเน้นราคา */
        .price-text {
            font-weight: 700;
            color: #198754;
            background-color: #e8f5e9;
            padding: 6px 14px;
            border-radius: 20px;
            display: inline-block;
        }

        /* -------------------------------------------
           3. FOOTER STYLE
        ------------------------------------------- */
        .footer {
            background: #111827;
            color: #9ca3af;
            text-align: center;
            padding: 22px 20px;
            margin-top: auto;
            font-size: 14px;
            border-top: 1px solid rgba(255, 255, 255, 0.05);
        }

        /* Responsive Layout Support */
        @media (max-width: 768px) {
            .navbar {
                flex-direction: column;
                gap: 15px;
                padding: 15px 20px;
            }

            .header-section {
                flex-direction: column;
                align-items: flex-start;
            }

            .container {
                padding: 20px;
            }
        }
    </style>
</head>
<body>

    <!-- 1. NAVBAR -->
    <nav class="navbar">
        <a href="index.php" class="brand">🏨 MANROOD06</a>
        <ul>
            <li><a href="index.php">📋 ข้อมูลการเข้าพัก</a></li>
            <li><a href="room.php" class="active">🏨 ข้อมูลห้องพัก</a></li>
            <li><a href="manage_order.php">⚙️ จัดการการจอง</a></li>
        </ul>
    </nav>

    <!-- 2. MAIN CONTENT -->
    <main class="main-content">
        <div class="container">
            
            <div class="header-section">
                <h1>🏨 รายการข้อมูลห้องพัก (Room List)</h1>
                <a href="index.php" class="btn btn-secondary">← กลับไปหน้า Orders</a>
            </div>

            <div class="table-responsive">
                <table>
                    <thead>
                        <tr>
                            <th>รหัสห้อง</th>
                            <th>การสูบบุหรี่ (Smoke)</th>
                            <th>ประเภทอ่าง (Bathtub)</th>
                            <th>ราคา/คืน</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php foreach($result as $order){ ?>
                        <tr>
                            <td><strong><?=$order["room_id"]?></strong></td>
                            <td><?=$order["smoke"]?></td>
                            <td><?=$order["bathtub"]?></td>
                            <td><span class="price-text"><?=number_format($order["price"])?> บาท</span></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>

        </div>
    </main>

    <!-- 3. FOOTER -->
    <footer class="footer">
        <p>&copy; <?=date('Y')?>poomin sawatdee 06 bit2/3 E-TECH</p>
    </footer>

</body>
</html>