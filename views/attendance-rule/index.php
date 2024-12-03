<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thiết lập yêu cầu chấm công</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
    .custom-container {}
    </style>
</head>

<body>
    <?php include 'views/layouts/sidebar_director.php'; ?>

    <div class="container p-5">
        <h1 class="text-center mb-4">Thiết lập quy định chấm công</h1>
        <div class="d-flex justify-content-end align-items-end mb-3">
            <a href="index.php?action=create-attendance-rule" class="btn btn-primary">Thêm quy định chấm công</a>
        </div>
        <table class="table table-striped table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Early Checkin</th>
                    <th>Late Checkin</th>
                    <th>Early Checkout</th>
                    <th>Late Checkout</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($rules as $rule): ?>
                <tr>
                    <td><?= $rule['RuleID'] ?></td>
                    <td><?= $rule['EarlyCheckinThreshold'] ?></td>
                    <td><?= $rule['LateCheckinThreshold'] ?></td>
                    <td><?= $rule['EarlyCheckoutThreshold'] ?></td>
                    <td><?= $rule['LateCheckoutThreshold'] ?></td>
                    <td>
                        <a href="index.php?action=edit-attendance-rule&id=<?= $rule['RuleID'] ?>">Edit</a>
                        <a href="index.php?action=delete-attendance-rule&id=<?= $rule['RuleID'] ?>">Delete</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>