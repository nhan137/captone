<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <link rel="stylesheet" href="assets/css/employee.css" />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
    />
    <style>
        .update-button {
            background-color: #4CAF50;
            color: white;
            padding: 12px 30px;
            border: none;
            border-radius: 25px;
            font-size: 16px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 2px 5px rgba(76, 175, 80, 0.2);
            margin-top: 20px;
            display: block;
            margin-left: auto;
            margin-right: auto;
            letter-spacing: 0.5px;
        }

        .update-button:hover {
            background-color: #45a049;
            box-shadow: 0 4px 8px rgba(76, 175, 80, 0.3);
            transform: translateY(-2px);
        }

        .update-button:active {
            transform: translateY(0);
            box-shadow: 0 2px 4px rgba(76, 175, 80, 0.2);
        }
    </style>
</head>
<body>
            <?php
                if ($_SESSION['role'] === 'nhan vien') {
                    include 'views/layouts/sidebar.php';
                } else if ($_SESSION['role'] === 'giam doc') {
                    include 'views/layouts/sidebar_director.php';
                } else {
                    
                }
        ?>
    <div class="main-content">
    <h2>Edit Profile Information</h2>
    <form method="POST" action="index.php?action=update_Profile" class="personal-info-form">
        <input type="hidden" name="EmployeeID" value="<?php echo $_SESSION['id']; ?>">

        <div class="form-row">
        <div class="form-group">
            <label for="first-name">First Name</label>
            <input type="text" id="first-name" name="FirstName" value="<?php echo htmlspecialchars($userInfo['FirstName']); ?>" required>
        </div>
        <div class="form-group">
            <label for="last-name">Last Name</label>
            <input type="text" id="last-name" name="LastName" value="<?php echo htmlspecialchars($userInfo['LastName']); ?>" required>
        </div>
        </div>
        <div class="form-row">
        <div class="form-group">
            <label for="dob">Date of Birth</label>
            <input type="date" id="dob" name="DateOfBirth" value="<?php echo htmlspecialchars($userInfo['DateOfBirth']); ?>" required>
        </div>
        <div class="form-group">
            <label for="gender">Gender</label>
            <select id="gender" name="Gender" required>
            <option value="male" <?php echo ($userInfo['Gender'] == 'male') ? 'selected' : ''; ?>>Male</option>
            <option value="female" <?php echo ($userInfo['Gender'] == 'female') ? 'selected' : ''; ?>>Female</option>
            <option value="other" <?php echo ($userInfo['Gender'] == 'other') ? 'selected' : ''; ?>>Other</option>
            </select>
        </div>
        </div>

        <div class="form-row">
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="Email" value="<?php echo htmlspecialchars($userInfo['Email']); ?>" required>
        </div>
        <div class="form-group">
            <label for="phone">Phone Number</label>
            <input type="tel" id="phone" name="PhoneNumber" pattern="^[0-9]{10}$" title="Phone number must be 10 digits"  value="<?php echo htmlspecialchars($userInfo['PhoneNumber']); ?>" required>
        </div>
        </div>

        <div class="form-row">
        <div class="form-group">
            <label for="marital-status">Marital Status</label>
            <select id="marital-status" name="MaritalStatus" required>
            <option value="Độc thân" <?php echo ($userInfo['MaritalStatus'] == 'Độc thân') ? 'selected' : ''; ?>>Độc thân</option>
            <option value="Có gia đình" <?php echo ($userInfo['MaritalStatus'] == 'Có gia đình') ? 'selected' : ''; ?>>Có gia đình</option>
            </select>
        </div>
        <div class="form-group">
            <label for="role">Job Title</label>
            <input type="text" id="role" name="Role" value="<?php echo htmlspecialchars($userInfo['Role']); ?>" readonly>
        </div>
        </div>

        <div class="form-row">
        <div class="form-group">
            <label for="nationality">Nationality</label>
            <input type="text" id="nationality" name="Nationality" value="<?php echo htmlspecialchars($userInfo['Nationality']); ?>" required>
        </div>
        </div>

        <button type="submit" class="update-button">Update Profile</button>
    </form>
    </div>

</body>
</html>
