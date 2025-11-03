@extends('template')
@section('title', 'Checkout')

@section('content')
    <style>
        body {
            background: #000;
            color: #fff;
            padding-top: 100px;
            font-family: 'Open Sans', sans-serif;
        }

        .checkout-container {
            max-width: 900px;
            margin: auto;
            background: #111;
            padding: 30px;
            border-radius: 12px;
        }

        h2 {
            text-align: center;
            color: #ffb703;
            font-family: 'Great Vibes', cursive;
            font-size: 36px;
            margin-bottom: 30px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th,
        td {
            padding: 12px;
            text-align: center;
            border-bottom: 1px solid #222;
        }

        th {
            color: #ffb703;
            font-weight: 600;
        }

        td img {
            width: 80px;
            height: 80px;
            border-radius: 8px;
            object-fit: cover;
        }

        .total {
            text-align: right;
            font-size: 20px;
            margin-top: 20px;
        }

        .checkout-actions {
            display: flex;
            justify-content: space-between;
            margin-top: 30px;
        }

        .checkout-actions a,
        .checkout-actions button {
            background: #ffb703;
            color: #000;
            padding: 12px 25px;
            border-radius: 25px;
            font-weight: 600;
            text-decoration: none;
            border: none;
            cursor: pointer;
        }

        .checkout-actions a:hover,
        .checkout-actions button:hover {
            background: #e0a106;
        }
    </style>

    <div class="checkout-container">
        <h2>Checkout Preview</h2>

        <table>
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($cartItems as $item)
                    <tr>
                        <td><img src="{{ asset($item->menu->image) }}" alt=""></td>
                        <td>{{ $item->menu->name }}</td>
                        <td>₹{{ $item->menu->price }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>₹{{ $item->menu->price * $item->quantity }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="total">
            <strong>Total: ₹{{ $total }}</strong>
        </div>

        <form action="{{ route('checkoutcomplete') }}" method="POST">
            @csrf
            <div class="checkout-actions">
                <a href="{{ route('cart') }}">Back to Cart</a>
                <button type="submit">Place Order</button>
            </div>
        </form>
    </div>
@endsection
