<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gửi Đơn Nghỉ Phép</title>
    <link rel="stylesheet" href="assets/css/employee.css" />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
    />
</head>
<body>
    <?php include 'views/layouts/sidebar.php'; ?>
    
    <div class="main-content">
        <div class="leave-application-container">
            <div class="leave-header">
                <h2><i class="fas fa-calendar-minus"></i> Leave Application Form</h2>
            </div>
        </div>
        <form action="index.php?action=submitLeaveRequest" method="POST" class="leave-request-form">
            <div class="form-group">
                <label for="reason">
                    <i class="fas fa-file-alt"></i> Reason for Leave
                </label>
                <select name="reason" id="reason" required>
                    <option value="">Select reason</option>
                    <option value="annual">Annual Leave</option>
                    <option value="sick">Sick Leave</option>
                    <option value="personal">Personal Leave</option>
                    <option value="other">Other</option>
                </select>
            </div>

            <div class="form-group">
                <label for="shift"> 
                    <i class="fas fa-clock"></i> Shift 
                </label>
                    <select name="shift" id="shift" required>
                    <option value="">Select shift</option>
                    <option value="morning">Morning Shift</option>
                    <option value="afternoon">Afternoon Shift</option>
                    <option value="full">Full Day</option>
                </select>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="start-date">
                        <i class="fas fa-calendar-plus"></i> From Date
                    </label>
                    <input type="date" name="start_date" id="start-date" required />
                </div>
                <div class="form-group">
                    <label for="end-date">
                        <i class="fas fa-calendar-minus"></i> To Date
                    </label>
                    <input type="date" name="end_date" id="end-date" required />
                </div>
            </div>

            <div class="form-group">
                <label for="description">
                <i class="fas fa-pen"></i> Description
                </label>
                <textarea
                name="description"
                id="description"
                rows="4"
                placeholder="Please provide additional details about your leave request..."
                required
                ></textarea>
            </div>

            <div class="form-actions">
                <button type="submit" class="submit-button">
                <i class="fas fa-paper-plane"></i> Submit Request
                </button>
                <button type="reset" class="cancel-button">
                <i class="fas fa-times"></i> Cancel
                </button>
            </div>

            <a href="index.php?action=viewPendingRequests" class="pending-link">
                <i class="fas fa-calendar-check"></i> View Pending Requests
            </a>
        </form>

</body>
</html>
