<!DOCTYPE html>
<html>
<head>
    <title>Online Exam System</title>

    <!-- Bootstrap CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Your Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/auth-custom.css') }}">
</head>

<body class="bg-light">

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container">
        <a class="navbar-brand fw-bold" href="#">
            Online Exam System
        </a>

        <div class="ms-auto">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="btn btn-sm btn-light">Logout</button>
            </form>
        </div>
    </div>
</nav>

<!-- Page Content -->
<div class="container mt-4">
    @yield('content')
</div>

{{-- Chatbot --}}
@include('chatbot')

<script>
document.addEventListener("DOMContentLoaded", function() {

    const toggleBtn = document.getElementById("chatbot-toggle");
    const chatBox = document.getElementById("chatbot-box");
    const closeBtn = document.getElementById("chatbot-close");
    const sendBtn = document.getElementById("chatSend");
    const input = document.getElementById("chatInput");
    const chatBody = document.getElementById("chatBody");

    toggleBtn.onclick = function() {
        chatBox.classList.toggle("d-none");
    };

    closeBtn.onclick = function() {
        chatBox.classList.add("d-none");
    };

    sendBtn.onclick = sendMessage;

    input.addEventListener("keypress", function(e) {
        if (e.key === "Enter") sendMessage();
    });

    function sendMessage() {

        let message = input.value.trim();
        if(message === "") return;

        chatBody.innerHTML += `<div class="user-message">${message}</div>`;
        input.value = "";

        fetch("/chatbot/process", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": "{{ csrf_token() }}"
            },
            body: JSON.stringify({ message: message })
        })
        .then(res => res.json())
        .then(data => {
            chatBody.innerHTML += `<div class="bot-message">${data.reply}</div>`;
            chatBody.scrollTop = chatBody.scrollHeight;
        })
        .catch(() => {
            chatBody.innerHTML += `<div class="bot-message">Server error.</div>`;
        });
    }
});
</script>


</body>
</html>
