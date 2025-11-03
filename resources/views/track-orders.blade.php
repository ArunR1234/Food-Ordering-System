@extends('template')
@section('title', 'Track Orders')

@section('content')
    <div class="container" id="orders-container">
        <h2>Your Orders</h2>

        @foreach ($orders as $order)
            <div class="order-card" id="order-{{ $order->id }}">
                <h3>
                    Order #{{ $order->id }} - Status:
                    <span class="status {{ $order->status }}" data-status="{{ $order->status }}">
                        {{ ucfirst($order->status) }}
                    </span>
                </h3>
                <ul>
                    @foreach ($order->items as $item)
                        <li>{{ $item->menu->name }} × {{ $item->quantity }} (₹{{ $item->menu->price }})</li>
                    @endforeach
                </ul>
                <p>Total: ₹{{ $order->items->sum(fn($i) => $i->menu->price * $i->quantity) }}</p>
                <a href="{{ route('track.details', $order->id) }}">View Details</a>
            </div>
        @endforeach
    </div>

    <style>
        .container {
            background: #0b0b0b;
            padding: 30px;
            border-radius: 15px;
            color: #f1f1f1;
            max-width: 900px;
            margin: 100px auto 50px auto;
            box-shadow: 0 0 20px rgba(252, 191, 73, 0.15);
        }

        .container h2 {
            font-size: 1.8rem;
            font-weight: 700;
            color: #fcbf49;
            margin-bottom: 25px;
            text-align: center;
            letter-spacing: 1px;
        }

        .order-card {
            background: #151515;
            border: 1px solid #333;
            padding: 20px;
            margin-bottom: 20px;
            border-radius: 12px;
            transition: all 0.3s ease;
            box-shadow: 0 0 10px rgba(252, 191, 73, 0.05);
        }

        .order-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 0 15px rgba(252, 191, 73, 0.2);
            border-color: #fcbf49;
        }

        .order-card h3 {
            font-size: 1.1rem;
            font-weight: 600;
            color: #fff;
            margin-bottom: 10px;
        }

        .order-card ul {
            list-style: none;
            margin: 10px 0;
            padding: 0;
        }

        .order-card ul li {
            padding: 6px 0;
            border-bottom: 1px solid #222;
            color: #ccc;
        }

        .order-card ul li:last-child {
            border-bottom: none;
        }

        .order-card p {
            margin-top: 10px;
            font-size: 1rem;
            font-weight: 500;
            color: #f1f1f1;
        }

        .order-card a {
            display: inline-block;
            margin-top: 12px;
            background: #fcbf49;
            color: #000;
            text-decoration: none;
            font-weight: 600;
            padding: 8px 15px;
            border-radius: 25px;
            transition: all 0.3s ease;
        }

        .order-card a:hover {
            background: #e0aa2b;
            transform: translateY(-2px);
        }

        .status.pending {
            color: #f39c12;
        }

        .status.preparing {
            color: #3498db;
        }

        .status.ready {
            color: #2ecc71;
        }

        .status.updated {
            animation: pulse 1s ease;
        }

        @keyframes pulse {
            0% {
                transform: scale(1);
                opacity: 1;
            }

            50% {
                transform: scale(1.2);
                opacity: 0.7;
            }

            100% {
                transform: scale(1);
                opacity: 1;
            }
        }

        @media (max-width: 600px) {
            .container {
                padding: 20px;
                margin: 80px 10px;
            }

            .order-card {
                padding: 15px;
            }

            .order-card h3 {
                font-size: 1rem;
            }
        }
    </style>


    <script>
        function fetchCustomerOrders() {
            $.ajax({
                url: "{{ route('customer.fetchOrders') }}",
                method: "GET",
                success: function(orders) {
                    orders.forEach(function(order) {
                        let orderCard = $('#order-' + order.id);

                        if (orderCard.length) {
                            let statusSpan = orderCard.find('.status');
                            let currentStatus = statusSpan.data('status');

                            if (currentStatus !== order.status) {
                                statusSpan.text(order.status.charAt(0).toUpperCase() + order.status
                                    .slice(1));
                                statusSpan.attr('class', 'status ' + order.status + ' updated');
                                statusSpan.data('status', order.status);
                                setTimeout(() => statusSpan.removeClass('updated'), 1000);
                            }
                        } else {

                            let itemsHtml = '';
                            order.items.forEach(function(item) {
                                itemsHtml +=
                                    `<li>${item.menu.name} × ${item.quantity} (₹${item.menu.price})</li>`;
                            });
                            let total = order.items.reduce((sum, i) => sum + (i.menu.price * i
                                .quantity), 0);

                            let orderHtml = `
                    <div class="order-card" id="order-${order.id}">
                        <h3>Order #${order.id} - Status:
                            <span class="status ${order.status}" data-status="${order.status}">
                                ${order.status.charAt(0).toUpperCase() + order.status.slice(1)}
                            </span>
                        </h3>
                        <ul>${itemsHtml}</ul>
                        <p>Total: ₹${total}</p>
                        <a href="/track-orders/${order.id}">View Details</a>
                    </div>`;
                            $('#orders-container').append(orderHtml);
                        }
                    });
                },
                error: function() {
                    console.error("Error fetching customer orders");
                }
            });
        }


        setInterval(fetchCustomerOrders, 3000);
    </script>
@endsection
