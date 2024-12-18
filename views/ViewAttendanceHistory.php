<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attendance History</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
    <style>
        .main-content {
            margin-left: 260px;
            padding: 20px;
            min-height: 100vh;
            background: #f0f4ff;
        }

        .attendance-container {
            background: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            margin: 20px 10px;
            width: calc(100% - 40px);
        }

        .attendance-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            padding: 10px;
            background: #f8f9fa;
            border-radius: 8px;
        }

        .header-title {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .filter-section {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            padding: 15px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }

        .filter-group {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .filter-item select,
        .filter-item input[type="date"] {
            padding: 8px 12px;
            border: 1px solid #ddd;
            border-radius: 6px;
            font-size: 14px;
            min-width: 200px;
        }

        .filter-item button {
            padding: 8px 20px;
            background: #4CAF50;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            transition: background 0.3s;
        }

        .filter-item button:hover {
            background: #45a049;
        }

        /* Table Styles */
        .records-table {
            overflow-x: auto;
            margin-top: 20px;
        }

        #attendanceTable {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            background: white;
            border-radius: 8px;
            table-layout: fixed;
        }

        #attendanceTable th,
        #attendanceTable td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #eee;
        }

        #attendanceTable th {
            background: #f8f9fa;
            font-weight: 600;
            color: #333;
        }

        #attendanceTable tr:hover {
            background: #f5f5f5;
        }

        /* Status Badges */
        .badge {
            display: inline-block;
            padding: 6px 15px;
            border-radius: 15px;
            font-size: 12px;
            font-weight: 500;
            margin: 0 4px;
            min-width: 110px;
            text-align: center;
        }

        .badge-warning {
            background: #fff3cd;
            color: #856404;
        }

        .badge-success {
            background: #d4edda;
            color: #155724;
        }

        .badge-danger {
            background: #f8d7da;
            color: #721c24;
        }

        /* Responsive Design */
        @media (max-width: 1200px) {
            .filter-group {
                flex-direction: column;
                gap: 10px;
            }

            .filter-item {
                width: 100%;
            }
        }

        /* Header Layout */
        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .header-left {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .header-right {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        /* Navigation Arrows */
        .nav-arrows {
            display: flex;
            gap: 10px;
            margin: 20px 0;
        }

        .nav-arrow {
            padding: 8px 15px;
            background: #fff;
            border: 1px solid #ddd;
            border-radius: 4px;
            cursor: pointer;
            transition: all 0.3s;
        }

        .nav-arrow:hover {
            background: #f8f9fa;
        }

        .filter-form {
            display: flex;
            gap: 10px;
            align-items: center;
        }

        .filter-group {
            display: flex;
            gap: 10px;
            align-items: center;
        }

        .filter-button {
            padding: 8px 20px;
            background: #4CAF50;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
        }

        .nav-arrows {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 20px;
            margin-top: 20px;
            padding: 10px;
        }

        .nav-arrow {
            padding: 8px 15px;
            background: #fff;
            border: 1px solid #ddd;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
            color: #333;
        }

        .nav-arrow.disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }

        .page-info {
            font-size: 14px;
            color: #666;
        }

        /* Column Widths */
        #attendanceTable th:first-child,
        #attendanceTable td:first-child {
            width: 20%;
        }

        #attendanceTable th:last-child,
        #attendanceTable td:last-child {
            width: 20%;
        }

        /* Thêm style mới cho cột GPS location */
        #attendanceTable td:nth-child(6),
        #attendanceTable td:nth-child(7) {
            max-width: 150px;        /* Giới hạn chiều rộng tối đa */
            overflow: hidden;        /* Ẩn nội dung thừa */
            text-overflow: ellipsis; /* Hiển thị dấu ... khi text quá dài */
            white-space: nowrap;     /* Không xuống dòng */
        }

        /* Thêm tooltip khi hover */
        #attendanceTable td:nth-child(6),
        #attendanceTable td:nth-child(7) {
            position: relative;
            cursor: pointer;
        }

        #attendanceTable td:nth-child(6):hover,
        #attendanceTable td:nth-child(7):hover {
            overflow: visible;
            white-space: normal;
            background-color: #f8f9fa;
            z-index: 1;
            position: relative;
        }

        /* Điều chỉnh độ rộng các cột */
        #attendanceTable th:nth-child(6),
        #attendanceTable td:nth-child(6),
        #attendanceTable th:nth-child(7),
        #attendanceTable td:nth-child(7) {
            width: 150px;
        }
    </style>
