@extends('template')
@section('title', 'Order Details')

@section('content')
    <div class="container">
        <h2>Order #{{ $order->id }} - Status: <span class="{{ $order->status }}">{{ ucfirst($order->status) }}</span></h2>
        <ul>
            @foreach ($order->items as $item)
                <li>{{ $item->menu->name }} × {{ $item->quantity }} (₹{{ $item->menu->price }})</li>
            @endforeach
        </ul>
        <p>Total: ₹{{ $order->items->sum(fn($i) => $i->menu->price * $i->quantity) }}</p>
        <a href="{{ route('track.orders') }}">Back to Orders</a>
    </div>

    <style>
        .container {
            background: #0b0b0b;
            padding: 30px;
            border-radius: 15px;
            color: #f1f1f1;
            max-width: 700px;
            margin: 100px auto 50px auto;
            box-shadow: 0 0 20px rgba(252, 191, 73, 0.15);
        }

        .container h2 {
            font-size: 1.6rem;
            font-weight: 700;
            color: #fcbf49;
            margin-bottom: 20px;
            text-align: center;
            letter-spacing: 0.5px;
        }

        .container ul {
            list-style: none;
            margin: 20px 0;
            padding: 0;
        }

        .container ul li {
            background: #151515;
            padding: 10px 15px;
            margin-bottom: 8px;
            border-radius: 8px;
            border: 1px solid #222;
            color: #ddd;
            transition: all 0.3s ease;
        }

        .container ul li:hover {
            border-color: #fcbf49;
            box-shadow: 0 0 8px rgba(252, 191, 73, 0.2);
        }

        .container p {
            font-size: 1.1rem;
            font-weight: 600;
            margin-top: 15px;
            color: #fff;
            text-align: right;
        }

        .container a {
            display: inline-block;
            margin-top: 25px;
            background: #fcbf49;
            color: #000;
            text-decoration: none;
            font-weight: 600;
            padding: 10px 20px;
            border-radius: 25px;
            transition: all 0.3s ease;
        }

        .container a:hover {
            background: #e0aa2b;
            transform: translateY(-2px);
        }


        .pending {
            color: #f39c12;
            background: rgba(243, 156, 18, 0.15);
            padding: 4px 10px;
            border-radius: 8px;
        }

        .preparing {
            color: #3498db;
            background: rgba(52, 152, 219, 0.15);
            padding: 4px 10px;
            border-radius: 8px;
        }

        .ready {
            color: #2ecc71;
            background: rgba(46, 204, 113, 0.15);
            padding: 4px 10px;
            border-radius: 8px;
        }


        @media (max-width: 600px) {
            .container {
                padding: 20px;
                margin: 80px 10px;
            }

            .container h2 {
                font-size: 1.2rem;
            }

            .container p {
                text-align: left;
            }
        }
    </style>

@endsection
