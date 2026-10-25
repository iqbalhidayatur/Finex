const canvas = document.getElementById("analyticsChart");
const rangeSelect = document.getElementById("analyticsRange");
const dataElement = document.getElementById("analyticsData");

if (canvas && rangeSelect && dataElement) {
    const transactions = JSON.parse(dataElement.textContent);

    function parseDate(value) {
        const [year, month, day] = value.split("-").map(Number);
        return new Date(year, month - 1, day);
    }

    function formatDate(date) {
        const year = date.getFullYear();
        const month = String(date.getMonth() + 1).padStart(2, "0");
        const day = String(date.getDate()).padStart(2, "0");

        return `${year}-${month}-${day}`;
    }

    function renderChart() {
        if (transactions.length === 0) {
            if (window.analyticsChartInstance) {
                window.analyticsChartInstance.destroy();
                window.analyticsChartInstance = null;
            }
            return;
        }

        const dates = transactions.map((item) => item.date).sort();
        const latestDate = parseDate(dates[dates.length - 1]);
        const range = rangeSelect.value;

        let startDate;

        if (range === "7" || range === "30") {
            startDate = new Date(latestDate);
            startDate.setDate(startDate.getDate() - Number(range) + 1);
        } else if (range === "month") {
            startDate = new Date(
                latestDate.getFullYear(),
                latestDate.getMonth(),
                1,
            );
        } else {
            startDate = parseDate(dates[0]);
        }

        const labels = [];
        const incomeData = [];
        const outcomeData = [];

        for (
            let date = new Date(startDate);
            date <= latestDate;
            date.setDate(date.getDate() + 1)
        ) {
            const dateString = formatDate(date);

            labels.push(dateString);

            const dailyTransactions = transactions.filter(
                (item) => item.date === dateString,
            );

            incomeData.push(
                dailyTransactions
                    .filter((item) => item.type === "income")
                    .reduce((total, item) => total + Number(item.amount), 0),
            );

            outcomeData.push(
                dailyTransactions
                    .filter((item) => item.type === "outcome")
                    .reduce((total, item) => total + Number(item.amount), 0),
            );
        }

        if (window.analyticsChartInstance) {
            window.analyticsChartInstance.destroy();
        }

        window.analyticsChartInstance = new Chart(canvas, {
            type: "line",

            data: {
                labels: labels.map((date) =>
                    parseDate(date).toLocaleDateString("id-ID", {
                        day: "2-digit",
                        month: "short",
                    }),
                ),

                datasets: [
                    {
                        label: "Income",
                        data: incomeData,
                        borderColor: "#16a34a",
                        backgroundColor: "#16a34a",
                        borderWidth: 2,
                        pointRadius: 3,
                        pointHoverRadius: 6,
                        tension: 0.3,
                    },
                    {
                        label: "Outcome",
                        data: outcomeData,
                        borderColor: "#dc2626",
                        backgroundColor: "#dc2626",
                        borderWidth: 2,
                        pointRadius: 3,
                        pointHoverRadius: 6,
                        tension: 0.3,
                    },
                ],
            },

            options: {
                responsive: true,
                maintainAspectRatio: false,

                interaction: {
                    mode: "index",
                    intersect: false,
                },

                plugins: {
                    legend: {
                        position: "top",
                        align: "end",
                    },

                    tooltip: {
                        callbacks: {
                            label(context) {
                                return `${context.dataset.label}: Rp ${new Intl.NumberFormat(
                                    "id-ID",
                                ).format(context.raw)}`;
                            },
                        },
                    },
                },

                scales: {
                    x: {
                        grid: {
                            display: false,
                        },
                    },

                    y: {
                        beginAtZero: true,

                        ticks: {
                            callback(value) {
                                return (
                                    "Rp " +
                                    new Intl.NumberFormat("id-ID", {
                                        notation: "compact",
                                        maximumFractionDigits: 1,
                                    }).format(value)
                                );
                            },
                        },
                    },
                },
            },
        });
    }

    rangeSelect.addEventListener("change", renderChart);

    renderChart();
}


const donutCanvas = document.getElementById("analyticsDonutChart");
const donutType = document.getElementById("donutType");

