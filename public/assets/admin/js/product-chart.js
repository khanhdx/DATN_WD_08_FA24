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
                    borderColor: "rgba(75, 192, 192, 1)",
                    backgroundColor: "rgba(75, 192, 192, 0.2)",
                    borderWidth: 2,
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
var inventoryChart;
var Ctx = document.getElementById("inventoryChart").getContext("2d");

function initInventoryChart(labels, datasets) {
    if (inventoryChart) {
        inventoryChart.destroy();
    }

    inventoryChart = new Chart(Ctx, {
        type: "bar",
        data: {
            labels: labels,
            datasets: datasets,
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: "top",
                },
            },
            scales: {
                x: {
                    title: { display: true, text: "Tên sản phẩm" },
                    stacked: true,
                },
                y: {
                    beginAtZero: true,
                    title: { display: true, text: "Số lượng tồn kho" },
                    stacked: true,
                },
            },
        },
    });
}

async function fetchInventoryData() {
    const response = await fetch("/api/inventory");
    return response.json();
}

function updateInventoryChart() {
    fetchInventoryData()
        .then((data) => {
            const labels = data.map((item) => item.name);

            const datasets = [];


            // Dữ liệu biến thể của từng sản phẩm
            data.forEach((product, index) => {
                product.variants.forEach((variant, variantIndex) => {
                    datasets.push({
                        label: `${product.name} - ${variant.color} - ${variant.size}`,
                        data: data.map((item, i) =>
                            i === index ? variant.quantity : 0
                        ),
                        backgroundColor: `${variant.code_color}`,
                        datalabels: { display: false },
                    });
                });
            });

            initInventoryChart(labels, datasets);
        })
        .catch((error) => console.log("Error", error));
}

updateInventoryChart();
