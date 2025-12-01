<style>
    .chatbot-container {
        position: fixed;
        bottom: 20px;
        right: 20px;
        z-index: 9999;
        font-family: 'Besley', serif;
    }
    .chatbot-toggle {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        background: linear-gradient(135deg, #ff5722, #e64a19);
        border: none;
        cursor: pointer;
        box-shadow: 0 4px 20px rgba(255, 87, 34, 0.4);
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s ease;
        position: relative;
    }
    .chatbot-toggle:hover {
        transform: scale(1.1);
        box-shadow: 0 6px 25px rgba(255, 87, 34, 0.5);
    }
    .chatbot-toggle svg {
        width: 30px;
        height: 30px;
        fill: white;
    }
    .chatbot-badge {
        position: absolute;
        top: -5px;
        right: -5px;
        background: #ff1744;
        color: white;
        width: 20px;
        height: 20px;
        border-radius: 50%;
        font-size: 12px;
        font-weight: bold;
        display: none;
        align-items: center;
        justify-content: center;
        animation: pulse 2s infinite;
    }
    .chatbot-badge.show {
        display: flex;
    }
    @keyframes pulse {
        0% {
            box-shadow: 0 0 0 0 rgba(255, 23, 68, 0.7);
        }
        70% {
            box-shadow: 0 0 0 10px rgba(255, 23, 68, 0);
        }
        100% {
            box-shadow: 0 0 0 0 rgba(255, 23, 68, 0);
        }
    }
    .chatbot-window {
        display: none;
        position: fixed;
        bottom: 100px;
        right: 20px;
        width: 380px;
        height: 600px;
        background: white;
        border-radius: 20px;
        box-shadow: 0 8px 30px rgba(0, 0, 0, 0.2);
        flex-direction: column;
        overflow: hidden;
        animation: slideUp 0.3s ease;
    }
    .chatbot-window.active {
        display: flex;
    }
    @keyframes slideUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    .chatbot-header {
        background: linear-gradient(135deg, #074159, #2CBABA);
        color: white;
        padding: 20px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }
    .chatbot-header-info {
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .chatbot-avatar {
        width: 40px;
        height: 40px;
        background: white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
    }
    .chatbot-header h3 {
        margin: 0;
        font-size: 16px;
        font-weight: 700;
    }
    .chatbot-status {
        font-size: 12px;
        opacity: 0.9;
        display: flex;
        align-items: center;
        gap: 5px;
    }
    .status-dot {
        width: 8px;
        height: 8px;
        background: #4caf50;
        border-radius: 50%;
        animation: blink 2s infinite;
    }
    @keyframes blink {
        0%, 100% { opacity: 1; }
        50% { opacity: 0.3; }
    }
    .chatbot-close {
        background: transparent;
        border: none;
        color: white;
        font-size: 24px;
        cursor: pointer;
        padding: 0;
        width: 30px;
        height: 30px;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: transform 0.2s;
    }
    .chatbot-close:hover {
        transform: rotate(90deg);
    }
    .chatbot-messages {
        flex: 1;
        overflow-y: auto;
        padding: 20px;
        background: #f5f5ff;
    }
    .chatbot-messages::-webkit-scrollbar {
        width: 6px;
    }
    .chatbot-messages::-webkit-scrollbar-track {
        background: #f1f1f1;
    }
    .chatbot-messages::-webkit-scrollbar-thumb {
        background: #888;
        border-radius: 3px;
    }
    .chatbot-messages::-webkit-scrollbar-thumb:hover {
        background: #555;
    }
    .message {
        margin-bottom: 15px;
        display: flex;
        align-items: flex-start;
        animation: fadeIn 0.3s ease;
    }
    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    .message.bot {
        justify-content: flex-start;
    }
    .message.user {
        justify-content: flex-end;
    }
    .message-content {
        max-width: 75%;
        padding: 12px 16px;
        border-radius: 18px;
        word-wrap: break-word;
        line-height: 1.6;
        font-size: 14px;
        white-space: pre-line;
    }
    .message.bot .message-content {
        background: white;
        color: #333;
        border-bottom-left-radius: 4px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
    }
    
    /* Style for links inside bot messages */
    .message.bot .message-content a {
        color: #ff5722;
        text-decoration: none;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 4px;
        transition: all 0.2s ease;
    }
    
    .message.bot .message-content a:hover {
        color: #e64a19;
        text-decoration: underline;
    }
    
    .message.bot .message-content a::before {
        content: '🔗';
        font-size: 0.9em;
    }
    .message.user .message-content {
        background: #ff5722;
        color: white;
        border-bottom-right-radius: 4px;
    }
    .quick-replies {
        display: none; /* Hidden by default */
        flex-wrap: wrap;
        gap: 8px;
        margin-top: 10px;
        padding: 0 20px 10px 20px;
    }
    .quick-reply-btn {
        background: white;
        border: 2px solid #ff5722;
        color: #ff5722;
        padding: 8px 16px;
        border-radius: 20px;
        font-size: 13px;
        cursor: pointer;
        transition: all 0.2s;
        font-family: 'Besley', serif;
        font-weight: 600;
    }
    .quick-reply-btn:hover {
        background: #ff5722;
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(255, 87, 34, 0.3);
    }
    .quick-reply-btn:disabled {
        opacity: 0.5;
        cursor: not-allowed;
        transform: none;
    }
    .chatbot-input-area {
        padding: 15px;
        background: white;
        border-top: 1px solid #e0e0e0;
        display: flex;
        gap: 10px;
    }
    .chatbot-input {
        flex: 1;
        padding: 12px 15px;
        border: 2px solid #e0e0e0;
        border-radius: 25px;
        font-size: 14px;
        outline: none;
        font-family: 'Besley', serif;
        transition: border-color 0.2s;
    }
    .chatbot-input:focus {
        border-color: #ff5722;
    }
    .chatbot-input:disabled {
        background: #f5f5f5;
        cursor: not-allowed;
    }
    .chatbot-send {
        width: 45px;
        height: 45px;
        border-radius: 50%;
        background: #ff5722;
        border: none;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s ease;
    }
    .chatbot-send:hover:not(:disabled) {
        background: #e64a19;
        transform: scale(1.05);
    }
    .chatbot-send:disabled {
        background: #ccc;
        cursor: not-allowed;
        transform: scale(1);
    }
    .chatbot-send svg {
        width: 20px;
        height: 20px;
        fill: white;
    }
    .typing-indicator {
        display: flex;
        gap: 5px;
        padding: 12px 16px;
        background: white;
        border-radius: 18px;
        width: fit-content;
    }
    .typing-indicator span {
        width: 8px;
        height: 8px;
        background: #bbb;
        border-radius: 50%;
        animation: typing 1.4s infinite;
    }
    .typing-indicator span:nth-child(2) {
        animation-delay: 0.2s;
    }
    .typing-indicator span:nth-child(3) {
        animation-delay: 0.4s;
    }
    @keyframes typing {
        0%, 60%, 100% {
            transform: translateY(0);
        }
        30% {
            transform: translateY(-10px);
        }
    }
    .chatbot-powered {
        text-align: center;
        padding: 8px;
        font-size: 11px;
        color: #999;
        background: #f9f9f9;
    }
    @media (max-width: 768px) {
        .chatbot-window {
            width: calc(100% - 40px);
            height: calc(100vh - 140px);
            right: 20px;
            bottom: 100px;
        }
        .quick-replies {
            padding: 0 15px 10px 15px;
        }
        .quick-reply-btn {
            font-size: 12px;
            padding: 6px 12px;
        }
    }
</style>

<div class="chatbot-container">
    <button class="chatbot-toggle" id="chatbot-toggle" aria-label="Toggle Chatbot">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
            <path d="M20 2H4c-1.1 0-2 .9-2 2v18l4-4h14c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2zm0 14H6l-2 2V4h16v12z"/>
            <circle cx="12" cy="10" r="1.5"/>
            <circle cx="8" cy="10" r="1.5"/>
            <circle cx="16" cy="10" r="1.5"/>
        </svg>
        <span class="chatbot-badge" id="chatbot-badge">1</span>
    </button>

    <div class="chatbot-window" id="chatbot-window">
        <div class="chatbot-header">
            <div class="chatbot-header-info">
                <div class="chatbot-avatar">🤖</div>
                <div>
                    <h3>SIKEMAS Assistant</h3>
                    <div class="chatbot-status">
                        <span class="status-dot"></span>
                        Online
                    </div>
                </div>
            </div>
            <button class="chatbot-close" id="chatbot-close" aria-label="Close Chatbot">&times;</button>
        </div>

        <div class="chatbot-messages" id="chatbot-messages">
            <!-- Messages will be dynamically added here -->
        </div>

        <!-- Quick replies removed from initial display -->
        <div class="quick-replies" id="quick-replies"></div>

        <div class="chatbot-input-area">
            <input 
                type="text" 
                class="chatbot-input" 
                id="chatbot-input" 
                placeholder="Ketik pesan Anda..."
                autocomplete="off"
            >
            <button class="chatbot-send" id="chatbot-send" aria-label="Send Message">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                    <path d="M2.01 21L23 12 2.01 3 2 10l15 2-15 2z"/>
                </svg>
            </button>
        </div>

        <div class="chatbot-powered">
            Powered by SIKEMAS • Bot Assistant
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // DOM Elements
    const toggle = document.getElementById('chatbot-toggle');
    const chatWindow = document.getElementById('chatbot-window');
    const close = document.getElementById('chatbot-close');
    const input = document.getElementById('chatbot-input');
    const send = document.getElementById('chatbot-send');
    const messages = document.getElementById('chatbot-messages');
    const badge = document.getElementById('chatbot-badge');
    
    let isOpen = false;
    let unreadCount = 0;
    let isProcessing = false;

    // Generate unique user ID
    const userId = 'user_' + (sessionStorage.getItem('sikemas_user_id') || Date.now());
    if (!sessionStorage.getItem('sikemas_user_id')) {
        sessionStorage.setItem('sikemas_user_id', Date.now().toString());
    }

    // Get CSRF Token
    function getCsrfToken() {
        const metaTag = document.querySelector('meta[name="csrf-token"]');
        if (metaTag) {
            return metaTag.getAttribute('content');
        }
        console.error('❌ CSRF token not found in meta tag!');
        return '';
    }

    // Enable/Disable Input
    function setInputEnabled(enabled) {
        input.disabled = !enabled;
        send.disabled = !enabled;
        
        if (enabled) {
            input.focus();
        }
    }

    // Add Message to Chat
    function addMessage(text, type) {
        const messageDiv = document.createElement('div');
        messageDiv.className = `message ${type}`;
        
        const contentDiv = document.createElement('div');
        contentDiv.className = 'message-content';
        
        if (type === 'bot') {
            // Convert newlines to <br> and allow HTML links for bot messages
            contentDiv.innerHTML = text.replace(/\n/g, '<br>');
        } else {
            contentDiv.textContent = text;
        }
        
        messageDiv.appendChild(contentDiv);
        messages.appendChild(messageDiv);
        
        messages.scrollTo({
            top: messages.scrollHeight,
            behavior: 'smooth'
        });

        if (!isOpen && type === 'bot') {
            unreadCount++;
            badge.textContent = unreadCount;
            badge.classList.add('show');
        }
    }

    // Show Typing Indicator
    function showTypingIndicator() {
        const indicator = document.createElement('div');
        indicator.className = 'message bot';
        indicator.id = 'typing-indicator';
        
        const typingDiv = document.createElement('div');
        typingDiv.className = 'typing-indicator';
        typingDiv.innerHTML = '<span></span><span></span><span></span>';
        
        indicator.appendChild(typingDiv);
        messages.appendChild(indicator);
        messages.scrollTop = messages.scrollHeight;
    }

    // Remove Typing Indicator
    function removeTypingIndicator() {
        const indicator = document.getElementById('typing-indicator');
        if (indicator) {
            indicator.remove();
        }
    }
    
    // Send Message to BotMan
    async function sendMessage(message) {
        const trimmedMessage = message.trim();
        if (!trimmedMessage || isProcessing) return;

        isProcessing = true;
        setInputEnabled(false);

        addMessage(trimmedMessage, 'user');
        input.value = ''; 
        
        showTypingIndicator();
        
        try {
            const csrfToken = getCsrfToken();
            
            if (!csrfToken) {
                throw new Error('CSRF token tidak ditemukan');
            }
            
            console.log('📤 Sending message to BotMan:', trimmedMessage);
            
            const response = await fetch('/botman', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: JSON.stringify({
                    driver: 'web',
                    userId: userId,
                    message: trimmedMessage
                })
            });

            removeTypingIndicator();

            if (!response.ok) {
                let errorMessage = '';
                
                switch(response.status) {
                    case 419:
                        errorMessage = '🔴 Sesi Anda telah habis. Silakan refresh halaman (F5).';
                        break;
                    case 500:
                        errorMessage = '🔴 Terjadi kesalahan server. Tim kami sedang memperbaikinya.';
                        break;
                    case 404:
                        errorMessage = '🔴 Endpoint chatbot tidak ditemukan. Hubungi administrator.';
                        break;
                    default:
                        errorMessage = `🔴 Error ${response.status}: ${response.statusText}`;
                }
                
                addMessage(errorMessage, 'bot');
                isProcessing = false;
                setInputEnabled(true);
                return;
            }
            
            const data = await response.json();
            console.log('📥 Received from BotMan:', data);
            
            if (data.messages && data.messages.length > 0) {
                data.messages.forEach((msg, index) => {
                    setTimeout(() => {
                        addMessage(msg.text, 'bot');
                        
                        if (index === data.messages.length - 1) {
                            isProcessing = false;
                            setInputEnabled(true);
                        }
                    }, index * 500);
                });
            } else {
                addMessage('⚠️ Bot tidak memberikan respons. Silakan coba lagi.', 'bot');
                isProcessing = false;
                setInputEnabled(true);
            }
            
        } catch (error) {
            removeTypingIndicator();
            console.error('❌ Chatbot Error:', error);
            addMessage('⚠️ Koneksi gagal: ' + error.message, 'bot');
            isProcessing = false;
            setInputEnabled(true);
        }
    }
    
    // Toggle Chat Window
    toggle.addEventListener('click', () => {
        isOpen = !isOpen;
        chatWindow.classList.toggle('active', isOpen);
        
        if (isOpen) {
            unreadCount = 0;
            badge.classList.remove('show');
            
            if (!sessionStorage.getItem('sikemas_chatbot_started')) {
                messages.innerHTML = '';
                setTimeout(() => {
                    sendMessage('start');
                    sessionStorage.setItem('sikemas_chatbot_started', 'true');
                }, 300);
            } else {
                setInputEnabled(true);
            }
        }
    });

    // Close Chat
    close.addEventListener('click', () => {
        isOpen = false;
        chatWindow.classList.remove('active');
    });

    // Send on Enter key
    input.addEventListener('keypress', (e) => {
        if (e.key === 'Enter' && input.value.trim() && !input.disabled) { 
            e.preventDefault(); 
            sendMessage(input.value);
        }
    });

    // Send Button Click
    send.addEventListener('click', () => {
        if (input.value.trim() && !input.disabled) {
            sendMessage(input.value);
        }
    });

    // Auto-focus input when typing
    document.addEventListener('keydown', (e) => {
        if (isOpen && !input.disabled && e.key.length === 1 && !e.ctrlKey && !e.altKey && !e.metaKey) {
            input.focus();
        }
    });

    console.log('✅ SIKEMAS Chatbot initialized successfully!');
    console.log('👤 User ID:', userId);
});
</script>