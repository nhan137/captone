<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Payroll Information</title>
    <link rel="stylesheet" href="assets/css/Employee/employee_payroll_view.css">
</head>
<body>
    <div class="sidebar">
        <?php include 'views/layouts/sidebar.php'; ?>
    </div>

    <div class="main-content">
        <div class="payroll-container">
            <div class="payroll-header">
                <h1>Your Payroll Information</h1>
                
                <form method="GET" action="" class="year-filter">
                    <input type="hidden" name="action" value="viewEmployeePayroll">
                    <label for="year">Select Year:</label>
                    <select name="year" id="year" onchange="this.form.submit()">
                        <option value="">-- Select Year --</option>
                        <?php 
                        $years = range(2020, date("Y"));
                        foreach ($years as $year): ?>
                            <option value="<?= $year ?>" <?= (isset($_GET['year']) && $_GET['year'] == $year) ? 'selected' : '' ?>><?= $year ?></option>
                        <?php endforeach; ?>
                    </select>
                </form>
            </div>

            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>Payroll ID</th>
                            <th>Month</th>
                            <th>Year</th>
                            <th>Total Hours</th>
                            <th>Hourly Rate</th>
                            <th>Total Salary</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($payrolls)): ?>
                            <?php 
                            usort($payrolls, function($a, $b) {
                                return $a['Month'] - $b['Month'];
                            });
                            foreach ($payrolls as $payroll): ?>
                                <tr>
                                    <td><?= htmlspecialchars($payroll['PayrollID']) ?></td>
                                    <td><?= htmlspecialchars($payroll['Month']) ?></td>
                                    <td><?= htmlspecialchars($payroll['Year']) ?></td>
                                    <td><?= htmlspecialchars($payroll['TotalHours']) ?></td>
                                    <td><?= htmlspecialchars($payroll['HourlyRate']) ?> VND</td>
                                    <td><?= htmlspecialchars($payroll['ActualSalary']) ?> VND</td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="6">No payroll data available for this employee.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <?php if ($totalPages > 1): ?>
            <div class="pagination">
                <?php 
                // Đảm bảo year được truyền vào URL nếu có
                $yearParam = isset($_GET['year']) && !empty($_GET['year']) ? "&year=" . $_GET['year'] : "";
                ?>
                
                <?php if ($page > 1): ?>
                    <a href="?action=viewEmployeePayroll<?= $yearParam ?>&page=<?= $page-1 ?>">&laquo; Previous</a>
                <?php endif; ?>
                
                <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                    <a href="?action=viewEmployeePayroll<?= $yearParam ?>&page=<?= $i ?>" 
                       class="<?= $i === $page ? 'active' : '' ?>">
                        <?= $i ?>
                    </a>
                <?php endfor; ?>
                
                <?php if ($page < $totalPages): ?>
                    <a href="?action=viewEmployeePayroll<?= $yearParam ?>&page=<?= $page+1 ?>">Next &raquo;</a>
                <?php endif; ?>
            </div>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
