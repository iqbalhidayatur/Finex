document.addEventListener("DOMContentLoaded", () => {
    const modal = document.getElementById("editTransactionModal");
    const form = document.getElementById("editTransactionForm");

    if (!modal || !form) return;

    modal.addEventListener("show.bs.modal", (event) => {
        const button = event.relatedTarget;

        const id = button.dataset.id;

        form.action = `/report/${id}`;

        document.getElementById("edit_date").value = button.dataset.date;

        document.getElementById("edit_description").value =
            button.dataset.description;

        document.getElementById("edit_category").value =
            button.dataset.category;

        document.getElementById("edit_type").value = button.dataset.type;

        document.getElementById("edit_amount").value = button.dataset.amount;
    });
});
