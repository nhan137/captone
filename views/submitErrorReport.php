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
    <?php include 'views/layouts/sidebar.php'; ?>

    <!-- Main Content -->
    <div class="main-content">
        <div class="error-report-container">
            <div class="error-report-header">
                <h2>
                    <i class="fas fa-exclamation-triangle"></i> Submit Attendance Error Report
                </h2>
            </div>

            <div class="error-report-form">
                <h3>Submit New Report</h3>
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
                        <button type="button" class="cancel-button">
                            <i class="fas fa-times"></i> Cancel
                        </button>
                    </div>
                </form>
                </>
            </div>

            <div class="error-report-history">
                <h3>Report History</h3>
                <div class="table-wrapper">
                    <table>
                        <thead>
                            <tr>
                                <th><i class="fas fa-user"></i> Employee Name</th>
                                <th><i class="fas fa-id-card"></i> Employee ID</th>
                                <th><i class="fas fa-exclamation-circle"></i> Error Description</th>
                                <th><i class="fas fa-paperclip"></i> Attachment</th> 
                                <th><i class="fas fa-calendar"></i> Report Date</th>
                                <th><i class="fas fa-info-circle"></i> Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($error_reports as $report): ?>
                            <tr>
                                <td><?php echo isset($report['FirstName']) && isset($report['LastName']) ? htmlspecialchars($report['FirstName'] . ' ' . $report['LastName']) : 'N/A'; ?></td>
                                <td><?php echo isset($report['EmployeeID']) ? htmlspecialchars($report['EmployeeID']) : 'N/A'; ?></td>
                                <td><?php echo isset($report['ErrorDescription']) ? htmlspecialchars($report['ErrorDescription']) : 'N/A'; ?></td>
                                <td>
                                    <?php if (isset($report['Attachment']) && !empty($report['Attachment'])): ?>
                                        <a href="download.php?file=<?php echo urlencode($report['Attachment']); ?>" class="attachment-link">
                                            <?php echo htmlspecialchars($report['Attachment']); ?>
                                        </a>
                                    <?php else: ?>
                                        No Attachment
                                    <?php endif; ?>
                                </td>
                                <td><?php echo isset($report['ReportDate']) ? htmlspecialchars($report['ReportDate']) : 'N/A'; ?></td>
                                <td><span class="<?php echo htmlspecialchars($report['ResolvedStatus']); ?>">
                                <?php echo htmlspecialchars($report['ResolvedStatus']); ?>
                                </span></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>
</html>













