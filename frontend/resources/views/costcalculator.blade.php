
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cost Calculator</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.2/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

    @vite('resources/css/global.css')
    @vite('resources/css/costcalculator.css')
    @vite('resources/js/costcalculator.js')
</head>

<body>
    <main>
        <section class="d-flex flex-row">
            <aside class="justify-content-start align-items-center flex-column ps-4 pe-4">
                @include('_sidebar')
            </aside>

            <div class="main-content">
                @include('_header')

            <div class="main cost-main">

                <div class="cost-heading">
                    <div>
                        <h1>Cost Calculator</h1>
                        <p>Calculate and manage your business costs with ease.</p>
                    </div>
                </div>

                <!-- Calculator Selector -->
                <div class="calculator-selector">
                    <button class="calculator-option active" data-calculator="production">
                        <i class="bi bi-box-seam"></i>
                        <span>Production</span>
                    </button>

                    <button class="calculator-option" data-calculator="resell">
                        <i class="bi bi-cart-check"></i>
                        <span>Resell</span>
                    </button>

                    <button class="calculator-option" data-calculator="custom">
                        <i class="bi bi-tools"></i>
                        <span>Custom</span>
                    </button>

                    <button class="calculator-option" data-calculator="other">
                        <i class="bi bi-receipt"></i>
                        <span>Other</span>
                    </button>
                </div>

                <!-- PRODUCTION CALCULATOR -->
                <div class="calculator-panel" id="production">

                    <div class="calculator-heading">
                        <div class="calculator-heading-icon">
                            <i class="bi bi-box-seam"></i>
                        </div>
                        <div>
                            <h2>Production Calculator</h2>
                            <p>Calculate the cost of manufacturing your products.</p>
                        </div>
                    </div>

                    <div class="calculator-card">
                        <h3>Product Information</h3>

                        <div class="row g-3">
                            <div class="col-md-6">
                                <label>Product Name</label>
                                <input type="text" class="form-control" placeholder="Enter product name">
                            </div>

                            <div class="col-md-6">
                                <label>Production Quantity</label>
                                <div class="input-group">
                                    <input type="number" class="form-control" placeholder="0">
                                    <span class="input-group-text">Units</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="calculator-card">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div>
                                <h3>Raw Materials</h3>
                                <p>Add materials used in production.</p>
                            </div>
                            <button type="button" class="btn-add" data-add-row="production">
                                <i class="bi bi-plus-lg"></i> Add Material
                            </button>
                        </div>

                        <div class="table-responsive">
                            <table class="table cost-table">
                                <thead>
                                    <tr>
                                        <th>Material Name</th>
                                        <th>Quantity</th>
                                        <th>Unit</th>
                                        <th>Price / Unit</th>
                                        <th>Total</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody id="production-materials">
                                    <tr>
                                        <td><input class="form-control" placeholder="e.g. Flour"></td>
                                        <td><input type="number" class="form-control" placeholder="0"></td>
                                        <td>
                                            <select class="form-select">
                                                <option>Kg</option>
                                                <option>Gram</option>
                                                <option>Liter</option>
                                                <option>Pcs</option>
                                            </select>
                                        </td>
                                        <td><input type="number" class="form-control" placeholder="0"></td>
                                        <td class="cost-value">Rp 0</td>
                                        <td>
                                            <button type="button" class="btn-delete">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="calculator-card">
                        <h3>Additional Costs</h3>

                        <div class="row g-3">
                            <div class="col-md-6">
                                <label>Labor Cost</label>
                                <div class="input-group">
                                    <span class="input-group-text">Rp</span>
                                    <input type="number" class="form-control" placeholder="0">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label>Production Overhead</label>
                                <div class="input-group">
                                    <span class="input-group-text">Rp</span>
                                    <input type="number" class="form-control" placeholder="0">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="cost-summary">
                        <h3>Production Summary</h3>
                        <div class="summary-row">
                            <span>Raw Material Cost</span>
                            <strong>Rp 0</strong>
                        </div>
                        <div class="summary-row">
                            <span>Additional Cost</span>
                            <strong>Rp 0</strong>
                        </div>
                        <div class="summary-row total">
                            <span>Total Production Cost</span>
                            <strong>Rp 0</strong>
                        </div>
                        <div class="summary-row">
                            <span>Cost Per Unit (HPP)</span>
                            <strong class="highlight">Rp 0</strong>
                        </div>
                    </div>
                </div>

                <!-- RESELL CALCULATOR -->
                <div class="calculator-panel d-none" id="resell">

                    <div class="calculator-heading">
                        <div class="calculator-heading-icon resell-color">
                            <i class="bi bi-cart-check"></i>
                        </div>
                        <div>
                            <h2>Resell Calculator</h2>
                            <p>Calculate purchasing costs and determine your selling price.</p>
                        </div>
                    </div>

                    <div class="calculator-card">
                        <h3>Product Information</h3>

                        <div class="row g-3">
                            <div class="col-md-6">
                                <label>Product Name</label>
                                <input type="text" class="form-control" placeholder="Enter product name">
                            </div>

                            <div class="col-md-6">
                                <label>Purchase Quantity</label>
                                <input type="number" class="form-control" placeholder="0">
                            </div>

                            <div class="col-md-6">
                                <label>Purchase Price / Unit</label>
                                <div class="input-group">
                                    <span class="input-group-text">Rp</span>
                                    <input type="number" class="form-control" placeholder="0">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label>Desired Profit Margin (%)</label>
                                <div class="input-group">
                                    <input type="number" class="form-control" placeholder="0">
                                    <span class="input-group-text">%</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="calculator-card">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div>
                                <h3>Additional Costs</h3>
                                <p>Include shipping, packaging, and other expenses.</p>
                            </div>
                            <button type="button" class="btn-add" data-add-row="resell">
                                <i class="bi bi-plus-lg"></i> Add Cost
                            </button>
                        </div>

                        <div class="table-responsive">
                            <table class="table cost-table">
                                <thead>
                                    <tr>
                                        <th>Cost Description</th>
                                        <th>Amount</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody id="resell-costs">
                                    <tr>
                                        <td><input class="form-control" placeholder="e.g. Shipping"></td>
                                        <td><input type="number" class="form-control" placeholder="0"></td>
                                        <td>
                                            <button type="button" class="btn-delete">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="cost-summary">
                        <h3>Resell Summary</h3>
                        <div class="summary-row">
                            <span>Total Purchase Cost</span>
                            <strong>Rp 0</strong>
                        </div>
                        <div class="summary-row">
                            <span>Additional Costs</span>
                            <strong>Rp 0</strong>
                        </div>
                        <div class="summary-row total">
                            <span>Total Capital</span>
                            <strong>Rp 0</strong>
                        </div>
                        <div class="summary-row">
                            <span>Cost Per Unit</span>
                            <strong>Rp 0</strong>
                        </div>
                        <div class="summary-row">
                            <span>Recommended Selling Price</span>
                            <strong class="highlight">Rp 0</strong>
                        </div>
                        <div class="summary-row">
                            <span>Estimated Profit</span>
                            <strong class="highlight">Rp 0</strong>
                        </div>
                    </div>
                </div>

                <!-- CUSTOM CALCULATOR -->
                <div class="calculator-panel d-none" id="custom">

                    <div class="calculator-heading">
                        <div class="calculator-heading-icon custom-color">
                            <i class="bi bi-tools"></i>
                        </div>
                        <div>
                            <h2>Custom Calculator</h2>
                            <p>Create your own cost calculation with flexible components.</p>
                        </div>
                    </div>

                    <div class="calculator-card">
                        <h3>Calculation Information</h3>

                        <div class="row g-3">
                            <div class="col-md-6">
                                <label>Calculation Name</label>
                                <input type="text" class="form-control" placeholder="Enter calculation name">
                            </div>

                            <div class="col-md-6">
                                <label>Quantity</label>
                                <input type="number" class="form-control" placeholder="0">
                            </div>
                            <div class="col-12">
                                <label>Description</label>
                                <textarea class="form-control" rows="3" placeholder="Describe your calculation..."></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="calculator-card">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div>
                                <h3>Cost Components</h3>
                                <p>Add any cost components you need.</p>
                            </div>
                            <button type="button" class="btn-add" data-add-row="custom">
                                <i class="bi bi-plus-lg"></i> Add Component
                            </button>
                        </div>

                        <div class="table-responsive">
                            <table class="table cost-table">
                                <thead>
                                    <tr>
                                        <th>Component Name</th>
                                        <th>Quantity</th>
                                        <th>Price / Unit</th>
                                        <th>Total</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody id="custom-components">
                                    <tr>
                                        <td><input class="form-control" placeholder="Component name"></td>
                                        <td><input type="number" class="form-control" placeholder="0"></td>
                                        <td><input type="number" class="form-control" placeholder="0"></td>
                                        <td class="cost-value">Rp 0</td>
                                        <td>
                                            <button type="button" class="btn-delete">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="cost-summary">
                        <h3>Custom Summary</h3>
                        <div class="summary-row total">
                            <span>Total Cost</span>
                            <strong>Rp 0</strong>
                        </div>
                        <div class="summary-row">
                            <span>Cost Per Unit</span>
                            <strong class="highlight">Rp 0</strong>
                        </div>
                    </div>
                </div>

                <!-- OTHER CALCULATOR -->
                <div class="calculator-panel d-none" id="other">

                    <div class="calculator-heading">
                        <div class="calculator-heading-icon other-color">
                            <i class="bi bi-receipt"></i>
                        </div>
                        <div>
                            <h2>Other Cost Calculator</h2>
                            <p>Track and calculate other business expenses.</p>
                        </div>
                    </div>

                    <div class="calculator-card">
                        <h3>Expense Information</h3>

                        <div class="row g-3">
                            <div class="col-md-6">
                                <label>Expense Name</label>
                                <input type="text" class="form-control" placeholder="e.g. Monthly Electricity">
                            </div>

                            <div class="col-md-6">
                                <label>Expense Category</label>
                                <select class="form-select">
                                    <option value="">Select category</option>
                                    <option>Rent</option>
                                    <option>Utilities</option>
                                    <option>Transportation</option>
                                    <option>Marketing</option>
                                    <option>Maintenance</option>
                                    <option>Other</option>
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label>Expense Amount</label>
                                <div class="input-group">
                                    <span class="input-group-text">Rp</span>
                                    <input type="number" class="form-control" placeholder="0">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label>Frequency</label>
                                <select class="form-select">
                                    <option>One-time</option>
                                    <option>Daily</option>
                                    <option>Weekly</option>
                                    <option>Monthly</option>
                                    <option>Yearly</option>
                                </select>
                            </div>

                            <div class="col-12">
                                <label>Description</label>
                                <textarea class="form-control" rows="3" placeholder="Additional expense details..."></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="cost-summary">
                        <h3>Expense Summary</h3>
                        <div class="summary-row">
                            <span>Expense Amount</span>
                            <strong>Rp 0</strong>
                        </div>
                        <div class="summary-row total">
                            <span>Total Expense</span>
                            <strong class="highlight">Rp 0</strong>
                        </div>
                    </div>
                </div>

                <!-- Actions -->
                <div class="calculator-actions">
                    <button type="button" class="btn-reset">
                        <i class="bi bi-arrow-counterclockwise"></i> Reset
                    </button>

                    <button type="button" class="btn-save">
                        <i class="bi bi-calculator"></i> Calculate Cost
                    </button>
                </div>

            </div>

            </div>
        </section>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
