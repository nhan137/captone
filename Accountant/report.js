function toggleSelectAll(checkbox) {
  // Nếu là checkbox ở header
  if (checkbox.parentElement.tagName === "TH") {
    const checkboxes = document.getElementsByClassName("employee-checkbox");
    for (let item of checkboxes) {
      item.checked = checkbox.checked;
      highlightRow(item);
    }
  } else {
    // Nếu là checkbox của từng hàng
    highlightRow(checkbox);

    // Kiểm tra xem có nên bỏ chọn checkbox "select all" không
    const allCheckboxes = document.getElementsByClassName("employee-checkbox");
    const headerCheckbox = document.querySelector(
      'thead input[type="checkbox"]'
    );
    let allChecked = true;

    for (let item of allCheckboxes) {
      if (!item.checked) {
        allChecked = false;
        break;
      }
    }
    headerCheckbox.checked = allChecked;
  }
}

function highlightRow(checkbox) {
  const row = checkbox.closest("tr");
  if (checkbox.checked) {
    row.classList.add("selected-row");
  } else {
    row.classList.remove("selected-row");
  }
}
// Thêm hàm xử lý chuyển tab
function switchTab(tabName) {
  // Bỏ active tất cả các tab
  const tabs = document.querySelectorAll(".tab");
  tabs.forEach((tab) => tab.classList.remove("active"));

  // Active tab được chọn
  const selectedTab = document.querySelector(`.tab[data-tab="${tabName}"]`);
  if (selectedTab) selectedTab.classList.add("active");

  // Ẩn tất cả nội dung tab
  const contents = document.querySelectorAll(".tab-content");
  contents.forEach((content) => (content.style.display = "none"));

  // Hiện nội dung tab được chọn
  const selectedContent = document.getElementById(`${tabName}Content`);
  if (selectedContent) selectedContent.style.display = "block";
}

// Hàm hiển thị chi tiết nhân viên
function showEmployeeDetail(employeeId) {
  // Giả lập dữ liệu nhân viên (trong thực tế sẽ lấy từ API/database)
  const employeeData = {
    NV002: {
      name: "Nguyễn Văn B",
      department: "IT",
      position: "Developer",
      email: "nguyenvanb@company.com",
      phone: "0987654321",
    },
    // Thêm data cho các nhân viên khác...
  };

  const employee = employeeData[employeeId];
  if (employee) {
    // Tạo nội dung popup
    const popupContent = `
      <div class="employee-detail-popup">
        <h3>Employee Details</h3>
        <p><strong>ID:</strong> ${employeeId}</p>
        <p><strong>Name:</strong> ${employee.name}</p>
        <p><strong>Department:</strong> ${employee.department}</p>
        <p><strong>Position:</strong> ${employee.position}</p>
        <p><strong>Email:</strong> ${employee.email}</p>
        <p><strong>Phone:</strong> ${employee.phone}</p>
      </div>
    `;

    // Tạo và hiển thị popup
    const popup = document.createElement("div");
    popup.className = "popup";
    popup.innerHTML = popupContent;

    // Thêm nút đóng
    const closeButton = document.createElement("button");
    closeButton.innerHTML = "×";
    closeButton.className = "close-button";
    closeButton.onclick = () => popup.remove();
    popup.querySelector(".employee-detail-popup").appendChild(closeButton);

    document.body.appendChild(popup);

    // Click bên ngoài để đóng popup
    popup.onclick = (e) => {
      if (e.target === popup) {
        popup.remove();
      }
    };
  }
}
