<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pending Overtime Requests</title>
    <link rel="stylesheet" href="assets/css/viewPendingOTRequests.css" />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
    />
    <style>
        /* Nút Approve */
        .new-request-button {
        background-color: #28a745; /* Màu xanh lá */
        color: white; /* Màu chữ trắng */
        border: none;
        padding: 0.8rem 1.5rem;
        border-radius: 5px;
        cursor: pointer;
        font-size: 1rem;
        transition: background-color 0.3s ease, transform 0.2s ease;
        }

        .new-request-button:hover {
        background-color: #218838; /* Màu xanh đậm hơn khi hover */
        transform: scale(1.05); /* Hiệu ứng phóng to nhẹ */
        }

        /* Nút Reject */
        .export-button {
        background-color: #dc3545; /* Màu đỏ */
        color: white; /* Màu chữ trắng */
        border: none;
        padding: 0.8rem 1.5rem;
        border-radius: 5px;
        cursor: pointer;
        font-size: 1rem;
        transition: background-color 0.3s ease, transform 0.2s ease;
        }

        .export-button:hover {
        background-color: #c82333; /* Màu đỏ đậm hơn khi hover */
        transform: scale(1.05); /* Hiệu ứng phóng to nhẹ */
        }


    </style>
</head>
<body>
    <?php include 'views/layouts/sidebar_director.php'; ?>
    <div class="main-content">
        <h1>Pending Overtime Requests</h1>
        <div class="overtime-records-container">
            <div class="records-header">
                <h2><i class="fas fa-clock"></i> Pending Overtime Requests</h2>
            </div>
            <div class="records-table">
                <table id="overtimeTable">
                    <thead>
                        <tr>
                            <th><i class="fas fa-hashtag"></i> Overtime ID</th>
                            <th><i class="fas fa-user"></i> Employee</th>
                            <th><i class="fas fa-calendar-day"></i> Date</th>
                            <th><i class="fas fa-user-clock"></i> Shift</th>
                            <th><i class="fas fa-align-left"></i> Description</th>
                            <th><i class="fas fa-tools"></i> Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($requests as $request): ?>
                            <tr>
                                <td><?= $request['overtimeID'] ?></td>
                                <td><?= $request['FirstName'] . ' ' . $request['LastName'] ?></td>
                                <td><?= $request['date'] ?></td>
                                <td><?= $request['shift'] ?></td> 
                                <td><?= $request['description'] ?></td>
                                <td>
                                    <div class="header-actions">
                                        <form action="index.php?action=approveRequest" method="POST" style="display: inline-block;">
                                            <input type="hidden" name="overtimeID" value="<?= $request['overtimeID'] ?>">
                                            <button class="new-request-button" type="submit">Approve</button>
                                        </form>
                                        <form action="index.php?action=rejectRequest" method="POST" style="display: inline-block;">
                                            <input type="hidden" name="overtimeID" value="<?= $request['overtimeID'] ?>">
                                            <button class="export-button" type="submit">Reject</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>


</body>
</html>