<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="assets/css/sidebar_accountant.css" />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
    />
</head>
<body>
<aside class="sidebar">
      <div class="sidebar-header">
        <img src="/Mangager_Human/Mangager_Human/images/avatar.png" alt="logo" />
        <h2>Accountant</h2>
      </div>
      <ul class="sidebar-links">
        <h4>
          <span>Dashboard Menu</span>
          <div class="menu-separator"></div>
        </h4>
        <li>
          <a href="index.php?action=profile">
            <i class="fas fa-address-card"> </i> Personal Information<br />
          </a
          >
        </li>
        <li>
          <a href="index.php?action=viewApprovedOTRequests"
            ><i class="far fa-check-circle"></i>OT Data</a
          >
        </li>
        <li>
          <a href="index.php?action=viewApprovedLeaveRequests">
            <i class="fas fa-calendar-check"></i>Leave Data</a
          >
        </li> 
        <li>
          <a href="index.php?action=viewAttendanceHistory">
            <i class="fas fa-calendar-check"></i>Attendance History</a
          >
        </li> 
        <h4>
          <span>General</span>
          <div class="menu-separator"></div>
        </h4>
        <li>
        <a href="index.php?action=manageErrorReports">
            <i class="fas fa-bug"></i>Time Attendance <br />Error Notification</a>
        </li>
        <li>
          <a href="index.php?action=payroll">
              <i class="fas fa-rectangle-list"></i>Caculate Salary</a>
        </li>
        <li>
          <a href="index.php?action=salary_detail">
              <i class="fas fa-rectangle-list"></i>Salary Table</a>
        </li>
        <li>
          <a href="index.php?action=logout"> <i class="fab fa-angellist"></i>Logout </a>
        </li>
        <!-- <h4>
          <span>Account</span>
          <div class="menu-separator"></div>
        </h4> -->
      </ul>
      <!--<div class="user-account">
         <div class="user-profile">
          <img src="images/profile-img.jpg" alt="Profile Image" />
          <div class="user-detail">       </div>
          <h3></h3> 
          
        </div> 
        <span>Web Developer</span>
      </div>
      -->
    </aside>
</body>
</html>