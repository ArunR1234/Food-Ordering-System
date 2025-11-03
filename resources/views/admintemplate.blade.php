<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>

    <link
        href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;500;600;700&family=Fredoka+One&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <script src="https://code.highcharts.com/highcharts.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <style>
        body {
            margin: 0;
            font-family: 'Open Sans', sans-serif;
            background: #121212;
            color: #e0e0e0;
        }


        .sidebar {
            width: 230px;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            background: #1c1c1c;
            padding-top: 20px;
            box-shadow: 2px 0 12px rgba(0, 0, 0, 0.7);
            border-right: 2px solid #DAA520;
            z-index: 1000;
            transition: width 0.3s ease;
        }

        .sidebar h2 {
            text-align: center;
            color: #DAA520;
            font-weight: 700;
            font-family: 'Great Vibes', cursive;
            font-size: 28px;
            margin-bottom: 30px;
            transition: opacity 0.3s ease, font-size 0.3s ease;
        }

        .sidebar a {
            display: flex;
            align-items: center;
            gap: 15px;
            padding: 14px 25px;
            color: #e0e0e0;
            text-decoration: none;
            transition: 0.3s;
            font-weight: 500;
            overflow: hidden;
        }

        .sidebar a:hover {
            background: #DAA520;
            color: #000;
            font-weight: 600;
        }


        .sidebar .material-symbols-outlined {
            font-size: 22px;
            vertical-align: middle;
            min-width: 24px;
            text-align: center;
        }


        .sidebar.collapsed {
            width: 70px;
        }

        .sidebar.collapsed h2 {
            opacity: 0;
            font-size: 0;
        }

        .sidebar.collapsed a {
            justify-content: center;
            gap: 0;
        }


        .sidebar a span.text {
            transition: opacity 0.2s ease;
        }

        .sidebar.collapsed a span.text {
            opacity: 0;
            width: 0;
            overflow: hidden;
        }


        .navbar {
            height: 60px;
            background: #222;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 30px;
            position: fixed;
            left: 230px;
            right: 0;
            top: 0;
            color: #DAA520;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.5);
            border-bottom: 2px solid #DAA520;
            z-index: 950;
            transition: left 0.3s ease;
        }

        .navbar h1 {
            font-size: 22px;
            font-size: 2.2rem;
            font-weight: 700;
            color: #DAA520;
            margin: 0;
            font-family: 'Great Vibes', cursive;
        }

        .navbar.collapsed {
            left: 70px;
        }

        .refresh-btn {
            background: transparent;
            border: 2px solid #DAA520;
            color: #DAA520;
            padding: 8px 18px;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .refresh-btn:hover {
            background: #DAA520;
            color: #000;
            box-shadow: 0 0 10px rgba(218, 165, 32, 0.4);
        }

        .logout {
            color: #DAA520;
            text-decoration: none;
            font-weight: 600;
            transition: 0.3s;
        }

        .logout:hover {
            color: #fff;
        }

        .content {
            margin-left: 230px;
            margin-top: 80px;
            padding: 20px 40px;
            background: #1a1a1a;
            border-radius: 12px;
            min-height: calc(100vh - 80px);
            transition: margin-left 0.3s ease;
        }

        .content.collapsed {
            margin-left: 70px;
        }
    </style>
</head>

<body>

    <div class="sidebar">
        <h2>Admin</h2>
        <a href="{{ route('admin') }}"><span class="material-symbols-outlined">dashboard</span><span
                class="text">Dashboard</span></a>
        <a href="{{ route('search') }}"><span class="material-symbols-outlined">search</span><span class="text">Search
                Menu</span></a>
        <a href="{{ route('menulist') }}"><span class="material-symbols-outlined">restaurant_menu</span><span
                class="text">Food Menu</span></a>
        <a href="{{ route('orders') }}"><span class="material-symbols-outlined">receipt_long</span><span
                class="text">Orders</span></a>
        <a href="{{ route('chefs') }}"><span class="material-symbols-outlined">chef_hat</span><span
                class="text">Chefs</span></a>
        <a href="{{ route('messages') }}"><span class="material-symbols-outlined">mail</span><span
                class="text">Messages</span></a>
        <a href="{{ route('regusers') }}"><span class="material-symbols-outlined">group</span><span class="text">Reg
                Users</span></a>
        <a href="{{ route('chart') }}"><span class="material-symbols-outlined">bar_chart</span><span
                class="text">Ordering Chart</span></a>
        <a href="{{ route('admin.mail.form') }}"><span class="material-symbols-outlined">email</span><span
                class="text">Send Mail</span></a>

    </div>

    <div class="navbar">
        <button id="toggleSidebar" class="refresh-btn">☰</button>
        <h1>R Menu</h1>
        <a href="{{ route('logout') }}" class="logout">Log out</a>
    </div>

    <div class="content">
        @yield('content')
    </div>

    <script>
        const sidebar = document.querySelector('.sidebar');
        const content = document.querySelector('.content');
        const navbar = document.querySelector('.navbar');
        const toggleBtn = document.getElementById('toggleSidebar');

        if (localStorage.getItem('sidebarCollapsed') === 'true') {
            sidebar.classList.add('collapsed');
            content.classList.add('collapsed');
            navbar.classList.add('collapsed');
        }

        toggleBtn.addEventListener('click', () => {
            sidebar.classList.toggle('collapsed');
            content.classList.toggle('collapsed');
            navbar.classList.toggle('collapsed');
            localStorage.setItem('sidebarCollapsed', sidebar.classList.contains('collapsed'));
        });
    </script>

</body>

</html>
