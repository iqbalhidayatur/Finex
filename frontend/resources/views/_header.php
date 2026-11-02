<header class="w-100">
    <div class="btn-header d-flex justify-content-center align-items-center">
        <i class="bi bi-bell-fill"></i>
    </div>

    <div class="btn-header d-flex justify-content-center align-items-center">
        <i class="bi bi-gear-fill"></i>
    </div>

    <button
        type="button"
        class="btn-ai d-flex justify-content-center align-items-center"
        data-bs-toggle="offcanvas"
        data-bs-target="#aiAssistant"
        aria-controls="aiAssistant">
        <i class="bi bi-stars me-2"></i>
        AI Assistance
    </button>
</header>

<!-- AI Assistant Offcanvas -->
<div
    class="offcanvas offcanvas-end ai-offcanvas"
    tabindex="-1"
    id="aiAssistant"
    aria-labelledby="aiAssistantLabel">
    <div class="ai-header">
        <div class="d-flex align-items-center gap-3">
            <div class="ai-avatar">
                <i class="bi bi-stars"></i>
            </div>

            <div>
                <h5 id="aiAssistantLabel">Finex AI</h5>
                <p><span class="ai-status"></span> Your finance assistant</p>
            </div>
        </div>

        <button
            type="button"
            class="ai-close"
            data-bs-dismiss="offcanvas"
            aria-label="Close">
            <i class="bi bi-x-lg"></i>
        </button>
    </div>

    <div class="ai-body" id="aiChatMessages">
        <div class="ai-welcome">
            <div class="ai-welcome-icon">
                <i class="bi bi-stars"></i>
            </div>

            <h4>Hi! How can I help you?</h4>
            <p>Ask me anything about your finances.</p>
        </div>

        <div class="ai-message ai-message-bot">
            <div class="ai-message-avatar">
                <i class="bi bi-stars"></i>
            </div>

            <div class="ai-message-content">
                <p>Hello! I'm Finex AI. I can help you understand your spending, manage your budget, and review your cash flow.</p>
                <span>Finex AI</span>
            </div>
        </div>

        <div class="ai-suggestions" id="aiSuggestions">
            <p>Try asking</p>

            <button type="button" class="ai-suggestion">
                <i class="bi bi-graph-up-arrow"></i>
                Analyze my cash flow
            </button>

            <button type="button" class="ai-suggestion">
                <i class="bi bi-wallet2"></i>
                Where does my money go?
            </button>

            <button type="button" class="ai-suggestion">
                <i class="bi bi-piggy-bank"></i>
                How can I save more?
            </button>
        </div>
    </div>

    <div class="ai-footer">
        <form id="aiChatForm" class="ai-input-wrapper">
            <textarea
                id="aiChatInput"
                rows="1"
                placeholder="Ask about your finances..."
                aria-label="Message Finex AI"
                required></textarea>

            <button type="submit" aria-label="Send message">
                <i class="bi bi-send"></i>
            </button>
        </form>

        <p>Finex AI can make mistakes. Verify important figures.</p>
    </div>
</div>