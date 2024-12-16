var revenueChart;
var ctx = document.getElementById("revenueChart").getContext("2d");

function initChart(labels, data) {
    if (revenueChart) revenueChart.destroy();

    revenueChart = new Chart(ctx, {
        type: "line",
        data: {
            labels: labels,
            datasets: [
                {
                    label: "Doanh thu",
                    data: data,
                    backgroundColor: 'rgba(0, 204, 255, 0.2)', // Màu nền mềm mại
                    borderColor: 'rgba(0, 204, 255, 1)',
                    borderWidth: 2,
                    fill: true, // Kích hoạt phần nền
                    tension: 0.4, // Điều chỉnh độ cong của đường
                    pointRadius: 4, // Kích thước điểm dữ liệu
                    pointBackgroundColor: 'rgba(0, 204, 255, 1)',
                },
            ],
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                }
            },
            scales: {
                x: {
                    beginAtZero: true
                },
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return value.toLocaleString() + ' VND';
                        }
                    }
                }
            }
        },
    });
}


function updateChartByDateRange(startDate = null, endDate = null) {
    let url = `/api/revenue`;
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
            let values = data.map(item => item.total);
            initChart(labels, values);
        })
        .catch(error => console.log('Error', error));
}


document.addEventListener('dateRangeChange', (event) => {
    const { startDate, endDate } = event.detail;
    updateChartByDateRange(startDate, endDate);
});


updateChartByDateRange();