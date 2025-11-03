@extends('admintemplate')
@section('title', 'Search Results')

@section('content')
    <div class="menu-container">
        <h2>Search Menu</h2>

        <form action="{{ route('search') }}" method="GET" class="search-bar" style="margin-bottom: 20px; display: flex; gap: 10px;">
            <input type="text" name="query" value="{{ request('query') }}" placeholder="Search for a dish..." style="flex:1; padding:10px 15px; border-radius:25px; border:1px solid #FFD700; background:#1a1a1a; color:#fff;">
            <button type="submit" class="add-menu-btn" style="padding:8px 18px;">Search</button>
            <button type="button" class="add-menu-btn" style="padding:8px 18px;" onclick="window.location.href='{{ route('search') }}'">All</button>
        </form>

        @if ($menus->isEmpty())
            <p class="no-orders">No results found.</p>
        @else
            <table>
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Menu Name</th>
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

    <style>
        .menu-container {
            max-width: 1000px;
            margin: 40px auto;
            background: #111;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 2px 12px rgba(255, 215, 0, 0.2);
            color: #e0e0e0;
        }

        .menu-container h2 {
            color: #FFD700;
            font-family: 'Great Vibes', cursive;
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 20px;
        }

        .no-orders {
            text-align: center;
            color: #ccc;
            margin-top: 20px;
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
            color: #FFD700;
            font-weight: 600;
            text-transform: uppercase;
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
            border: 1px solid #FFD700;
        }
        .add-menu-btn{
            background: #FFD700;
            color: #111;
            padding: 8px 18px;
            border-radius: 25px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s ease;
            cursor: pointer;
        }
        .add-menu-btn:hover {
            background: #e6b347;
            box-shadow: 0 2px 8px rgba(255, 215, 0, 0.3);
        }
    </style>
@endsection
