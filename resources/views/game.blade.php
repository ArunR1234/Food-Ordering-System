@extends('template')
@section('title', 'Guess The Number')

@section('content')
    <div class="game-container" id="gameBox">
        <h1>GUESS THE NUMBER</h1>
        <p class="subtitle">Guess a number between <strong>1</strong> to <strong>10</strong></p>

        <input id="guessnumber" type="number" placeholder="Enter your guess" min="1" max="10">
        <button onclick="check()">Check</button>

        <p id="result">Enter your guess to start!</p>
        <p>Your Guess: <span id="enteredValue"></span></p>

        <a href="/home" class="back-btn"> Back to Home</a>
    </div>

    <style>
        body {
            background: radial-gradient(circle at center, #121212 0%, #000 100%);
            font-family: 'Poppins', sans-serif;
            color: #e0e0e0;
            text-align: center;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
        }

        .game-container {
            background: linear-gradient(145deg, #1a1a1a 0%, #101010 100%);
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: 20px;
            box-shadow: 0 0 15px rgba(255, 215, 130, 0.05), inset 0 0 10px rgba(255, 215, 130, 0.02);
            padding: 40px 30px;
            width: 360px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .game-container:hover {
            box-shadow: 0 0 20px rgba(255, 215, 130, 0.15);
        }

        h1 {
            font-family: 'Great Vibes', cursive;
            color: #ffcc66;
            font-size: 1.9rem;
            letter-spacing: 2px;
            margin-bottom: 8px;
        }

        .subtitle {
            color: #999;
            font-size: 15px;
            margin-bottom: 25px;
        }

        input {
            padding: 12px;
            width: 80%;
            border-radius: 12px;
            border: 1px solid #ffcc66;
            outline: none;
            text-align: center;
            font-size: 18px;
            background: #222;
            color: #f0f0f0;
            transition: 0.3s;
            box-shadow: inset 0 0 6px rgba(255, 204, 102, 0.05);
        }

        input:focus {
            border-color: #ffd580;
            box-shadow: 0 0 8px #ffcc66, inset 0 0 8px rgba(255, 204, 102, 0.1);
        }

        button {
            display: inline-block;
            margin-top: 20px;
            background: linear-gradient(90deg, #ffb84d, #ffcc66);
            color: #111;
            border: none;
            padding: 12px 35px;
            border-radius: 30px;
            font-weight: bold;
            font-size: 16px;
            cursor: pointer;
            transition: 0.3s ease;
            box-shadow: 0 0 10px rgba(255, 204, 102, 0.3);
        }

        button:hover {
            transform: scale(1.05);
            box-shadow: 0 0 18px rgba(255, 204, 102, 0.5);
        }

        .back-btn {
            display: inline-block;
            margin-top: 30px;
            text-decoration: none;
            background: linear-gradient(90deg, #333, #222);
            color: #ffcc66;
            border: 1px solid #ffcc66;
            padding: 10px 28px;
            border-radius: 25px;
            font-size: 15px;
            transition: 0.3s;
        }

        .back-btn:hover {
            background: #ffcc66;
            color: #111;
            box-shadow: 0 0 10px rgba(255, 204, 102, 0.4);
            transform: translateY(-2px);
        }

        #result {
            font-size: 20px;
            margin-top: 25px;
            font-weight: 600;
            letter-spacing: 1.2px;
            transition: 0.3s;
            text-shadow: 0 0 6px rgba(255, 255, 255, 0.08);
        }

        .right {
            color: #66bb6a;
            text-shadow: 0 0 10px rgba(102, 187, 106, 0.6);
        }

        .wrong {
            color: #ef5350;
            text-shadow: 0 0 10px rgba(239, 83, 80, 0.6);
        }

        .close {
            color: #ffa726;
            text-shadow: 0 0 10px rgba(255, 167, 38, 0.6);
        }

        .shake {
            animation: shake 0.4s;
        }

        @keyframes shake {

            0%,
            100% {
                transform: translateX(0);
            }

            20%,
            60% {
                transform: translateX(-10px);
            }

            40%,
            80% {
                transform: translateX(10px);
            }
        }

        #enteredValue {
            color: #ffcc66;
            font-weight: bold;
            text-shadow: 0 0 6px rgba(255, 204, 102, 0.4);
        }
    </style>

    <script>
        const guessnumber = document.getElementById("guessnumber");
        const result = document.getElementById("result");
        const gameBox = document.getElementById("gameBox");
        const enteredValue = document.getElementById("enteredValue");

        let randomnumber = Math.floor(Math.random() * 10) + 1;

        function check() {
            const enterednumber = Number(guessnumber.value);
            if (!enterednumber || enterednumber < 1 || enterednumber > 10) {
                result.textContent = "Enter a number between 1 and 10";
                result.className = "wrong";
                guessnumber.value = "";
                return;
            }

            const difference = Math.abs(randomnumber - enterednumber);
            enteredValue.textContent = enterednumber;

            if (enterednumber === randomnumber) {
                result.textContent = " YOU ARE RIGHT";
                result.className = "right";
                randomnumber = Math.floor(Math.random() * 10) + 1;

                gameBox.style.transform = "scale(1.05)";
                setTimeout(() => gameBox.style.transform = "scale(1)", 300);
            } else {
                if (difference === 1) {
                    result.textContent = " So Close";
                    result.className = "close";
                } else if (enterednumber > randomnumber) {
                    result.textContent = " Too High";
                    result.className = "wrong";
                } else {
                    result.textContent = " Too Low";
                    result.className = "wrong";
                }
            }

            guessnumber.value = "";
        }

        guessnumber.addEventListener("keypress", function(event) {
            if (event.key === "Enter") check();
        });
    </script>
@endsection
