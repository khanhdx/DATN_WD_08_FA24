var mostOrderedProductChart;
var mostOrderedProductCtx = document
    .getElementById("mostOrderedProductChart")
    .getContext("2d");

function initMostOrderChart(labels, data) {
    if (mostOrderedProductChart) {
        mostOrderedProductChart.destroy();
    }

    mostOrderedProductChart = new Chart(mostOrderedProductCtx, {
        type: "bar",
        data: {
            labels: labels,
            datasets: [
                {
                    label: "Top sản phẩm bán chạy nhất",
                    data: data,
                    borderColor: "rgba(54, 162, 235, 1)",
                    backgroundColor: "rgba(54, 162, 235, 0.2)",
                    fill: true,
                },
            ],
        },
        options: {
            scales: {
                x: { title: { display: true, text: "Tên sản phẩm" } },
                y: {
                    beginAtZero: true,
                    title: { display: true, text: "Số lượng bán ra" },
                },
            },
        },
    });
}

function updateMostOrderChart(startDate = null, endDate = null) {
    let url = `/api/top10-most-orders`;

    fetch(url)
        .then((response) => response.json())
        .then((data) => {
            console.log(data);

            let labels = data.map((item) => item.productName);
            let values = data.map((item) => item.total_quantity);
            initMostOrderChart(labels, values);
        })
        .catch((error) => console.log("Error", error));
}

updateMostOrderChart();

// Số lượng sản phẩn
let currentPage = 1;

async function fetchInventoryData(page = 1) {
    const response = await fetch(`/api/inventory?page=${page}`);
    return response.json();
}

function renderInventoryTable(data) {
    const tableBody = document.getElementById("inventoryTableBody");
    tableBody.innerHTML = ""; // Xóa nội dung cũ

    let rowIndex = (data.current_page - 1) * data.per_page;

    data.data.forEach((product) => {
        rowIndex++;
        const row = `<tr>
                <td>${rowIndex}</td>
                <td>${product.name}</td>
                <td>${product.base_stock}</td>
            </tr>`;
        tableBody.innerHTML += row;
    });
}

function renderPagination(data) {
    const pagination = document.getElementById("pagination");
    pagination.innerHTML = "";

    // Nút "Previous"
    if (data.prev_page_url) {
        pagination.innerHTML += `<li class="page-item">
            <a class="page-link" href="#" onclick="updateInventoryTable(${
                data.current_page - 1
            }, event)">Trước</a>
        </li>`;
    } else {
        pagination.innerHTML += `<li class="page-item disabled">
            <span class="page-link">Trước</span>
        </li>`;
    }

    // Các số trang
    for (let i = 1; i <= data.last_page; i++) {
        pagination.innerHTML += `<li class="page-item ${
            i === data.current_page ? "active" : ""
        }">
            <a class="page-link" href="#" onclick="updateInventoryTable(${i}, event)">${i}</a>
        </li>`;
    }

    // Nút "Next"
    if (data.next_page_url) {
        pagination.innerHTML += `<li class="page-item">
            <a class="page-link" href="#" onclick="updateInventoryTable(${
                data.current_page + 1
            },event)">Sau</a>
        </li>`;
    } else {
        pagination.innerHTML += `<li class="page-item disabled">
            <span class="page-link">Sau</span>
        </li>`;
    }
}

function updateInventoryTable(page = 1, event = null) {
    if (event) {
        event.preventDefault();
    }

    fetchInventoryData(page)
        .then((data) => {
            renderInventoryTable(data);
            renderPagination(data);
        })
        .catch((error) => console.log("Error", error));
}

updateInventoryTable(currentPage);
