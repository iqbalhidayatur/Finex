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

                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show mx-4 mt-3">
                        {{ session('success') }}
                        <button type="button" class="btn-close"
                                data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger mx-4 mt-3">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="main gap-3 d-flex flex-column">
                    <div class="dashboard d-flex justify-content-between align-items-center flex-row">
                        <div class="dashboard-head">
                            <h2>Dashboard</h2>
                            <p>See your finance resume here</p>
                        </div>
                        <div class="dashboard-btn d-flex flex-row gap-2">
                            <div class="btn-dashboard btn-add" data-bs-toggle="modal" data-bs-target="#incomeModal" role="button" tabindex="0"><i class="bi bi-plus"></i></div>
                            <div class="btn-dashboard btn-out" data-bs-toggle="modal" data-bs-target="#outcomeModal" role="button" tabindex="0"><i class="bi bi-dash"></i></div>
                        </div>
                    </div>

                    <div class="d-flex flex-row gap-2 w-100 h-100">
                        <div class="balance card w-100 d-flex justify-content-center align-items-start">
                            <h2>Balances</h2>
                            <p>Check your overall balances here</p>
                            <div class="value d-flex w-100 flex-row justify-content-between align-items-center">
                                <h1>2.000.000.000</h1>
                                <a href=""><i class="bi bi-eye-fill"></i></a>
                            </div>
                        </div>

                                                
                        <div class="savings card d-flex flex-column">
                            <div class="d-flex justify-content-between align-items-center">
                                
                                <div class="d-flex justify-content-center align-items-start flex-column">
                                    <h2>Saving Goals</h2>
                                    <p>Your saving goals here</p>
                                </div>

                                <button type="button"
                                        class="btn btn-sm btn-outline-primary"
                                        data-bs-toggle="modal"
                                        data-bs-target="#savingGoalModal">
                                    <i class="bi bi-plus-lg"></i>
                                </button>
                            </div>


                            @php
                                $mainGoal = $savingGoals->first();
                            @endphp

                            @if ($mainGoal)
                                <h3>{{ $mainGoal->name }}</h3>

                                <progress
                                    value="{{ $mainGoal->progress }}"
                                    max="100">
                                </progress>

                                <div class="d-flex justify-content-between mt-2">
                                    <small>{{ $mainGoal->progress }}% tercapai</small>
                                    <small>
                                        Rp{{ number_format($mainGoal->target_amount, 0, ',', '.') }}
                                    </small>
                                </div>

                                <div class="target d-flex w-100 justify-content-between mt-3">
                                    <p>
                                        Sisa Rp{{ number_format($mainGoal->remaining_amount, 0, ',', '.') }}
                                    </p>

                                    <button type="button"
                                            class="btn btn-sm btn-primary"
                                            data-bs-toggle="modal"
                                            data-bs-target="#addSavingsModal"
                                            data-id="{{ $mainGoal->id }}"
                                            data-name="{{ $mainGoal->name }}"
                                            data-remaining="{{ $mainGoal->remaining_amount }}">
                                        Tambah Tabungan
                                    </button>
                                </div>
                            @else
                                <div class="my-auto text-center">
                                    <p>Belum ada target tabungan.</p>
                                </div>
                            @endif
                        </div>

                    </div>

                    <div class="d-flex flex-row gap-2 h-100">
                        <div class="chart-card d-flex h-100 flex-column">
                            <div class="chart-header">
                                <div>
                                    <h2>Transaction Overview</h2>
                                    <p>Income vs Outcome</p>
                                </div>

                                <select id="chartRange">
                                    <option value="7">7 Hari Terakhir</option>
                                    <option value="30" selected>30 Hari Terakhir</option>
                                    <option value="month">Bulan Ini</option>
                                    <option value="all">Semua Data</option>
                                </select>
                            </div>

                            <div class="chart-container">
                                <canvas id="transactionChart"></canvas>
                            </div>
                        </div>

                        <div class="card recent-act d-flex w-100 h-100">
                            <div class="d-flex justify-content-between align-items-center w-100">
                                
                                <div class="recent-activity d-flex h-100 flex-column">
                                    <div class="d-flex flex-row justify-content-between align-items-center">
                                        <h2>Recent Activity</h2>
                                        <a href="/report">
                                            <i class="bi bi-arrow-right-circle"></i>
                                        </a>
                                    </div>

                                    @forelse ($activities as $activity)
                                        <div class="activity-item">
                                            <div class="activity-info">
                                                <h4>{{ $activity['description'] }}</h4>

                                                <p>
                                                    {{ \Carbon\Carbon::parse($activity['date'])->format('d M Y') }}
                                                    · {{ ucfirst($activity['category']) }}
                                                </p>
                                            </div>

                                            <span class="activity-amount {{ $activity['type'] }}">
                                                {{ $activity['type'] === 'income' ? '+' : '-' }}
                                                Rp {{ number_format($activity['amount'], 0, ',', '.') }}
                                            </span>
                                        </div>
                                    @empty
                                        <p>Belum ada aktivitas.</p>
                                    @endforelse
                                </div>

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

            <div class="saving-goals-grid">
                @forelse ($savingGoals as $goal)
                    <div class="card saving-goal-card">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <h3>{{ $goal->name }}</h3>
                                <p>{{ $goal->description ?: 'Saving goal' }}</p>
                            </div>

                            <div class="dropdown">
                                <button class="btn btn-sm"
                                        type="button"
                                        data-bs-toggle="dropdown">
                                    <i class="bi bi-three-dots"></i>
                                </button>

                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li>
                                        <button type="button"
                                                class="dropdown-item"
                                                data-bs-toggle="modal"
                                                data-bs-target="#savingGoalModal"
                                                data-id="{{ $goal->id }}"
                                                data-name="{{ $goal->name }}"
                                                data-description="{{ $goal->description }}"
                                                data-target="{{ $goal->target_amount }}"
                                                data-saved="{{ $goal->saved_amount }}"
                                                data-date="{{ $goal->target_date?->format('Y-m-d') }}">
                                            Edit Goal
                                        </button>
                                    </li>

                                    <li>
                                        <form method="POST"
                                            action="{{ route('saving-goals.destroy', $goal) }}"
                                            onsubmit="return confirm('Hapus saving goal ini?')">
                                            @csrf
                                            @method('DELETE')

                                            <button class="dropdown-item text-danger">
                                                Hapus Goal
                                            </button>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="saving-goal-amount">
                            <span>Tabungan terkumpul</span>
                            <h2>Rp{{ number_format($goal->saved_amount, 0, ',', '.') }}</h2>
                            <p>
                                dari Rp{{ number_format($goal->target_amount, 0, ',', '.') }}
                            </p>
                        </div>

                        <div class="progress saving-goal-progress">
                            <div class="progress-bar"
                                role="progressbar"
                                style="width: {{ $goal->progress }}%"
                                aria-valuenow="{{ $goal->progress }}"
                                aria-valuemin="0"
                                aria-valuemax="100">
                            </div>
                        </div>

                        <div class="d-flex justify-content-between mt-2">
                            <small>{{ $goal->progress }}%</small>
                            <small>
                                Sisa Rp{{ number_format($goal->remaining_amount, 0, ',', '.') }}
                            </small>
                        </div>

                        @if ($goal->target_date)
                            <p class="mt-3 mb-0">
                                <i class="bi bi-calendar-event"></i>
                                Target: {{ $goal->target_date->format('d M Y') }}
                            </p>
                        @endif

                        @if ($goal->remaining_amount > 0)
                            <button type="button"
                                    class="btn btn-outline-primary mt-3"
                                    data-bs-toggle="modal"
                                    data-bs-target="#addSavingsModal"
                                    data-id="{{ $goal->id }}"
                                    data-name="{{ $goal->name }}"
                                    data-remaining="{{ $goal->remaining_amount }}">
                                <i class="bi bi-plus-circle"></i>
                                Tambah Tabungan
                            </button>
                        @else
                            <div class="alert alert-success mt-3 mb-0">
                                <i class="bi bi-check-circle"></i>
                                Target tercapai!
                            </div>
                        @endif
                    </div>
                @empty
                @endforelse
            </div>
        </div>

        <!-- Modal Create / Edit Saving Goal -->
        <div class="modal fade" id="savingGoalModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <form id="savingGoalForm"
                        action="{{ route('saving-goals.store') }}"
                        method="POST"
                        data-store-url="{{ route('saving-goals.store') }}">
                        @csrf

                        <div id="savingGoalMethod"></div>

                        <div class="modal-header">
                            <h5 class="modal-title" id="savingGoalTitle">
                                Create Saving Goal
                            </h5>
                            <button type="button" class="btn-close"
                                    data-bs-dismiss="modal"></button>
                        </div>

                        <div class="modal-body">
                            <div class="mb-3">
                                <label class="form-label" for="goalName">Nama Goal</label>
                                <input class="form-control" id="goalName"
                                    name="name" required maxlength="255">
                            </div>

                            <div class="mb-3">
                                <label class="form-label" for="goalDescription">Deskripsi</label>
                                <textarea class="form-control" id="goalDescription"
                                        name="description" rows="2"
                                        maxlength="1000"></textarea>
                            </div>

                            <div class="mb-3">
                                <label class="form-label" for="goalTarget">Target Tabungan (Rp)</label>
                                <input type="number" class="form-control"
                                    id="goalTarget" name="target_amount"
                                    min="1" step="0.01" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label" for="goalSaved">Sudah Terkumpul (Rp)</label>
                                <input type="number" class="form-control"
                                    id="goalSaved" name="saved_amount"
                                    min="0" step="0.01" value="0" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label" for="goalDate">Tanggal Target</label>
                                <input type="date" class="form-control"
                                    id="goalDate" name="target_date"
                                    min="{{ now()->toDateString() }}">
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary"
                                    data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary"
                                    id="goalSubmit">Simpan Goal</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modal Add Savings -->
        <div class="modal fade" id="addSavingsModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <form id="addSavingsForm" method="POST" action="#">
                        @csrf

                        <div class="modal-header">
                            <h5 class="modal-title">Tambah Tabungan</h5>
                            <button type="button" class="btn-close"
                                    data-bs-dismiss="modal"></button>
                        </div>

                        <div class="modal-body">
                            <p id="addSavingsGoalName"></p>

                            <p>
                                Sisa target:
                                <strong id="addSavingsRemaining"></strong>
                            </p>

                            <label class="form-label" for="savingAmount">
                                Nominal Tabungan (Rp)
                            </label>

                            <input type="number" class="form-control"
                                id="savingAmount" name="amount"
                                min="0.01" step="0.01" required>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary"
                                    data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary">
                                Tambah Tabungan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </main>

    <!-- Income Popup -->
    <div class="modal fade" id="incomeModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered income-modal-dialog">
            <div class="income-modal-wrapper">

                <form id="incomeForm">
                    <!-- Income Card -->
                    <div class="modal-content popup-container">

                        <!-- Form Income -->
                        <div class="modal-body income-form">
                            <h2>Add Income</h2>
                            <p>Insert your income in the form below</p>

                            <div class="income d-flex flex-column gap-2">
                                <label for="amount">Amount</label>
                                <input
                                    type="number"
                                    name="amount"
                                    id="amount"
                                    placeholder="Enter amount"
                                    min="1"
                                    required
                                >

                                <label for="description">Description</label>
                                <input
                                    type="text"
                                    name="description"
                                    id="description"
                                    placeholder="Enter description"
                                    required
                                >

                                <label for="incomeWallet">Wallet</label>
                                <select
                                    class="form-select"
                                    id="incomeWallet"
                                    name="wallet"
                                    required
                                >
                                    <option value="" selected disabled>
                                        Select Wallet
                                    </option>
                                    <option value="wallet1">Wallet 1</option>
                                    <option value="wallet2">Wallet 2</option>
                                    <option value="wallet3">Wallet 3</option>
                                    <option value="wallet4">Wallet 4</option>
                                </select>
                            </div>
                        </div>

                        <!-- Drop File -->
                        <div class="modal-body file-section">
                            <label for="incomeFile" class="drop-zone">
                                <i class="bi bi-cloud-arrow-up"></i>
                                <p>Drop your file here</p>
                                <span>or click to browse</span>
                                <input
                                    type="file"
                                    name="file"
                                    id="incomeFile"
                                    accept="image/*,.pdf"
                                    hidden
                                >
                            </label>
                        </div>

                    </div>

                    <!-- Submit di luar card -->
                    <div class="popup-actions">
                        <button type="submit" class="btn-submit btn-submit-income">
                            <i class="bi bi-plus-lg"></i>
                            Add Income
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>


    <!-- Outcome Popup -->
    <div class="modal fade" id="outcomeModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered income-modal-dialog">
            <div class="income-modal-wrapper">

                <form id="outcomeForm">
                    <!-- Outcome Card -->
                    <div class="modal-content popup-container">

                        <!-- Form Outcome -->
                        <div class="modal-body income-form">
                            <h2>Add Outcome</h2>
                            <p>Insert your outcome in the form below</p>

                            <div class="outcome d-flex flex-column gap-2">
                                <label for="outcomeAmount">Amount</label>
                                <input
                                    type="number"
                                    name="amount"
                                    id="outcomeAmount"
                                    placeholder="Enter amount"
                                    min="1"
                                    required
                                >

                                <label for="outcomeDescription">Description</label>
                                <input
                                    type="text"
                                    name="description"
                                    id="outcomeDescription"
                                    placeholder="Enter description"
                                    required
                                >

                                <label for="outcomeCategory">Category</label>
                                <select
                                    class="form-select"
                                    id="outcomeCategory"
                                    name="category"
                                    required
                                >
                                    <option value="" selected disabled>
                                        Select Category
                                    </option>
                                    <option value="food">Food</option>
                                    <option value="transport">Transportation</option>
                                    <option value="shopping">Shopping</option>
                                    <option value="bills">Bills</option>
                                    <option value="entertainment">Entertainment</option>
                                    <option value="other">Other</option>
                                </select>

                                <label for="outcomeWallet">Wallet</label>
                                <select
                                    class="form-select"
                                    id="outcomeWallet"
                                    name="wallet"
                                    required
                                >
                                    <option value="" selected disabled>
                                        Select Wallet
                                    </option>
                                    <option value="wallet1">Wallet 1</option>
                                    <option value="wallet2">Wallet 2</option>
                                    <option value="wallet3">Wallet 3</option>
                                    <option value="wallet4">Wallet 4</option>
                                </select>
                            </div>
                        </div>

                        <!-- Drop File -->
                        <div class="modal-body file-section">
                            <label for="outcomeFile" class="drop-zone outcome-drop-zone">
                                <i class="bi bi-cloud-arrow-up"></i>
                                <p>Drop your file here</p>
                                <span>or click to browse</span>
                                <input
                                    type="file"
                                    name="file"
                                    id="outcomeFile"
                                    accept="image/*,.pdf"
                                    hidden
                                >
                            </label>
                        </div>

                    </div>

                    <!-- Submit di luar card -->
                    <div class="popup-actions">
                        <button type="submit" class="btn-submit btn-submit-outcome">
                            <i class="bi bi-dash-lg"></i>
                            Add Outcome
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <script id="transactionData" type="application/json">
        @json($transactions)
    </script>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    @vite('resources/js/dashboard.js')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>