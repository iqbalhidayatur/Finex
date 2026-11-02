document.addEventListener("DOMContentLoaded", function () {
    const options = document.querySelectorAll(".calculator-option");
    const panels = document.querySelectorAll(".calculator-panel");

    options.forEach((option) => {
        option.addEventListener("click", function () {
            const selectedCalculator = this.dataset.calculator;

            // Reset active selector
            options.forEach((item) => {
                item.classList.remove("active");
            });

            // Activate selected selector
            this.classList.add("active");

            // Hide all calculator panels
            panels.forEach((panel) => {
                panel.classList.add("d-none");
            });

            // Show selected calculator
            const selectedPanel = document.getElementById(selectedCalculator);

            if (selectedPanel) {
                selectedPanel.classList.remove("d-none");
            }
        });
    });
});


// Dynamic Input Rows

document.addEventListener('DOMContentLoaded', function () {

    const rowTemplates = {
        production: `
            <td>
                <input class="form-control" placeholder="Material name">
            </td>
            <td>
                <input type="number" class="form-control" placeholder="0">
            </td>
            <td>
                <select class="form-select">
                    <option>Kg</option>
                    <option>Gram</option>
                    <option>Liter</option>
                    <option>ML</option>
                    <option>Pcs</option>
                    <option>Pack</option>
                </select>
            </td>
            <td>
                <input type="number" class="form-control" placeholder="0">
            </td>
            <td class="cost-value">Rp 0</td>
            <td>
                <button type="button" class="btn-delete">
                    <i class="bi bi-trash"></i>
                </button>
            </td>
        `,

        resell: `
            <td>
                <input class="form-control" placeholder="Cost description">
            </td>
            <td>
                <input type="number" class="form-control" placeholder="0">
            </td>
            <td>
                <button type="button" class="btn-delete">
                    <i class="bi bi-trash"></i>
                </button>
            </td>
        `,

        custom: `
            <td>
                <input class="form-control" placeholder="Component name">
            </td>
            <td>
                <input type="number" class="form-control" placeholder="0">
            </td>
            <td>
                <input type="number" class="form-control" placeholder="0">
            </td>
            <td class="cost-value">Rp 0</td>
            <td>
                <button type="button" class="btn-delete">
                    <i class="bi bi-trash"></i>
                </button>
            </td>
        `
    };

    const tableTargets = {
        production: 'production-materials',
        resell: 'resell-costs',
        custom: 'custom-components'
    };

    // Add Row
    document.addEventListener('click', function (e) {

        const addButton = e.target.closest('[data-add-row]');

        if (addButton) {
            const type = addButton.dataset.addRow;
            const tbody = document.getElementById(tableTargets[type]);

            if (!tbody || !rowTemplates[type]) return;

            const row = document.createElement('tr');
            row.innerHTML = rowTemplates[type];

            tbody.appendChild(row);
        }

        // Delete Row
        const deleteButton = e.target.closest('.btn-delete');

        if (deleteButton) {
            const row = deleteButton.closest('tr');

            if (row) {
                row.remove();
            }
        }

    });

});
