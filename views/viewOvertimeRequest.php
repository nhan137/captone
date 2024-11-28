<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Yêu Cầu Làm Thêm</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <?php include 'views/layouts/sidebar.php'; ?>
    
    <div class="container my-5">
        <h1 class="text-center mb-4">Yêu Cầu Làm Thêm</h1>
        
        <table class="table table-striped table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Ca</th>
                    <th>Thời gian</th>
                    <th>Ngày</th>
                    <th>Phòng ban</th>
                    <th>Mô tả</th>
                    <th>Trạng thái</th>
                    <th>Ngày gửi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($overtime_requests)): ?>
                    <?php foreach ($overtime_requests as $request): ?>
                        <tr>
                            <td><?= htmlspecialchars($request['RequestID']) ?></td>
                            <td><?= htmlspecialchars($request['Shift']) ?></td>
                            <td><?= htmlspecialchars($request['Time']) ?></td>
                            <td><?= htmlspecialchars($request['Date']) ?></td>
                            <td><?= htmlspecialchars($request['Department']) ?></td>
                            <td><?= htmlspecialchars($request['Description']) ?></td>
                            <td class="status <?= strtolower(htmlspecialchars($request['Status'])) ?>">
                                <?= htmlspecialchars($request['Status']) ?>
                            </td>
                            <td><?= htmlspecialchars($request['SubmitDate']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="8" class="text-center">Không có yêu cầu nào.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>