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
                    borderColor: "rgba(75, 192, 192, 1)",
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderWidth: 2,
                    fill: true,
                },
            ],
        },
        options: {
            scales: {
                x: { title: { display: true, text: 'Thời gian' } },
                y: {
                    beginAtZero: true,
                    title: { display: true, text: 'Doanh thu (VNĐ)' },
                },
            },
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