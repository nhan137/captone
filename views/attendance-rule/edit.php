<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thiết lập yêu cầu chấm công</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <?php include 'views/layouts/sidebar_director.php'; ?>

    <div class="container p-5">
        <h1 class="text-center mb-4">Chỉnh sửa quy định chấm công</h1>
        <form action="index.php?action=edit-attendance-rule&id=<?= $rule['RuleID'] ?>" method="POST">

            <div class="form-group mb-3">
                <label for="earlyCheckinThreshold">Early Check-in Threshold:</label>
                <input type="time" class="form-control" name="earlyCheckinThreshold"
                    value="<?= $rule['EarlyCheckinThreshold'] ?>" required>
            </div>

            <div class="form-group mb-3">
                <label for="lateCheckinThreshold">Late Check-in Threshold:</label>
                <input type="time" class="form-control" name="lateCheckinThreshold"
                    value="<?= $rule['LateCheckinThreshold'] ?>" required>
            </div>

            <div class="form-group mb-3">
                <label for="earlyCheckoutThreshold">Early Checkout Threshold:</label>
                <input type="time" class="form-control" name="earlyCheckoutThreshold"
                    value="<?= $rule['EarlyCheckoutThreshold'] ?>" required>
            </div>

            <div class="form-group mb-3">
                <label for="lateCheckoutThreshold">Late Checkout Threshold:</label>
                <input type="time" class="form-control" name="lateCheckoutThreshold"
                    value="<?= $rule['LateCheckoutThreshold'] ?>" required>
            </div>

            <div class="form-group mb-3">
                <label for="baseOvertimeRate">Base Overtime Rate:</label>
                <input type="number" class="form-control" step="0.01" name="baseOvertimeRate"
                    value="<?= $rule['BaseOvertimeRate'] ?>" required>
            </div>

            <div class="form-group mb-3">
                <label for="latePenaltyRate">Late Penalty Rate:</label>
                <input type="number" class="form-control" step="0.01" name="latePenaltyRate"
                    value="<?= $rule['LatePenaltyRate'] ?>" required>
            </div>

            <div class="form-group mb-3">
                <label for="earlyLeavePenaltyRate">Early Leave Penalty Rate:</label>
                <input type="number" class="form-control" step="0.01" name="earlyLeavePenaltyRate"
                    value="<?= $rule['EarlyLeavePenaltyRate'] ?>" required>
            </div>

            <div class="form-group mb-3">
                <label for="formula">Salary Calculation Formula:</label>
                <input type="text" class="form-control" name="formula" value="<?= $rule['Formula'] ?>" required>
            </div>

            <div class="form-group text-center">
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </form>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>