<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thiết lập yêu cầu chấm công</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
    </style>
</head>

<body>
    <?php include 'views/layouts/sidebar_director.php'; ?>

    <div class="container p-5">
        <h1 class="text-center mb-4">Thêm mới quy định chấm công</h1>
        <h1>Add New Attendance Rule</h1>
        <form action="index.php?action=create-attendance-rule" method="POST" class="container mt-4">
            <div class="mb-3">
                <label for="earlyCheckinThreshold" class="form-label">Early Check-in Threshold:</label>
                <input type="time" name="earlyCheckinThreshold" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="lateCheckinThreshold" class="form-label">Late Check-in Threshold:</label>
                <input type="time" name="lateCheckinThreshold" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="earlyCheckoutThreshold" class="form-label">Early Checkout Threshold:</label>
                <input type="time" name="earlyCheckoutThreshold" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="lateCheckoutThreshold" class="form-label">Late Checkout Threshold:</label>
                <input type="time" name="lateCheckoutThreshold" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="baseOvertimeRate" class="form-label">Base Overtime Rate:</label>
                <input type="number" step="0.01" name="baseOvertimeRate" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="latePenaltyRate" class="form-label">Late Penalty Rate:</label>
                <input type="number" step="0.01" name="latePenaltyRate" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="earlyLeavePenaltyRate" class="form-label">Early Leave Penalty Rate:</label>
                <input type="number" step="0.01" name="earlyLeavePenaltyRate" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="formula" class="form-label">Salary Calculation Formula:</label>
                <input type="text" name="formula" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>

        <!-- Link đến Bootstrap JS (nếu cần dùng các tính năng như dropdown, modal, v.v.) -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>


    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>