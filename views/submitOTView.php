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
<style>
  /* CSS cho thông báo */


</style>
<body>
  <?php include 'views/layouts/sidebar.php'; ?>
  <div class="main-content">
    <div class="overtime-container">
      <div class="overtime-header">
        <h2><i class="fas fa-business-time"></i> Overtime Registration</h2>
      </div>

      <!-- Hiển thị thông báo nếu có -->
      <?php if (!empty($message)): ?>
        <div class="alert ">
          <p><?php echo htmlspecialchars($message); ?></p>
        </div>
      <?php endif; ?>

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
              <label for="time"><i class="fas fa-clock"></i> Hours</label>
              <input type="number" step="0.01" id="time" name="time" required placeholder="Enter hours (e.g., 1.5)" />
            </div>
          </div>

          <div class="form-row">
            <div class="form-group">
              <label for="date"><i class="fas fa-calendar-alt"></i> Date</label>
              <input type="date" id="date" name="date" required />
            </div>
          </div>

          <div class="form-group">
            <label for="description"><i class="fas fa-pen"></i> Description</label>
            <textarea id="description" name="description" rows="4" placeholder="Please provide details about your overtime work..." required></textarea>
          </div>

          <div class="form-actions">
            <button type="submit" class="submit-button">
              <i class="fas fa-paper-plane"></i> Submit Request
            </button>
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