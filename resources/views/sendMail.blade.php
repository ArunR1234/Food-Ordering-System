@extends('admintemplate')
@section('title', 'Send Mail')

@section('content')
    <style>
        .mail-form {
            background: #222;
            padding: 30px 40px;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.6);
            max-width: 600px;
            margin: 40px auto;
            color: #e0e0e0;
            border: 1px solid #DAA520;
            transition: all 0.3s ease;
        }

        .mail-form:hover {
            box-shadow: 0 0 15px rgba(218, 165, 32, 0.3);
            transform: translateY(-3px);
        }

        .mail-form h2 {
            text-align: center;
            color: #DAA520;
            margin-bottom: 25px;
            font-weight: 700;
            font-family: 'Great Vibes', cursive;
            font-size: 1.8rem;
            letter-spacing: 1px;
        }

        .mail-form label {
            display: block;
            margin-top: 15px;
            font-weight: 600;
            color: #f5f5f5;
            font-size: 0.95rem;
        }

        .mail-form select,
        .mail-form input,
        .mail-form textarea {
            width: 100%;
            padding: 12px;
            margin-top: 8px;
            border-radius: 8px;
            border: 1px solid #444;
            background: #1a1a1a;
            color: #fff;
            font-size: 0.95rem;
            transition: 0.3s;
            font-family: 'Open Sans', sans-serif;
        }

        .mail-form select:focus,
        .mail-form input:focus,
        .mail-form textarea:focus {
            outline: none;
            border-color: #DAA520;
            box-shadow: 0 0 8px rgba(218, 165, 32, 0.4);
        }

        .mail-form button {
            width: 100%;
            background: #DAA520;
            border: none;
            color: #000;
            font-weight: 700;
            font-size: 1rem;
            padding: 12px 0;
            border-radius: 8px;
            margin-top: 25px;
            cursor: pointer;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .mail-form button:hover {
            background: #ffcc33;
            box-shadow: 0 0 15px rgba(218, 165, 32, 0.6);
            transform: translateY(-2px);
        }

        .alert-success {
            background: #154c1a;
            color: #aaffaa;
            padding: 12px;
            border-left: 4px solid #28a745;
            border-radius: 6px;
            margin-bottom: 15px;
            text-align: center;
            font-weight: 500;
        }
    </style>

    <div class="mail-form">
        <h2>Send Email to User</h2>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <form action="{{ route('admin.mail.send') }}" method="POST">
            @csrf

            <label for="email">Select User</label>
            <select name="email" required>
                <option value="">-- Select Email --</option>
                <option value="all">Send All Users</option>
                @foreach ($users as $user)
                    <option value="{{ $user->email }}">{{ $user->email }}</option>
                @endforeach
            </select>

            <label for="subject">Subject</label>
            <input type="text" name="subject" placeholder="Enter subject" required>

            <label for="message">Message</label>
            <textarea name="message" rows="5" placeholder="Write your message here..." required></textarea>

            <button type="submit">Send Mail</button>
        </form>
    </div>
@endsection
