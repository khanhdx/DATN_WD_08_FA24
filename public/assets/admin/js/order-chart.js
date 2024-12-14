var orderChart;

function initOrderChart(labels, data) {
    if (orderChart) {
        orderChart.destroy();
    }

    const ctx = document.getElementById('orderChart').getContext('2d');
    orderChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: 'Đơn hàng',
                data: data,
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1,
            }],
        },
        options: {
            responsive: true,
            scales: {
                x: {
                    title: {
                        display: true,
                        text: 'Thời gian',
                    },
                },
                y: {
                    title: {
                        display: true,
                        text: 'Số lượng đơn hàng',
                    },
                    beginAtZero: true,
                },
            },
        },
    });
}

function updateOrderChart(startDate, endDate) {
    let url = `/api/order`;
    if (startDate && endDate) {
        url += `?start_date=${startDate}&end_date=${endDate}`;
    }

    fetch(url)
        .then(response => response.json())
        .then(data => {
            let labels = data.map((item) => {
                let date = new Date(item.date);
                return date.toLocaleDateString("vi-VN", {
                    day: "2-digit",
                    month: "2-digit",
                    year: "numeric",
                });
            });
            const values = data.map(item => item.count);
            initOrderChart(labels, values);
        })
        .catch(error => console.error('Lỗi khi tải dữ liệu biểu đồ đơn hàng:', error));
}

document.addEventListener('dateRangeChange', (event) => {
    console.log();
    
    const { startDate, endDate } = event.detail;
    updateOrderChart(startDate, endDate);
});

// Khởi tạo biểu đồ lần đầu
updateOrderChart();


let orderStatusPieChart;

async function fetchOrderStatusData(startDate = null, endDate = null) {
    let url = `/api/order-by-status`;
    if (startDate && endDate) {
        url += `?start_date=${startDate}&end_date=${endDate}`;
    }

    try {
        const response = await fetch(url);
        const data = await response.json();

        const labels = data.map(item => translateStatus(item.name_status));
        console.log(labels);
        
        const values = data.map(item => item.total);

        if (orderStatusPieChart) {
            orderStatusPieChart.destroy();
        }

        const ctx = document.getElementById('orderStatusPieChart').getContext('2d');
        orderStatusPieChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: labels,
                datasets: [{
                    data: values,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)',
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)',
                    ],
                    borderWidth: 1,
                }],
            },
        });
    } catch (error) {
        console.error('Lỗi khi tải dữ liệu biểu đồ trạng thái đơn hàng:', error);
    }
}

document.addEventListener('dateRangeChange', (event) => {
    const { startDate, endDate } = event.detail;
    fetchOrderStatusData(startDate, endDate);
});

function translateStatus(name_status) {
    switch (name_status) {
        case 'pending':
            return 'Chờ xử lý';
        case 'processing':
            return 'Đang lấy hàng';
        case 'picked':
            return 'Đã lấy hàng';
        case 'delivering':
            return 'Đang giao';
        case 'success':
            return 'Giao thành công';
        case 'failed':
            return 'Giao thất bại';
        case 'completed':
            return 'Hoàn thành';
        case 'cancel':
            return 'Hủy đơn';
        case 'canceling':
            return 'Chờ xác nhận hủy';
        case 'canceled':
            return 'Đã hủy';
        case 'refunding':
            return 'Đang hoàn trả';
        case 'refunded':
            return 'Đã hoàn trả';
        default:
            return name_status; 
    }
}

fetchOrderStatusData();
