@extends('template')
@section('title', 'Our Chefs')

@section('content')
    <style>
        .chefs-section {
            padding: 120px 20px 60px;
            background: linear-gradient(180deg, #000 0%, #111 100%);
            min-height: 100vh;
        }

        h2.page-title {
            text-align: center;
            color: #FFD700;
            font-family: 'Fredoka One', cursive;
            font-size: 2.5rem;
            margin-bottom: 60px;
        }

        .chefs-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 30px;
            max-width: 1200px;
            margin: 0 auto;
        }

        .chef-card {
            background: #111;
            border-radius: 15px;
            padding: 25px;
            text-align: center;
            color: #fff;
            box-shadow: 0 2px 15px rgba(255, 215, 0, 0.2);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            min-width: 240px;
            flex: 1 1 240px;
            max-width: 280px;
        }

        .chef-card:hover {
            transform: translateY(-7px);
            box-shadow: 0 6px 25px rgba(255, 215, 0, 0.4);
        }

        .chef-card img {
            width: 100%;
            height: 240px;
            border-radius: 15px;
            object-fit: cover;
            margin-bottom: 18px;
            transition: transform 0.3s ease;
            border: none;
        }

        .chef-card:hover img {
            transform: scale(1.05);
        }

        .chef-card h3 {
            color: #FFD700;
            font-family: 'Fredoka One', cursive;
            font-size: 1.5rem;
            margin-bottom: 8px;
        }

        .chef-card p {
            color: #e0e0e0;
            font-size: 1rem;
            font-weight: 500;
            margin: 0;
        }

        @media (max-width: 768px) {
            .chefs-section {
                padding: 100px 15px 50px;
            }

            .chef-card img {
                height: 200px;
            }

            .chef-card h3 {
                font-size: 1.3rem;
            }
        }

        @media (max-width: 480px) {
            h2.page-title {
                font-size: 1.8rem;
                margin-bottom: 40px;
            }

            .chef-card {
                padding: 20px 15px;
                max-width: 220px;
            }

            .chef-card img {
                height: 180px;
            }
        }
    </style>

    <div class="chefs-section">
        <h2 class="page-title">Meet Our Chefs</h2>

        <div class="chefs-container">
            @foreach ($chefs as $chef)
                <div class="chef-card">
                    @if ($chef->image)
                        <img src="{{ asset('images/chefs/' . $chef->image) }}" alt="{{ $chef->name }}">
                    @endif
                    <h3>{{ $chef->name }}</h3>
                    <p>{{ $chef->role }}</p>
                </div>
            @endforeach
        </div>
    </div>
@endsection
