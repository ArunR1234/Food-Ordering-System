<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chef Dashboard</title>

    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary: #DAA520;
            --bg-dark: #121212;
            --card-bg: #1e1e1e;
            --text-light: #f0f0f0;
            --text-muted: #bdbdbd;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Open Sans', sans-serif;
            background: var(--bg-dark);
            color: var(--text-light);
            min-height: 100vh;
            padding-top: 90px;
        }

        /* Navbar */
        .navbar {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            background: #1a1a1a;
            color: var(--primary);
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 18px 40px;
            box-shadow: 0 4px 12px rgba(218, 165, 32, 0.15);
            z-index: 1000;
        }

        .navbar h1 {
            font-size: 1.9rem;
            font-family: 'Great Vibes', cursive;
            letter-spacing: 1px;
        }

        .navbar .buttons {
            display: flex;
            gap: 15px;
        }

        .navbar button {
            background: transparent;
            border: 2px solid var(--primary);
            border-radius: 10px;
            padding: 10px 20px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .navbar button a {
            color: var(--primary);
            text-decoration: none;
            font-size: 1rem;
        }

        .navbar button:hover {
            background: var(--primary);
            box-shadow: 0 0 10px var(--primary);
        }

        .navbar button:hover a {
            color: var(--bg-dark);
        }

        /* Dashboard */
        .dashboard-container {
            max-width: 1300px;
            margin: 0 auto;
            padding: 30px 20px 60px;
        }

        /* Summary cards grid */
        .summary {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 25px;
            margin-bottom: 60px;
        }

        .summary-card,
        .card {
            background: var(--card-bg);
            border-radius: 15px;
            padding: 35px 25px;
            text-align: center;
            box-shadow: 0 0 15px rgba(218, 165, 32, 0.08);
            border: 1.5px solid transparent;
            transition: all 0.3s ease;
        }

        .summary-card:hover,
        .card:hover {
            transform: translateY(-5px);
            border-color: var(--primary);
            box-shadow: 0 6px 20px rgba(218, 165, 32, 0.15);
        }

        .summary-card h2 {
            color: var(--primary);
            font-size: 2.6rem;
            margin-bottom: 10px;
        }

        .summary-card p {
            color: var(--text-muted);
            font-size: 1.1rem;
            font-family: 'Great Vibes', cursive;
        }

        .card h3 {
            color: var(--primary);
            font-family: 'Great Vibes', cursive;
            font-size: 1.7rem;
            margin-bottom: 12px;
        }

        .card p {
            font-size: 2.4rem;
            color: var(--text-light);
            font-weight: 700;
        }

        .card span {
            color: var(--text-muted);
            font-size: 1.1rem;
            font-family: 'Great Vibes', cursive;
        }

        /* Order Cards */
        #orders {
            display: flex;
            flex-direction: column;
            gap: 25px;
        }

        .order-card {
            background: var(--card-bg);
            border-left: 5px solid var(--primary);
            border-radius: 12px;
            padding: 25px 30px;
            transition: all 0.4s ease;
            box-shadow: 0 2px 12px rgba(218, 165, 32, 0.07);
        }

        .order-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 4px 18px rgba(218, 165, 32, 0.1);
        }

        .order-card.fade-out {
            opacity: 0;
            transform: translateY(-10px);
        }

        .order-header h2 {
            font-size: 1.3rem;
            color: var(--primary);
            margin-bottom: 12px;
        }

        .order-items {
            list-style: none;
            margin-bottom: 20px;
            padding-left: 10px;
        }

        .order-items li {
            color: var(--text-muted);
            font-size: 1rem;
            line-height: 1.8;
        }

        .status-buttons {
            display: flex;
            gap: 12px;
        }

        .status-btn {
            flex: 1;
            border: none;
            border-radius: 8px;
            background: #2a2a2a;
            color: var(--primary);
            padding: 10px 0;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .status-btn:hover {
            background: var(--primary);
            color: var(--bg-dark);
            box-shadow: 0 0 8px var(--primary);
        }

        .status-btn.active {
            background: var(--primary);
            color: var(--bg-dark);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .navbar {
                padding: 15px 25px;
                flex-direction: column;
                gap: 10px;
            }

            .navbar h1 {
                font-size: 1.6rem;
            }

            .dashboard-container {
                padding: 20px;
            }
        }
    </style>
</head>

<body>

    <div class="navbar">
        <h1>Chef Dashboard</h1>
        <div class="buttons">
            <button><a href="{{ route('chefmenu') }}">MENU</a></button>
            <button><a href="{{ route('logout') }}">Logout</a></button>
        </div>
    </div>

    <div class="dashboard-container">
        <div class="summary">
            <div class="summary-card">
                <h2 id="pending-count">0</h2>
                <p>Pending</p>
            </div>
            <div class="summary-card">
                <h2 id="preparing-count">0</h2>
                <p>Preparing</p>
            </div>




            <div class="card">
                <h3>Today's Orders</h3>
                <p>{{ $todaysOrders }}</p>
                <span>Orders Today</span>
            </div>


        </div>

        <div id="orders">
            @foreach ($orders as $order)
                @if ($order->status !== 'ready')
                    <div class="order-card" id="order-{{ $order->id }}" data-status="{{ $order->status }}">
                        <div class="order-header">
                            <h2>Order #{{ $order->id }} — {{ $order->user->name }}</h2>
                        </div>
                        <ul class="order-items">
                            @foreach ($order->items as $item)
                                <li>{{ $item->menu->name }} × {{ $item->quantity }}</li>
                            @endforeach
                        </ul>
                        <div class="status-buttons">
                            <button class="status-btn pending {{ $order->status == 'pending' ? 'active' : '' }}"
                                onclick="setStatus({{ $order->id }}, 'pending')">Pending</button>
                            <button class="status-btn preparing {{ $order->status == 'preparing' ? 'active' : '' }}"
                                onclick="setStatus({{ $order->id }}, 'preparing')">Preparing</button>
                            <button class="status-btn ready {{ $order->status == 'ready' ? 'active' : '' }}"
                                onclick="setStatus({{ $order->id }}, 'ready')">Ready</button>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </div>

    <script>
        function setStatus(orderId, status) {
            if (status === 'ready' && !confirm("Are you sure this order is ready?")) return;

            fetch(`/chef/order/${orderId}/status`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        status: status
                    })
                })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        const order = document.getElementById(`order-${orderId}`);
                        if (status === 'ready') {
                            order.classList.add('fade-out');
                            setTimeout(() => {
                                order.remove();
                                updateSummary();
                            }, 400);
                        } else {
                            order.dataset.status = status;
                            order.querySelectorAll('.status-btn').forEach(btn => btn.classList.remove('active'));
                            order.querySelector(`.status-btn.${status}`).classList.add('active');
                            updateSummary();
                        }
                    }
                });
        }

        function updateSummary() {
            const orders = document.querySelectorAll('.order-card');
            let pending = 0,
                preparing = 0;

            orders.forEach(order => {
                const status = order.dataset.status;
                if (status === 'pending') pending++;
                if (status === 'preparing') preparing++;
            });

            document.getElementById('pending-count').textContent = pending;
            document.getElementById('preparing-count').textContent = preparing;
        }

        function loadOrders() {
            fetch(`{{ route('chef.fetchOrders') }}`)
                .then(res => res.json())
                .then(orders => {
                    const container = document.getElementById('orders');
                    container.innerHTML = '';
                    orders.filter(o => o.status !== 'ready').forEach(o => {
                        const items = o.items.map(i => `<li>${i.menu.name} × ${i.quantity}</li>`).join('');
                        container.innerHTML += `
                            <div class="order-card" id="order-${o.id}" data-status="${o.status}">
                                <div class="order-header"><h2>Order #${o.id} — ${o.user.name}</h2></div>
                                <ul class="order-items">${items}</ul>
                                <div class="status-buttons">
                                    <button class="status-btn pending ${o.status === 'pending' ? 'active' : ''}" onclick="setStatus(${o.id}, 'pending')">Pending</button>
                                    <button class="status-btn preparing ${o.status === 'preparing' ? 'active' : ''}" onclick="setStatus(${o.id}, 'preparing')">Preparing</button>
                                    <button class="status-btn ready ${o.status === 'ready' ? 'active' : ''}" onclick="setStatus(${o.id}, 'ready')">Ready</button>
                                </div>
                            </div>`;
                    });
                    updateSummary();
                });
        }

        loadOrders();
        setInterval(loadOrders, 5000);
    </script>

</body>

</html>
