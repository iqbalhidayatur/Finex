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
    @vite('resources/css/dashboard.css')
</head>
<body>
    <main>
        <section class="d-flex flex-row">
            <aside class="justify-content-start align-items-center flex-column ps-4 pe-4">
                @include('_sidebar')
            </aside>

            <div class="main-content">
                @include('_header')

                <div class="main gap-3 d-flex flex-column">
                    <div class="dashboard d-flex justify-content-between align-items-center flex-row">
                        <div class="dashboard-head">
                            <h2>Dashboard</h2>
                            <p>See your finance resume here</p>
                        </div>
                        <div class="dashboard-btn d-flex flex-row gap-2">
                            <div class="btn-dashboard btn-add"><i class="bi bi-plus"></i></div>
                            <div class="btn-dashboard btn-out"><i class="bi bi-dash"></i></div>
                        </div>
                    </div>

                    <div class="d-flex flex-row gap-2">
                        <div class="balance card w-100">
                            <h2>Balances</h2>
                            <p>Check your overall balances here</p>
                            <h1>2.000.000.000</h1>
                        </div>

                        <div class="savings card w-100 d-flex flex-column">
                            <h2>Saving Goals</h2>
                            <p>Your saving goals here</p>
                            <progress value="80%">80%</progress>
                            <div class="target d-flex w-100 justify-content-end">
                                <p>-5.000.000</p>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex flex-row gap-2">
                        <div class="card monthly-stat w-100">
                            <h2>Monthly Statistic</h2>
                            <p>See your statistic based on latest data here</p>
                        </div>

                        <div class="card recent-act d-flex w-100">
                            <div class="d-flex justify-content-between align-items-center w-100">
                                <div>
                                    <h2>Recent Activity</h2>
                                    <p>See your recent activity here</p>
                                </div>
                                <i class="bi bi-arrow-right-circle"></i>
                            </div>
                        </div>
                    </div>

                    <div class="wallet">
                        <div class="card wallet-card">
                            <h2>Wallet 1</h2>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                            <h1>2.000.000</h1>
                        </div>
                        
                        <div class="card wallet-card">
                            <h2>Wallet 1</h2>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                            <h1>2.000.000</h1>
                        </div>

                        <div class="card wallet-card">
                            <h2>Wallet 1</h2>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                            <h1>2.000.000</h1>
                        </div>

                        <div class="card wallet-card">
                            <h2>Wallet 1</h2>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                            <h1>2.000.000</h1>
                        </div>

                    </div>

                </div>
            </div>
        </section>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>