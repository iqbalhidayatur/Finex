<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.2/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    @vite('resources/css/global.css')
    @vite('resources/css/analytics.css')
</head>

<body>
    <main>
        <section class="d-flex flex-row">
            <aside class="justify-content-start align-items-center flex-column ps-4 pe-4">
                @include('_sidebar')
            </aside>

            <div class="main-content">
                @include('_header')

                <div class="main d-flex flex-column gap-3">

                    <div class="chart-card">
                        <div class="chart-header">
                            <div>
                                <h2>Overall Chart</h2>
                                <p>Perbandingan pemasukan dan pengeluaran</p>
                            </div>

                            <select id="analyticsRange">
                                <option value="7">7 Hari Terakhir</option>
                                <option value="30" selected>30 Hari Terakhir</option>
                                <option value="month">Bulan Ini</option>
                                <option value="all">Semua Data</option>
                            </select>
                        </div>

                        <div class="chart-container">
                            <canvas id="analyticsChart"></canvas>
                        </div>
                    </div>

                    <div class="d-flex w-100 gap-3">
                        <div class="d-flex w-100">

                            <div class="chart-card donut-card">
                                <div class="chart-header">
                                    <div>
                                        <h2>Transaction Distribution</h2>
                                        <p>Distribusi transaksi berdasarkan kategori</p>
                                    </div>

                                    <select id="donutType">
                                        <option value="income">Income</option>
                                        <option value="outcome">Outcome</option>
                                    </select>
                                </div>

                                <div class="donut-container">
                                    <div class="donut-chart-wrapper">
                                        <canvas id="analyticsDonutChart"></canvas>
                                    </div>

                                    <div class="donut-summary">
                                        <p id="donutTotalLabel">Total Income</p>
                                        <h3 id="donutTotal">Rp 0</h3>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="d-flex w-100">
                            <div class="chart-card top-spending-card">
                                <div class="chart-header">
                                    <div>
                                        <h3>Top Spending Categories</h3>
                                        <p>Kategori dengan total pengeluaran terbesar</p>
                                    </div>
                                </div>

                                <div class="top-spending-container">
                                    <canvas id="topSpendingChart"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>
    </main>

    <script id="analyticsData" type="application/json">
        @json($transactions)
    </script>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    @vite('resources/js/analytics.js')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>