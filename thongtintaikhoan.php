<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: dangnhap.php");
    exit;
}

$username = $_SESSION['username'];
$fullname = isset($_SESSION['fullname']) ? $_SESSION['fullname'] : '';
$email = isset($_SESSION['email']) ? $_SESSION['email'] : '';
$phone = isset($_SESSION['phone']) ? $_SESSION['phone'] : '';
$address = isset($_SESSION['address']) ? $_SESSION['address'] : '';
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Thông Tin Tài Khoản</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gradient-to-br from-yellow-50 via-yellow-100 to-beige-200 min-h-screen flex items-center justify-center px-4" style="background-color: #fefaf0;">
    <div class="bg-white shadow-2xl rounded-3xl p-8 w-full max-w-2xl border border-yellow-200">
        <div class="flex flex-col items-center mb-6">
            <img src="https://i.pravatar.cc/100?u=<?= urlencode($username) ?>" alt="Avatar" class="w-24 h-24 rounded-full shadow-md mb-4 border-4 border-yellow-300">
            <h2 class="text-3xl font-extrabold text-yellow-700">Thông Tin Cá Nhân</h2>
            <p class="text-gray-500">Chi tiết tài khoản của bạn</p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mt-8">
            <div class="flex flex-col">
                <label class="text-sm text-yellow-800 mb-1 font-medium"><i class="fas fa-user mr-2 text-yellow-600"></i>Tên đăng nhập</label>
                <div class="bg-yellow-50 p-3 rounded-xl text-gray-800 shadow-inner"><?= htmlspecialchars($username) ?></div>
            </div>
            <div class="flex flex-col">
                <label class="text-sm text-yellow-800 mb-1 font-medium"><i class="fas fa-phone mr-2 text-yellow-600"></i>Số điện thoại</label>
                <div class="bg-yellow-50 p-3 rounded-xl text-gray-800 shadow-inner"><?= htmlspecialchars($phone) ?></div>
            </div>
            <div class="col-span-1 sm:col-span-2 flex flex-col">
                <label class="text-sm text-yellow-800 mb-1 font-medium"><i class="fas fa-map-marker-alt mr-2 text-yellow-600"></i>Địa chỉ</label>
                <div class="bg-yellow-50 p-3 rounded-xl text-gray-800 shadow-inner"><?= htmlspecialchars($address) ?></div>
            </div>
        </div>

        <div class="mt-8 text-center">
            <a href="trangchu.php" class="inline-block bg-yellow-500 text-white px-6 py-2 rounded-full shadow-md hover:bg-yellow-600 transition">
                <i class="fas fa-home mr-2"></i>Quay lại Trang chủ
            </a>
        </div>
    </div>
</body>
</html>