</head>
<body>
    <?php include 'views/layouts/sidebar_accountant.php'; ?>
    <div class="main-content">
        <div class="attendance-container">
            <div class="page-header">
                <div class="header-left">
                    <h2>Employee Attendance History</h2>
                </div>
                <div class="header-right">
                    <form method="GET" action="index.php" class="filter-form">
                        <input type="hidden" name="action" value="viewAttendanceHistory">
                        <div class="filter-group">
                            <select name="employee_id" class="form-select">
                                <option value="">All Employees</option>
                                <?php foreach ($employees as $employee): ?>
                                    <option value="<?= $employee['EmployeeID'] ?>" 
                                        <?= $selectedEmployee == $employee['EmployeeID'] ? 'selected' : '' ?>>
                                        <?= htmlspecialchars($employee['FirstName'] . ' ' . $employee['LastName']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <input type="date" name="start_date" value="<?= htmlspecialchars($startDate) ?>" class="form-control">
                            <input type="date" name="end_date" value="<?= htmlspecialchars($endDate) ?>" class="form-control">
                            <button type="submit" class="filter-button">Filter</button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Table Content -->
            <div class="records-table">
                <table id="attendanceTable">
                    <thead>
                        <tr>
                            <th>Employee</th>
                            <th>Date</th>
                            <th>Check In</th>
                            <th>Check Out</th>
                            <th>Total Hours</th>
                            <th>Check In Location</th>
                            <th>Check Out Location</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($attendanceData as $record): ?>
                            <tr>
                                <td><?= htmlspecialchars($record['FirstName'] . ' ' . $record['LastName']) ?></td>
                                <td><?= date('m/d/Y', strtotime($record['CheckinTime'])) ?></td>
                                <td><?= date('H:i:s', strtotime($record['CheckinTime'])) ?></td>
                                <td><?= $record['CheckoutTime'] ? date('H:i:s', strtotime($record['CheckoutTime'])) : 'N/A' ?></td>
                                <td><?= $record['TotalWorkHours'] ?? 'N/A' ?></td>
                                <td><?= htmlspecialchars($record['GPSLocation']) ?></td>
                                <td><?= htmlspecialchars($record['CheckoutLocation'] ?? 'N/A') ?></td>
                                <td>
                                    <?php if (!empty($record['IsAbsent']) && $record['IsAbsent']) : ?>
                                        <span class="status-absent">Absent</span>
                                    <?php else : ?>
                                        <?php 
                                            // Hiển thị trạng thái check-in
                                            if ($record['CheckinStatus'] === 'On Time') {
                                                echo '<span class="badge badge-success">Check-in On Time</span>';
                                            } else {
                                                echo '<span class="badge badge-danger">Late Check-in</span>';
                                            }

                                            echo ' '; // Khoảng cách giữa các badge

                                            // Hiển thị trạng thái check-out
                                            if (!empty($record['CheckoutTime'])) {
                                                if ($record['CheckoutStatus'] === 'On Time') {
                                                    echo '<span class="badge badge-success">Check-out On Time</span>';
                                                } else {
                                                    echo '<span class="badge badge-warning">Early Check-out</span>';
                                                }
                                            }
                                        ?>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <!-- Navigation Arrows -->
            <div class="nav-arrows">
                <?php if ($totalPages > 1): ?>
                    <a href="?action=viewAttendanceHistory&page=<?= max(1, $page-1) ?>&employee_id=<?= $selectedEmployee ?>&start_date=<?= $startDate ?>&end_date=<?= $endDate ?>" 
                       class="nav-arrow <?= $page <= 1 ? 'disabled' : '' ?>">
                        <i class="fas fa-chevron-left"></i>
                    </a>
                    <span class="page-info">Page <?= $page ?> of <?= $totalPages ?></span>
                    <a href="?action=viewAttendanceHistory&page=<?= min($totalPages, $page+1) ?>&employee_id=<?= $selectedEmployee ?>&start_date=<?= $startDate ?>&end_date=<?= $endDate ?>" 
                       class="nav-arrow <?= $page >= $totalPages ? 'disabled' : '' ?>">
                        <i class="fas fa-chevron-right"></i>
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</body>
</html> 