document.addEventListener("DOMContentLoaded", () => {
    const form = document.getElementById("aiChatForm");
    const input = document.getElementById("aiChatInput");
    const messages = document.getElementById("aiChatMessages");
    const suggestions = document.getElementById("aiSuggestions");

    if (!form || !input || !messages) return;

    function scrollToBottom() {
        messages.scrollTop = messages.scrollHeight;
    }

    function addMessage(text, sender) {
        const message = document.createElement("div");
        message.className = `ai-message ai-message-${sender}`;

        const content = document.createElement("div");
        content.className = "ai-message-content";

        const paragraph = document.createElement("p");
        paragraph.textContent = text;

        const label = document.createElement("span");
        label.textContent = sender === "user" ? "You" : "Finex AI";

        content.append(paragraph, label);
        message.append(content);

        if (sender === "bot") {
            const avatar = document.createElement("div");
            avatar.className = "ai-message-avatar";
            avatar.innerHTML = '<i class="bi bi-stars"></i>';
            message.prepend(avatar);
        }

        messages.append(message);
        scrollToBottom();
    }

    function getDemoResponse(question) {
        const text = question.toLowerCase();

        if (text.includes("cash flow") || text.includes("arus kas")) {
            return "Untuk menganalisis cash flow, bandingkan total pemasukan dan pengeluaran dalam periode yang sama. Pastikan saldo akhir sesuai dengan saldo awal ditambah pemasukan, lalu dikurangi pengeluaran.";
        }

        if (
            text.includes("money go") ||
            text.includes("spending") ||
            text.includes("pengeluaran")
        ) {
            return "Periksa halaman Report dan Analytics untuk melihat kategori pengeluaran terbesar. Tentukan batas anggaran untuk kategori yang paling banyak menyerap uang.";
        }

        if (
            text.includes("save") ||
            text.includes("saving") ||
            text.includes("tabungan") ||
            text.includes("budget")
        ) {
            return "Tentukan target tabungan bulanan, sisihkan dana di awal periode, lalu tetapkan batas pengeluaran untuk setiap kategori. Pantau progresnya melalui Budgeting dan Saving Goals.";
        }

        return "Saya menerima pertanyaan Anda. Setelah AI dihubungkan ke backend Finex, saya bisa membantu menganalisis transaksi dan memberikan saran berdasarkan data keuangan Anda.";
    }

    function sendMessage(text) {
        const question = text.trim();

        if (!question) return;

        addMessage(question, "user");
        suggestions?.classList.add("d-none");

        input.value = "";
        input.style.height = "auto";

        window.setTimeout(() => {
            addMessage(getDemoResponse(question), "bot");
        }, 400);
    }

    form.addEventListener("submit", (event) => {
        event.preventDefault();
        sendMessage(input.value);
    });

    input.addEventListener("input", () => {
        input.style.height = "auto";
        input.style.height = `${Math.min(input.scrollHeight, 120)}px`;
    });

    suggestions?.addEventListener("click", (event) => {
        const button = event.target.closest(".ai-suggestion");

        if (button) {
            sendMessage(button.textContent.trim());
        }
    });
});
