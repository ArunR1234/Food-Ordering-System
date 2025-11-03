@extends('admintemplate')
@section('title', 'Registered Users')

@section('content')
    <style>
        .user-list {
            background: #111;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 0 15px rgba(218, 165, 32, 0.3);
            max-width: 1100px;
            margin: 50px auto;
            color: #fff;
        }

        .user-list h2 {
            color: #FFD700;
            font-family: 'Great Vibes', cursive;
            font-size: 1.5rem;
            font-weight: 700;
            margin: 0;
            margin-bottom: 20px;

        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: #222;
            border-radius: 10px;
            overflow: hidden;
            table-layout: fixed;
        }

        th,
        td {
            padding: 12px 10px;
            text-align: center;
            vertical-align: middle;
        }

        th {
            background: #DAA520;
            color: #000;
            font-weight: 600;
            text-transform: uppercase;
        }

        td {
            color: #fff;
            border-bottom: 1px solid #333;
        }

        tr:hover td {
            background: #333;
            transition: 0.3s;
        }

        .user-actions button {
            padding: 6px 12px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-weight: 600;
        }

        .user-actions .delete {
            background: #e74c3c;
            color: #fff;
        }

        .user-actions .delete:hover {
            background: #c0392b;
        }
    </style>

    <div class="user-list">
        <h2>Registered Users</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>NAME</th>
                    <th>EMAIL</th>
                    <th>ROLL</th>
                    <th>REGISTERED ON</th>
                    <th>ACTIONS</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->role }}</td>
                        <td>{{ $user->created_at->format('d M Y') }}</td>
                        <td class="user-actions">
                            <form action="{{ route('deleteUser', $user->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button class="delete">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
