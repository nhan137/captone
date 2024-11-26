<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Check In System</title>
    <link rel="stylesheet" href="assets/css/checkin.css">
</head>

<body>
    <?php include 'views/layouts/sidebar.php'; ?>
    <div class="main-container">
        <!-- Header -->
        <div class="header">
            <h1>Company HRTECH</h1>
            <p>Hello! You have a great day.</p>
            <img src="assets/images/nhan_vien_1.png" alt="Avatar" class="avatar">
        </div>

        <!-- Thời gian hiện tại -->
        <div class="time-container">
            <h2>Current Time</h2>
            <div id="clock">00:00:00</div>
            <div id="date">Loading date...</div>
        </div>

        <!-- Tabs Check In / Check Out -->
        <div class="tabs">
            <button id="checkin-tab" class="tab-button active">Check In</button>
            <button id="checkout-tab" class="tab-button">Check Out</button>
        </div>

        <!-- Form Check In -->
        <form id="checkin-form" onsubmit="submitAndRedirect(event)" class="form">
            <input type="hidden" id="employee-id" value="<?php echo $_SESSION['id']; ?>" />
            
            <div class="form-group">
                <label>Employee ID</label>
                <input type="text" value="<?php echo isset($_SESSION['id']) ? $_SESSION['id'] : ''; ?>" readonly />
            </div>

            <div class="form-group">
                <label>Name</label>
                <input type="text" value="<?php echo isset($_SESSION['username']) ? $_SESSION['username'] : ''; ?>" readonly />
            </div>

            <div class="form-group">
                <label for="checkin-time">Check-in Time</label>
                <input type="text" id="checkin-time" readonly required />
            </div>

            <div class="form-group">
                <label for="gps-location">GPS Location</label>
                <input type="text" id="gps-location" readonly required />
            </div>

            <button type="submit" class="submit-button checkin">
                <i class="fas fa-sign-in-alt"></i> CHECK IN
            </button>
        </form>

        <!-- Form Check Out -->
        <form id="checkout-form" onsubmit="handleCheckout(event)" class="form hidden">
            <div class="form-group">
                <label for="checkout-time">Check-out Time</label>
                <input type="text" id="checkout-time" readonly required />
            </div>

            <div class="form-group">
                <label for="checkout-location">GPS Location</label>
                <input type="text" id="checkout-location" readonly required />
            </div>

            <button type="submit" class="submit-button checkout">
                <i class="fas fa-sign-out-alt"></i> CHECK OUT
            </button>
        </form>
    </div>
    <script>
        // Cập nhật thời gian hiện tại
        function updateClock() {
            const now = new Date();
            const timeDisplay = document.getElementById("clock");
            const dateDisplay = document.getElementById("date");

            timeDisplay.textContent = now.toLocaleTimeString();
            dateDisplay.textContent = now.toLocaleDateString("en-US", {
                weekday: "long",
                year: "numeric",
                month: "long",
                day: "numeric",
            });
        }

        setInterval(updateClock, 1000);
        updateClock();
    </script>
    <script src="checkin.js"></script>
</body>
</html>
