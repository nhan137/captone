<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/Accountant/salary_detail_modal.css"> <!-- Link to the CSS file -->
    <title>Salary Detail Modal</title>
</head>
<body>
    <div class="salary-detail">
        <h2>Salary Details for Month <?= $payrollDetail['Month'] ?>/<?= $payrollDetail['Year'] ?></h2>
        
        <div class="employee-info">
            <h3>Employee Information</h3>
            <p><strong>Employee ID:</strong> <?= htmlspecialchars($payrollDetail['EmployeeID']) ?></p>
            <p><strong>Full Name:</strong> <?= htmlspecialchars($payrollDetail['FirstName'] . ' ' . $payrollDetail['LastName']) ?></p>
            <p><strong>Email:</strong> <?= htmlspecialchars($payrollDetail['Email']) ?></p>
            <p><strong>Phone Number:</strong> <?= htmlspecialchars($payrollDetail['PhoneNumber']) ?></p>
            <p><strong>Position:</strong> <?= htmlspecialchars($payrollDetail['Role']) ?></p>
        </div>

        <div class="salary-info">
            <h3>Salary Information</h3>
            <p><strong>Base Salary:</strong> <?= number_format($payrollDetail['BaseSalary'], 0) ?> VND</p>
            <p><strong>Hours Worked:</strong> <?= number_format($payrollDetail['TotalHours'], 2) ?> hours</p>
            <p><strong>Hourly Rate:</strong> <?= number_format($payrollDetail['HourlyRate'], 0) ?> VND</p>
            <p><strong>Total Salary:</strong> <?= number_format($payrollDetail['ActualSalary'], 0) ?> VND</p>
        </div>
    </div>
</body>
</html> 