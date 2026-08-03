<?php
include "action/connect.php";
$sql = "SELECT * FROM orders";
$result = mysqli_query($con, $sql);
?>
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>จัดการข้อมูลการจอง - MANROOD06</title>

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
            max-width: 1200px;
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

        /* Buttons Style */
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

        .btn-add {
            background-color: #198754;
            color: #ffffff;
        }

        .btn-add:hover {
            background-color: #146c43;
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(25, 135, 84, 0.3);
        }

        .btn-edit {
            background-color: #ffc107;
            color: #000000;
            padding: 6px 12px;
            font-size: 13px;
            margin-right: 4px;
        }

        .btn-edit:hover {
            background-color: #e0a800;
            transform: translateY(-1px);
        }

        .btn-delete {
            background-color: #dc3545;
            color: #ffffff;
            padding: 6px 12px;
            font-size: 13px;
        }

        .btn-delete:hover {
            background-color: #bb2d3b;
            transform: translateY(-1px);
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
        }

        /* Image Styling */
        .room-img {
            width: 140px;
            height: 90px;
            object-fit: cover;
            border-radius: 8px;
            border: 2px solid #e0e0e0;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .action-btns {
            display: flex;
            justify-content: center;
            gap: 6px;
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

        /* Responsive Design */
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
            <li><a href="room.php">🏨 ข้อมูลห้องพัก</a></li>
            <li><a href="manage_order.php" class="active">⚙️ จัดการการจอง</a></li>
        </ul>
    </nav>

    <!-- 2. MAIN CONTENT -->
    <main class="main-content">
        <div class="container">
            
            <div class="header-section">
                <h1>⚙️ รายการจัดการการจอง (Manage Orders)</h1>
                <a href="add_order.php" class="btn btn-add">➕ เพิ่มรายการใหม่</a>
            </div>

            <div class="table-responsive">
                <table>
                    <thead>
                        <tr>
                            <th>รหัสรายการ</th>
                            <th>ชื่อผู้เข้าพัก</th>
                            <th>ชำระเงิน</th>
                            <th>ประเภท</th>
                            <th>ห้อง</th>
                            <th>ภาพ</th>
                            <th>จัดการ</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php foreach($result as $order){ ?>
                        <tr>
                            <td><strong><?= $order["order_id"] ?></strong></td>
                            <td><?= $order["name"] ?></td>
                            <td><?= $order["payment"] ?></td>
                            <td><?= $order["usage_type"] ?></td>
                            <td><?= $order["room_id"] ?></td>
                            <td>
                                <img src="<?= $order["image"] ?>" class="room-img" alt="ภาพห้องพัก">
                            </td>
                            <td>
                                <div class="action-btns">
                                    <a href="edit_order.php?id=<?= $order["order_id"]?>" class="btn btn-edit">แก้ไข</a>
                                    <a href="action/delete_order.php?id=<?= $order["order_id"]?>" class="btn btn-delete" onclick="return confirm('ยืนยันการลบรายการนี้?');">ลบ</a>
                                </div>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>

        </div>
    </main>

    <!-- 3. FOOTER -->
    <footer class="footer">
        <p>&copy; <?=date('Y')?> poomin sawatdee bit2/3 E-TECH</p>
    </footer>

</body>
</html>