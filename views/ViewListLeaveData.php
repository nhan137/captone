<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pending Leave Requests</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .status {
            font-weight: bold;
            padding: 5px 10px;
            border-radius: 4px;
            text-align: center;
        }
        .status.approved {
            background-color: #d4edda;
            color: #155724;
        }
        .status.rejected {
            background-color: #f8d7da;
            color: #721c24;
        }
        .status.pending {
            background-color: #fff3cd;
            color: #856404;
        }
    </style>
</head>
<body>
    <?php include 'views/layouts/sidebar_accountant.php'; ?>

    <div class="container my-5">
        <h1 class="text-center mb-4">Approved Leave History</h1>
        
        <form method="GET" action="index.php" class="mb-4">
            <input type="hidden" name="action" value="viewApprovedLeaveRequests">
            <div class="row">
                <div class="col-md-8">
                    <div class="d-flex gap-4">
                        <div class="d-flex align-items-center gap-2">
                            <i class="fas fa-user"></i>
                            <select name="employee_id" class="form-select" onchange="this.form.submit()">
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
                </div>
            </div>
        </form>
        
        <table class="table table-striped table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>Request ID</th>
                    <th>Employee Name</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Reason</th>
                    <th>Shift</th>
                    <th>Description</th>
                    <th>Status</th>
                    <th>Submit Date</th>
                    <th>Approved Date</th>
                    <!-- <th>Actions</th> -->
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($pendingRequests)) : ?>
                    <?php foreach ($pendingRequests as $request) : ?>
                        <tr>
                            <td><?= htmlspecialchars($request['LeaveRequestID']) ?></td>
                            <td><?= htmlspecialchars($request['FirstName'] . ' ' . $request['LastName']) ?></td>
                            <td><?= htmlspecialchars($request['StartDate']) ?></td>
                            <td><?= htmlspecialchars($request['EndDate']) ?></td>
                            <td><?= htmlspecialchars($request['Reason']) ?></td>
                            <td><?= htmlspecialchars($request['Shift']) ?></td>
                            <td><?= htmlspecialchars($request['Description']) ?></td>
                            <td class="status <?= strtolower(htmlspecialchars($request['Status'])) ?>">
                                <?= htmlspecialchars($request['Status']) ?>
                            </td>
                            <td><?= htmlspecialchars($request['SubmitDate']) ?></td>
                            <td><?= htmlspecialchars($request['ApprovedDate'] ?? '-') ?></td>
                            <!-- <td>
                                <a href="index.php?action=approveLeaveRequest&id=<?= htmlspecialchars($request['LeaveRequestID']) ?>" class="btn btn-success btn-sm">Approve</a>
                                <a href="index.php?action=rejectLeaveRequest&id=<?= htmlspecialchars($request['LeaveRequestID']) ?>" class="btn btn-danger btn-sm">Reject</a>
                                <span class="btn btn-success btn-sm">Approved</span>
                            </td> -->
                        </tr>
                    <?php endforeach; ?>
                <?php else : ?>
                    <tr>
                        <td colspan="11" class="text-center">No pending requests found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
