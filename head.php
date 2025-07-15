
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang Chủ - Nội Thất</title>
    <!-- Tailwind CDN và các plugin forms, typography -->
    <script src="https://cdn.tailwindcss.com?plugins=forms,typography"></script>
    <!-- Lazy load images -->
    <script src="https://unpkg.com/unlazy@0.11.3/dist/unlazy.with-hashing.iife.js" defer init></script>
    <!-- Cấu hình màu sắc cho Tailwind sử dụng biến CSS -->
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
                        muted: {
                            DEFAULT: 'hsl(var(--muted))',
                            foreground: 'hsl(var(--muted-foreground))'
                        },
                        accent: {
                            DEFAULT: 'hsl(var(--accent))',
                            foreground: 'hsl(var(--accent-foreground))'
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
    <style>
        :root {
            --background: #fff;
            --foreground: #222;
            --primary: #22223b;
            --primary-foreground: #fff;
            --secondary: #CD853F;
        }
        body {
            font-family: 'Segoe UI', Arial, sans-serif;
        }
    </style>
        <style>
        nav a {
            color: #222;
            transition: color 0.25s cubic-bezier(.4,0,.2,1);
        }
        nav a:hover, nav a:focus {
            color: #A67C68 !important;
        }
    </style>
<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$username = isset($_SESSION['username']) ? strtolower($_SESSION['username']) : null;

// Xác định các link và text cho menu dựa trên trạng thái đăng nhập
if (!$username) {
    $giohang_href = "dangnhap.php";
    $giohang_onclick = "alert('Bạn cần đăng nhập để sử dụng chức năng này!'); return false;";
    $giohang_text = "Giỏ Hàng";

    $thongtin_href = "dangnhap.php";
    $thongtin_onclick = "alert('Bạn cần đăng nhập để sử dụng chức năng này!'); return false;";
    $thongtin_text = "Thông Tin Tài Khoản";

    $dathang_href = "dathang.php";
    $dathang_text = "Đặt Hàng";

    $cuoi_href = "dangnhap.php";
    $cuoi_text = "Đăng Nhập";
    $cuoi_onclick = "";
} else if ($username == "admin") {
    $giohang_href = "quanlysp.php";
    $giohang_onclick = "";
    $giohang_text = "Quản lý Sản phẩm";

    $thongtin_href = "donhang.php";
    $thongtin_onclick = "";
    $thongtin_text = "Đơn Hàng";

    $cuoi_href = "dangxuat.php";
    $cuoi_text = "Đăng Xuất (" . htmlspecialchars($_SESSION['username']) . ")";
    $cuoi_onclick = "";
} else {
    $giohang_href = "giohang.php";
    $giohang_onclick = "";
    $giohang_text = "Giỏ Hàng";

    // Thêm hai dòng này để menu Đặt Hàng hiển thị cho user thường
    $dathang_href = "dathang.php";
    $dathang_text = "Đơn Hàng Của Bạn";

    $thongtin_href = "thongtintaikhoan.php";
    $thongtin_onclick = "";
    $thongtin_text = "Thông Tin Tài Khoản";

    $cuoi_href = "dangxuat.php";
    $cuoi_text = "Đăng Xuất (" . htmlspecialchars($_SESSION['username']) . ")";
    $cuoi_onclick = "";
}
?>
<header class="bg-[#fdf5e6] shadow-md px-6 py-4 flex flex-col md:flex-row md:items-center md:justify-between space-y-4 md:space-y-0">
    <div class="text-2xl font-extrabold text-[#8b4513] tracking-wide">
        NỘI THẤT TOÀN
    </div>

    <nav class="flex flex-wrap gap-4 justify-center text-sm font-semibold">
        <a href="trangchu.php" class="text-[#5c4033] hover:text-[#a67c68] transition-colors">Trang Chủ</a>
        <a href="<?= $giohang_href ?>" <?= $giohang_onclick ? 'onclick="'.$giohang_onclick.'"' : '' ?> class="text-[#5c4033] hover:text-[#a67c68] transition-colors"><?= $giohang_text ?></a>
        <?php if (isset($dathang_href)): ?>
            <a href="<?= $dathang_href ?>" class="text-[#5c4033] hover:text-[#a67c68] transition-colors"><?= $dathang_text ?></a>
        <?php endif; ?>
        <a href="<?= $thongtin_href ?>" <?= $thongtin_onclick ? 'onclick="'.$thongtin_onclick.'"' : '' ?> class="text-[#5c4033] hover:text-[#a67c68] transition-colors"><?= $thongtin_text ?></a>
        <a href="<?= $cuoi_href ?>" <?= $cuoi_onclick ? 'onclick="'.$cuoi_onclick.'"' : '' ?> class="text-[#5c4033] hover:text-[#a67c68] transition-colors"><?= $cuoi_text ?></a>
    </nav>

    <div class="relative">
        <input type="text" id="search-box" placeholder="Search..." autocomplete="off"
            class="border border-[#d9b99b] p-2 pl-4 rounded-full focus:outline-none focus:ring-2 focus:ring-[#a67c68] shadow-sm w-56" />
        <div id="autocomplete-box" class="autocomplete-suggestions" style="display:none;"></div>
    </div>
</header>

<style>
.autocomplete-suggestions {
    position: absolute;
    top: 56px;
    right: 16px;
    background: #fff;
    border: 1px solid #ddd;
    border-radius: 0 0 8px 8px;
    width: 220px;
    max-height: 220px;
    overflow-y: auto;
    z-index: 9999;
    box-shadow: 0 2px 8px rgba(0,0,0,0.08);
}
.autocomplete-suggestion {
    padding: 10px 16px;
    cursor: pointer;
    border-bottom: 1px solid #f3f3f3;
}
.autocomplete-suggestion:last-child {
    border-bottom: none;
}
.autocomplete-suggestion:hover, .autocomplete-suggestion.active {
    background: #ffe4c4;
    color: #7B4B37;
}
</style>
<script>
const suggestions = [
    { name: "Bàn làm việc chân sắt", url: "chitietsp.php?id=sp01" },
    { name: "Sofa đơn bọc nỉ", url: "chitietsp.php?id=sp02" },
    { name: "Bàn IKEA 2m", url: "chitietsp.php?id=sp03" },
    { name: "Bộ Bàn Ăn Scania", url: "chitietsp.php?id=sp04" },
    { name: "Combo Giường Ngủ MOHO VLINE", url: "chitietsp.php?id=sp05" },
    { name: "Combo Phòng Khách MOHO VLINE", url: "chitietsp.php?id=sp06" },
    { name: "Tủ Quần Áo Gỗ Có Gương", url: "chitietsp.php?id=sp07" },
    { name: "Combo Sofa Gỗ Cao Su Chữ L", url: "chitietsp.php?id=sp08" },
    { name: "Ghế thư giãn", url: "chitietsp.php?id=sp09" },
    { name: "Tủ giày thông minh", url: "chitietsp.php?id=sp10" }
];

document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('search-box');
    const suggestionBox = document.getElementById('autocomplete-box');
    if (!searchInput || !suggestionBox) return;

    searchInput.parentNode.style.position = 'relative';
    suggestionBox.style.left = searchInput.offsetLeft + 'px';

    searchInput.addEventListener('input', function() {
        const value = this.value.trim().toLowerCase();
        suggestionBox.innerHTML = '';
        if (!value) {
            suggestionBox.style.display = 'none';
            return;
        }
        const filtered = suggestions.filter(item => item.name.toLowerCase().includes(value));
        if (filtered.length === 0) {
            suggestionBox.style.display = 'none';
            return;
        }
        filtered.forEach(item => {
            const div = document.createElement('div');
            div.className = 'autocomplete-suggestion';
            div.textContent = item.name;
            div.onclick = function() {
                window.location.href = item.url;
            };
            suggestionBox.appendChild(div);
        });
        suggestionBox.style.display = 'block';
    });

    document.addEventListener('click', function(e) {
        if (!suggestionBox.contains(e.target) && e.target !== searchInput) {
            suggestionBox.style.display = 'none';
        }
    });
});
</script>

</header>
</head>