@extends('template')
@section('title', 'Contact')

@section('content')

    <style>
        body {
            background-color: #0d0d0d;
            color: #fff;
            font-family: 'Open Sans', sans-serif;
            height: 100vh;
            overflow: hidden;
        }

        .contact-container {
            max-width: 800px;
            margin: 100px auto;
            text-align: center;
            padding: 0 20px;
        }

        .contact-container h2 {
            font-family: 'Great Vibes', cursive;
            font-size: 2.8rem;
            color: #ffb703;
            margin-bottom: 20px;
            font-weight: 700;
            letter-spacing: 1px;
        }

        .contact-container p {
            font-size: 1.1rem;
            color: #ccc;
            margin-bottom: 40px;
            font-weight: 400;
            line-height: 1.6;
        }

        form {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 20px;
        }

        input,
        textarea {
            width: 100%;
            max-width: 600px;
            padding: 12px;
            border: none;
            border-radius: 8px;
            background: #1a1a1a;
            color: #fff;
            font-size: 1rem;
            outline: none;
            font-family: 'Open Sans', sans-serif;
        }

        textarea {
            resize: none;
            height: 150px;
        }

        button {
            background: #ffb703;
            color: #000;
            border: none;
            padding: 12px 30px;
            font-size: 1rem;
            border-radius: 25px;
            cursor: pointer;
            font-family: 'Open Sans', sans-serif;
            font-weight: 600;
            transition: 0.3s ease;
        }

        button:hover {
            background: #ffd166;
            transform: translateY(-2px);
        }

        @media (max-width: 768px) {
            .contact-container {
                margin: 80px auto;
                padding: 10px;
            }

            .contact-container h2 {
                font-size: 2rem;
            }

            .contact-container p {
                font-size: 1rem;
            }

            input,
            textarea {
                max-width: 100%;
            }
        }
    </style>

    <div class="contact-container">
        <h2>Contact</h2>
        <p>We’d love to hear from you! Reach out with questions, feedback, or just to say hello.</p>

        <form action="{{ route('contact.send') }}" method="post">
            @csrf
            <input type="text" name="name" placeholder="Your Name">
            <input type="email" name="email" placeholder="Your Email">
            <textarea name="message" placeholder="Your Message"></textarea>
            <button type="submit">Send Message</button>
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
@endsection
