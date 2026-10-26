const walletModal = document.getElementById("walletModal");

if (walletModal) {
    walletModal.addEventListener("show.bs.modal", function (event) {
        const button = event.relatedTarget;
        const form = document.getElementById("walletForm");
        const method = document.getElementById("walletMethod");

        const isEdit = button?.dataset.id;

        form.reset();
        method.replaceChildren();

        document.getElementById("walletModalLabel").textContent = isEdit
            ? "Edit Wallet"
            : "Tambah Wallet";

        document.getElementById("walletSubmit").textContent = isEdit
            ? "Simpan Perubahan"
            : "Simpan Wallet";

        if (isEdit) {
            form.action = button.dataset.updateUrl;

            const input = document.createElement("input");
            input.type = "hidden";
            input.name = "_method";
            input.value = "PUT";

            method.appendChild(input);

            document.getElementById("walletName").value =
                button.dataset.name || "";

            document.getElementById("walletDescription").value =
                button.dataset.description || "";

            document.getElementById("walletBudget").value =
                button.dataset.budget || "0";

            document.getElementById("walletCategory").value =
                button.dataset.category || "Monthly Expenses";
        } else {
            form.action = form.dataset.storeUrl;
        }
    });
}
