<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Salary Details</title>
    <link rel="stylesheet" href="assets/css/Accountant/salary_detail_view.css">
</head>
<body>
    <?php include 'views/layouts/sidebar_accountant.php'; ?>
    <div class="main-content">
        <h1>Employee Salary Details</h1>

        <div class="filter-section">
            <div>
                <label for="employee">Select Employee:</label>
                <select id="employee" onchange="updateFilters()">
                    <option value="">All Employees</option>
                    <?php foreach ($employees as $emp): ?>
                        <option value="<?= $emp['EmployeeID'] ?>" 
                                <?= ($selectedEmployee == $emp['EmployeeID']) ? 'selected' : '' ?>>
                            <?= htmlspecialchars($emp['FullName']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div>
                <label for="month">Select Month:</label>
                <select id="month" onchange="updateFilters()">
                    <?php for ($m = 1; $m <= 12; $m++): ?>
                        <option value="<?= $m ?>" <?= ($selectedMonth == $m) ? 'selected' : '' ?>>
                            Month <?= $m ?>
                        </option>
                    <?php endfor; ?>
                </select>
            </div>

            <div>
                <label for="year">Select Year:</label>
                <select id="year" onchange="updateFilters()">
                    <?php foreach ($years as $y): ?>
                        <option value="<?= $y ?>" <?= ($selectedYear == $y) ? 'selected' : '' ?>>
                            <?= $y ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>

        <?php if (!empty($payrollsOnPage)): ?>
            <table>
                <tr>
                    <th>Full Name</th>
                    <th>Hours Worked</th>
                    <th>Hourly Rate (VND)</th>
                    <th>Total Salary (VND)</th>
                    <th>Actions</th>
                </tr>
                <?php foreach ($payrollsOnPage as $payroll): ?>
                    <tr>
                        <td><?= htmlspecialchars($payroll['FirstName'] . ' ' . $payroll['LastName']) ?></td>
                        <td><?= number_format($payroll['TotalHours'], 2) ?></td>
                        <td><?= number_format($payroll['HourlyRate'], 0) ?></td>
                        <td><?= number_format($payroll['ActualSalary'], 0) ?></td>
                        <td>
                            <button class="detail-btn" onclick="viewDetail(<?= $payroll['EmployeeID'] ?>, <?= $payroll['Month'] ?>, <?= $payroll['Year'] ?>)">
                                Details
                            </button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>

            <?php if ($pagination['totalPages'] > 1): ?>
                <div class="pagination">
                    <?php if ($pagination['currentPage'] > 1): ?>
                        <a href="?action=salary_detail&page=1&employee=<?= $selectedEmployee ?>&month=<?= $selectedMonth ?>&year=<?= $selectedYear ?>"><<</a>
                        <a href="?action=salary_detail&page=<?= $pagination['currentPage']-1 ?>&employee=<?= $selectedEmployee ?>&month=<?= $selectedMonth ?>&year=<?= $selectedYear ?>"><</a>
                    <?php endif; ?>

                    <?php for ($i = max(1, $pagination['currentPage']-2); $i <= min($pagination['totalPages'], $pagination['currentPage']+2); $i++): ?>
                        <?php if ($i == $pagination['currentPage']): ?>
                            <span class="active"><?= $i ?></span>
                        <?php else: ?>
                            <a href="?action=salary_detail&page=<?= $i ?>&employee=<?= $selectedEmployee ?>&month=<?= $selectedMonth ?>&year=<?= $selectedYear ?>"><?= $i ?></a>
                        <?php endif; ?>
                    <?php endfor; ?>

                    <?php if ($pagination['currentPage'] < $pagination['totalPages']): ?>
                        <a href="?action=salary_detail&page=<?= $pagination['currentPage']+1 ?>&employee=<?= $selectedEmployee ?>&month=<?= $selectedMonth ?>&year=<?= $selectedYear ?>">></a>
                        <a href="?action=salary_detail&page=<?= $pagination['totalPages'] ?>&employee=<?= $selectedEmployee ?>&month=<?= $selectedMonth ?>&year=<?= $selectedYear ?>">>></a>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
        <?php else: ?>
            <p style="text-align: center;">No salary data available for the selected criteria.</p>
        <?php endif; ?>

        <div id="detailModal" class="modal">
            <div class="modal-content">
                <span class="close" onclick="closeModal()">&times;</span>
                <div id="modalContent"></div>
            </div>
        </div>
    </div>

    <script>
        function updateFilters() {
            const employee = document.getElementById('employee').value;
            const month = document.getElementById('month').value;
            const year = document.getElementById('year').value;
            window.location.href = `index.php?action=salary_detail&employee=${employee}&month=${month}&year=${year}`;
        }

        function viewDetail(employeeId, month, year) {
            fetch(`index.php?action=salary_detail&sub_action=view_detail&employee_id=${employeeId}&month=${month}&year=${year}`)
                .then(response => response.text())
                .then(html => {
                    document.getElementById('modalContent').innerHTML = html;
                    document.getElementById('detailModal').style.display = 'block';
                });
        }

        function closeModal() {
            document.getElementById('detailModal').style.display = 'none';
        }

        window.onclick = function(event) {
            const modal = document.getElementById('detailModal');
            if (event.target == modal) {
                modal.style.display = 'none';
            }
        }
    </script>
</body>
</html> 