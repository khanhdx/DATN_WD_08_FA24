var revenueChart;

// Khởi tạo biểu đồ trống
function initRevenueChart(labels, data) {
    if (revenueChart) {
        revenueChart.destroy();
    }

    var ctx = document.getElementById("revenueChart").getContext("2d");
    revenueChart = new Chart(ctx, {
        type: "line",
        data: {
            labels: labels,
            datasets: [
                {
                    label: "Doanh thu",
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
                        text: "Doanh thu (VNĐ)",
                    },
                },
            },
        },
    });
}

function updateRevenueChart(type) {
    fetch(`/api/revenue?type=${type}`)
        .then((response) => response.json())
        .then((data) => {
            let labels = data.map(
                (item) => item.date || item.month || item.day
            );
            let values = data.map((item) => item.total);
            initRevenueChart(labels, values);
        })
        .catch((error) => console.log("Error", error));
}

document.getElementById("timeSelect").addEventListener("change", function () {
    updateRevenueChart(this.value);
});

updateRevenueChart("day");
