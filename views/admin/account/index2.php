<?php include('../../../layouts/admin/admin_header.php'); ?>

<div id="wrapper">
    <?php include('../../../layouts/admin/admin_sidebar.php'); ?>

    <div id="content-wrapper" class="d-flex flex-column">
        <div id="content">
            <?php include('../../../layouts/admin/admin_topbar.php'); ?>

            <!-- Begin Page Content -->
            <div class="container-fluid">
                <!-- Page Heading -->
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>STT</th>
                                            <th>Tên đăng nhập</th>
                                            <th>Họ</th>
                                            <th>Tên</th>
                                            <th>Email</th>
                                            <th>Số điện thoại</th>
                                            <th>Vai trò</th>
                                            <th>Chức năng</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (!empty($accounts)): ?>
                                        <?php foreach ($accounts as $index => $account): ?>
                                        <tr>
                                            <td><?= $index + 1 ?></td>
                                            <td><?= htmlspecialchars($account['Username']) ?></td>
                                            <td><?= htmlspecialchars($account['FirstName']) ?></td>
                                            <td><?= htmlspecialchars($account['LastName']) ?></td>
                                            <td><?= htmlspecialchars($account['Email']) ?></td>
                                            <td><?= htmlspecialchars($account['PhoneNumber']) ?></td>
                                            <td><?= htmlspecialchars($account['Role']) ?></td>
                                            <td>
                                                <a
                                                    href="/?controller=account&action=edit&id=<?= $account['EmployeeID'] ?>">Sửa</a>
                                                <a href="/?controller=account&action=delete&id=<?= $account['EmployeeID'] ?>"
                                                    onclick="return confirm('Bạn có chắc chắn muốn xóa tài khoản này?');">Xóa</a>
                                            </td>
                                        </tr>
                                        <?php endforeach; ?>
                                        <?php else:  ?>
                                        <tr>
                                            <td colspan="8">Không có dữ liệu.</td>
                                        </tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('../../../layouts/admin/admin_footer.php'); ?>

</body>

</html>