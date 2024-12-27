// Thêm hàm kiểm tra tọa độ trong khu vực
function isWithinPolygon(latUser, lonUser, polygonPoints) {
    let n = polygonPoints.length;
    let inside = false;

    for (let i = 0, j = n - 1; i < n; j = i++) {
        let lat1 = polygonPoints[i][0], lon1 = polygonPoints[i][1];
        let lat2 = polygonPoints[j][0], lon2 = polygonPoints[j][1];

        if (lonUser > Math.min(lon1, lon2) && lonUser <= Math.max(lon1, lon2) &&
            latUser <= Math.max(lat1, lat2) && lat1 != lat2) {
            let xinters = (lonUser - lon1) * (lat2 - lat1) / (lon2 - lon1) + lat1;
            if (lat1 == lat2 || latUser <= xinters) {
                inside = !inside;
            }
        }
    }
    return inside;
}

// Hàm lấy tọa độ GPS và điền vào form
function getGPSCoordinates() {
    navigator.geolocation.getCurrentPosition(function (position) {
        const latUser = position.coords.latitude;
        const lonUser = position.coords.longitude;
        
        // Định nghĩa các điểm của khu vực công ty
        const polygonPoints = [
            [16.063481, 108.156315], // Điểm phía Bắc
            [16.063281, 108.156715], // Điểm phía Đông
            [16.063081, 108.156515], // Điểm phía Nam
            [16.063281, 108.156315]  // Điểm phía Tây
        ];

        // Kiểm tra vị trí
        const isInCompany = isWithinPolygon(latUser, lonUser, polygonPoints);
        
        // Lưu tọa độ vào form
        const gpsLocation = latUser + ", " + lonUser;
        document.getElementById('gps-location').value = gpsLocation;
        document.getElementById('checkout-location').value = gpsLocation;
        
        // Lưu trạng thái vào form
        document.getElementById('is-in-company').value = isInCompany;
    }, function (error) {
        alert("Không thể lấy vị trí: " + error.message);
    });
}

// Hàm lấy thời gian hiện tại và điền vào form
function setCurrentDateTime() {
    var currentDateTime = new Date(); // Lấy thời gian hiện tại theo UTC
  
    // Chuyển thời gian hiện tại sang giờ Việt Nam (UTC +7)
    currentDateTime.setHours(currentDateTime.getHours() + 7);
  
    // Định dạng lại thời gian theo dạng ngày tháng năm giờ phút giây
    var formattedDateTime = currentDateTime.toISOString().slice(0, 19).replace('T', ' ');
  
    // Tách ngày và giờ cách nhau một chút và bỏ phần "Z"
    formattedDateTime = formattedDateTime.replace('T', ' '); // Thay "T" bằng khoảng trắng
  
    // Điền thời gian vào input
    document.getElementById('checkin-time').value = formattedDateTime; // Điền vào form
    document.getElementById('checkout-time').value = formattedDateTime;
}

// Hàm xử lý gửi form và gửi thông tin tới PHP
function submitAndRedirect(event) {
    event.preventDefault();

    var formData = new URLSearchParams();
    formData.append('gps_location', document.getElementById('gps-location').value);
    formData.append('datetime', document.getElementById('checkin-time').value);
    formData.append('is_in_company', document.getElementById('is-in-company').value);

    fetch('index.php?action=checkin', {
        method: 'POST',
        body: formData
    })
    .then(response => response.text())
    .then(data => {
        alert(data);
        if(data === 'Check-in thành công!') {
            window.location.reload();
        }
    })
    .catch(error => console.error('Error:', error));
}

// Gọi hàm lấy GPS và thời gian khi trang được tải
window.onload = function() {
    getGPSCoordinates();
    setCurrentDateTime();
};   

// Thêm code để xử lý chuyển đổi tab
document.getElementById('checkin-tab').addEventListener('click', function() {
    document.getElementById('checkin-form').style.display = 'block';
    document.getElementById('checkout-form').style.display = 'none';
    this.classList.add('bg-green-500', 'text-white');
    this.classList.remove('bg-gray-300', 'text-gray-800');
    document.getElementById('checkout-tab').classList.add('bg-gray-300', 'text-gray-800');
    document.getElementById('checkout-tab').classList.remove('bg-red-500', 'text-white');
});

document.getElementById('checkout-tab').addEventListener('click', function() {
    document.getElementById('checkin-form').style.display = 'none';
    document.getElementById('checkout-form').style.display = 'block';
    this.classList.add('bg-red-500', 'text-white');
    this.classList.remove('bg-gray-300', 'text-gray-800');
    document.getElementById('checkin-tab').classList.add('bg-gray-300', 'text-gray-800');
    document.getElementById('checkin-tab').classList.remove('bg-green-500', 'text-white');
});

// Thêm hàm xử lý checkout
document.getElementById('checkout-form').addEventListener('submit', function(event) {
    event.preventDefault();
    
    var formData = new URLSearchParams();
    formData.append('gps_location', document.getElementById('checkout-location').value);
    formData.append('datetime', document.getElementById('checkout-time').value);

    fetch('index.php?action=checkout', {
        method: 'POST',
        body: formData
    })
    .then(response => response.text())
    .then(data => {
        alert(data);
        if(data === 'Check-out thành công!') {
            window.location.reload();
        }
    })
    .catch(error => console.error('Error:', error));
});