<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Attendance History</title>
    <!-- <link rel="stylesheet" href="../attendancehistory.css" /> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
    <style>
    /* Importing Google font - Poppins */
    @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap");

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: "Poppins", sans-serif;
    }

    body {
        min-height: 100vh;
        background: #f0f4ff;
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        background-color: #f5f5f5;
    }

    .sidebar {
        position: fixed;
        top: 0;
        left: 0;
        height: 100%;
        width: 80px;
        display: flex;
        overflow-x: hidden;
        flex-direction: column;
        background: #161a2d;
        padding: 25px 19px;
        transition: all 0.4s ease;
    }

    .sidebar:hover {
        width: 260px;
    }

    .sidebar .sidebar-header {
        display: flex;
        align-items: center;
    }

    .sidebar .sidebar-header img {
        width: 50px;
        border-radius: 55%;
    }

    .sidebar .sidebar-header h2 {
        color: #fff;
        font-size: 1.25rem;
        font-weight: 600;
        white-space: nowrap;
        margin-left: 23px;
    }

    .sidebar-links h4 {
        color: #fff;
        font-weight: 500;
        white-space: nowrap;
        margin: 10px 0;
        position: relative;
    }

    .sidebar-links h4 span {
        opacity: 0;
    }

    .sidebar:hover .sidebar-links h4 span {
        opacity: 1;
    }

    .sidebar-links .menu-separator {
        position: absolute;
        left: 0;
        top: 50%;
        width: 100%;
        height: 1px;
        transform: translateY(-50%);
        background: #4f52ba;
        transform-origin: right;
        transition-delay: 0.2s;
    }

    .sidebar:hover .sidebar-links .menu-separator {
        transition-delay: 0s;
        transform: scaleX(0);
    }

    .sidebar-links {
        list-style: none;
        margin-top: 20px;
        height: 80%;
        overflow-y: auto;
        scrollbar-width: none;
    }

    .sidebar-links::-webkit-scrollbar {
        display: none;
    }

    .sidebar-links li a {
        display: flex;
        align-items: center;
        gap: 0 20px;
        color: #fff;
        font-weight: 500;
        white-space: nowrap;
        padding: 15px 10px;
        text-decoration: none;
        transition: 0.2s ease;
    }

    .sidebar-links li a:hover {
        color: #161a2d;
        background: #fff;
        border-radius: 4px;
    }

    .user-account {
        margin-top: auto;
        padding: 12px 10px;
        margin-left: -10px;
    }

    .user-profile {
        display: flex;
        align-items: center;
        color: #161a2d;
    }

    .user-profile img {
        width: 42px;
        border-radius: 50%;
        border: 2px solid #fff;
    }

    .user-profile h3 {
        font-size: 1rem;
        font-weight: 600;
    }

    .user-profile span {
        font-size: 0.775rem;
        font-weight: 600;
    }

    .user-detail {
        margin-left: 23px;
        white-space: nowrap;
    }

    .sidebar:hover .user-account {
        background: #fff;
        border-radius: 4px;
    }

    .main-content {
        padding: 30px;
        max-width: 1200px;
        margin: 0 auto;
    }

    .personal-info-form {
        background: white;
        padding: 40px;
        border-radius: 12px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    /* Style cho headers */
    h2 {
        color: #2c3e50;
        font-size: 20px;
        margin-bottom: 30px;
        padding-bottom: 15px;
        border-bottom: 2px solid #eee;
    }

    h3 {
        color: #2c3e50;
        font-size: 18px;
        margin: 30px 0 20px;
        grid-column: 1 / -1;
    }

    /* Layout chính */
    .form-row {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 30px;
        /* Tăng khoảng cách giữa các cột */
        margin-bottom: 30px;
    }

    .form-group {
        display: flex;
        flex-direction: column;
        gap: 10px;
    }

    /* Style cho labels */
    .form-group label {
        font-weight: 500;
        color: #4a5568;
        font-size: 14px;
    }

    /* Style cho inputs và selects */
    .form-group input,
    .form-group select {
        width: 100%;
        padding: 12px 15px;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        font-size: 14px;
        transition: all 0.3s ease;
        background-color: #f8fafc;
        /* Màu nền nhẹ */
    }

    .form-group input:focus,
    .form-group select:focus {
        outline: none;
        border-color: #4299e1;
        box-shadow: 0 0 0 3px rgba(66, 153, 225, 0.1);
        background-color: white;
    }

    /* Section spacing */
    .section {
        margin-bottom: 40px;
    }

    /* Responsive */
    @media (max-width: 1024px) {
        .form-row {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 768px) {
        .form-row {
            grid-template-columns: 1fr;
        }

        .main-content {
            padding: 15px;
        }

        .personal-info-form {
            padding: 20px;
        }
    }

    .checkin-container {
        background: #fff;
        padding: 2rem;
        border-radius: 10px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .company-header {
        text-align: center;
        margin-bottom: 2rem;
    }

    .company-header h1 {
        color: #2c3e50;
        margin-bottom: 0.5rem;
    }

    .greeting {
        color: #7f8c8d;
        font-size: 1.1rem;
    }

    .profile-section {
        text-align: center;
        margin-bottom: 2rem;
    }

    .avatar-large {
        width: 150px;
        height: 150px;
        border-radius: 50%;
        object-fit: cover;
        border: 4px solid #3498db;
    }

    .checkin-form {
        max-width: 500px;
        margin: 0 auto;
    }

    .checkin-form .form-group {
        margin-bottom: 1.5rem;
    }

    .checkin-form label {
        display: block;
        margin-bottom: 0.5rem;
        color: #2c3e50;
        font-weight: 500;
    }

    .checkin-form input {
        width: 100%;
        padding: 0.8rem;
        border: 1px solid #ddd;
        border-radius: 5px;
        font-size: 1rem;
    }

    .checkin-button {
        width: 100%;
        padding: 1rem;
        background-color: #2ecc71;
        color: white;
        border: none;
        border-radius: 5px;
        font-size: 1.1rem;
        font-weight: bold;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        transition: background-color 0.3s ease;
    }

    .checkin-button:hover {
        background-color: #27ae60;
    }

    .checkin-button i {
        font-size: 1.2rem;
    }

    /* Time Display Styles */
    .time-display {
        text-align: center;
        margin-bottom: 2rem;
        padding: 1rem;
        background: #f8f9fa;
        border-radius: 8px;
    }

    #clock {
        font-size: 2.5rem;
        font-weight: bold;
        color: #2c3e50;
        margin: 0.5rem 0;
    }

    #date {
        color: #7f8c8d;
        font-size: 1.1rem;
    }

    @media (max-width: 768px) {
        .checkin-container {
            padding: 1rem;
        }

        .avatar-large {
            width: 100px;
            height: 100px;
        }

        #clock {
            font-size: 2rem;
        }
    }

    /* Thêm vào file profile.css */

    .confirmation-header {
        text-align: center;
        margin-bottom: 2rem;
    }

    .confirmation-header h2 {
        color: #2c3e50;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
    }

    .confirmation-header h2 i {
        color: #3498db;
    }

    .confirmation-table {
        margin: 2rem 0;
        overflow-x: auto;
    }

    .confirmation-table table {
        width: 100%;
        border-collapse: collapse;
        background: #fff;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    }

    .confirmation-table th,
    .confirmation-table td {
        padding: 1rem;
        text-align: left;
        border-bottom: 1px solid #eee;
    }

    .confirmation-table th {
        background: #f8f9fa;
        color: #2c3e50;
        font-weight: 600;
    }

    .confirmation-table th i {
        margin-right: 0.5rem;
        color: #3498db;
    }

    .confirmation-table tbody tr:hover {
        background-color: #f8f9fa;
    }

    .confirmation-actions {
        display: flex;
        justify-content: center;
        margin-top: 2rem;
    }

    .back-button {
        padding: 0.8rem 1.5rem;
        background-color: #3498db;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 1rem;
        transition: background-color 0.3s ease;
    }

    .back-button:hover {
        background-color: #2980b9;
    }

    .back-button i {
        font-size: 1rem;
    }

    @media (max-width: 768px) {
        .confirmation-table {
            margin: 1rem -1rem;
        }

        .confirmation-table th,
        .confirmation-table td {
            padding: 0.8rem;
            font-size: 0.9rem;
        }
    }

    .attendance-container {
        background: #fff;
        padding: 2rem;
        border-radius: 10px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .attendance-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 2rem;
    }

    .attendance-header h2 {
        color: #2c3e50;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .attendance-header h2 i {
        color: #3498db;
    }

    .month-selector {
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .month-nav {
        background: none;
        border: none;
        color: #3498db;
        cursor: pointer;
        font-size: 1.2rem;
    }

    .attendance-table-wrapper {
        overflow-x: auto;
        margin-bottom: 2rem;
    }

    .attendance-table {
        width: 100%;
        border-collapse: collapse;
        font-size: 0.9rem;
    }

    .attendance-table th,
    .attendance-table td {
        padding: 0.5rem;
        text-align: center;
        border: 1px solid #ddd;
    }

    .attendance-table thead th {
        background: #f8f9fa;
        color: #2c3e50;
        font-weight: 600;
    }

    .attendance-table th i {
        margin-right: 0.5rem;
        color: #3498db;
    }

    .days-header th {
        background: #e9ecef;
        font-weight: normal;
    }

    /* Attendance Status Colors */
    .present {
        background: #e8f5e9;
        color: #2e7d32;
    }

    .absent {
        background: #ffebee;
        color: #c62828;
    }

    .late {
        background: #fff3e0;
        color: #ef6c00;
    }

    .weekend {
        background: #f3e5f5;
        color: #6a1b9a;
    }

    .holiday {
        background: #e3f2fd;
        color: #1565c0;
    }

    .leave {
        background: #f1f8e9;
        color: #558b2f;
    }

    .attendance-legend {
        display: flex;
        flex-wrap: wrap;
        gap: 1rem;
        margin-bottom: 2rem;
        padding: 1rem;
        background: #f8f9fa;
        border-radius: 5px;
    }

    .legend-item {
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .legend-color {
        width: 20px;
        height: 20px;
        border-radius: 4px;
    }

    .attendance-actions {
        display: flex;
        gap: 1rem;
        justify-content: flex-end;
    }

    .export-button,
    .print-button {
        padding: 0.8rem 1.5rem;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 1rem;
        transition: background-color 0.3s ease;
    }

    .export-button {
        background-color: #2ecc71;
        color: white;
    }

    .print-button {
        background-color: #3498db;
        color: white;
    }

    .export-button:hover {
        background-color: #27ae60;
    }

    .print-button:hover {
        background-color: #2980b9;
    }

    @media (max-width: 1024px) {
        .attendance-table {
            font-size: 0.8rem;
        }

        .attendance-legend {
            gap: 0.5rem;
        }
    }

    @media (max-width: 768px) {
        .attendance-header {
            flex-direction: column;
            gap: 1rem;
        }

        .attendance-actions {
            flex-direction: column;
        }

        .legend-item {
            font-size: 0.9rem;
        }
    }

    .error-report-container {
        background: #fff;
        padding: 2rem;
        border-radius: 10px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .error-report-header {
        margin-bottom: 2rem;
    }

    .error-report-header h2 {
        color: #2c3e50;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .error-report-header h2 i {
        color: #e74c3c;
    }

    .error-report-form {
        background: #f8f9fa;
        padding: 2rem;
        border-radius: 8px;
        margin-bottom: 2rem;
    }

    .error-report-form h3,
    .error-report-history h3 {
        color: #2c3e50;
        margin-bottom: 1.5rem;
        font-size: 1.2rem;
    }

    .form-group {
        margin-bottom: 1.5rem;
    }

    .form-group label {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        margin-bottom: 0.5rem;
        color: #2c3e50;
    }

    .form-group label i {
        color: #3498db;
    }

    .form-group input[type="date"],
    .form-group textarea {
        width: 100%;
        padding: 0.8rem;
        border: 1px solid #ddd;
        border-radius: 5px;
        font-size: 1rem;
    }

    .file-input {
        padding: 0.8rem;
        background: #fff;
        border: 1px dashed #3498db;
        border-radius: 5px;
        width: 100%;
    }

    .table-wrapper {
        overflow-x: auto;
        margin-bottom: 2rem;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    th,
    td {
        padding: 1rem;
        text-align: left;
        border-bottom: 1px solid #eee;
    }

    th {
        background: #f8f9fa;
        color: #2c3e50;
        font-weight: 600;
    }

    th i {
        color: #3498db;
        margin-right: 0.5rem;
    }

    .attachment-link {
        color: #3498db;
        text-decoration: none;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .attachment-link:hover {
        text-decoration: underline;
    }

    .status-processing {
        background: #fff3e0;
        color: #ef6c00;
        padding: 0.3rem 0.8rem;
        border-radius: 20px;
        font-size: 0.9rem;
    }

    .status-resolved {
        background: #e8f5e9;
        color: #2e7d32;
        padding: 0.3rem 0.8rem;
        border-radius: 20px;
        font-size: 0.9rem;
    }

    .form-actions {
        display: flex;
        gap: 1rem;
        justify-content: flex-end;
    }

    .submit-button,
    .cancel-button {
        padding: 0.8rem 1.5rem;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 1rem;
        transition: all 0.3s ease;
    }

    .submit-button {
        background-color: #2ecc71;
        color: white;
    }

    .submit-button:hover {
        background-color: #27ae60;
    }

    .cancel-button {
        background-color: #e74c3c;
        color: white;
    }

    .cancel-button:hover {
        background-color: #c0392b;
    }

    @media (max-width: 768px) {
        .error-report-form {
            padding: 1rem;
        }

        .form-actions {
            flex-direction: column;
        }

        .submit-button,
        .cancel-button {
            width: 100%;
            justify-content: center;
        }
    }

    .leave-application-container {
        background: #fff;
        padding: 2rem;
        border-radius: 10px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .leave-header {
        margin-bottom: 2rem;
    }

    .leave-header h2 {
        color: #2c3e50;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .leave-header h2 i {
        color: #3498db;
    }

    .leave-info-box {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 1.5rem;
        margin-bottom: 2rem;
    }

    .info-item {
        background: #f8f9fa;
        padding: 1.5rem;
        border-radius: 8px;
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .info-item i {
        font-size: 2rem;
        color: #3498db;
    }

    .info-content h4 {
        color: #7f8c8d;
        font-size: 0.9rem;
        margin-bottom: 0.5rem;
    }

    .info-content p {
        color: #2c3e50;
        font-size: 1.2rem;
        font-weight: bold;
    }

    .leave-request-form {
        background: #f8f9fa;
        padding: 2rem;
        border-radius: 8px;
    }

    .form-row {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 1.5rem;
        margin-bottom: 1.5rem;
    }

    .form-group {
        margin-bottom: 1.5rem;
    }

    .form-group label {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        margin-bottom: 0.5rem;
        color: #2c3e50;
    }

    .form-group label i {
        color: #3498db;
    }

    .form-group input,
    .form-group select,
    .form-group textarea {
        width: 100%;
        padding: 0.8rem;
        border: 1px solid #ddd;
        border-radius: 5px;
        font-size: 1rem;
        background: #fff;
    }

    .form-group textarea {
        resize: vertical;
    }

    .file-input {
        padding: 0.8rem;
        background: #fff;
        border: 1px dashed #3498db;
        border-radius: 5px;
    }

    .form-actions {
        display: flex;
        gap: 1rem;
        justify-content: flex-end;
        margin-top: 2rem;
    }

    .submit-button,
    .cancel-button {
        padding: 0.8rem 1.5rem;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 1rem;
        transition: all 0.3s ease;
    }

    .submit-button {
        background-color: #2ecc71;
        color: white;
    }

    .submit-button:hover {
        background-color: #27ae60;
    }

    .cancel-button {
        background-color: #e74c3c;
        color: white;
    }

    .cancel-button:hover {
        background-color: #c0392b;
    }

    @media (max-width: 768px) {
        .leave-info-box {
            grid-template-columns: 1fr;
        }

        .form-row {
            grid-template-columns: 1fr;
        }

        .form-actions {
            flex-direction: column;
        }

        .submit-button,
        .cancel-button {
            width: 100%;
            justify-content: center;
        }
    }

    .leave-details-container {
        background: #fff;
        padding: 2rem;
        border-radius: 10px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .leave-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 2rem;
    }

    .application-status {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.5rem 1rem;
        border-radius: 20px;
        font-size: 0.9rem;
    }

    .application-status.pending {
        background: #fff3e0;
        color: #ef6c00;
    }

    .details-section {
        background: #f8f9fa;
        padding: 1.5rem;
        border-radius: 8px;
        margin-bottom: 2rem;
    }

    .details-section h3 {
        color: #2c3e50;
        font-size: 1.1rem;
        margin-bottom: 1.5rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .details-section h3 i {
        color: #3498db;
    }

    .details-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 1.5rem;
    }

    .detail-item {
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
    }

    .detail-item.full-width {
        grid-column: 1 / -1;
    }

    .detail-item label {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        color: #7f8c8d;
        font-size: 0.9rem;
    }

    .detail-item label i {
        color: #3498db;
    }

    .detail-item input,
    .detail-item textarea {
        width: 100%;
        padding: 0.8rem;
        border: 1px solid #ddd;
        border-radius: 5px;
        background: #fff;
        color: #2c3e50;
        font-size: 1rem;
    }

    .detail-item input[readonly],
    .detail-item textarea[readonly] {
        background: #f8f9fa;
        cursor: not-allowed;
    }

    .form-actions {
        display: flex;
        gap: 1rem;
        justify-content: flex-end;
        margin-top: 2rem;
    }

    .back-button,
    .print-button {
        padding: 0.8rem 1.5rem;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 1rem;
        transition: all 0.3s ease;
    }

    .back-button {
        background-color: #95a5a6;
        color: white;
    }

    .back-button:hover {
        background-color: #7f8c8d;
    }

    .print-button {
        background-color: #3498db;
        color: white;
    }

    .print-button:hover {
        background-color: #2980b9;
    }

    @media (max-width: 768px) {
        .leave-header {
            flex-direction: column;
            gap: 1rem;
            text-align: center;
        }

        .details-grid {
            grid-template-columns: 1fr;
        }

        .form-actions {
            flex-direction: column;
        }

        .back-button,
        .print-button {
            width: 100%;
            justify-content: center;
        }
    }

    .leave-history-table {
        overflow-x: auto;
    }

    .leave-history-table table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 1rem;
    }

    .leave-history-table th,
    .leave-history-table td {
        padding: 1rem;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }

    .leave-history-table th {
        background: #f1f1f1;
        color: #2c3e50;
        font-weight: 600;
    }

    .leave-history-table th i {
        color: #3498db;
        margin-right: 0.5rem;
    }

    .leave-history-table tbody tr:hover {
        background-color: #f8f9fa;
    }

    /* Status badges */
    .status-approved,
    .status-rejected,
    .status-pending {
        padding: 0.3rem 0.8rem;
        border-radius: 20px;
        font-size: 0.9rem;
        display: inline-block;
    }

    .status-approved {
        background: #e8f5e9;
        color: #2e7d32;
    }

    .status-rejected {
        background: #ffebee;
        color: #c62828;
    }

    .status-pending {
        background: #fff3e0;
        color: #ef6c00;
    }

    @media (max-width: 768px) {
        .leave-history-table {
            font-size: 0.9rem;
        }

        .leave-history-table th,
        .leave-history-table td {
            padding: 0.8rem;
        }
    }

    .overtime-container {
        background: #fff;
        padding: 2rem;
        border-radius: 10px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .overtime-header {
        margin-bottom: 2rem;
    }

    .overtime-header h2 {
        color: #2c3e50;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .overtime-header h2 i {
        color: #3498db;
    }

    .overtime-stats {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 1.5rem;
        margin-bottom: 2rem;
    }

    .stat-card {
        background: #f8f9fa;
        padding: 1.5rem;
        border-radius: 8px;
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .stat-card i {
        font-size: 2rem;
        color: #3498db;
    }

    .stat-info h4 {
        color: #7f8c8d;
        font-size: 0.9rem;
        margin-bottom: 0.5rem;
    }

    .stat-info p {
        color: #2c3e50;
        font-size: 1.2rem;
        font-weight: bold;
    }

    .overtime-form {
        background: #f8f9fa;
        padding: 2rem;
        border-radius: 8px;
    }

    .overtime-form h3 {
        color: #2c3e50;
        margin-bottom: 1.5rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .overtime-form h3 i {
        color: #3498db;
    }

    .form-row {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 1.5rem;
        margin-bottom: 1.5rem;
    }

    .form-group {
        margin-bottom: 1.5rem;
    }

    .form-group label {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        margin-bottom: 0.5rem;
        color: #2c3e50;
    }

    .form-group label i {
        color: #3498db;
    }

    .form-group input,
    .form-group select,
    .form-group textarea {
        width: 100%;
        padding: 0.8rem;
        border: 1px solid #ddd;
        border-radius: 5px;
        font-size: 1rem;
    }

    .form-group textarea {
        resize: vertical;
    }

    .form-actions {
        display: flex;
        gap: 1rem;
        justify-content: flex-end;
        margin-top: 2rem;
    }

    .submit-button,
    .cancel-button {
        padding: 0.8rem 1.5rem;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 1rem;
        transition: all 0.3s ease;
    }

    .submit-button {
        background-color: #2ecc71;
        color: white;
    }

    .submit-button:hover {
        background-color: #27ae60;
    }

    .cancel-button {
        background-color: #e74c3c;
        color: white;
    }

    .cancel-button:hover {
        background-color: #c0392b;
    }

    @media (max-width: 768px) {
        .overtime-stats {
            grid-template-columns: 1fr;
        }

        .form-row {
            grid-template-columns: 1fr;
        }

        .form-actions {
            flex-direction: column;
        }

        .submit-button,
        .cancel-button {
            width: 100%;
            justify-content: center;
        }
    }

    .overtime-records-container {
        background: #fff;
        padding: 2rem;
        border-radius: 10px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .records-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 2rem;
    }

    .header-actions {
        display: flex;
        gap: 1rem;
    }

    .new-request-button,
    .export-button {
        padding: 0.8rem 1.5rem;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 1rem;
        transition: all 0.3s ease;
    }

    .new-request-button {
        background-color: #2ecc71;
        color: white;
    }

    .export-button {
        background-color: #3498db;
        color: white;
    }

    .records-filters {
        display: flex;
        gap: 1.5rem;
        margin-bottom: 2rem;
    }

    .filter-group {
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
    }

    .filter-group label {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        color: #7f8c8d;
    }

    .filter-group select {
        padding: 0.5rem;
        border: 1px solid #ddd;
        border-radius: 5px;
        min-width: 150px;
    }

    .records-table {
        overflow-x: auto;
        margin-bottom: 2rem;
    }

    .records-table table {
        width: 100%;
        border-collapse: collapse;
    }

    .records-table th,
    .records-table td {
        padding: 1rem;
        text-align: left;
        border-bottom: 1px solid #eee;
    }

    .records-table th {
        background: #f8f9fa;
        color: #2c3e50;
        font-weight: 600;
    }

    .records-table th i {
        color: #3498db;
        margin-right: 0.5rem;
    }

    .records-table tbody tr:hover {
        background-color: #f8f9fa;
    }

    .status-badge {
        padding: 0.3rem 0.8rem;
        border-radius: 20px;
        font-size: 0.9rem;
    }

    .status-badge.pending {
        background: #fff3e0;
        color: #ef6c00;
    }

    .status-badge.approved {
        background: #e8f5e9;
        color: #2e7d32;
    }

    .status-badge.rejected {
        background: #ffebee;
        color: #c62828;
    }

    .records-summary {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 1.5rem;
        margin-top: 2rem;
        padding-top: 2rem;
        border-top: 1px solid #eee;
    }

    .summary-item {
        display: flex;
        align-items: center;
        gap: 1rem;
        padding: 1rem;
        background: #f8f9fa;
        border-radius: 8px;
    }

    .summary-item i {
        font-size: 2rem;
        color: #3498db;
    }

    .summary-info h4 {
        color: #7f8c8d;
        font-size: 0.9rem;
        margin-bottom: 0.5rem;
    }

    .summary-info p {
        color: #2c3e50;
        font-size: 1.2rem;
        font-weight: bold;
    }

    @media (max-width: 768px) {
        .records-header {
            flex-direction: column;
            gap: 1rem;
        }

        .header-actions {
            width: 100%;
            flex-direction: column;
        }

        .records-filters {
            flex-direction: column;
        }

        .records-summary {
            grid-template-columns: 1fr;
        }

        .new-request-button,
        .export-button {
            width: 100%;
            justify-content: center;
        }
    }

    /* Cơ bản cho badge */
    .badge {
        display: inline-block;
        padding: 0.5em 1em;
        font-size: 0.875rem;
        font-weight: 700;
        text-align: center;
        border-radius: 12px;
        color: #fff;
    }

    /* Badge cho cảnh báo (Warning) */
    .badge-warning {
        background-color: #f39c12;
        /* Màu vàng cảnh báo */
        border: 1px solid #e67e22;
        /* Màu viền đậm hơn để tạo điểm nhấn */
    }

    /* Badge cho lỗi (Error/Danger) */
    .badge-danger {
        background-color: #e74c3c;
        /* Màu đỏ cho lỗi */
        border: 1px solid #c0392b;
        /* Màu viền đỏ đậm */
    }

    /* Tùy chọn thêm các badge khác */
    .badge-info {
        background-color: #3498db;
        /* Màu xanh dương cho thông tin */
        border: 1px solid #2980b9;
    }

    .badge-success {
        background-color: #2ecc71;
        /* Màu xanh lá cho thành công */
        border: 1px solid #27ae60;
    }

    .salary-form {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .attendance-header h2 {
        color: #007bff;
        margin-bottom: 20px;
    }

    .salary-form {
        margin-bottom: 30px;
    }

    .form-group {
        margin-bottom: 15px;
    }

    .form-group label {
        display: block;
        margin-bottom: 5px;
        font-weight: bold;
    }

    .form-group input {
        width: 100%;
        padding: 8px;
        border: 1px solid #ddd;
        border-radius: 5px;
    }

    .btn {
        background-color: #007bff;
        color: white;
        padding: 10px 15px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    .btn:hover {
        background-color: #0056b3;
    }

    .attendance-table-wrapper {
        margin-top: 20px;
    }

    .salary-summary {
        margin-bottom: 15px;
    }

    .highlight {
        color: #28a745;
        font-weight: bold;
    }

    .attendance-table {
        width: 100%;
        border-collapse: collapse;
    }

    .attendance-table th,
    .attendance-table td {
        border: 1px solid #ddd;
        padding: 10px;
        text-align: center;
    }

    .attendance-table th {
        background-color: #f8f9fa;
        font-weight: bold;
    }

    .attendance-table tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    .no-data {
        color: #666;
        font-style: italic;
    }
    </style>
</head>

<body>
<?php
            if ($_SESSION['role'] === 'nhan vien') {
                include 'views/layouts/sidebar.php';
            } else if ($_SESSION['role'] === 'giam doc') {
                include 'views/layouts/sidebar_director.php';
            } else {
                include 'views/layouts/sidebar_accountant.php';
            }
            ?>

    <!-- Main Content -->
    <div class="main-content">
        <div class="attendance-container">

            <div class="attendance-header">
                <h2><i class="fas fa-list"></i> Salary List of Employee</h2>
            </div>

            <!-- Salary and attendance table -->
            <div class="attendance-table-wrapper">

                <table>
                    <thead>
                        <tr>
                            <th>Employee ID</th>
                            <th>Employee Name</th>
                            <th>Base Salary</th>
                            <th>Bonus</th>
                            <th>Deductions</th>
                            <th>Overtime Hours</th>
                            <th>Overtime Pay</th>
                            <th>Total Working Days</th>
                            <th>Total Salary</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($salaries as $salary) : ?>
                        <tr>
                            <td><?= htmlspecialchars($salary['EmployeeID']) ?></td>
                            <td><?= htmlspecialchars($salary['FirstName']) . ' ' . htmlspecialchars($salary['LastName']) ?>
                            </td>
                            <td>$<?= number_format($salary['BaseSalary'], 2) ?></td>
                            <td>$<?= number_format($salary['Bonus'], 2) ?></td>
                            <td>$<?= number_format($salary['Deductions'], 2) ?></td>
                            <td><?= htmlspecialchars($salary['OvertimeHours']) ?> hrs</td>
                            <td>$<?= number_format($salary['OvertimeHours'] * $salary['OvertimeRate'], 2) ?></td>
                            <td><?= htmlspecialchars(  $salary['TotalWorkingDays']) ?></td>
                            <td>$<?= number_format($salary['TotalSalary'], 2) ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

</html>