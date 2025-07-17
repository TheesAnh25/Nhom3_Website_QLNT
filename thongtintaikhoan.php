<?php include"head.php" ?>
<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$error = '';
$success = '';

// Kiểm tra nếu người dùng chưa đăng nhập
if (!isset($_SESSION['username'])) {
    header("Location: dangnhap.php");
    exit;
}

// Xử lý cập nhật thông tin
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $matkhau = trim($_POST['txtMatKhau'] ?? '');
    $diachi = trim($_POST['txtDiaChi'] ?? '');
    $sdt = trim($_POST['txtSDT'] ?? '');
    $username = $_SESSION['username'];

    // Kết nối MySQL
    $conn = new mysqli('localhost', 'root', '', 'webnoithat');
    $conn->set_charset("utf8");

    if ($conn->connect_error) {
        $error = "Kết nối thất bại: " . $conn->connect_error;
    } else {
        // Cập nhật thông tin tài khoản
        $stmt = $conn->prepare("UPDATE taikhoan SET matkhau = ?, diachi = ?, sdt = ? WHERE taikhoan = ?");
        if (!$stmt) {
            $error = "Lỗi prepare: " . $conn->error;
        } else {
            $stmt->bind_param("ssss", $matkhau, $diachi, $sdt, $username);
            if ($stmt->execute()) {
                if ($stmt->affected_rows > 0) {
                    $success = "Cập nhật thông tin thành công!";
                } else {
                    $error = "Cập nhật không thành công!";
                }
            } else {
                $error = "Lỗi: " . $stmt->error;
            }
            $stmt->close();
        }
        $conn->close();
    }
}

// Lấy thông tin tài khoản để hiển thị
$userInfo = null;
$conn = new mysqli('localhost', 'root', '', 'webnoithat');
$conn->set_charset("utf8");

if (!$conn->connect_error) {
    $stmt = $conn->prepare("SELECT * FROM taikhoan WHERE taikhoan = ?");
    if ($stmt) {
        $stmt->bind_param("s", $_SESSION['username']);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $userInfo = $result->fetch_assoc();
        }
        $stmt->close();
    }
    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com?plugins=forms,typography"></script>
    <script src="https://unpkg.com/unlazy@0.11.3/dist/unlazy.with-hashing.iife.js" defer init></script>
    <script type="text/javascript">
        window.tailwind = window.tailwind || {};
        window.tailwind.config = {
            darkMode: ['class'],
            theme: {
                extend: {
                    colors: {
                        border: 'hsl(var(--border))',
                        input: 'hsl(var(--input))',
                        ring: 'hsl(var(--ring))',
                        background: 'hsl(var(--background))',
                        foreground: 'hsl(var(--foreground))',
                        primary: {
                            DEFAULT: 'hsl(var(--primary))',
                            foreground: 'hsl(var(--primary-foreground))'
                        },
                        secondary: {
                            DEFAULT: 'hsl(var(--secondary))',
                            foreground: 'hsl(var(--secondary-foreground))'
                        },
                        destructive: {
                            DEFAULT: 'hsl(var(--destructive))',
                            foreground: 'hsl(var(--destructive-foreground))'
                        },
                        muted: {
                            DEFAULT: 'hsl(var(--muted))',
                            foreground: 'hsl(var(--muted-foreground))'
                        },
                        accent: {
                            DEFAULT: 'hsl(var(--accent))',
                            foreground: 'hsl(var(--accent-foreground))'
                        },
                        popover: {
                            DEFAULT: 'hsl(var(--popover))',
                            foreground: 'hsl(var(--popover-foreground))'
                        },
                        card: {
                            DEFAULT: 'hsl(var(--card))',
                            foreground: 'hsl(var(--card-foreground))'
                        },
                    },
                }
            }
        }
    </script>
    <style type="text/tailwindcss">
        @layer base {
            :root {
                --background: 0 0% 100%;
                --foreground: 240 10% 3.9%;
                --card: 0 0% 100%;
                --card-foreground: 240 10% 3.9%;
                --popover: 0 0% 100%;
                --popover-foreground: 240 10% 3.9%;
                --primary: 240 5.9% 10%;
                --primary-foreground: 0 0% 98%;
                --secondary: 240 4.8% 95.9%;
                --secondary-foreground: 240 5.9% 10%;
                --muted: 240 4.8% 95.9%;
                --muted-foreground: 240 3.8% 46.1%;
                --accent: 240 4.8% 95.9%;
                --accent-foreground: 240 5.9% 10%;
                --destructive: 0 84.2% 60.2%;
                --destructive-foreground: 0 0% 98%;
                --border: 240 5.9% 90%;
                --input: 240 5.9% 90%;
                --ring: 240 5.9% 10%;
                --radius: 0.5rem;
            }
            .dark {
                --background: 240 10% 3.9%;
                --foreground: 0 0% 98%;
                --card: 240 10% 3.9%;
                --card-foreground: 0 0% 98%;
                --popover: 240 10% 3.9%;
                --popover-foreground: 0 0% 98%;
                --primary: 0 0% 98%;
                --primary-foreground: 240 5.9% 10%;
                --secondary: 240 3.7% 15.9%;
                --secondary-foreground: 0 0% 98%;
                --muted: 240 3.7% 15.9%;
                --muted-foreground: 240 5% 64.9%;
                --accent: 240 3.7% 15.9%;
                --accent-foreground: 0 0% 98%;
                --destructive: 0 62.8% 30.6%;
                --destructive-foreground: 0 0% 98%;
                --border: 240 3.7% 15.9%;
                --input: 240 3.7% 15.9%;
                --ring: 240 4.9% 83.9%;
            }
        }
    </style>
