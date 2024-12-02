<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Error Reports</title>
    <link rel="stylesheet" href="assets/css/employee.css" />
    <link rel="stylesheet" href="assets/css/error.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
</head>
<body>
<?php
            if ($_SESSION['role'] === 'nhan vien') {
                include 'views/layouts/sidebar.php';
            } else if ($_SESSION['role'] === 'giam doc') {
                include 'views/layouts/sidebar_director.php';
            } else {
                include 'views/layouts/sidebar_accountant.php';
            }
            ?>
    
    <div class="main-content">
        <div class="error-report-container">
            <h2>Manage Error Reports</h2>
            <?php if (isset($_SESSION['message'])): ?>
                <div style="color: green;"><?php echo $_SESSION['message']; unset($_SESSION['message']); ?></div>
            <?php endif; ?>
            <table>
                <thead>
                    <tr>
                        <th>Employee Name</th>
                        <th>Employee ID</th>
                        <th>Error Description</th>
                        <th>Attachment</th>
                        <th>Report Date</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($error_reports)): ?>
                        <?php foreach ($error_reports as $report): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($report['FirstName'] . ' ' . $report['LastName']); ?></td>
                                <td><?php echo htmlspecialchars($report['EmployeeID']); ?></td>
                                <td><?php echo htmlspecialchars($report['ErrorDescription']); ?></td>
                                <td>
                                    <?php if (!empty($report['Attachment'])): ?>
                                        <a href="download.php?file=<?php echo urlencode($report['Attachment']); ?>"><?php echo htmlspecialchars($report['Attachment']); ?></a>
                                    <?php else: ?>
                                        No Attachment
                                    <?php endif; ?>
                                </td>
                                <td><?php echo htmlspecialchars($report['ReportDate']); ?></td>
                                <td><?php echo htmlspecialchars($report['ResolvedStatus']); ?></td>
                                <td>
                                    <form method="POST" action="index.php?action=approveErrorReport">
                                        <input type="hidden" name="id" value="<?php echo $report['ErrorReportID']; ?>">
                                        <button type="submit" class="btn-approve">Approve</button>
                                    </form>
                                    <form method="POST" action="index.php?action=rejectErrorReport">
                                        <input type="hidden" name="id" value="<?php echo $report['ErrorReportID']; ?>">
                                        <button type="submit" class="btn-reject">Reject</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="7" class="text-center">No pending error reports.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html> 