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
                            <div class="btn-dashboard btn-add" data-bs-toggle="modal" data-bs-target="#incomeModal" role="button" tabindex="0"><i class="bi bi-plus"></i></div>
                            <div class="btn-dashboard btn-out" data-bs-toggle="modal" data-bs-target="#outcomeModal" role="button" tabindex="0"><i class="bi bi-dash"></i></div>
                        </div>
                    </div>

                    <div class="d-flex flex-row gap-2">
                        <div class="balance card w-100">
                            <h2>Balances</h2>
                            <p>Check your overall balances here</p>
                            <div class="value d-flex flex-row justify-content-between align-items-center">
                                <h1>2.000.000.000</h1>
                                <a href=""><i class="bi bi-eye-fill"></i></a>
                            </div>
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>