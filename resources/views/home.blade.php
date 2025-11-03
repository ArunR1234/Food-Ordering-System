@extends('template')
@section('title', 'Home')

@section('content')
    <section class="hero">
        <div class="hero-content">
            <h2>Welcome {{ $user->name }}</h2>
            <p>
                Discover a world of flavor, freshness, and warmth. From our kitchen to your table,
                we bring you deliciously crafted dishes made with love and the finest ingredients.
            </p>
            <div class="button-group">
                <a href="/menu" class="btn">
                    <i class="fa-solid fa-book-open"></i>
                    <span>Order Now</span>
                </a>
                <a href="{{ route('randomgame') }}" class="btn">
                    <i class="fa-solid fa-dice"></i>
                    <span>Game</span>
                </a>
            </div>
        </div>
    </section>

    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Open Sans', sans-serif;
            background: url("{{ asset('image/bg.png') }}") no-repeat center center/cover;
            height: 100vh;
            overflow-x: hidden;
            position: relative;
        }

        body::before {
            content: "";
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.45);
            z-index: 0;
        }

        .hero {
            position: relative;
            height: 100vh;
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: flex-start;
            padding-left: 5%;
            margin-left: -35px;
            z-index: 1;
        }

        .hero-content {
            position: relative;
            z-index: 1;
            max-width: 520px;
            color: #fff;
            text-align: left;
        }

        .hero-content h2 {
            font-family: 'Great Vibes', cursive;
            font-size: 3rem;
            color: #ffb703;
            margin-bottom: 1rem;
            font-weight: 700;
            letter-spacing: 1px;
        }

        .hero-content p {
            font-size: 1.05rem;
            line-height: 1.6;
            color: #f8f8f8;
            margin-bottom: 2rem;
            font-weight: 400;
        }


        .button-group {
            display: flex;
            gap: 1rem;
            flex-wrap: wrap;
        }


        .btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            text-decoration: none;
            background-color: #ffb703;
            color: #000;
            font-weight: 600;
            border: none;
            border-radius: 30px;
            padding: 12px 32px;
            cursor: pointer;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        .btn:hover {
            background-color: #ffd166;
            transform: translateY(-2px);
        }

        @media (max-width: 1024px) {
            .hero {
                padding-left: 3%;
            }
        }

        @media (max-width: 768px) {
            .hero {
                justify-content: center;
                padding: 0 5%;
                text-align: center;
                margin-left: 0;
            }

            .hero-content h2 {
                font-size: 2.4rem;
            }

            .hero-content p {
                font-size: 0.95rem;
            }

            .button-group {
                justify-content: center;
            }
        }
    </style>
@endsection
