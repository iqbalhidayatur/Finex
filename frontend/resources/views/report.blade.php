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

                    @if (session('success'))
                        <div class="alert alert-success mx-3">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="alert alert-danger mx-3">
                            {{ session('error') }}
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger mx-3">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    {{-- table --}}

                    <div class="d-flex p-3">
                        
                        <div class="transaction-table">
                            <h2>Recent Transactions</h2>

                            <div class="table-responsive">
                                <table>
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Date</th>
                                            <th>Description</th>
                                            <th>Category</th>
                                            <th>Type</th>
                                            <th>Amount</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @forelse ($transactions as $transaction)
                                            <tr>
                                                <td>{{ $transaction['id'] }}</td>

                                                <td>
                                                    {{ \Carbon\Carbon::parse($transaction['date'])->format('d M Y') }}
                                                </td>

                                                <td>{{ $transaction['description'] }}</td>

                                                <td>{{ ucwords($transaction['category']) }}</td>

                                                <td>
                                                    <span class="badge {{ $transaction['type'] === 'income' ? 'income' : 'outcome' }}">
                                                        {{ ucfirst($transaction['type']) }}
                                                    </span>
                                                </td>

                                                <td class="{{ $transaction['type'] === 'income' ? 'amount-income' : 'amount-outcome' }}">
                                                    {{ $transaction['type'] === 'income' ? '+' : '-' }}Rp{{ number_format($transaction['amount'], 0, ',', '.') }}
                                                </td>
                                                <td>
                                                    <button
                                                        type="button"
                                                        class="btn btn-sm btn-outline-primary"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#editTransactionModal"
                                                        data-id="{{ $transaction['id'] }}"
                                                        data-date="{{ $transaction['date'] }}"
                                                        data-description="{{ $transaction['description'] }}"
                                                        data-category="{{ $transaction['category'] }}"
                                                        data-type="{{ $transaction['type'] }}"
                                                        data-amount="{{ $transaction['amount'] }}"
                                                    >
                                                        <i class="bi bi-pencil-square"></i> Edit
                                                    </button>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="6">Belum ada transaksi.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
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

    <div class="modal fade" id="editTransactionModal" tabindex="-1"
        aria-labelledby="editTransactionModalLabel" aria-hidden="true">

        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content filter-modal">

                <div class="modal-header">
                    <div>
                        <h2 class="modal-title" id="editTransactionModalLabel">
                            Edit Transaction
                        </h2>
                        <p class="mb-0">Update your transaction details</p>
                    </div>

                    <button type="button" class="btn-close"
                        data-bs-dismiss="modal" aria-label="Close">
                    </button>
                </div>

                <div class="modal-body">
                    <form id="editTransactionForm" method="POST">

                        @csrf
                        @method('PUT')

                        <div class="filter-group">
                            <label for="edit_date">Date</label>
                            <input type="date" name="date" id="edit_date"
                                class="form-control" required>
                        </div>

                        <div class="filter-group">
                            <label for="edit_description">Description</label>
                            <input type="text" name="description"
                                id="edit_description" class="form-control"
                                maxlength="255" required>
                        </div>

                        <div class="filter-group">
                            <label for="edit_category">Category</label>
                            <input type="text" name="category"
                                id="edit_category" class="form-control"
                                maxlength="100" required>
                        </div>

                        <div class="filter-group">
                            <label for="edit_type">Type</label>
                            <select name="type" id="edit_type"
                                class="form-select" required>
                                <option value="income">Income</option>
                                <option value="outcome">Outcome</option>
                            </select>
                        </div>

                        <div class="filter-group">
                            <label for="edit_amount">Amount (Rp)</label>
                            <input type="number" name="amount"
                                id="edit_amount" class="form-control"
                                min="0" step="1" required>
                        </div>

                        <div class="filter-actions">
                            <button type="button" class="btn-reset"
                                data-bs-dismiss="modal">
                                Cancel
                            </button>

                            <button type="submit" class="btn-apply">
                                Save Changes
                            </button>
                        </div>

                    </form>
                </div>

            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    @vite('resources/js/report.js')
</body>

</html>