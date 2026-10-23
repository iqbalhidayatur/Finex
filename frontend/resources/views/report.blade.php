<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Report</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.2/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    @vite('resources/css/global.css')
    @vite('resources/css/report.css')
</head>

<body>
    <main>
        <section class="d-flex flex-row">
            <aside class="justify-content-start align-items-center flex-column ps-4 pe-4">
                @include('_sidebar')
            </aside>

            <div class="main-content">
                @include('_header')

                <div class="main">
                    <div class="report-head p-3">
                        <h2>Report</h2>
                        <p>See all your reports here</p>
                    </div>

                    <div class="d-flex justify-content-between align-items-center p-3 gap-3">
                        <div class="d-flex justify-content-start align-items-center w-100 gap-3">
                            <input type="text" class="d-flex w-100"></input>
                        </div>
                        <div class="d-flex gap-3">
                            <i class="icon-report icon bi bi-search"></i>
                            
                            <button
                                type="button"
                                class="icon-report filter-button"
                                data-bs-toggle="modal"
                                data-bs-target="#filterModal"
                            >
                                <i class="icon bi bi-filter"></i>
                            </button>
                            
                            <div class="icon-report"><i class="icon bi bi-cloud-download"></i></div>
                        </div>
                    </div>

                    <div class="d-flex p-3">
                        <div class="table-container">
                            <table class="transaction-table">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Amount</th>
                                        <th>Description</th>
                                        <th>Date</th>
                                        <th>Type</th>
                                    </tr>
                                </thead>
    
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>Rp500.000</td>
                                        <td>Gaji bulanan</td>
                                        <td>23/10/2026</td>
                                        <td>
                                            <span class="type income">Income</span>
                                        </td>
                                    </tr>
    
                                    <tr>
                                        <td>2</td>
                                        <td>Rp75.000</td>
                                        <td>Makan siang</td>
                                        <td>23/10/2026</td>
                                        <td>
                                            <span class="type outcome">Outcome</span>
                                        </td>
                                    </tr>
    
                                    <tr>
                                        <td>3</td>
                                        <td>Rp150.000</td>
                                        <td>Freelance project</td>
                                        <td>22/10/2026</td>
                                        <td>
                                            <span class="type income">Income</span>
                                        </td>
                                    </tr>
    
                                    <tr>
                                        <td>4</td>
                                        <td>Rp50.000</td>
                                        <td>Transportasi</td>
                                        <td>22/10/2026</td>
                                        <td>
                                            <span class="type outcome">Outcome</span>
                                        </td>
                                    </tr>
    
                                    <tr>
                                        <td>5</td>
                                        <td>Rp200.000</td>
                                        <td>Belanja bulanan</td>
                                        <td>21/10/2026</td>
                                        <td>
                                            <span class="type outcome">Outcome</span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </section>
    </main>

    <div class="modal fade" id="filterModal" tabindex="-1"
        aria-labelledby="filterModalLabel" aria-hidden="true">

        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content filter-modal">

                <div class="modal-header">
                    <div>
                        <h2 class="modal-title" id="filterModalLabel">
                            Filter
                        </h2>
                        <p class="mb-0">Filter your transactions</p>
                    </div>

                    <button type="button" class="btn-close"
                        data-bs-dismiss="modal" aria-label="Close">
                    </button>
                </div>

                <div class="modal-body">
                    <form action="{{ url('/report') }}" method="GET">

                        <div class="filter-group">
                            <label for="type">Transaction Type</label>
                            <select name="type" id="type" class="form-select">
                                <option value="">All Types</option>
                                <option value="income">Income</option>
                                <option value="outcome">Outcome</option>
                            </select>
                        </div>

                        <div class="row">
                            <div class="col-6 filter-group">
                                <label for="start_date">Start Date</label>
                                <input type="date" name="start_date"
                                    id="start_date" class="form-control">
                            </div>

                            <div class="col-6 filter-group">
                                <label for="end_date">End Date</label>
                                <input type="date" name="end_date"
                                    id="end_date" class="form-control">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-6 filter-group">
                                <label for="min_amount">Minimum Amount</label>
                                <input type="number" name="min_amount"
                                    id="min_amount" class="form-control"
                                    placeholder="Rp0" min="0">
                            </div>

                            <div class="col-6 filter-group">
                                <label for="max_amount">Maximum Amount</label>
                                <input type="number" name="max_amount"
                                    id="max_amount" class="form-control"
                                    placeholder="Rp1.000.000" min="0">
                            </div>
                        </div>

                        <div class="filter-actions">
                            <a href="{{ url('/report') }}" class="btn-reset">
                                Reset
                            </a>

                            <button type="submit" class="btn-apply">
                                Apply Filter
                            </button>
                        </div>

                    </form>
                </div>

            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>