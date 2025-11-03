@extends('admintemplate')
@section('title', 'Orders')

@section('content')
    <div class="orders-container">
        <h2>Orders Management</h2>

        @if ($orders->isEmpty())
            <p class="no-orders">No orders found.</p>
        @else
            <table class="orders-table">
                <thead>
                    <tr>
                        <th>Customer</th>
                        <th>Items</th>
                        <th>Status</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Action</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                        <tr>
                            <td>{{ $order->user->name }}</td>
                            <td>
                                <ul>
                                    @foreach ($order->items as $item)
                                        <li>{{ $item->menu->name ?? 'Deleted Item' }} × {{ $item->quantity }}</li>
                                    @endforeach
                                </ul>
                            </td>
                            <td class="capitalize">{{ $order->status }}</td>
                            <td>{{ $order->created_at->format('d M Y') }}</td>
                            <td>{{ $order->created_at->format('h:i A') }}</td>
                            <td class="user-actions">
                                <form action="{{ route('deleteorder', $order->id) }}" method="POST" style="display:inline;">
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
        .orders-table {
            width: 100%;
            border-collapse: collapse;
            background: #222;
            border-radius: 10px;
            overflow: hidden;
            table-layout: fixed;
        }

        .orders-table th,
        .orders-table td {
            padding: 12px 10px;
            text-align: left;
            vertical-align: top;
        }

        .orders-table th {
            background: #DAA520;
            color: #000;
        }

        .orders-table td {
            border-bottom: 1px solid #333;
            color: #fff;
        }

        .orders-table ul {
            margin: 0;
            padding-left: 18px;
        }

        .update-form {
            display: flex;
            gap: 6px;
            align-items: center;
        }

        .update-form select {
            padding: 6px;
            border-radius: 6px;
            background: #333;
            color: #fff;
            border: 1px solid #DAA520;
        }

        .update-form button {
            background: #DAA520;
            border: none;
            padding: 6px 12px;
            border-radius: 6px;
            font-weight: 600;
            cursor: pointer;
        }

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
            margin: 0;
            margin-bottom: 20px;
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
        }

        .orders-table th {
            background: #DAA520;
            color: #000;
            padding: 12px;
        }

        .orders-table td {
            padding: 10px;
            border-bottom: 1px solid #333;
        }

        .orders-table td.capitalize {
            text-transform: capitalize;
        }

        .orders-table ul {
            margin: 0;
            padding-left: 18px;
        }

        .update-form {
            display: flex;
            gap: 6px;
            align-items: center;
        }

        .update-form select {
            padding: 6px;
            border-radius: 6px;
            background: #333;
            color: #fff;
            border: 1px solid #DAA520;
        }

        .update-form button {
            background: #DAA520;
            border: none;
            padding: 6px 12px;
            border-radius: 6px;
            font-weight: 600;
            cursor: pointer;
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
