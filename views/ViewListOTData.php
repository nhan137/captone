<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pending Overtime Requests</title>
    <link rel="stylesheet" href="assets/css/viewPendingOTRequests.css" />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
    />
    <style>
        /* Nút Approve */
        .new-request-button {
        background-color: #28a745; /* Màu xanh lá */
        color: white; /* Màu chữ trắng */
        border: none;
        padding: 0.8rem 1.5rem;
        border-radius: 5px;
        cursor: pointer;
        font-size: 1rem;
        transition: background-color 0.3s ease, transform 0.2s ease;
        }

        .filter-group {
            display: flex;
            gap: 20px;
        }

        .filter-item {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .filter-item i {
            color: #666;
        }

        .filter-item select {
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
            background-color: white;
            min-width: 150px;
        }


    </style>
</head>
<body>
    <?php include 'views/layouts/sidebar_accountant.php'; ?>
    <div class="main-content">
        <h1>Approved Overtime History</h1>
        <div class="overtime-records-container">
            <div class="records-header">
                <h2><i class="fas fa-clock"></i>Approved Overtime History</h2>
                <form method="GET" action="index.php" class="filter-form">
                    <input type="hidden" name="action" value="viewApprovedOTRequests">
                    <div class="filter-group">
                        <div class="filter-item">
                            <i class="fas fa-user"></i>
                            <select name="employee_id" onchange="this.form.submit()">
                                <option value="">All Employees</option>
                                <?php foreach ($employees as $employee): ?>
                                    <option value="<?= $employee['EmployeeID'] ?>" 
                                        <?= isset($_GET['employee_id']) && $_GET['employee_id'] == $employee['EmployeeID'] ? 'selected' : '' ?>>
                                        <?= htmlspecialchars($employee['FirstName'] . ' ' . $employee['LastName']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                </form>
            </div>
            <div class="records-table">
                <table id="overtimeTable">
                    <thead>
                        <tr>
                            <th><i class="fas fa-hashtag"></i> Overtime ID</th>
                            <th><i class="fas fa-user"></i> Employee</th>
                            <th><i class="fas fa-calendar-day"></i> Date</th>
                            <th><i class="fas fa-user-clock"></i> Shift</th>
                            <th><i class="fas fa-align-left"></i> Description</th>
                            <th><i class="fas fa-tools"></i> Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($requests as $request): ?>
                            <tr>
                                <td><?= $request['overtimeID'] ?></td>
                                <td><?= $request['FirstName'] . ' ' . $request['LastName'] ?></td>
                                <td><?= $request['date'] ?></td>
                                <td><?= $request['shift'] ?></td> 
                                <td><?= $request['description'] ?></td>
                                <td>
                                    <div class="header-actions">
                                        <!-- <form action="index.php?action=approveRequest" method="POST" style="display: inline-block;">
                                            <input type="hidden" name="overtimeID" value="<?= $request['overtimeID'] ?>">
                                            <button class="new-request-button" type="submit">Approve</button>
                                            
                                        </form> -->
                                        <span class="new-request-button">Approved</span>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>


</body>
</html>