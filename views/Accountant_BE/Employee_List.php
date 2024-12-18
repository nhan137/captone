<!DOCTYPE html>
<html>
<head>
    <title>Employee List</title>
</head>
<body>
    <h1>Danh sách nhân viên</h1>
    <form method="GET" action="index.php">
        <input type="hidden" name="action" value="ViewEmployeeListAccountant">
        <input type="text" name="search" placeholder="Tìm kiếm theo tên" value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
        <button type="submit">Tìm kiếm</button>
    </form>

    <table border="1">
        <thead>
            <tr>
                <th>Mã nhân viên</th>
                <th>Họ tên</th>
                <th>Hometown</th>
                <th>Vai trò</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($employees as $employee): ?>
                <tr>
                    <td><?php echo $employee['EmployeeID']; ?></td>
                    <td><?php echo $employee['FirstName'] . ' ' . $employee['LastName']; ?></td>
                    <td><?php echo $employee['Hometown']; ?></td>
                    <td><?php echo $employee['Role']; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
