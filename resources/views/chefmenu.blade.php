<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chef Menu Search</title>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary: #DAA520;
            --bg-dark: #121212;
            --card-bg: #1e1e1e;
            --text-light: #e0e0e0;
            --text-muted: #bbb;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Open Sans', sans-serif;
            background: var(--bg-dark);
            color: var(--text-light);
            min-height: 100vh;
            padding-top: 90px;
        }

        /* Navbar */
        .navbar {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            background: #1a1a1a;
            color: var(--primary);
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 18px 40px;
            box-shadow: 0 4px 12px rgba(218, 165, 32, 0.15);
            z-index: 1000;
        }

        .navbar h1 {
            font-size: 1.8rem;
            font-weight: 700;
            display: flex;
            align-items: center;
            font-family: 'Great Vibes', cursive;
            gap: 10px;
        }

        .nav-right button {
            background: transparent;
            border: 2px solid var(--primary);
            border-radius: 10px;
            padding: 10px 20px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-left: 10px;
        }

        .navbar button a {
            color: var(--primary);
            text-decoration: none;
            font-size: 1rem;
        }

        .navbar button:hover {
            background: var(--primary);
            box-shadow: 0 0 10px var(--primary);
        }

        .navbar button:hover a {
            color: var(--bg-dark);
        }

        /* Menu Container */
        .menu-container {
            max-width: 1000px;
            margin: 40px auto;
            background: var(--card-bg);
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 2px 12px rgba(218, 165, 32, 0.2);
            color: #e0e0e0;
        }

        .menu-container h2 {
            color: var(--primary);
            font-family: 'Great Vibes', cursive;
            font-size: 1.8rem;
            font-weight: 700;
            margin-bottom: 25px;
            text-align: center;
        }

        .search-bar {
            display: flex;
            gap: 10px;
            margin-bottom: 20px;
        }

        .search-bar input {
            flex: 1;
            padding: 10px 15px;
            border-radius: 25px;
            border: 1px solid var(--primary);
            background: #1a1a1a;
            color: #fff;
        }

        .search-btn {
            background: var(--primary);
            color: #121212;
            padding: 10px 20px;
            border-radius: 25px;
            font-weight: 600;
            border: none;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .search-btn:hover {
            background: #cfa72c;
            box-shadow: 0 2px 8px rgba(218, 165, 32, 0.3);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        th,
        td {
            padding: 12px 15px;
            text-align: left;
        }

        th {
            background: #222;
            color: var(--primary);
            text-transform: uppercase;
            font-weight: 600;
        }

        tr:nth-child(even) {
            background: #1a1a1a;
        }

        tr:hover {
            background: #222;
            transition: 0.3s;
        }

        td img {
            width: 60px;
            height: 60px;
            border-radius: 8px;
            object-fit: cover;
            border: 1px solid var(--primary);
        }

        .no-results {
            text-align: center;
            color: #aaa;
            margin-top: 20px;
        }

        .status {
            font-weight: 600;
            padding: 4px 10px;
            border-radius: 5px;
        }

        .available {
            color: #32CD32;
        }

        .unavailable {
            color: #ff5555;
        }

        /* Responsive */
        @media (max-width: 600px) {
            .navbar {
                flex-direction: column;
                padding: 15px 20px;
                text-align: center;
            }

            .nav-right {
                margin-top: 10px;
            }

            .navbar h1 {
                font-size: 1.5rem;
                justify-content: center;
            }

            .nav-right button {
                margin: 5px;
            }

            .search-bar {
                flex-direction: column;
            }

            .search-btn {
                width: 100%;
            }
        }
    </style>
</head>

<body>

    <div class="navbar">
        <h1>Chef Dashboard</h1>

        <div class="nav-right">
            <button><a href="{{ route('chef') }}">Dashboard</a></button>
            <button><a href="{{ route('logout') }}">Logout</a></button>
        </div>
    </div>

    <div class="menu-container">
        <h2>Search Menu</h2>

        <form action="{{ route('chefmenu') }}" method="GET" class="search-bar">
            <input type="text" name="query" value="{{ request('query') }}" placeholder="Search for a dish...">
            <button type="submit" class="search-btn">Search</button>
            <button type="button" class="search-btn"
                onclick="window.location.href='{{ route('chefmenu') }}'">All</button>
        </form>

        @if ($menus->isEmpty())
            <p class="no-results">No results found.</p>
        @else
            <table>
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Dish Name</th>
                        <th>Price (₹)</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($menus as $menu)
                        <tr>
                            <td>
                                @if ($menu->image)
                                    <img src="{{ asset($menu->image) }}" alt="{{ $menu->name }}">
                                @endif
                            </td>
                            <td>{{ $menu->name }}</td>
                            <td>₹{{ number_format($menu->price, 2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>

</body>

</html>
