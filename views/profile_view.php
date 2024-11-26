<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Information</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container-fluid d-flex">
        <!-- Sidebar -->
        <div>
        <?php
            if ($_SESSION['role'] === 'nhan vien') {
                include 'views/layouts/sidebar.php';
            } else if ($_SESSION['role'] === 'giam doc') {
                include 'views/layouts/sidebar_director.php';
            } else {
                
            }
            ?>
        </div>

        <!-- Profile Information -->
        <div class="col-8 offset-1 p-4">
            <h2 class="fs-2 fw-bold text-dark border-bottom pb-2 mb-4">Profile Information</h2>
            
            <div class="row g-4">
                <div class="col-md-6">
                    <div class="p-3 border rounded bg-light">
                        <strong class="d-block text-secondary">Full Name:</strong>
                        <span class="text-dark fw-medium"><?php echo htmlspecialchars($userInfo['FirstName'] . ' ' . $userInfo['LastName']); ?></span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="p-3 border rounded bg-light">
                        <strong class="d-block text-secondary">Date of Birth:</strong>
                        <span class="text-dark fw-medium"><?php echo htmlspecialchars($userInfo['DateOfBirth']); ?></span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="p-3 border rounded bg-light">
                        <strong class="d-block text-secondary">Gender:</strong>
                        <span class="text-dark fw-medium"><?php echo htmlspecialchars(ucfirst($userInfo['Gender'])); ?></span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="p-3 border rounded bg-light">
                        <strong class="d-block text-secondary">Email:</strong>
                        <span class="text-dark fw-medium"><?php echo htmlspecialchars($userInfo['Email']); ?></span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="p-3 border rounded bg-light">
                        <strong class="d-block text-secondary">Phone Number:</strong>
                        <span class="text-dark fw-medium"><?php echo htmlspecialchars($userInfo['PhoneNumber']); ?></span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="p-3 border rounded bg-light">
                        <strong class="d-block text-secondary">Marital Status:</strong>
                        <span class="text-dark fw-medium"><?php echo htmlspecialchars($userInfo['MaritalStatus']); ?></span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="p-3 border rounded bg-light">
                        <strong class="d-block text-secondary">Job Title:</strong>
                        <span class="text-dark fw-medium"><?php echo htmlspecialchars($userInfo['Role']); ?></span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="p-3 border rounded bg-light">
                        <strong class="d-block text-secondary">Nationality:</strong>
                        <span class="text-dark fw-medium"><?php echo htmlspecialchars($userInfo['Nationality']); ?></span>
                    </div>
                </div>
            </div>

            <div class="text-center mt-4">
                <a href="index.php?action=editProfile" 
                   class="btn btn-primary fw-semibold">
                    Edit Profile
                </a>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS (optional for interactivity) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
