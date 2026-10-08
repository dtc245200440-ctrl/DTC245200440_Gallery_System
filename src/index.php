<?php
$host = 'db';
$user = 'gallery_user';
$pass = 'gallery_password';
$db   = 'gallery_db';

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Kết nối CSDL thất bại: " . $conn->connect_error);
}

// Tạo bảng album nếu chưa có
$conn->query("CREATE TABLE IF NOT EXISTS photos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    image_url VARCHAR(500) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)");

// Xử lý thêm ảnh mẫu
if (isset($_POST['add'])) {
    $title = $_POST['title'];
    $url = $_POST['url'];
    if(!empty($title) && !empty($url)){
        $stmt = $conn->prepare("INSERT INTO photos (title, image_url) VALUES (?, ?)");
        $stmt->bind_param("ss", $title, $url);
        $stmt->execute();
    }
}

$result = $conn->query("SELECT * FROM photos ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Hệ thống Thư viện Ảnh - MSV: DTC245200440</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 30px; background-color: #f4f6f9; }
        h1 { color: #333; }
        .form-box { background: #fff; padding: 20px; border-radius: 8px; margin-bottom: 20px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); }
        input[type="text"] { width: 40%; padding: 8px; margin-right: 10px; }
        button { padding: 8px 15px; background: #28a745; color: white; border: none; border-radius: 4px; cursor: pointer; }
        .gallery { display: grid; grid-template-columns: repeat(auto-fill, minmax(200px, 1fr)); gap: 15px; }
        .card { background: #fff; padding: 10px; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); text-align: center; }
        .card img { width: 100%; height: 150px; object-fit: cover; border-radius: 4px; }
    </style>
</head>
<body>
    <h1>🖼️ Hệ thống Thư viện Ảnh / Gallery (Đề 31)</h1>
    <p><strong>Sinh viên thực hiện:</strong> Nguyễn Thị Hương - MSV: DTC245200440</p>

    <div class="form-box">
        <h3>Thêm ảnh mới vào Album</h3>
        <form method="POST">
            <input type="text" name="title" placeholder="Tên bức ảnh..." required>
            <input type="text" name="url" placeholder="URL hình ảnh (https://...)" required>
            <button type="submit" name="add">Tải ảnh lên</button>
        </form>
    </div>

    <h2>Danh sách hình ảnh trong Album</h2>
    <div class="gallery">
        <?php if ($result && $result->num_rows > 0): ?>
            <?php while($row = $result->fetch_assoc()): ?>
                <div class="card">
                    <img src="<?php echo htmlspecialchars($row['image_url']); ?>" alt="Photo">
                    <h4><?php echo htmlspecialchars($row['title']); ?></h4>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p>Chưa có hình ảnh nào trong thư viện.</p>
        <?php endif; ?>
    </div>
</body>
</html>