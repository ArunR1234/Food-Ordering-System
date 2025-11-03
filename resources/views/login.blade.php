<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Open Sans', sans-serif;
        }

        body {
            background: radial-gradient(circle at top left, #111 0%, #000 80%);
            color: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .icon {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(12px);
            padding: 45px 55px;
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(255, 183, 3, 0.15);
            width: 360px;
        }

        .icon h1 {
            text-align: center;
            margin-bottom: 10px;
            font-weight: 600;
            color: #ffb703;
            letter-spacing: 1px;
            font-family: 'Great Vibes', cursive;
        }

        .icon hr {
            border: none;
            height: 1px;
            background: linear-gradient(to right, transparent, #ffb703, transparent);
            margin-bottom: 25px;
        }

        form .in {
            margin-bottom: 20px;
            display: flex;
            flex-direction: column;
        }

        label {
            font-size: 14px;
            color: #ccc;
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 6px;
        }

        input,
        select {
            width: 100%;
            padding: 10px;
            border: 1px solid transparent;
            border-radius: 6px;
            outline: none;
            background: rgba(255, 255, 255, 0.08);
            color: #fff;
            transition: all 0.3s ease;
        }

        input:focus,
        select:focus {
            background: rgba(255, 255, 255, 0.15);
            border: 1px solid #ffb703;
            box-shadow: 0 0 5px rgba(255, 183, 3, 0.4);
        }

        select {
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
            cursor: pointer;
        }

        select option {
            background-color: #111;
            color: #fff;
        }

        .field {
            text-align: center;
            margin-top: 25px;
        }

        .button {
            width: 100%;
            padding: 12px;
            background: linear-gradient(45deg, #ffb703, #e0a106);
            border: none;
            border-radius: 6px;
            color: #000;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .button:hover {
            background: linear-gradient(45deg, #ffd166, #ffb703);
            transform: translateY(-2px);
        }

        .register {
            text-align: center;
            margin-top: 15px;
            font-size: 14px;
            color: #ccc;
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 5px;
            white-space: nowrap;
        }

        .register a {
            color: #ffb703;
            text-decoration: none;
            font-weight: 500;
        }

        .register a:hover {
            text-decoration: underline;
            color: #ffd166;
        }


        .material-icons {
            color: #ffb703;
            font-size: 18px;
        }

        .forgot {
            text-align: right;
            margin-top: 10px;
        }

        .forgot a {
            color: #ffb703;
            font-size: 13px;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .forgot a:hover {
            color: #ffd166;
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <div class="icon">
        <h1>Login</h1>
        <hr>
        <form action="{{ route('logstore') }}" method="post">
            @csrf
            <div class="in">
                <label for="email"><i class="material-icons">email</i> Email</label>
                <input id="email" type="email" name="email">
            </div>

            <div class="in">
                <label for="password"><i class="material-icons">lock</i> Password</label>
                <input id="password" type="password" name="password">
                <div class="forgot">
                    <a href="{{ route('forgot') }}">Forgot Password?</a>
                </div>
            </div>



            <div class="field">
                <input class="button" type="submit" value="Login">
            </div>

            <div class="register">
                Don't have an account? <a href="{{ route('register') }}">Register Now</a>
            </div>

        </form>
    </div>
    <script>
        @if (session('error'))
            toastr.error("{{ session('error') }}");
        @endif
        @if (session('success'))
            toastr.success("{{ session('success') }}");
        @endif

        @foreach ($errors->all() as $error)
            toastr.error("{{ $error }}");
        @endforeach
    </script>
</body>

</html>

