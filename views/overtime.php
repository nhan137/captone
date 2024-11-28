<?php
require_once 'controllers/OvertimeController.php';
require_once 'config.php';
if (!isset($_SESSION['id'])) {
    header("Location: index.php?action=login");
    exit();
}

$overtimeController = new OvertimeController($pdo);
$overtimeController->handleRequest();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Overtime Registration</title>
    <link rel="stylesheet" href="assets/css/overtime.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
</head>
<body>
    <?php include 'views/layouts/sidebar.php'; ?>
    <div class="main-content">
        <div class="overtime-container">
            <div class="overtime-header">
                <h2><i class="fas fa-business-time"></i> Overtime Registration</h2>
            </div>

            <div class="overtime-stats">
                <div class="stat-card">
                    <i class="fas fa-clock"></i>
                    <div class="stat-info">
                        <h4>Total OT Hours</h4>
                        <p><?php echo $overtimeController->getTotalHours(); ?> hours</p>
                    </div>
                </div>
                <div class="stat-card">
                    <i class="fas fa-calendar-check"></i>
                    <div class="stat-info">
                        <h4>This Month</h4>
                        <p><?php echo $overtimeController->getMonthlyHours(); ?> hours</p>
                    </div>
                </div>
                <div class="stat-card">
                    <i class="fas fa-hourglass-half"></i>
                    <div class="stat-info">
                        <h4>Pending Requests</h4>
                        <p><?php echo $overtimeController->getPendingRequests(); ?> requests</p>
                    </div>
                </div>
            </div>

            <div class="overtime-form">
                <h3><i class="fas fa-file-alt"></i> New OT Request</h3>
                <form id="ot-form" method="POST" action="overtime.php">
                    <div class="form-row">
                        <div class="form-group">
                            <label for="shift"><i class="fas fa-user-clock"></i> Shift</label>
                            <select id="shift" name="shift" required>
                                <option value="">Select shift</option>
                                <option value="morning">Morning Shift</option>
                                <option value="afternoon">Afternoon Shift</option>
                                <option value="night">Night Shift</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="time"><i class="fas fa-clock"></i> Time</label>
                            <input type="time" id="time" name="time" required />
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="date"><i class="fas fa-calendar-alt"></i> Date</label>
                            <input type="date" id="date" name="date" required />
                        </div>
                        <div class="form-group">
                            <label for="department"><i class="fas fa-building"></i> Department</label>
                            <input type="text" id="department" name="department" required />
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="description"><i class="fas fa-pen"></i> Description</label>
                        <textarea id="description" name="description" rows="4" placeholder="Please provide details about your overtime work..." required></textarea>
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="submit-button"><i class="fas fa-paper-plane"></i> Submit Request</button>
                        <button type="button" class="cancel-button" onclick="document.getElementById('ot-form').reset();"><i class="fas fa-times"></i> Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html> 