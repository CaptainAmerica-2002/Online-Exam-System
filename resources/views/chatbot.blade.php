<style>
#chatbot-container {
    position: fixed;
    bottom: 20px;
    right: 20px;
    z-index: 9999;
}

/* Toggle button */
#chatbot-toggle {
    width: 60px;
    height: 60px;
    background: #0d6efd;
    color: white;
    font-size: 28px;
    border-radius: 50%;
    text-align: center;
    line-height: 60px;
    cursor: pointer;
}

/* Chat window */
#chatbot-box {
    width: 320px;
    height: 420px;
    background: white;
    border-radius: 15px;
    box-shadow: 0 0 15px rgba(0,0,0,0.2);
    display: flex;
    flex-direction: column;
    overflow: hidden;
    margin-bottom: 10px;
}

.chat-header {
    background: #0d6efd;
    color: white;
    padding: 10px;
    font-weight: bold;
    display: flex;
    justify-content: space-between;
}

.chat-body {
    flex: 1;
    padding: 10px;
    overflow-y: auto;
    background: #f1f1f1;
    display: flex;
    flex-direction: column;
}

.user-message {
    background: #0d6efd;
    color: white;
    padding: 8px 12px;
    border-radius: 15px;
    margin-bottom: 8px;
    max-width: 75%;
    align-self: flex-end;
}

.bot-message {
    background: #e4e6eb;
    padding: 8px 12px;
    border-radius: 15px;
    margin-bottom: 8px;
    max-width: 75%;
}

.chat-footer {
    display: flex;
    padding: 8px;
    border-top: 1px solid #ddd;
}
.chat-footer input {
    flex: 1;
    border-radius: 20px;
    border: 1px solid #ccc;
    padding: 5px 10px;
}
.chat-footer button {
    margin-left: 5px;
}
</style>


<!-- 🔥 IMPORTANT CONTAINER -->
<div id="chatbot-container">

    <div id="chatbot-box" class="d-none">
        <div class="chat-header">
            AI Assistant
            <span id="chatbot-close" style="cursor:pointer;">&times;</span>
        </div>

        <div class="chat-body" id="chatBody">
            <div class="bot-message">
                👋 Ask me about exams, results, login, departments.
            </div>
        </div>

        <div class="chat-footer">
            <input type="text" id="chatInput" placeholder="Type message...">
            <button id="chatSend" class="btn btn-primary btn-sm">Send</button>
        </div>
    </div>

    <div id="chatbot-toggle">💬</div>

</div>
