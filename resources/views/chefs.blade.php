@extends('admintemplate')
@section('title', 'Chefs')

@section('content')
    <style>
        .chef-container {
            max-width: 1000px;
            margin: 40px auto;
            background: #111;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 2px 12px rgba(255, 215, 0, 0.2);
            color: #e0e0e0;
        }

        .chef-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .chef-header h2 {
            color: #FFD700;
            font-family: 'Great Vibes', cursive;
           font-size: 1.5rem;
            font-weight: 700;
            margin: 0;
        }

        .add-chef-btn {
            background: #FFD700;
            color: #111;
            padding: 8px 18px;
            border-radius: 25px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .add-chef-btn:hover {
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

    <div class="chef-container">
        <div class="chef-header">
            <h2>Chef List</h2>
            <a href="{{ route('admin.chefs.create') }}" class="add-chef-btn"> Add Chef</a>
        </div>

        <table>
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Role</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($chefs as $chef)
                    <tr>
                        <td>
                            @if ($chef->image)
                                <img src="{{ asset('images/chefs/' . $chef->image) }}" alt="{{ $chef->name }}">
                            @else
                                <span>No Image</span>
                            @endif
                        </td>
                        <td>{{ $chef->name }}</td>
                        <td>{{ $chef->role }}</td>
                        <td>
                            <a href="{{ route('admin.chefs.edit', $chef->id) }}" class="action-btn edit-btn">Edit</a>
                            <form action="{{ route('admin.chefs.delete', $chef->id) }}" method="POST"
                                style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="action-btn delete-btn">Delete</button>
                            </form>
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
