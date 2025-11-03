<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>

    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <style>
        body {
            background: radial-gradient(circle at top left, #111 0%, #000 80%);
            color: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            font-family: 'Open Sans', sans-serif;
        }

        .box {
            background: rgba(255, 255, 255, 0.05);
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(255, 183, 3, 0.2);
            width: 340px;
        }

        h2 {
            color: #ffb703;
            text-align: center;
            margin-bottom: 20px;
        }

        input {
            width: 100%;
            padding: 10px;
            border-radius: 6px;
            border: none;
            margin-bottom: 15px;
            background: rgba(255, 255, 255, 0.1);
            color: #fff;
        }

        .btn {
            width: 100%;
            background: linear-gradient(45deg, #ffb703, #e0a106);
            border: none;
            padding: 10px;
            border-radius: 6px;
            color: #000;
            font-weight: 600;
            cursor: pointer;
        }

        a {
            display: block;
            text-align: center;
            margin-top: 10px;
            color: #ffb703;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="box">
        <h2>Reset Password</h2>

        <form action="{{ route('forgot.updatePassword') }}" method="POST">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">
            <input type="email" name="email" placeholder="Enter your email" required>
            <input type="password" name="password" placeholder="New password" required>
            <input type="password" name="password_confirmation" placeholder="Confirm password" required>
            <button type="submit" class="btn">Update Password</button>
            <a href="{{ route('login') }}">Back to Login</a>
        </form>
    </div>

    <script>
        @if (session('success'))
            toastr.success("{{ session('success') }}");
        @endif
        @if (session('error'))
            toastr.error("{{ session('error') }}");
        @endif
        @foreach ($errors->all() as $error)
            toastr.error("{{ $error }}");
        @endforeach
    </script>
</body>
</html>
