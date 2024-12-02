<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Submit Attendance Error Report</title>
    <link rel="stylesheet" href="views/Employee/errorreport.css"/>
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
        <h2>
            <i class="fas fa-exclamation-triangle"></i> 
            Submit Attendance Error Report 
            (<?php echo count($error_reports); ?>)
        </h2>
        <form method="POST" action="index.php?action=submitErrorReport" enctype="multipart/form-data">
            <div class="form-group">
                <label><i class="fas fa-calendar-day"></i> Date of Error</label>
                <input type="date" name="error_date" required />
            </div>
            <div class="form-group">
                <label><i class="fas fa-pen"></i> Error Description</label>
                <textarea name="error_description" rows="4" placeholder="Please describe the error in detail..." required></textarea>
            </div>
            <div class="form-group">
                <label><i class="fas fa-paperclip"></i> Attachment</label>
                <input type="file" name="attachment" class="file-input" />
            </div>
            <div class="form-actions">
                <button type="submit" class="submit-button">
                    <i class="fas fa-paper-plane"></i> Submit Report
                </button>
                <button type="button" class="cancel-button" onclick="window.location.href='index.php?action=viewPendingErrorReports'">
                    <i class="fas fa-times"></i> Cancel
                </button>
            </div>
        </form>

        <div class="error-report-history">
            <h3>Report History</h3>
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Employee Name</th>
                        <th>Employee ID</th>
                        <th>Error Description</th>
                        <th>Attachment</th>
                        <th>Report Date</th>
                        <th>Status</th>
                        <th>Resolved By</th>
                        <th>Approved Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $index = 0;
                    foreach ($error_reports as $report): 
                    ?>
                    <tr>
                        <td><?php echo $index + 1; ?></td>
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
                        <td><?php echo htmlspecialchars($report['ResolvedBy']); ?></td>
                        <td><?php echo htmlspecialchars($report['ApprovedDate']); ?></td>
                    </tr>
                    <?php 
                    $index++;
                    endforeach; 
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
</body>
</html>