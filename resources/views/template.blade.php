<!DOCTYPE html>
<html lang="en">

<head>
    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>


    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0&icon_names=chat" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Open Sans", sans-serif;
        }

        body {
            min-height: 100vh;
            width: 100%;
            color: #fff;
            background-color: #000;
            overflow-x: hidden;
        }

        nav {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem 4rem;
            z-index: 1000;
        }

        .logo {
            font-size: 1.8rem;
            font-weight: 700;
            color: #fff;
            letter-spacing: 1px;
        }

        nav ul {
            list-style: none;
            display: flex;
            align-items: center;
            gap: 30px;
        }

        nav ul li a {
            text-decoration: none;
            color: #fff;
            font-weight: 500;
            letter-spacing: 0.5px;
            padding: 6px 12px;
            position: relative;
            transition: color 0.3s ease;
        }

        nav ul li a::after {
            content: "";
            position: absolute;
            left: 0;
            bottom: -4px;
            width: 0%;
            height: 2px;
            background: #fcbf49;
            transition: width 0.3s ease-in-out;
        }

        nav ul li a:hover::after {
            width: 100%;
        }

        nav ul li a:hover {
            color: #fcbf49;
        }

        .icons {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .icons i {
            font-size: 1.2rem;
            color: #fff;
            cursor: pointer;
            position: relative;
            transition: color 0.3s ease;
        }

        .icons i::after {
            content: "";
            position: absolute;
            left: 0;
            bottom: -6px;
            width: 0%;
            height: 2px;
            background: #fcbf49;
            transition: width 0.3s ease-in-out;
        }

        .icons i:hover::after {
            width: 100%;
        }

        .icons i:hover {
            color: #fcbf49;
        }

        .logout-btn {
            text-decoration: none;
            color: #fff;
            font-weight: 600;
            padding: 6px 16px;
            border-radius: 25px;
            transition: all 0.3s ease;
            position: relative;
        }

        .logout-btn::after {
            content: "";
            position: absolute;
            left: 0;
            bottom: -5px;
            width: 0%;
            height: 2px;
            background: #fcbf49;
            transition: width 0.3s ease-in-out;
        }

        .logout-btn:hover::after {
            width: 100%;
        }

        .logout-btn:hover {
            color: #fcbf49;
        }

        @media (max-width: 900px) {
            nav {
                padding: 1rem 2rem;
            }

            nav ul {
                gap: 15px;
            }
        }
    </style>
</head>

<body>
    <nav>
        @include('nav')
    </nav>
    @yield('content')


    <div id="chat-icon"><span class="material-symbols-outlined">chat</span></div>


    <div id="chat-widget">
        <div id="chat-header">
            <button id="back-btn">x</button>
            Chat Support
        </div>

        <div id="chat-body">

        </div>

        <div id="chat-footer">
            <input type="text" id="chat-input" placeholder="Type your message" />
            <button id="chat-send">Send</button>
        </div>
    </div>


    <script>
        const chatSend = document.getElementById("chat-send");
        const chatInput = document.getElementById("chat-input");
        const chatBody = document.getElementById("chat-body");
        const chatIcon = document.getElementById("chat-icon");
        const chatWidget = document.getElementById("chat-widget");
        const backBtn = document.getElementById("back-btn");


        function appendMessage(message, sender) {
            const msgDiv = document.createElement("div");
            msgDiv.classList.add("message", sender);
            msgDiv.textContent = message;
            chatBody.appendChild(msgDiv);
            chatBody.scrollTop = chatBody.scrollHeight;
        }


        function sendMessage() {
            const message = chatInput.value.trim();
            if (message === "") return;

            appendMessage(message, "user");
            chatInput.value = "";

            fetch("{{ route('message') }}", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                    },
                    body: JSON.stringify({
                        message: message
                    })
                })
                .then(response => {
                    if (!response.ok) throw new Error("Network response was not ok");
                    return response.json();
                })
                .then(data => appendMessage(data.message, "bot"))
                .catch(error => {
                    console.error("Fetch error:", error);
                    appendMessage("⚠️ Error connecting to server.", "bot");
                });
        }

        chatSend.addEventListener("click", sendMessage);
        chatInput.addEventListener("keypress", function(e) {
            if (e.key === "Enter") sendMessage();
        });

        chatIcon.addEventListener("click", () => {
            chatWidget.style.display = "flex";
            chatIcon.style.display = "none";
        });

        backBtn.addEventListener("click", () => {
            chatWidget.style.display = "none";
            chatIcon.style.display = "flex";
        });


        let isDragging = false;
        let offsetX, offsetY;

        chatHeader = document.getElementById("chat-header");

        chatHeader.style.cursor = "move";

        chatHeader.addEventListener("mousedown", (e) => {
            isDragging = true;
            offsetX = e.clientX - chatWidget.offsetLeft;
            offsetY = e.clientY - chatWidget.offsetTop;
            chatWidget.style.transition = "none";
        });

        document.addEventListener("mouseup", () => {
            isDragging = false;
            chatWidget.style.transition = "all 0.3s";
        });

        document.addEventListener("mousemove", (e) => {
            if (!isDragging) return;

            let left = e.clientX - offsetX;
            let top = e.clientY - offsetY;


            const maxLeft = window.innerWidth - chatWidget.offsetWidth;
            const maxTop = window.innerHeight - chatWidget.offsetHeight;

            left = Math.max(0, Math.min(left, maxLeft));
            top = Math.max(0, Math.min(top, maxTop));

            chatWidget.style.left = `${left}px`;
            chatWidget.style.top = `${top}px`;
            chatWidget.style.bottom = "auto";
            chatWidget.style.right = "auto";
            chatWidget.style.position = "fixed";
        });
    </script>


    <style>
        #chat-icon {
            position: fixed;
            bottom: 20px;
            right: 20px;
            width: 60px;
            height: 60px;
            background-color: #ebbd1a;
            color: #000000;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 28px;
            cursor: pointer;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
            z-index: 9998;
            transition: transform 0.3s, opacity 0.3s;
        }

        #chat-icon:hover {
            transform: scale(1.1);
        }


        #chat-widget {
            position: fixed;
            bottom: 90px;
            right: 20px;
            width: 300px;
            max-height: 400px;
            background: #111;
            color: #010101;
            border-radius: 12px;
            display: none;
            flex-direction: column;
            overflow: hidden;
            font-family: sans-serif;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
            transition: all 0.3s;
            z-index: 9999;
        }

        #chat-header {
            background: #fcbf49;
            padding: 10px;
            cursor: pointer;
            font-weight: bold;
            text-align: center;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
        }

        #back-btn {
            position: absolute;
            left: 10px;
            background: none;
            border: none;
            color: rgb(4, 3, 3);
            font-size: 20px;
            cursor: pointer;
        }

        #chat-body {
            flex: 1;
            padding: 10px;
            overflow-y: auto;
            display: flex;
            flex-direction: column;
        }

        #chat-footer {
            display: flex;
            border-top: 1px solid #333;
        }

        #chat-input {
            flex: 1;
            border: none;
            padding: 10px;
            outline: none;
            background: #222;
            color: #fff;
        }

        #chat-send {
            background: #25d331;
            border: none;
            color: #fff;
            padding: 0 15px;
            cursor: pointer;
        }

        .message {
            margin: 5px 0;
            padding: 8px 12px;
            border-radius: 15px;
            max-width: 80%;
        }

        .user {
            background: #0b93f6;
            align-self: flex-end;
        }

        .bot {
            background: #555;
            align-self: flex-start;
        }

        ul li i {
            margin-right: 8px;
        }

        .logo {
            color: #fcbf49;
            font-family: 'Great Vibes', cursive;
        }
    </style>



</body>

</html>
