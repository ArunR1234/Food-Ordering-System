@extends('template')
@section('title', 'About')

@section('content')
    <style>
        body {
            background-color: #0d0d0d;
            color: #fff;
            font-family: 'Open Sans', sans-serif;
            height: 100vh;
            overflow: hidden;
        }

        .about-section {
            margin: 25vh auto 100px auto;
            max-width: 1000px;
            text-align: center;
            padding: 20px;
        }

        .about-section h2 {
            font-family: 'Great Vibes', cursive;
            font-size: 2.8rem;
            color: #ffb703;
            margin-bottom: 20px;
            font-weight: 700;
            letter-spacing: 1px;
        }

        .about-section p {
            font-family: 'Open Sans', sans-serif;
            font-size: 1.1rem;
            color: #ddd;
            margin-bottom: 20px;
            line-height: 1.7;
            font-weight: 400;
        }

        @media (max-width: 768px) {
            .about-section {
                margin: 18vh auto;
                padding: 10px;
            }

            .about-section h2 {
                font-size: 2rem;
            }

            .about-section p {
                font-size: 1rem;
            }
        }
    </style>

    <div class="about-section">
        <h2>About Rsoft Food Restaurant</h2>
        <p>
            Welcome to Rsoft Food Restaurant — where every bite tells a story! Founded with a passion for flavor and
            quality,
            we bring you the finest fast food experience crafted with love and care.
        </p>
        <p>
            Our chefs use only the freshest ingredients to create meals that satisfy your cravings and warm your heart.
            Whether it’s our juicy burgers, crispy fries, or our secret sauces, every dish is made to delight.
        </p>
        <p>
            We believe in more than just serving food — we serve happiness, one plate at a time.
        </p>
    </div>
@endsection
