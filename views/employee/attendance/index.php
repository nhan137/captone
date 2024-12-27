<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Attendance History</title>
    <!-- <link rel="stylesheet" href="../attendancehistory.css" /> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
    <style>
    /* Importing Google font - Poppins */
    @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap");

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: "Poppins", sans-serif;
    }

    body {
        min-height: 100vh;
        background: #f0f4ff;
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        background-color: #f5f5f5;
    }

    .sidebar {
        position: fixed;
        top: 0;
        left: 0;
        height: 100%;
        width: 80px;
        display: flex;
        overflow-x: hidden;
        flex-direction: column;
        background: #161a2d;
        padding: 25px 19px;
        transition: all 0.4s ease;
    }

    .sidebar:hover {
        width: 260px;
    }

    .sidebar .sidebar-header {
        display: flex;
        align-items: center;
    }

    .sidebar .sidebar-header img {
        width: 50px;
        border-radius: 55%;
    }

    .sidebar .sidebar-header h2 {
        color: #fff;
        font-size: 1.25rem;
        font-weight: 600;
        white-space: nowrap;
        margin-left: 23px;
    }

    .sidebar-links h4 {
        color: #fff;
        font-weight: 500;
        white-space: nowrap;
        margin: 10px 0;
        position: relative;
    }

    .sidebar-links h4 span {
        opacity: 0;
    }

    .sidebar:hover .sidebar-links h4 span {
        opacity: 1;
    }

    .sidebar-links .menu-separator {
        position: absolute;
        left: 0;
        top: 50%;
        width: 100%;
        height: 1px;
        transform: translateY(-50%);
        background: #4f52ba;
        transform-origin: right;
        transition-delay: 0.2s;
    }

    .sidebar:hover .sidebar-links .menu-separator {
        transition-delay: 0s;
        transform: scaleX(0);
    }

    .sidebar-links {
        list-style: none;
        margin-top: 20px;
        height: 80%;
        overflow-y: auto;
        scrollbar-width: none;
    }

    .sidebar-links::-webkit-scrollbar {
        display: none;
    }

    .sidebar-links li a {
        display: flex;
        align-items: center;
        gap: 0 20px;
        color: #fff;
        font-weight: 500;
        white-space: nowrap;
        padding: 15px 10px;
        text-decoration: none;
        transition: 0.2s ease;
    }

    .sidebar-links li a:hover {
        color: #161a2d;
        background: #fff;
        border-radius: 4px;
    }

    .user-account {
        margin-top: auto;
        padding: 12px 10px;
        margin-left: -10px;
    }

    .user-profile {
display: flex;
        align-items: center;
        color: #161a2d;
    }

    .user-profile img {
        width: 42px;
        border-radius: 50%;
        border: 2px solid #fff;
    }

    .user-profile h3 {
        font-size: 1rem;
        font-weight: 600;
    }

    .user-profile span {
        font-size: 0.775rem;
        font-weight: 600;
    }

    .user-detail {
        margin-left: 23px;
        white-space: nowrap;
    }

    .sidebar:hover .user-account {
        background: #fff;
        border-radius: 4px;
    }

    .main-content {
        margin-left: 260px;
        padding: 0;
        min-height: 100vh;
        background: #f0f4ff;
    }

    .personal-info-form {
        background: white;
        padding: 40px;
        border-radius: 12px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    /* Style cho headers */
    h2 {
        color: #2c3e50;
        font-size: 20px;
        margin-bottom: 30px;
        padding-bottom: 15px;
        border-bottom: 2px solid #eee;
    }

    h3 {
        color: #2c3e50;
        font-size: 18px;
        margin: 30px 0 20px;
        grid-column: 1 / -1;
    }

    /* Layout chính */
    .form-row {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 30px;
        /* Tăng khoảng cách giữa các cột */
        margin-bottom: 30px;
    }

    .form-group {
        display: flex;
        flex-direction: column;
        gap: 10px;
    }

    /* Style cho labels */
    .form-group label {
        font-weight: 500;
        color: #4a5568;
        font-size: 14px;
    }

    /* Style cho inputs và selects */
    .form-group input,
    .form-group select {
        width: 100%;
        padding: 12px 15px;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        font-size: 14px;
        transition: all 0.3s ease;
        background-color: #f8fafc;
        /* Màu nền nhẹ */
    }

    .form-group input:focus,
    .form-group select:focus {
        outline: none;
        border-color: #4299e1;
        box-shadow: 0 0 0 3px rgba(66, 153, 225, 0.1);
        background-color: white;
    }

    /* Section spacing */
    .section {
        margin-bottom: 40px;
    }

    /* Responsive */
    @media (max-width: 1024px) {
        .form-row {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 768px) {
        .form-row {
            grid-template-columns: 1fr;
        }

        .main-content {
            padding: 15px;
        }

        .personal-info-form {
            padding: 20px;
        }
    }

    .checkin-container {
        background: #fff;
        padding: 2rem;
        border-radius: 10px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .company-header {
        text-align: center;
        margin-bottom: 2rem;
    }

    .company-header h1 {
        color: #2c3e50;
        margin-bottom: 0.5rem;
    }

    .greeting {
        color: #7f8c8d;
        font-size: 1.1rem;
    }

    .profile-section {
text-align: center;
        margin-bottom: 2rem;
    }

    .avatar-large {
        width: 150px;
        height: 150px;
        border-radius: 50%;
        object-fit: cover;
        border: 4px solid #3498db;
    }

    .checkin-form {
        max-width: 500px;
        margin: 0 auto;
    }

    .checkin-form .form-group {
        margin-bottom: 1.5rem;
    }

    .checkin-form label {
        display: block;
        margin-bottom: 0.5rem;
        color: #2c3e50;
        font-weight: 500;
    }

    .checkin-form input {
        width: 100%;
        padding: 0.8rem;
        border: 1px solid #ddd;
        border-radius: 5px;
        font-size: 1rem;
    }

    .checkin-button {
        width: 100%;
        padding: 1rem;
        background-color: #2ecc71;
        color: white;
        border: none;
        border-radius: 5px;
        font-size: 1.1rem;
        font-weight: bold;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        transition: background-color 0.3s ease;
    }

    .checkin-button:hover {
        background-color: #27ae60;
    }

    .checkin-button i {
        font-size: 1.2rem;
    }

    /* Time Display Styles */
    .time-display {
        text-align: center;
        margin-bottom: 2rem;
        padding: 1rem;
        background: #f8f9fa;
        border-radius: 8px;
    }

    #clock {
        font-size: 2.5rem;
        font-weight: bold;
        color: #2c3e50;
        margin: 0.5rem 0;
    }

    #date {
        color: #7f8c8d;
        font-size: 1.1rem;
    }

    @media (max-width: 768px) {
        .checkin-container {
            padding: 1rem;
        }

        .avatar-large {
            width: 100px;
            height: 100px;
        }

        #clock {
            font-size: 2rem;
        }
    }

    /* Thêm vào file profile.css */

    .confirmation-header {
        text-align: center;
        margin-bottom: 2rem;
    }

    .confirmation-header h2 {
        color: #2c3e50;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
    }

    .confirmation-header h2 i {
        color: #3498db;
    }

    .confirmation-table {
        margin: 2rem 0;
        overflow-x: auto;
    }

    .confirmation-table table {
        width: 100%;
        border-collapse: collapse;
        background: #fff;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    }

    .confirmation-table th,
    .confirmation-table td {
        padding: 1rem;
        text-align: left;
        border-bottom: 1px solid #eee;
    }

    .confirmation-table th {
        background: #f8f9fa;
        color: #2c3e50;
        font-weight: 600;
    }

    .confirmation-table th i {
        margin-right: 0.5rem;
        color: #3498db;
    }

    .confirmation-table tbody tr:hover {
        background-color: #f8f9fa;
    }

    .confirmation-actions {
        display: flex;
        justify-content: center;
margin-top: 2rem;
    }

    .back-button {
        padding: 0.8rem 1.5rem;
        background-color: #3498db;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 1rem;
        transition: background-color 0.3s ease;
    }

    .back-button:hover {
        background-color: #2980b9;
    }

    .back-button i {
        font-size: 1rem;
    }

    @media (max-width: 768px) {
        .confirmation-table {
            margin: 1rem -1rem;
        }

        .confirmation-table th,
        .confirmation-table td {
            padding: 0.8rem;
            font-size: 0.9rem;
        }
    }

    .attendance-container {
        background: white;
        padding: 2rem;
        border-radius: 10px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        margin: 20px;
        width: calc(100% - 40px); /* Đảm bảo container không bị tràn */
    }

    .attendance-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 2rem;
        padding: 1rem;
        background: #f8f9fa;
        border-radius: 8px;
    }

    .attendance-header h2 {
        color: #2c3e50;
        font-size: 1.5rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .date-filter-form {
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .date-inputs {
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .form-group {
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .form-group label {
        color: #2c3e50;
        font-weight: 500;
        white-space: nowrap;
    }

    .form-group input[type="date"] {
        padding: 8px 12px;
        border: 1px solid #ddd;
        border-radius: 5px;
        font-size: 14px;
        height: 38px;
    }

    .filter-button {
        background-color: #3498db;
        color: white;
        padding: 8px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        height: 38px;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 14px;
        transition: all 0.3s;
    }

    .filter-button:hover {
        background-color: #2980b9;
    }

    /* Table Styles */
    .attendance-table-wrapper {
        background: white;
        border-radius: 10px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        overflow: hidden;
        margin-bottom: 2rem;
        width: 100%;
    }

    .attendance-table {
        width: 100%;
        border-collapse: collapse;
    }

    .attendance-table th {
        background: #f8f9fa;
        padding: 15px;
        font-weight: 600;
        color: #2c3e50;
        text-align: left;
        border-bottom: 2px solid #eee;
    }

    .attendance-table td {
        padding: 15px;
        border-bottom: 1px solid #eee;
    }

    .attendance-table tr:hover {
        background-color: #f8f9fa;
    }

    /* Status Badges */
    .badge {
        display: inline-flex;
        align-items: center;
        padding: 4px 8px;
        border-radius: 15px;
        font-size: 11px;
        font-weight: 500;
        margin-right: 4px;
        white-space: nowrap;
    }

    .badge-success {
        background-color: #27ae60;
        color: white;
    }

    .badge-warning {
        background-color: #f39c12;
        color: white;
    }

    .badge-danger {
        background-color: #e74c3c;
        color: white;
    }

    /* Action Buttons */
    .attendance-actions {
        display: flex;
        gap: 1rem;
        justify-content: flex-end;
    }

    .export-button,
    .print-button {
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 14px;
        transition: all 0.3s;
    }

    .export-button {
        background-color: #3498db;
        color: white;
    }

    .print-button {
        background-color: #2ecc71;
        color: white;
    }

    .export-button:hover,
    .print-button:hover {
        opacity: 0.9;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .attendance-header {
            flex-direction: column;
            gap: 1rem;
        }

        .date-filter-form {
            flex-direction: column;
            width: 100%;
        }
    }

    .attendance-table td:last-child {
        white-space: nowrap;
        min-width: 280px;
    }

    .status-container {
        display: flex;
        flex-direction: column;
        gap: 4px;
        min-width: 150px;
    }

    .badge {
        display: inline-flex;
        align-items: center;
        padding: 6px 12px;
        border-radius: 15px;
        font-size: 13px;
        font-weight: 500;
    }

    .badge-success {
        background-color: #e7f6ec;
        color: #1d6f42;
        border: 1px solid #d1e7dd;
    }

    .badge-warning {
        background-color: #fff8e6;
        color: #997404;
        border: 1px solid #ffeeba;
    }

    .badge-danger {
        background-color: #ffebee;
        color: #dc3545;
        border: 1px solid #f5c2c7;
    }

    /* Responsive styles */
    @media (min-width: 768px) {
        .status-container {
            flex-wrap: nowrap;
        }
    }
    </style>
</head>

<body>

    <?php include 'views/layouts/sidebar.php'; ?>
    <!-- Main Content -->
    <div class="main-content">
        <div class="attendance-container">
            <!-- Header -->
            <div class="attendance-header">
                <h2><i class="fas fa-history"></i> Attendance History</h2>
                <form class="date-filter-form" method="GET">
                    <input type="hidden" name="action" value="attendance">
                    <div class="form-group">
                        <label>Start Date:</label>
                        <input type="date" name="start_date" 
                            value="<?= htmlspecialchars($_GET['start_date'] ?? date('Y-m-01')) ?>">
                    </div>

                    <div class="form-group">
                        <label>End Date:</label>
                        <input type="date" name="end_date" 
                            value="<?= htmlspecialchars($_GET['end_date'] ?? date('Y-m-t')) ?>">
                    </div>

                    <button type="submit" class="filter-button">
                        <i class="fas fa-filter"></i> Filter
                    </button>
                </form>
            </div>

            <!-- Table -->
            <div class="attendance-table-wrapper">
                <table class="attendance-table">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Date</th>
                            <th>Check-in</th>
                            <th>Check-out</th>
                            <th>Total Hours</th>
                            <th>Check-in Location</th>
                            <th>Check-out Location</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($attendanceData)) : ?>
                        <?php foreach ($attendanceData as $index => $attendance) : ?>
                        <tr>
                            <td><?= $index + 1 ?></td>
                            <td><?= DateTime::createFromFormat('Y-m-d', $attendance['WorkDate'])->format('d/m/y') ?></td>
                            <td>
                                <?php if ($attendance['IsAbsent']) : ?>
                                    <span class="absent">Absent</span>
                                <?php else : ?>
                                    <?= DateTime::createFromFormat('Y-m-d H:i:s', $attendance['CheckinTime'])->format('d/m/y H:i') ?>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if ($attendance['IsAbsent']) : ?>
                                    <span class="absent">Absent</span>
                                <?php else : ?>
                                    <?= DateTime::createFromFormat('Y-m-d H:i:s', $attendance['CheckoutTime'])->format('d/m/y H:i') ?>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if ($attendance['IsAbsent']) : ?>
                                    N/A
                                <?php else : ?>
                                    <?= htmlspecialchars($attendance['TotalWorkHours'] ?? 'N/A') ?>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if ($attendance['IsAbsent']) : ?>
                                    N/A
                                <?php else : ?>
                                    <?= htmlspecialchars($attendance['CheckinLocation']) ?>
<?php endif; ?>
                            </td>
                            <td>
                                <?php if ($attendance['IsAbsent']) : ?>
                                    N/A
                                <?php else : ?>
                                    <?= htmlspecialchars($attendance['CheckoutLocation'] ?? 'N/A') ?>
                                <?php endif; ?>
                            </td>
                            <td>
                                <div class="status-container">
                                    <?php if ($attendance['IsAbsent']) : ?>
                                        <span class="badge badge-danger">Absent</span>
                                    <?php else : ?>
                                        <span class="badge <?= $attendance['CheckinLate'] ? 'badge-danger' : 'badge-success' ?>">
                                            <?= $attendance['CheckinLate'] ? 'Late Check-in' : 'Check-in On Time' ?>
                                        </span>
                                        <span class="badge <?= $attendance['CheckoutEarly'] ? 'badge-warning' : 'badge-success' ?>">
                                            <?= $attendance['CheckoutEarly'] ? 'Early Check-out' : 'Check-out On Time' ?>
                                        </span>
                                    <?php endif; ?>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                        <?php else : ?>
                        <tr>
                            <td colspan="8">No attendance records found for the selected date range.</td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <!-- Actions -->
            <div class="attendance-actions">
                <button class="export-button">
                    <i class="fas fa-file-export"></i> Export Report
                </button>
                <button class="print-button">
                    <i class="fas fa-print"></i> Print
                </button>
            </div>
        </div>
    </div>
</body>

</html>