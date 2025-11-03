@extends('admintemplate')
@section('title', 'Admin Dashboard')

@section('content')
    <style>
        .dashboard-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
        }

        .card {
            background: #1a1a1a;
            border: 1px solid #FFD700;
            border-radius: 12px;
            padding: 25px;
            text-align: center;
            box-shadow: 0 0 10px rgba(255, 215, 0, 0.2);
            transition: 0.3s ease;
            cursor: pointer;
        }

        .card:hover {
            transform: translateY(-6px);
            box-shadow: 0 0 20px rgba(255, 215, 0, 0.4);
        }

        .card h3 {
            color: #FFD700;
            margin-bottom: 12px;
            font-size: 20px;
            font-weight: 600;
            font-family: 'Great Vibes', cursive;
        }

        .card p {
            font-size: 28px;
            margin: 0;
            color: #fff;
            font-weight: 700;
        }

        .card span {
            font-size: 14px;
            color: #b3b3b3;
        }

        a.card-link {
            text-decoration: none;
            color: inherit;
        }
    </style>

    <div class="dashboard-container">


        <a href="{{ route('regusers') }}" class="card-link">
            <div class="card">
                <h3>TOTAL USERS</h3>
                <p>{{ $totalUsers }}</p>
                <span>Total Registered Users</span>
            </div>
        </a>

        <a href="{{ route('regusers') }}" class="card-link">
            <div class="card">
                <h3>ACTIVE CUSTOMER</h3>
                <p>{{ $activecustomer }}</p>
                <span>Active Customer</span>
            </div>
        </a>


        <a href="{{ route('regusers') }}" class="card-link">
            <div class="card">
                <h3>ACTIVE CHEFS</h3>
                <p>{{ $activeChefs }}</p>
                <span>Active Chefs</span>
            </div>
        </a>

        

        <a href="{{ route('regusers') }}" class="card-link">
            <div class="card">
                <h3>ACTIVE ADMIN</h3>
                <p>{{ $activeadmin }}</p>
                <span>Active Admin</span>
            </div>
        </a>


        <a href="{{ route('menulist') }}" class="card-link">
            <div class="card">
                <h3>TOTAL MENU ITEMS</h3>
                <p>{{ $totalMenuItems }}</p>
                <span>Total Menu Items</span>
            </div>
        </a>


        <a href="{{ route('orders') }}" class="card-link">
            <div class="card">
                <h3>TOTAL ORDERS</h3>
                <p>{{ $totalorders }}</p>
                <span>Total Orders</span>
            </div>
        </a>


        <a href="{{ route('messages') }}" class="card-link">
            <div class="card">
                <h3>TOTAL MESSAGES</h3>
                <p>{{ $totalmessages }}</p>
                <span>Total Messages</span>
            </div>
        </a>

        <a href="{{ route('orders') }}" class="card-link">
            <div class="card">
                <h3>TODAY'S ORDERS</h3>
                <p>{{ $todaysOrders }}</p>
                <span>Orders Today</span>
            </div>
        </a>

        <a href="{{ route('chefs') }}" class="card-link">
            <div class="card">
                <h3>OUR CHEFS</h3>
                <p>{{ $ourchef }}</p>
                <span>Our Chefs</span>
            </div>
        </a>


        <a href="{{ route('orders') }}" class="card-link">
            <div class="card">
                <h3>PENDING ORDERS</h3>
                <p>{{ $pendingOrders }}</p>
                <span>Pending Orders</span>
            </div>
        </a>

        <a href="{{ route('orders') }}" class="card-link">
            <div class="card">
                <h3>PREPARING ORDERS</h3>
                <p>{{ $preparingOrders }}</p>
                <span> Preparing Orders </span>
            </div>
        </a>

        <a href="{{ route('orders') }}" class="card-link">
            <div class="card">
                <h3>READY ORDERS</h3>
                <p>{{ $readyOrders }}</p>
                <span>Ready Orders</span>
            </div>
        </a>

    </div>
@endsection