if (donutCanvas && donutType && rangeSelect && dataElement) {
    const transactions = JSON.parse(dataElement.textContent);

    const currencyFormatter = new Intl.NumberFormat("id-ID", {
        style: "currency",
        currency: "IDR",
        maximumFractionDigits: 0,
    });

    const categoryColors = [
        "#16a34a",
        "#2563eb",
        "#f59e0b",
        "#9333ea",
        "#0891b2",
        "#e11d48",
        "#64748b",
        "#ca8a04",
        "#0d9488",
        "#7c3aed",
    ];

    function parseDate(value) {
        const [year, month, day] = value.split("-").map(Number);
        return new Date(year, month - 1, day);
    }

    function getFilteredTransactions() {
        const dates = transactions.map((item) => item.date).sort();

        if (!dates.length) return [];

        const latestDate = parseDate(dates[dates.length - 1]);
        const range = rangeSelect.value;

        if (range === "all") return transactions;

        let startDate = new Date(latestDate);

        if (range === "7" || range === "30") {
            startDate.setDate(startDate.getDate() - Number(range) + 1);
        } else if (range === "month") {
            startDate = new Date(
                latestDate.getFullYear(),
                latestDate.getMonth(),
                1,
            );
        }

        return transactions.filter((item) => {
            const date = parseDate(item.date);
            return date >= startDate && date <= latestDate;
        });
    }

    function renderDonutChart() {
        const selectedType = donutType.value;

        const filteredTransactions = getFilteredTransactions().filter(
            (item) => item.type === selectedType,
        );

        const grouped = {};

        filteredTransactions.forEach((item) => {
            const category = item.category || "other";

            grouped[category] = (grouped[category] || 0) + Number(item.amount);
        });

        const labels = Object.keys(grouped);
        const values = labels.map((category) => grouped[category]);

        const total = values.reduce((sum, value) => sum + value, 0);

        document.getElementById("donutTotalLabel").textContent =
            selectedType === "income" ? "Total Income" : "Total Outcome";

        document.getElementById("donutTotal").textContent =
            currencyFormatter.format(total);

        if (window.analyticsDonutInstance) {
            window.analyticsDonutInstance.destroy();
        }

        window.analyticsDonutInstance = new Chart(donutCanvas, {
            type: "doughnut",

            data: {
                labels: labels.map(
                    (category) =>
                        category.charAt(0).toUpperCase() + category.slice(1),
                ),

                datasets: [
                    {
                        data: values,
                        backgroundColor: labels.map(
                            (_, index) =>
                                categoryColors[index % categoryColors.length],
                        ),
                        borderWidth: 0,
                        hoverOffset: 8,
                    },
                ],
            },

            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: "70%",

                plugins: {
                    legend: {
                        position: "right",
                    },

                    tooltip: {
                        callbacks: {
                            label(context) {
                                const value = Number(context.raw);
                                const percentage = total
                                    ? ((value / total) * 100).toFixed(1)
                                    : 0;

                                return `${context.label}: ${currencyFormatter.format(
                                    value,
                                )} (${percentage}%)`;
                            },
                        },
                    },
                },
            },
        });
    }

    donutType.addEventListener("change", renderDonutChart);
    rangeSelect.addEventListener("change", renderDonutChart);

    renderDonutChart();
}


document.addEventListener("DOMContentLoaded", () => {
    const canvas = document.getElementById("topSpendingChart");
    const dataElement = document.getElementById("analyticsData");
    const rangeSelect = document.getElementById("analyticsRange");

    if (!canvas || !dataElement || !rangeSelect) {
        return;
    }

    const transactions = JSON.parse(dataElement.textContent);

    const categoryNames = {
        salary: "Gaji",
        freelance: "Freelance",
        "monthly expenses": "Pengeluaran Bulanan",
        groceries: "Kebutuhan Rumah",
        "food & beverage": "Makanan & Minuman",
        lifestyle: "Gaya Hidup",
        bonus: "Bonus",
        transportation: "Transportasi",
        "other income": "Pendapatan Lain",
        health: "Kesehatan",
        entertainment: "Hiburan",
        education: "Pendidikan",
        gift: "Hadiah",
        investment: "Investasi",
    };

    const formatRupiah = (amount) =>
        new Intl.NumberFormat("id-ID", {
            style: "currency",
            currency: "IDR",
            maximumFractionDigits: 0,
        }).format(amount);

    const referenceDate = transactions.reduce(
        (latest, transaction) =>
            transaction.date > latest ? transaction.date : latest,
        "0000-00-00",
    );

    function getFilteredTransactions() {
        const range = rangeSelect.value;

        return transactions.filter((transaction) => {
            if (transaction.type !== "outcome") {
                return false;
            }

            if (range === "all") {
                return true;
            }

            const transactionDate = new Date(`${transaction.date}T00:00:00`);
            const latestDate = new Date(`${referenceDate}T00:00:00`);

            if (range === "month") {
                return (
                    transactionDate.getFullYear() ===
                        latestDate.getFullYear() &&
                    transactionDate.getMonth() === latestDate.getMonth()
                );
            }

            const days = Number(range);
            const startDate = new Date(latestDate);
            startDate.setDate(startDate.getDate() - days + 1);

            return (
                transactionDate >= startDate && transactionDate <= latestDate
            );
        });
    }

    function getTopCategories() {
        const totals = {};

        getFilteredTransactions().forEach((transaction) => {
            const category = transaction.category || "other";

            totals[category] =
                (totals[category] || 0) + Number(transaction.amount);
        });

        return Object.entries(totals)
            .sort((a, b) => b[1] - a[1])
            .slice(0, 5);
    }

    const chart = new Chart(canvas, {
        type: "bar",
        data: {
            labels: [],
            datasets: [
                {
                    label: "Total Pengeluaran",
                    data: [],
                    backgroundColor: [
                        "#dc2626",
                        "#ea580c",
                        "#f59e0b",
                        "#64748b",
                        "#94a3b8",
                    ],
                    borderRadius: 6,
                    barThickness: 24,
                },
            ],
        },
        options: {
            indexAxis: "y",
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false,
                },
                tooltip: {
                    callbacks: {
                        label: (context) => formatRupiah(context.raw),
                    },
                },
            },
            scales: {
                x: {
                    beginAtZero: true,
                    ticks: {
                        callback: (value) =>
                            new Intl.NumberFormat("id-ID", {
                                notation: "compact",
                                maximumFractionDigits: 1,
                            }).format(value),
                    },
                    grid: {
                        color: "rgba(148, 163, 184, 0.15)",
                    },
                },
                y: {
                    grid: {
                        display: false,
                    },
                },
            },
        },
    });

    function updateChart() {
        const categories = getTopCategories();

        chart.data.labels = categories.map(
            ([category]) =>
                categoryNames[category] ||
                category.replace(/\b\w/g, (letter) => letter.toUpperCase()),
        );

        chart.data.datasets[0].data = categories.map(([, amount]) => amount);

        chart.update();
    }

    rangeSelect.addEventListener("change", updateChart);

    updateChart();
});
