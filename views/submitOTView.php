<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Submit OT</title>
  <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="path/to/your-styles.css">
  <link rel="stylesheet" href="assets/css/employee.css">
</head>
<body>
  <?php include 'views/layouts/sidebar.php'; ?>
  <div class="main-content">
    <div class="overtime-container">
      <div class="overtime-header">
        <h2><i class="fas fa-business-time"></i> Overtime Registration</h2>
      </div>

      <!-- <div class="overtime-stats">
        <div class="stat-card">
          <i class="fas fa-clock"></i>
          <div class="stat-info">
            <h4>Total OT Hours</h4>
            <p>24 hours</p>
          </div>
        </div>
        <div class="stat-card">
          <i class="fas fa-calendar-check"></i>
          <div class="stat-info">
            <h4>This Month</h4>
            <p>8 hours</p>
          </div>
        </div>
        <div class="stat-card">
          <i class="fas fa-hourglass-half"></i>
          <div class="stat-info">
            <h4>Pending Requests</h4>
            <p>2 requests</p>
          </div>
        </div>
      </div> -->

      <div class="overtime-form">
        <h3><i class="fas fa-file-alt"></i> New OT Request</h3>
        <form action="index.php?action=submitOT" method="POST" id="ot-form">
          <div class="form-row">
            <div class="form-group">
              <label for="shift"><i class="fas fa-user-clock"></i> Shift</label>
              <select id="shift" name="shift" required>
                <option value="">Select shift</option>
                <option value="Weekend">Weekend</option>
                <option value="Night">Night</option>
                <option value="Holiday">Holiday</option>
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
            <!-- <div class="form-group">
              <label for="department"><i class="fas fa-building"></i> Department</label>
              <input type="text" id="department" name="department" required />
            </div> -->
          </div>

          <div class="form-group">
            <label for="description"><i class="fas fa-pen"></i> Description</label>
            <textarea id="description" name="description" rows="4" placeholder="Please provide details about your overtime work..." required></textarea>
          </div>

          <div class="form-actions"> <button type="submit" class="submit-button">
              <i class="fas fa-paper-plane"></i> Submit Request
            </button>
            <!-- <button type="button" class="cancel-button" onclick="cancelForm()">
              <i class="fas fa-times"></i> Cancel
            </button> -->
          </div>

          <a href="index.php?action=viewPendingOTRequests" class="pending-link">
                <i class="fas fa-calendar-check"></i> View Pending OT Requests
            </a>
        </form>
      </div>
    </div>
  </div>

  
</body>
</html>