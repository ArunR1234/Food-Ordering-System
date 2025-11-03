@extends('admintemplate')
@section('title', 'Menu List')

@section('content')
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

        .menu-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .menu-header h2 {
            color: #FFD700;

            font-family: 'Great Vibes', cursive;
            font-size: 1.5rem;
            font-weight: 700;
            margin: 0;
        }

        .add-menu-btn {
            background: #FFD700;
            color: #111;
            padding: 8px 18px;
            border-radius: 25px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .add-menu-btn:hover {
            background: #e6b347;
            box-shadow: 0 2px 8px rgba(255, 215, 0, 0.3);
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

        .action-btn {
            display: inline-block;
            padding: 6px 12px;
            margin-right: 5px;
            border-radius: 25px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .edit-btn {
            background: #FFD700;
            color: #111;
        }

        .edit-btn:hover {
            background: #e6b347;
            box-shadow: 0 2px 8px rgba(255, 215, 0, 0.3);
        }

        .delete-btn {
            background: #e74c3c;
            color: #fff;
        }

        .delete-btn:hover {
            background: #c0392b;
            box-shadow: 0 2px 8px rgba(231, 76, 60, 0.3);
        }
    </style>

    <div class="menu-container">
        <div class="menu-header">
            <h2>Menu List</h2>
            <a href="{{ route('addmenu') }}" class="add-menu-btn">Add Menu</a>
        </div>

        <table>
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Menu Name</th>
                    <th>Price (₹)</th>
                    <th>Actions</th>
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
                        <td>₹{{ $menu->price }}</td>
                        <td>
                            <a href="{{ route('menuedit', $menu->id) }}" class="action-btn edit-btn">Edit</a>
                            <a href="{{ route('menudelete', $menu->id) }}" class="action-btn delete-btn">Delete</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <script>
        @if (session('success'))
            toastr.success("{{ session('success') }}");
        @endif
        @if (session('error'))
            toastr.error("{{ session('error') }}");
        @endif
    </script>
@endsection
