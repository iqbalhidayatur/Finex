const chartCanvas = document.getElementById("transactionChart");
const rangeSelect = document.getElementById("chartRange");

if (chartCanvas && rangeSelect) {
    const transactions = JSON.parse(
        document.getElementById("transactionData").textContent,
    );

    const latestDate = transactions.reduce((latest, transaction) => {
        return transaction.date > latest ? transaction.date : latest;
    }, "0000-00-00");

    function getLocalDate(dateString) {
        const [year, month, day] = dateString.split("-").map(Number);
        return new Date(year, month - 1, day);
    }

    function renderChart() {
        const range = rangeSelect.value;
        const referenceDate = getLocalDate(latestDate);
        let startDate = null;

        if (range === "7" || range === "30") {
            startDate = new Date(referenceDate);
            startDate.setDate(startDate.getDate() - Number(range) + 1);
        } else if (range === "month") {
            startDate = new Date(
                referenceDate.getFullYear(),
                referenceDate.getMonth(),
                1,
            );
        }

        const filteredTransactions = transactions.filter((transaction) => {
            const date = getLocalDate(transaction.date);

            return !startDate || (date >= startDate && date <= referenceDate);
        });

        const groupedData = {};

        filteredTransactions.forEach((transaction) => {
            const date = transaction.date;

            if (!groupedData[date]) {
                groupedData[date] = {
                    income: 0,
                    outcome: 0,
                };
            }

            if (transaction.type === "income") {
                groupedData[date].income += Number(transaction.amount);
            } else if (transaction.type === "outcome") {
                groupedData[date].outcome += Number(transaction.amount);
            }
        });

        const labels = Object.keys(groupedData).sort();

        const incomeData = labels.map((date) => groupedData[date].income);
        const outcomeData = labels.map((date) => groupedData[date].outcome);

        if (window.transactionChartInstance) {
            window.transactionChartInstance.destroy();
        }

        window.transactionChartInstance = new Chart(chartCanvas, {
            type: "bar",
            data: {
                labels: labels.map((date) =>
                    getLocalDate(date).toLocaleDateString("id-ID", {
                        day: "2-digit",
                        month: "short",
                    }),
                ),
                datasets: [
                    {
                        label: "Income",
                        data: incomeData,
                        backgroundColor: "#16a34a",
                        borderRadius: 5,
                        maxBarThickness: 30,
                    },
                    {
                        label: "Outcome",
                        data: outcomeData,
                        backgroundColor: "#dc2626",
                        borderRadius: 5,
                        maxBarThickness: 30,
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