</head>
<body>
    <div class="flex flex-col items-center justify-center min-h-[80vh] py-8" style="background-color: #e2ddcf;">
        <div class="p-8 rounded-lg shadow-lg w-full max-w-md mx-auto" style="background-color: #fcf6e7;">
            <h2 class="text-2xl font-bold text-foreground mb-6 text-center">THÔNG TIN TÀI KHOẢN</h2>
            
            <?php if ($error): ?>
                <div class="mb-4 text-red-600 text-center font-semibold"><?= htmlspecialchars($error) ?></div>
            <?php endif; ?>
            
            <?php if ($success): ?>
                <div class="mb-4 text-green-600 text-center font-semibold"><?= htmlspecialchars($success) ?></div>
            <?php endif; ?>
            
            <form method="post" class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-muted-foreground mb-1">TÊN TÀI KHOẢN</label>
                    <div class="border border-muted rounded-lg p-3" style="background-color: #ffffff;">
                        <?= htmlspecialchars($userInfo['taikhoan'] ?? '') ?>
                    </div>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-muted-foreground mb-1" for="txtMatKhau">MẬT KHẨU</label>
                    <input class="border border-muted rounded-lg p-3 w-full" 
                           type="password" name="txtMatKhau" id="txtMatKhau" 
                           value="<?= htmlspecialchars($userInfo['matkhau'] ?? '') ?>" 
                           style="background-color: #ffffff;" required />
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-muted-foreground mb-1" for="txtDiaChi">ĐỊA CHỈ</label>
                    <input class="border border-muted rounded-lg p-3 w-full" 
                           type="text" name="txtDiaChi" id="txtDiaChi" 
                           value="<?= htmlspecialchars($userInfo['diachi'] ?? '') ?>" 
                           style="background-color: #ffffff;" />
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-muted-foreground mb-1" for="txtSDT">SỐ ĐIỆN THOẠI</label>
                    <input class="border border-muted rounded-lg p-3 w-full" 
                           type="tel" name="txtSDT" id="txtSDT" 
                           value="<?= htmlspecialchars($userInfo['sdt'] ?? '') ?>" 
                           style="background-color: #ffffff;" />
                </div>
                
                <button type="submit" class="w-full mt-6 text-white hover:bg-opacity-90 py-2 px-4 rounded-lg transition-colors duration-200" 
                        style="background-color: #8b7355;">LƯU THAY ĐỔI</button>
            </form>
            
            <div style="text-align:center; margin-top: 20px;">
        <a href="trangchu.php" style="display:inline-block; background:#e5c07b; color:#4b3c00; padding:10px 24px; border-radius:6px; text-decoration:none; font-weight:bold; transition:background 0.2s;"
           onmouseover="this.style.background='#d1ae66'" onmouseout="this.style.background='#e5c07b'">
            Quay lại Trang chủ
        </a>
    </div>
        </div>
    </div>
</body>
</html>
