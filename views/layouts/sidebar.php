<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="assets/css/sidebar.css" />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
    />
</head>
<body>
<aside class="sidebar">
      <div class="sidebar-header">
        <img src=" assets/images/logo-HR-quan-tri-nhan-su-2.png" alt="Avatar"/>
        <h2>Attendance</h2>
      </div>
      <div class="sidebar-links">
        <h4>
          <span>Dashboard Menu</span>
          <div class="menu-separator"></div>
        </h4>
        <li>
          <a href="index.php?action=profile">
            <i class="fas fa-address-card"> </i> Personal Information
            Dashboard</a
          >
        </li>
        <li>
          <a href="index.php?action=checkin">
            <i class="far fa-check-circle"></i>Check In/Check Out</a
          >
        </li>
        <li>
          <a href="attendancehistory.html">
            <i class="fas fa-calendar-check"></i>Attendance History</a
          >
        </li>
        <h4>
          <span>General</span>
          <div class="menu-separator"></div>
        </h4>
        <li>
          <a href="index.php?action=submitErrorReport" > <i class="fas fa-bug"></i>Error Report</a>
        </li>
        <li>
          <a href="index.php?action=submitLeaveRequest">
            <i class="far fa-clock"></i>Leave Application</a
          >
        </li>
        <li>
          <a href="ot.html"
            ><i class="fas fa-clock"></i>Overtime Registration</a
          >
        </li>
        <li>
          <a href="index.php?action=logout"> <i class="fab fa-angellist"></i>Logout </a>
        </li>
        <!-- <h4>
          <span>Account</span>
          <div class="menu-separator"></div>
        </h4> -->
        <!-- </ul> -->
        <!-- <div class="user-account">
         <div class="user-profile">
          <img src="images/profile-img.jpg" alt="Profile Image" />
          <div class="user-detail">       </div>
          <h3></h3> 
          
        
        <span>Web Developer</span> -->
      </div>
    </aside>
</body>
</html>