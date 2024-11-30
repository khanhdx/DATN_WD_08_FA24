var orderChart;

// Khởi tạo biểu đồ trống
function initOrderChart(labels, data) {
    if (orderChart) {
        orderChart.destroy();
    }

    var ctx = document.getElementById("orderChart").getContext("2d");
    orderChart = new Chart(ctx, {
        type: "bar",
        data: {
            labels: labels,
            datasets: [
                {
                    label: "Đơn hàng",
                    data: data,
                    borderColor: "rgba(75, 192, 192, 1)",
                    backgroundColor: "rgba(75, 192, 192, 0.2)",
                    borderWidth: 2,
                    fill: true,
                },
            ],
        },
        options: {
            scales: {
                x: {
                    title: {
                        display: true,
                        text: "Thời gian",
                    },
                },
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: "Đơn hàng",
                    },
                },
            },
        },
    });
}

function updateOrderChartByDateRange(startDate = null, endDate = null) {
    let url = `/api/order`;
    if (startDate && endDate) {
        url += `?start_date=${startDate}&end_date=${endDate}`;
    }

    fetch(url)
        .then(response => response.json())
        .then(data => {
            let labels = data.map(item => item.date);
            let values = data.map(item => item.count);
            initOrderChart(labels, values);
        })
        .catch(error => console.log('Error', error));
}

document.getElementById('updateOrderChartButton').addEventListener('click', function() {
    const startDate = document.getElementById('startOrderDate').value;
    const endDate = document.getElementById('endOrderDate').value;
    updateOrderChartByDateRange(startDate, endDate);
});


updateOrderChartByDateRange();


async function fetchOrderStatusData() {
    try {
        const response = await fetch('/api/order-by-status');
        const orderStatusData = await response.json();

        // Chuẩn bị dữ liệu cho biểu đồ
        const labels = orderStatusData.map(item => item.name_status);
        const data = orderStatusData.map(item => item.total);

        // Vẽ biểu đồ hình tròn
        const ctx = document.getElementById('orderStatusPieChart').getContext('2d');
        const orderStatusPieChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Số lượng đơn hàng',
                    data: data,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
            }
        });
    } catch (error) {
        console.error("Error fetching order status data:", error);
    }
}

fetchOrderStatusData();
