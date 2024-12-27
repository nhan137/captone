<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thông Tin Bảng Lương Nhân Viên</title>
    <link rel="stylesheet" href="assets/css/Employee/employee_payroll_view.css"> <!-- Liên kết đến tệp CSS của bạn -->
</head>
<body>
    <div class="container">
        <div class="sidebar">
            <?php include 'views/layouts/sidebar.php'; ?>
        </div>

        <div class="main-content">
            <h1>Thông Tin Bảng Lương Của Bạn</h1>

            <form method="GET" action="">
                <input type="hidden" name="action" value="viewEmployeePayroll">
                <label for="year">Chọn Năm:</label>
                <select name="year" id="year" onchange="this.form.submit()">
                    <option value="">-- Chọn Năm --</option>
                    <?php 
                    $years = range(2020, date("Y")); // Thay đổi năm bắt đầu nếu cần
                    foreach ($years as $year): ?>
                        <option value="<?= $year ?>" <?= (isset($_GET['year']) && $_GET['year'] == $year) ? 'selected' : '' ?>><?= $year ?></option>
                    <?php endforeach; ?>
                </select>
            </form>

            <table>
                <thead>
                    <tr>
                        <th>ID Bảng Lương</th>
                        <th>Tháng</th>
                        <th>Năm</th>
                        <th>Tổng Giờ Làm</th>
                        <th>Giá Theo Giờ</th>
                        <th>Tổng Lương</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($payrolls)): ?>
                        <?php 
                        // Sắp xếp bảng lương theo tháng
                        usort($payrolls, function($a, $b) {
                            return $a['Month'] - $b['Month'];
                        });
                        foreach ($payrolls as $payroll): ?>
                            <tr>
                                <td><?= htmlspecialchars($payroll['PayrollID']) ?></td>
                                <td><?= htmlspecialchars($payroll['Month']) ?></td>
                                <td><?= htmlspecialchars($payroll['Year']) ?></td>
                                <td><?= htmlspecialchars($payroll['TotalHours']) ?></td>
                                <td><?= htmlspecialchars($payroll['HourlyRate']) ?> VND</td>
                                <td><?= htmlspecialchars($payroll['ActualSalary']) ?> VND</td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6">Không có dữ liệu bảng lương cho nhân viên này.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
