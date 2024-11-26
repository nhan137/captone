// Hàm lấy tọa độ GPS và điền vào form
function getGPSCoordinates() {
    navigator.geolocation.getCurrentPosition(function (position) {
      var gpsLocation = position.coords.latitude + ", " + position.coords.longitude;
      document.getElementById('gps-location').value = gpsLocation; // Điền GPS vào input
      document.getElementById('checkout-location').value = gpsLocation;
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