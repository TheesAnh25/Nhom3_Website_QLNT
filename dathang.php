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
            background-color: #f4f4f4;
            display: flex;
            flex-direction: column;
            align-items: center;
            min-height: 100vh;
        }
        h2 {
            color: #333;
            margin-top: 20px;
            font-size: 2rem;
            text-align: center;
        }
        table {
            width: 90%;
            max-width: 1200px;
            border-collapse: collapse;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin: 20px 0;
        }
        th, td {
            padding: 12px;
            text-align: center;
            border: 1px solid #ddd;
        }
        th {
            background-color: #007bff;
            color: white;
            font-weight: bold;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        tr:hover {
            background-color: #f1f1f1;
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
</body>
</html>