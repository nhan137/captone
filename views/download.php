<?php
if (isset($_GET['file'])) {
    $file = $_GET['file'];
    $filePath = 'uploads/' . basename($file); // Đường dẫn đến thư mục uploads

    // Kiểm tra xem tệp có tồn tại không
    if (file_exists($filePath) && is_readable($filePath)) {
        // Thiết lập tiêu đề để tải xuống tệp
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . basename($filePath) . '"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($filePath));
        flush(); // Xóa bộ đệm hệ thống
        readfile($filePath); // Đọc tệp và gửi đến trình duyệt
        exit;
    } else {
        echo "File does not exist or cannot be read: " . htmlspecialchars($filePath);
    }
} else {
    echo "No file to download.";
}

if (isset($_FILES['attachment'])) {
    $file_name = $_FILES['attachment']['name'];
    $file_tmp = $_FILES['attachment']['tmp_name'];
    $file_size = $_FILES['attachment']['size'];
    $file_error = $_FILES['attachment']['error'];

    // Kiểm tra lỗi
    if ($file_error > 0) {
        echo "Có lỗi xảy ra khi tải lên tệp tin.";
    } elseif ($file_size > 5242880) { // Giới hạn kích thước 5MB
        echo "Kích thước tệp tin vượt quá giới hạn cho phép.";
    } else {
        // Lưu tệp vào thư mục uploads
        $upload_dir = "uploads/";
        $file_dest = $upload_dir . basename($file_name);
        
        if (move_uploaded_file($file_tmp, $file_dest)) {
            echo "Tệp tin đã được tải lên thành công.";
        } else {
            echo "Có lỗi xảy ra khi lưu tệp tin.";
        }
    }
}

$allowed_types = array('jpg', 'jpeg', 'png', 'gif');
$file_extension = pathinfo($file_name, PATHINFO_EXTENSION);
if (!in_array($file_extension, $allowed_types)) {
    echo "Chỉ cho phép tải lên các tệp tin hình ảnh.";
}
?>