@extends('template')
@section('title', 'Menu')

@section('content')
    <style>
        body {
            background: #000;
            color: #fff;
            margin: 0;
            padding-top: 80px;
            font-family: 'Open Sans', sans-serif;
        }

        .top-bar {
            display: flex;
            justify-content: center;
            padding: 20px 40px;
            flex-wrap: wrap;
            gap: 15px;
        }

        .search-area {
            display: flex;
            align-items: center;
            gap: 10px;
            flex-wrap: wrap;
        }

        .search-box {
            display: flex;
            align-items: center;
            background: #111;
            border-radius: 25px;
            padding: 5px 10px;
            box-shadow: 0 0 6px rgba(252, 191, 73, 0.2);
            transition: 0.3s;
        }

        .search-box button {
            margin-top: -2px;
        }


        .search-box input,
        .search-box button,
        .back-btn {
            height: 40px;
            border-radius: 20px;
            font-weight: 600;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .search-box input {
            width: 220px;
            padding: 0 12px;
            background: #1c1c1c;
            border: 1px solid #fcbf49;
            outline: none;
            color: #fff;
            transition: 0.3s;
        }

        .search-box input::placeholder {
            color: #fcbf49;
        }

        .search-box input:focus {
            background: #222;
            border-color: #e6b347;
            box-shadow: 0 0 8px rgba(252, 191, 73, 0.4);
        }

        .search-box button,
        .back-btn {
            background: #fcbf49;
            border: none;
            color: #000;
            padding: 0 15px;
            cursor: pointer;
            transition: 0.3s;
            text-decoration: none;
            margin-left: 8px;
        }

        .search-box button:hover,
        .back-btn:hover {
            background: #e6b347;
            box-shadow: 0 2px 8px rgba(252, 191, 73, 0.3);
            color: #000;
        }

        .card-container {
            display: flex;
            flex-wrap: wrap;
            gap: 30px;
            justify-content: center;
            padding: 30px;
        }

        .card {
            background: #111;
            border-radius: 12px;
            width: 220px;
            padding: 15px;
            text-align: center;
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .card:hover {
            transform: scale(1.03);
            box-shadow: 0 4px 12px rgba(252, 191, 73, 0.2);
        }

        .card img {
            width: 100%;
            border-radius: 8px;
            height: 140px;
            object-fit: cover;
            margin-bottom: 10px;
        }

        h3 {
            color: #fcbf49;
            margin: 10px 0;
            font-family: 'Great Vibes', cursive;
        }

        .price {
            font-weight: 700;
            color: #e91e63;
            margin: 8px 0;
        }

        button {
            background: #fcbf49;
            color: #000;
            border: none;
            padding: 10px;
            margin-top: 10px;
            cursor: pointer;
            border-radius: 25px;
            width: 100%;
            font-weight: 600;
            transition: 0.3s;
        }

        button:hover {
            background: #e6b347;
            box-shadow: 0 2px 8px rgba(252, 191, 73, 0.3);
        }

        @media (max-width: 768px) {
            .card {
                width: 45%;
            }

            .search-box input {
                width: 150px;
            }
        }

        @media (max-width: 480px) {
            .card {
                width: 90%;
            }

            .search-area {
                flex-direction: column;
                align-items: center;
                width: 100%;
            }

            .search-box {
                width: 100%;
                justify-content: center;
            }

            .back-btn {
                width: 100%;
                text-align: center;
                margin-left: 0;
                margin-top: 8px;
            }
        }
    </style>

    <div class="top-bar">
        <div class="search-area">
            <form action="{{ route('menu.search') }}" method="GET" class="search-box">
                <input type="text" name="query" placeholder="Search menu..." value="{{ request('query') }}">
                <button type="submit">Search</button>
            </form>
            <a href="{{ route('menu') }}" class="back-btn">ALL</a>
        </div>
    </div>

    <div class="card-container">
        @forelse ($menus as $menu)
            <div class="card">
                <img src="{{ asset($menu->image) }}" alt="{{ $menu->name }}">
                <h3>{{ $menu->name }}</h3>
                <p class="price">₹{{ $menu->price }}</p>
                <button class="add-to-cart" data-id="{{ $menu->id }}">Add to Cart</button>
            </div>
        @empty
            <p>No menu items found.</p>
        @endforelse
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
    <script>
        document.querySelectorAll('.add-to-cart').forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                const id = this.dataset.id;

                fetch(`/add/${id}`, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'X-Requested-With': 'XMLHttpRequest',
                            'Accept': 'application/json',
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            toastr.success(data.success);
                        } else if (data.error) {
                            toastr.error(data.error);
                        }
                    })
                    .catch(() => toastr.error('Something went wrong. Please try again.'));
            });
        });
    </script>

@endsection
