<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: dangnhap.php");
    exit;
}
$tentaikhoan = $_SESSION['username'];
$conn = new mysqli('localhost', 'root', '', 'webnoithat');
$conn->set_charset("utf8");
$sql = "SELECT * FROM dathang WHERE tentaikhoan = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $tentaikhoan);
$stmt->execute();
$result = $stmt->get_result();
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đơn hàng của bạn</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background-color: #fefaf0; /* màu be nhạt */
            display: flex;
            flex-direction: column;
            align-items: center;
            min-height: 100vh;
        }
        h2 {
            color: #7a5a00;
            margin-top: 20px;
            font-size: 2rem;
            text-align: center;
        }
        table {
            width: 90%;
            max-width: 1200px;
            border-collapse: collapse;
            background-color: #fffdf5;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.05);
            margin: 20px 0;
        }
        th, td {
            padding: 12px;
            text-align: center;
            border: 1px solid #e0d6c3; /* viền be nhạt */
        }
        th {
            background-color: #e5c07b; /* be vàng */
            color: #4b3c00;
            font-weight: bold;
        }
        tr:nth-child(even) {
            background-color: #f9f5e8;
        }
        tr:hover {
            background-color: #f1ecdc;
        }
        img {
            max-width: 80px;
            height: auto;
            border-radius: 5px;
        }
        @media (max-width: 768px) {
            table {
                width: 95%;
            }
            th, td {
                font-size: 0.9rem;
                padding: 8px;
            }
            img {
                max-width: 60px;
            }
            h2 {
                font-size: 1.5rem;
            }
        }
    </style>
</head>
<body>
    <h2>Đơn hàng của bạn</h2>
    <table border="1" cellpadding="8">
        <tr>
            <th>Mã SP</th>
            <th>Tên SP</th>
            <th>Giá</th>
            <th>Số lượng</th>
            <th>Ảnh</th>
            <th>Ngày đặt</th>
        </tr>
        <?php while($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?php echo htmlspecialchars($row['masp']); ?></td>
            <td><?php echo htmlspecialchars($row['tensp']); ?></td>
            <td><?php echo number_format($row['gia'], 0, ',', '.'); ?> VNĐ</td>
            <td><?php echo $row['soluong']; ?></td>
            <td><img src="<?php echo htmlspecialchars($row['anh']); ?>" width="80"></td>
            <td><?php echo $row['ngaydat']; ?></td>
        </tr>
        <?php endwhile; ?>
    </table>
    <div style="text-align:center; margin-top: 20px;">
        <a href="trangchu.php" style="display:inline-block; background:#e5c07b; color:#4b3c00; padding:10px 24px; border-radius:6px; text-decoration:none; font-weight:bold; transition:background 0.2s;"
           onmouseover="this.style.background='#d1ae66'" onmouseout="this.style.background='#e5c07b'">
            Quay lại Trang chủ
        </a>
    </div>
</body>
</html>
