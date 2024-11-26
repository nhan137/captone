<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="assets/css/sidebar_dirrector.css" />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
    />
</head>
<body>
<aside class="sidebar">
      <div class="sidebar-header">
        <img src="/Mangager_Human/images/avatar.png" alt="logo" />
        <h3 style="color: #fff">Director</h3>
      </div>
      <ul class="sidebar-links">
        <h4>
          <span>Dashboard Menu</span>
          <div class="menu-separator"></div>
        </h4>
        <li>
          <a href="profile.html">
            <i class="fas fa-address-card"> </i> Personal Information<br />
            Dashboard</a
          >
        </li>
        <li>
          <a href="Timekeeping-Rules.html"
            ><i class="far fa-check-circle"></i>Timekeeping Rules</a
          >
        </li>
        <li>
          <a href="overtime.html">
            <i class="fas fa-calendar-check"></i>Overtime Regulations
          </a>
        </li>
        <h4>
          <span>General</span>
          <div class="menu-separator"></div>
        </h4>
        <li>
          <a href="index.php?action=viewAllPendingRequests">
            <i class="fas fa-bug"></i>Leave Request Approval</a
          >
        </li>
        <li>
          <a href="notification-error.html"
            ><i class="far fa-clock"></i>Receiving Violation notice</a
          >
        </li>
        <li>
          <a href="Viewreport.html"
            ><i class="far fa-clock"></i>View Summary Report</a
          >
        </li>
        <!-- <li>
          <a href="reviewthereport.html"
            ><i class="far fa-clock"></i>Accounting Report Approval
          </a>
        </li> -->
        <li>
          <a href="index.php?action=logout"> <i class="fab fa-angellist"></i>Logout </a>
        </li>
      </ul>
    </aside>
</body>
</html>