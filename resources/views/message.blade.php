@extends('admintemplate')
@section('title', 'Messages')

@section('content')
    <div class="orders-container">
        <h2>Contact Messages</h2>

        @if ($messages->isEmpty())
            <p class="no-orders">No messages found.</p>
        @else
            <table class="orders-table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Message</th>
                        <th>Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($messages as $msg)
                        <tr>
                            <td>{{ $msg->name }}</td>
                            <td>{{ $msg->email }}</td>
                            <td>{{ $msg->message }}</td>
                            <td>{{ $msg->created_at->format('d M Y h:i A') }}</td>
                            <td class="user-actions">
                                <form action="{{ route('messages.delete', $msg->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button class="delete">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>

    <style>
        .orders-container {
            background: #111;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 0 15px rgba(218, 165, 32, 0.3);
            max-width: 1100px;
            margin: 50px auto;
            color: #fff;
        }

        .orders-container h2 {
            color: #FFD700;
            font-family: 'Great Vibes', cursive;
            font-size: 1.5rem;
            font-weight: 700;
            margin: 0 0 20px 0;
        }

        .no-orders {
            color: #ccc;
        }

        .orders-table {
            width: 100%;
            border-collapse: collapse;
            background: #222;
            border-radius: 10px;
            overflow: hidden;
            table-layout: fixed;
        }

        .orders-table th {
            background: #DAA520;
            color: #000;
            padding: 12px;
            border: 1px solid #444;
        }

        .orders-table td {
            padding: 12px 10px;
            color: #fff;
            border: 1px solid #444;
        }

        .orders-table td.capitalize {
            text-transform: capitalize;
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
@endsection
