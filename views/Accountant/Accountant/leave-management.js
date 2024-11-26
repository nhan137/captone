// Thêm function để toggle sidebar
function toggleSidebar() {
  const sidebar = document.querySelector(".sidebar");
  const mainContent = document.querySelector(".main-content");

  // Toggle class 'collapsed' cho sidebar
  sidebar.classList.toggle("collapsed");

  // Toggle class 'expanded' cho main content
  mainContent.classList.toggle("expanded");
}

// Thêm event listener cho menu icon
document.addEventListener("DOMContentLoaded", function () {
  const menuIcon = document.querySelector(".menu-icon");
  menuIcon.addEventListener("click", toggleSidebar);
});

let currentPage = 1;
const itemsPerPage = 50;
let totalItems = 0; // Sẽ được cập nhật từ dữ liệu thực tế

function updatePagination() {
  const startItem = (currentPage - 1) * itemsPerPage + 1;
  const endItem = Math.min(currentPage * itemsPerPage, totalItems);

  // Cập nhật text hiển thị
  document.querySelector(".pagination").innerHTML = `
        Từ ${startItem} đến ${endItem} bản ghi
        <span class="pagination-arrows">
            <span class="pagination-arrow ${
              currentPage === 1 ? "disabled" : ""
            }" 
                  onclick="changePage('prev')">＜</span>
            <span class="pagination-arrow ${
              endItem >= totalItems ? "disabled" : ""
            }" 
                  onclick="changePage('next')">＞</span>
        </span>
    `;
}

function changePage(direction) {
  if (direction === "prev" && currentPage > 1) {
    currentPage--;
  } else if (direction === "next" && currentPage * itemsPerPage < totalItems) {
    currentPage++;
  }

  // Gọi API hoặc lọc dữ liệu để lấy items cho trang mới
  fetchPageData(currentPage);
  updatePagination();
}

function fetchPageData(page) {
  // Giả sử đây là hàm gọi API của bạn
  // Thay thế bằng API thực tế của bạn
  fetch(`/api/leave-requests?page=${page}&limit=${itemsPerPage}`)
    .then((response) => response.json())
    .then((data) => {
      totalItems = data.total; // Cập nhật tổng số items
      // Cập nhật bảng với dữ liệu mới
      updateTable(data.items);
      updatePagination();
    });
}

function updateTable(items) {
  const tbody = document.querySelector(".leave-table tbody");
  tbody.innerHTML = items
    .map(
      (item) => `
        <tr>
            <td>${item.employeeId}</td>
            <td>${item.employeeName}</td>
            <td>${item.startDate}</td>
            <td>${item.endDate}</td>
            <td>${item.days}</td>
            <td>${item.reason}</td>
            <td>${item.leaveType}</td>
            <td>${item.approver}</td>
            <td>${item.status}</td>
            <td>${item.notes}</td>
        </tr>
    `
    )
    .join("");
}

document.addEventListener("DOMContentLoaded", function () {
  const itemsPerPage = 50; // Số bản ghi trên mỗi trang
  const table = document.querySelector(".leave-table");
  const tbody = table.querySelector("tbody");
  const rows = tbody.querySelectorAll("tr");
  const totalPages = Math.ceil(rows.length / itemsPerPage);
  let currentPage = 1;

  // Cập nhật text hiển thị số bản ghi
  const updatePaginationText = () => {
    const start = (currentPage - 1) * itemsPerPage + 1;
    const end = Math.min(currentPage * itemsPerPage, rows.length);
    const paginationText = document.querySelector(".pagination");
    paginationText.textContent = `Từ ${start} đến ${end} trong tổng số ${rows.length} bản ghi`;
  };

  // Hiển thị các bản ghi của trang hiện tại
  const showPage = (page) => {
    const start = (page - 1) * itemsPerPage;
    const end = start + itemsPerPage;

    rows.forEach((row, index) => {
      if (index >= start && index < end) {
        row.style.display = "";
      } else {
        row.style.display = "none";
      }
    });

    updatePaginationText();
  };

  // Xử lý sự kiện click nút Previous
  document
    .querySelector(".pagination-arrow:first-child")
    .addEventListener("click", () => {
      if (currentPage > 1) {
        currentPage--;
        showPage(currentPage);
      }
    });

  // Xử lý sự kiện click nút Next
  document
    .querySelector(".pagination-arrow:last-child")
    .addEventListener("click", () => {
      if (currentPage < totalPages) {
        currentPage++;
        showPage(currentPage);
      }
    });

  // Hiển thị trang đầu tiên khi load trang
  showPage(1);
});

document.addEventListener("DOMContentLoaded", function () {
  const itemsPerPage = 50;
  const table = document.querySelector(".leave-table");
  const tbody = table.querySelector("tbody");
  const rows = Array.from(tbody.querySelectorAll("tr"));

  // Các elements điều hướng
  const prevBtn = document.getElementById("prev-btn");
  const nextBtn = document.getElementById("next-btn");
  const currentPageSpan = document.getElementById("current-page");
  const totalRecordsSpan = document.getElementById("total-records");

  let currentPage = 1;
  const totalPages = Math.ceil(rows.length / itemsPerPage);

  // Cập nhật tổng số bản ghi
  totalRecordsSpan.textContent = rows.length;

  function showPage(page) {
    // Tính toán range của các bản ghi cần hiển thị
    const start = (page - 1) * itemsPerPage;
    const end = start + itemsPerPage;

    // Ẩn tất cả các rows
    rows.forEach((row) => (row.style.display = "none"));

    // Hiển thị các rows của trang hiện tại
    rows.slice(start, end).forEach((row) => (row.style.display = ""));

    // Cập nhật số trang hiện tại
    currentPageSpan.textContent = page;

    // Cập nhật trạng thái các nút
    prevBtn.disabled = page === 1;
    nextBtn.disabled = page === totalPages;

    // Cập nhật thông tin hiển thị
    const paginationInfo = document.querySelector(".pagination-info");
    paginationInfo.textContent = `Hiển thị từ ${start + 1} đến ${Math.min(
      end,
      rows.length
    )} trong tổng số ${rows.length} bản ghi`;
  }

  // Xử lý sự kiện click nút Previous
  prevBtn.addEventListener("click", () => {
    if (currentPage > 1) {
      currentPage--;
      showPage(currentPage);
    }
  });

  // Xử lý sự kiện click nút Next
  nextBtn.addEventListener("click", () => {
    if (currentPage < totalPages) {
      currentPage++;
      showPage(currentPage);
    }
  });

  // Hiển thị trang đầu tiên khi load
  showPage(1);
});
