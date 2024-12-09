<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee List</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            display: flex;
        }
        .sidebar {
            width: 200px;
            background-color: #007BFF;
            color: white;
            padding: 20px;
            height: 100vh;
            position: fixed;
        }
        .content {
            margin-left: 60px;
            padding: 10px;
            width: calc(100% - 70px);
        }
        h1 {
            color: #007BFF;
            margin: 20px 0;
        }
        .container {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 15px;
            overflow-x: auto;
            margin-left: 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        th, td {
            padding: 6px;
            text-align: left;
            border: 1px solid #ddd;
        }
        th {
            background-color: #007BFF;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        tr:hover {
            background-color: #ddd;
        }
        .notification-button {
            position: relative;
            display: inline-block;
            text-decoration: none;
            color: black;
            text-align: center;
        }
        .notification-icon {
            width: 50px;
            height: 50px;
        }
        .notification-count {
            position: absolute;
            top: -5px;
            right: -10px;
            background-color: red;
            color: white;
            border-radius: 50%;
            padding: 2px 5px;
            font-size: 12px;
            display: inline-block;
        }
        .modal-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 1000;
        }

        .notification-modal {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            z-index: 1001;
            min-width: 300px;
        }

        .notification-item {
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .notification-item:hover {
            background-color: #f0f0f0;
        }

        .modal-close {
            position: absolute;
            top: 10px;
            right: 10px;
            cursor: pointer;
            font-size: 20px;
        }

        .search-filter-container {
            margin-bottom: 20px;
            display: flex;
        }

        .search-filter-form {
            display: flex;
            width: 100%;
        }

        .search-box {
            flex: 1;
            display: flex;
            gap: 10px;
            background-color: #f0f0f0;
            padding: 10px;
            border-radius: 5px;
        }

        .search-box input {
            flex: 1;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        .search-btn {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 8px 15px;
            border-radius: 4px;
            cursor: pointer;
        }

        .search-btn:hover {
            background-color: #45a049;
        }

        .page-title {
            display: flex;
            align-items: center;
            gap: 10px;
            color: #007BFF;
            margin: 20px 0;
            font-size: 24px;
        }

        .page-title i {
            color: #007BFF;
            font-size: 24px;
        }
    </style>
    <script>
        function showNotificationModal(employeeId) {
            // Lấy thông báo từ server bằng AJAX
            fetch(`index.php?action=getNotifications&employeeId=${employeeId}`)
                .then(response => response.json())
                .then(notifications => {
                    const modalContent = document.getElementById('notificationContent');
                    modalContent.innerHTML = '';

                    if (notifications.length === 0) {
                        modalContent.innerHTML = '<p>Không có thông báo mới</p>';
                    } else {
                        notifications.forEach(notification => {
                            const notificationDiv = document.createElement('div');
                            notificationDiv.className = 'notification-item';
                            notificationDiv.onclick = () => window.location.href = notification.url;
                            notificationDiv.innerHTML = notification.message;
                            modalContent.appendChild(notificationDiv);
                        });
                    }

                    // Hiển thị modal
                    document.getElementById('modalOverlay').style.display = 'block';
                    document.getElementById('notificationModal').style.display = 'block';
                });
        }

        function closeModal() {
            document.getElementById('modalOverlay').style.display = 'none';
            document.getElementById('notificationModal').style.display = 'none';
        }

        // Đóng modal khi click bên ngoài
        document.getElementById('modalOverlay').onclick = closeModal;
    </script>
</head>
<body>
    <div class="sidebar" id="sidebar">
        <?php include 'views/layouts/sidebar_director.php'; ?>
    </div>
    <div class="content" id="content">
        <div class="container">
            <h1 class="page-title">
                <i class="fas fa-users"></i> List of Employees
            </h1>
            <!-- Thêm form tìm kiếm và lọc -->
            <div class="search-filter-container">
                <form method="GET" action="index.php" class="search-filter-form">
                    <input type="hidden" name="action" value="viewEmployeeList">
                    
                    <!-- Thanh tìm kiếm (màu xanh) -->
                    <div class="search-box">
                        <input type="text" 
                               name="search" 
                               placeholder="Tìm kiếm theo tên ..."
                               value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>"
                        >
                        <button type="submit" class="search-btn">
                            <i class="fas fa-search"></i> Search
                        </button>
                    </div>
                </form>
            </div>

            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>Employee ID</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Date of Birth</th>
                            <th>Gender</th>
                            <th>Identity Number</th>
                            <th>Identity Issued Date</th>
                            <th>Identity Issued Place</th>
                            <th>Email</th>
                            <th>Phone Number</th>
                            <th>Marital Status</th>
                            <th>Hometown</th>
                            <th>Place of Birth</th>
                            <th>Nationality</th>
                            <th>Role</th>
                            <th>Notifications</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($employees as $employee): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($employee['EmployeeID']); ?></td>
                                <td><?php echo htmlspecialchars($employee['FirstName']); ?></td>
                                <td><?php echo htmlspecialchars($employee['LastName']); ?></td>
                                <td><?php echo htmlspecialchars($employee['DateOfBirth']); ?></td>
                                <td><?php echo htmlspecialchars($employee['Gender']); ?></td>
                                <td><?php echo htmlspecialchars($employee['IdentityNumber']); ?></td>
                                <td><?php echo htmlspecialchars($employee['IdentityIssuedDate']); ?></td>
                                <td><?php echo htmlspecialchars($employee['IdentityIssuedPlace']); ?></td>
                                <td><?php echo htmlspecialchars($employee['Email']); ?></td>
                                <td><?php echo htmlspecialchars($employee['PhoneNumber']); ?></td>
                                <td><?php echo htmlspecialchars($employee['MaritalStatus']); ?></td>
                                <td><?php echo htmlspecialchars($employee['Hometown']); ?></td>
                                <td><?php echo htmlspecialchars($employee['PlaceOfBirth']); ?></td>
                                <td><?php echo htmlspecialchars($employee['Nationality']); ?></td>
                                <td><?php echo htmlspecialchars($employee['Role']); ?></td>
                                <td style="text-align: center;">
                                    <a href="javascript:void(0);" class="notification-button" onclick="showNotificationModal(<?php echo $employee['EmployeeID']; ?>)">
                                        <img src="assets/images/anhthongbao.jpg" alt="Notification" class="notification-icon">
                                        <?php 
                                        $notificationCount = $employeeModel->getNotificationCount($employee['EmployeeID']);
                                        if ($notificationCount > 0): ?>
                                            <span class="notification-count"><?php echo $notificationCount; ?></span>
                                        <?php endif; ?>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal for notifications -->
    <div class="modal-overlay" id="modalOverlay"></div>
    <div class="notification-modal" id="notificationModal">
        <span class="modal-close" onclick="closeModal()">&times;</span>
        <h2>Thông báo</h2>
        <div id="notificationContent"></div>
    </div>
</body>
</html>
