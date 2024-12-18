<?php
class ViewListDataEmployeeModel {
    protected $pdo;

    // Hàm khởi tạo nhận đối tượng PDO
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Lấy danh sách các đơn OT có status = 'Approved'
    public function getApprovedOTRequests($employeeId = null) {
        $query = "SELECT ot.*, e.FirstName, e.LastName 
                  FROM ot 
                  JOIN employee e ON ot.employeeID = e.EmployeeID
                  WHERE ot.status = 'Approved'";
        
        $params = [];
        if ($employeeId) {
            $query .= " AND ot.employeeID = ?";
            $params[] = $employeeId;
        }
        
        $query .= " ORDER BY ot.overtimeID DESC";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Lấy danh sách các đơn leave có status = 'Approved'
    public function getApprovedLeaveRequests($employeeId = null) {
        $query = "SELECT lr.*, e.FirstName, e.LastName 
                  FROM leaverequest lr
                  JOIN employee e ON lr.EmployeeID = e.EmployeeID
                  WHERE lr.Status = 'approved'";
        
        $params = [];
        if ($employeeId) {
            $query .= " AND lr.EmployeeID = ?";
            $params[] = $employeeId;
        }
        
        $query .= " ORDER BY lr.SubmitDate DESC";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllEmployees() {
        $query = "SELECT EmployeeID, FirstName, LastName 
                  FROM employee 
                  ORDER BY FirstName, LastName";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAttendanceHistory($employeeId = null, $startDate = null, $endDate = null, $limit = 10, $offset = 0) {
        $query = "SELECT SQL_CALC_FOUND_ROWS cc.*, e.FirstName, e.LastName,
                  TIMEDIFF(CheckoutTime, CheckinTime) AS TotalWorkHours
                  FROM checkincheckout cc
                  JOIN employee e ON cc.EmployeeID = e.EmployeeID
                  WHERE 1=1";
        
        if ($employeeId !== null) {
            $query .= " AND cc.EmployeeID = :employeeId";
        }
        
        if ($startDate) {
            $startDate = DateTime::createFromFormat('d-m-Y', $startDate)->format('Y-m-d');
            $query .= " AND DATE(cc.CheckinTime) >= :startDate";
        }
        
        if ($endDate) {
            $endDate = DateTime::createFromFormat('d-m-Y', $endDate)->format('Y-m-d');
            $query .= " AND DATE(cc.CheckoutTime) <= :endDate";
        }
        
        $query .= " ORDER BY cc.CheckinTime DESC LIMIT :limit OFFSET :offset";
        
        $stmt = $this->pdo->prepare($query);
        
        if ($employeeId !== null) {
            $stmt->bindValue(':employeeId', $employeeId, PDO::PARAM_INT);
        }
        if ($startDate) {
            $stmt->bindValue(':startDate', $startDate);
        }
        if ($endDate) {
            $stmt->bindValue(':endDate', $endDate);
        }
        
        $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', (int)$offset, PDO::PARAM_INT);
        
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        $stmt = $this->pdo->query("SELECT FOUND_ROWS()");
        $totalRecords = $stmt->fetchColumn();
        
        // Thêm xử lý trạng thái cho mỗi bản ghi
        foreach ($results as &$record) {
            // Xử lý Check-in Status
            $checkinTime = new DateTime($record['CheckinTime']);
            $workDate = $checkinTime->format('Y-m-d');
            $startTime = new DateTime($workDate . ' 08:00:00');
            
            if ($checkinTime <= $startTime) {
                $record['CheckinStatus'] = 'On Time';
            } else {
                $record['CheckinStatus'] = 'Late';
            }

            // Xử lý Check-out Status
            if (!empty($record['CheckoutTime'])) {
                $checkoutTime = new DateTime($record['CheckoutTime']);
                $endTime = new DateTime($workDate . ' 17:30:00');
                
                if ($checkoutTime >= $endTime) {
                    $record['CheckoutStatus'] = 'On Time';
                } else {
                    $record['CheckoutStatus'] = 'Early';
                }
            } else {
                $record['CheckoutStatus'] = 'N/A';
            }
        }

        return [
            'data' => $results,
            'total' => $totalRecords
        ];
    }
}