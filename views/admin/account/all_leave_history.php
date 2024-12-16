<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Leave History</title>
    <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
    <link href="assets/css/sb-admin-2.min.css" rel="stylesheet">
    <style>
        .status-badge {
            padding: 5px 10px;
            border-radius: 4px;
            font-size: 12px;
            font-weight: bold;
        }
        .approved { background: #1cc88a; color: white; }
        .rejected { background: #e74a3b; color: white; }
        .pending { background: #f6c23e; color: white; }
        
        /* .card-header {
            background-color: #4e73df;
            color: white;
        } */
        .table th {
            background-color: #4e73df;
            color: white;
        }
        .pagination {
        margin: 20px 0;
        }
        .page-link {
        color: #4e73df;
        }
        .page-item.active .page-link {
        background-color: #4e73df;
        border-color: #4e73df;
        }
    </style>
</head>
<body id="page-top">
    <div id="wrapper">
        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                <div class="sidebar-brand-text mx-3">Admin </div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="index.php?action=account">
                    <i class="fas fa-fw fa-user"></i>
                    <span class="font-weight-bold">Account</span>
                </a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Nav Items - History -->
            <li class="nav-item">
                <a class="nav-link" href="index.php?action=all_ot_history">
                    <i class="fas fa-fw fa-clock"></i>
                    <span class="font-weight-bold">Overtime History</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="index.php?action=all_error_reports">
                    <i class="fas fa-fw fa-exclamation-triangle"></i>
                    <span class="font-weight-bold">Error Reports History</span>
                </a>
            </li>

            <li class="nav-item active"> <!-- Active cho trang hiện tại -->
                <a class="nav-link" href="index.php?action=all_leave_history">
                    <i class="fas fa-fw fa-calendar"></i>
                    <span class="font-weight-bold">Leave History</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="index.php?action=all_attendance_history">
                    <i class="fas fa-fw fa-clipboard-list"></i>
                    <span class="font-weight-bold">Attendance History</span>
                </a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>
        </ul>

        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <div class="container-fluid">
                    <h1 class="h3 mb-2 text-gray-800">Leave Request History</h1>
                    
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold">All Employee Leave Records</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Employee Name</th>
                                            <th>Start Date</th>
                                            <th>End Date</th>
                                            <th>Reason</th>
                                            <th>Shift</th>
                                            <th>Description</th>
                                            <th>Status</th>
                                            <th>Submit Date</th>
                                            <th>Approved Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($leaveHistory as $record): ?>
                                            <tr>
                                                <td><?= htmlspecialchars($record['FirstName'] . ' ' . $record['LastName']) ?></td>
                                                <td><?= htmlspecialchars($record['StartDate']) ?></td>
                                                <td><?= htmlspecialchars($record['EndDate']) ?></td>
                                                <td><?= htmlspecialchars($record['Reason']) ?></td>
                                                <td><?= htmlspecialchars($record['Shift']) ?></td>
                                                <td><?= htmlspecialchars($record['Description']) ?></td>
                                                <td>
                                                    <span class="status-badge <?= strtolower($record['Status']) ?>">
                                                        <?= htmlspecialchars($record['Status']) ?>
                                                    </span>
                                                </td>
                                                <td><?= htmlspecialchars($record['SubmitDate']) ?></td>
                                                <td><?= $record['ApprovedDate'] ?? 'N/A' ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="assets/vendor/jquery/jquery.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="assets/js/sb-admin-2.min.js"></script>
</body>
</html>
