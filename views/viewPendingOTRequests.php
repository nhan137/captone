<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="assets/css/viewPendingOTRequests.css" />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
    />
    <Style>
       /* Định kiểu chung cho cột Status */
.status {
    font-weight: bold;
    padding: 5px 10px;
    border-radius: 4px;
    text-align: center;
}

/* Status Approved (Approved) */
.status.approved {
    background-color: #d4edda;  /* Màu nền xanh nhạt */
    color: #155724;  /* Màu chữ xanh đậm */
}

/* Status Rejected (Rejected) */
.status.rejected {
    background-color: #f8d7da;  /* Màu nền đỏ nhạt */
    color: #721c24;  /* Màu chữ đỏ đậm */
}

/* Status Pending (Pending) */
.status.pending {
    background-color: #fff3cd;  /* Màu nền vàng nhạt */
    color: #856404;  /* Màu chữ vàng đậm */
}


    </Style>
</head>
<body>
    <div class="main-content">
    <div class="overtime-records-container">
        <div class="records-header">
        <h2><i class="fas fa-history"></i> Overtime Records</h2>
        <!-- <div class="header-actions">
            <button class="new-request-button">
            <i class="fas fa-plus"></i> New Request
            </button>
            <button class="export-button">
            <i class="fas fa-file-export"></i> Export
            </button>
        </div> -->
        </div>

        <div class="records-filters">
        <div class="filter-group">
            <label><i class="fas fa-calendar"></i> Date Range</label>
            <select>
            <option>This Month</option>
            <option>Last Month</option>
            <option>Last 3 Months</option>
            <option>Custom Range</option>
            </select>
        </div>
        <div class="filter-group">
            <label><i class="fas fa-filter"></i> Status</label>
            <select>
            <option>All Status</option>
            <option>Pending</option>
            <option>Approved</option>
            <option>Rejected</option>
            </select>
        </div>
        </div>

        <div class="records-table">
        <table id="overtimeTable">
            <thead>
            <tr>
                <th><i class="fas fa-hashtag"></i> No.</th>
                <th><i class="fas fa-id-card"></i> Employee ID</th>
                <th><i class="fas fa-user"></i> Full Name</th>
                <th><i class="fas fa-user-clock"></i> Shift</th>
                <th><i class="fas fa-clock"></i> Time</th>
                <th><i class="fas fa-calendar-day"></i> Date</th>
                <th><i class="fas fa-align-left"></i> Description</th>
                <th><i class="fas fa-check-circle"></i> Status</th>
            </tr>
            </thead>
            <tbody>
                <!-- PHP code to display OT records -->
                <?php
                    if (isset($overtime_requests) && !empty($overtime_requests)) {
                        $counter = 1;
                        foreach ($overtime_requests as $request) {
                            // Xác định class cho cột Status dựa trên giá trị của Status
                            $statusClass = '';
                            switch ($request['status']) {
                                case 'Pending':
                                    $statusClass = 'pending';
                                    break;
                                case 'Approved':
                                    $statusClass = 'approved';
                                    break;
                                case 'Rejected':
                                    $statusClass = 'rejected';
                                    break;
                                default:
                                    $statusClass = '';
                            }

                            echo "<tr>";
                            echo "<td>{$counter}</td>";
                            echo "<td>{$request['employeeID']}</td>";
                            echo "<td>{$request['FirstName']} {$request['LastName']}</td>";
                            echo "<td>{$request['shift']}</td>";
                            echo "<td>{$request['time']}</td>";
                            echo "<td>{$request['date']}</td>";
                            echo "<td>{$request['description']}</td>";
                            echo "<td class='status {$statusClass}'>{$request['status']}</td>";
                            echo "</tr>";
                            $counter++;
                        }
                    } else {
                        echo "<tr><td colspan='8'>No overtime requests found.</td></tr>";
                    }
                ?>
        </tbody>


        </table>
        </div>

        <div class="records-summary">
        <div class="summary-item">
            <i class="fas fa-clock"></i>
            <div class="summary-info">
            <h4>Total Hours</h4>
            <p>24 hours</p>
            </div>
        </div>
        <div class="summary-item">
            <i class="fas fa-check-circle"></i>
            <div class="summary-info">
            <h4>Approved</h4>
            <p>16 hours</p>
            </div>
        </div>
        <div class="summary-item">
            <i class="fas fa-hourglass-half"></i>
            <div class="summary-info">
            <h4>Pending</h4>
            <p>8 hours</p>
            </div>
        </div>
        </div>
    </div>
    </div>

</body>
</html>