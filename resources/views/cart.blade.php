@extends('template')
@section('title', 'Cart')

@section('content')

    <style>
        body {
            font-family: 'Open Sans', sans-serif;
            background: #000;
            color: #fff;
            margin: 0;
            padding-top: 100px;
        }

        .cart-container {
            max-width: 900px;
            margin: auto;
            padding: 30px;
            background: #111;
            border-radius: 12px;
        }

        h2 {
            text-align: center;
            font-size: 36px;
            color: #ffb703;
            font-family: 'Great Vibes', cursive;
            margin-bottom: 30px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
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

        .qty-input {
            width: 60px;
            text-align: center;
            padding: 8px;
            border: none;
            border-radius: 6px;
            background: #1a1a1a;
            color: #fff;
        }

        .remove-btn {
            background: #e91e63;
            color: #fff;
            padding: 6px 12px;
            border-radius: 6px;
            text-decoration: none;
        }

        .remove-btn:hover {
            background: #d21858;
        }

        .total-section {
            text-align: right;
            margin-top: 20px;
            font-size: 20px;
        }

        .cart-actions {
            display: flex;
            justify-content: space-between;
            margin-top: 30px;
            gap: 10px;
        }

        .cart-actions a,
        .cart-actions button {
            background: #ffb703;
            color: #000;
            padding: 12px 25px;
            border-radius: 25px;
            font-weight: 600;
            text-decoration: none;
            cursor: pointer;
        }

        .cart-actions a:hover,
        .cart-actions button:hover {
            background: #e0a106;
        }

        @media (max-width: 768px) {
            table {
                font-size: 14px;
            }

            td img {
                width: 60px;
                height: 60px;
            }

            .cart-actions {
                flex-direction: column;
            }
        }
    </style>

    <div class="cart-container">
        <h2>Your Cart</h2>
        <form action="{{ route('cartupdate') }}" method="POST">
            @csrf
            <table>
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Subtotal</th>
                        <th>Remove</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($cartItems as $item)
                        <tr>
                            <td>
                                <img src="{{ asset($item->menu->image) }}" alt="{{ $item->menu->name }}">
                            </td>
                            <td>{{ $item->menu->name }}</td>
                            <td class="price">₹{{ $item->menu->price }}</td>
                            <td>
                                <input type="number" name="quantities[{{ $item->id }}]" class="qty-input"
                                    value="{{ $item->quantity }}" min="1">
                            </td>
                            <td class="subtotal">₹{{ $item->menu->price * $item->quantity }}</td>
                            <td>
                                <a href="{{ route('cartremove', $item->id) }}" class="remove-btn">Remove</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="total-section">
                Total: ₹{{ $total }}
            </div>

            <div class="cart-actions">
                <a href="{{ route('menu') }}">Continue Shopping</a>
                <a href="{{ route('checkout') }}">Proceed to Checkout</a>
            </div>
        </form>
    </div>


    <script>
        $(function() {
            function updateTotals() {
                let total = 0;
                $('tbody tr').each(function() {
                    let subtotal = parseFloat($(this).find('.subtotal').text().replace('₹', '')) || 0;
                    total += subtotal;
                });
                $('.total-section').text('Total: ₹' + total.toFixed(2));
            }


            $('.qty-input').on('input', function() {
                let row = $(this).closest('tr'),
                    price = parseFloat(row.find('.price').text().replace('₹', '')) || 0,
                    qty = parseInt($(this).val()) || 0,
                    subtotal = price * qty;

                row.find('.subtotal').text('₹' + subtotal.toFixed(2));
                updateTotals();


                $.ajax({
                    url: "{{ route('cart.liveUpdate') }}",
                    method: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        id: row.find('.qty-input').attr('name').match(/\d+/)[0],
                        quantity: qty
                    },
                    success: function(res) {
                        if (res.success) {
                            toastr.success(res.success);
                        } else if (res.error) {
                            toastr.error(res.error);
                        }
                    },
                    error: function() {
                        toastr.error('Failed to update quantity.');
                    }
                });
            });

            updateTotals();

            @if (session('error'))
                toastr.error("{{ session('error') }}");
            @endif
            @if (session('success'))
                toastr.success("{{ session('success') }}");
            @endif
            @foreach ($errors->all() as $error)
                toastr.error("{{ $error }}");
            @endforeach
        });
    </script>

@endsection
