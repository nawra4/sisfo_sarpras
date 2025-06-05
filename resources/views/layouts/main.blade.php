<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>@yield('title') | SisfoSarpras</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap');

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(120deg, #667eea, #764ba2);
            min-height: 100vh;
            color: #fff;
            display: flex;
            overflow-x: hidden;
        }

        /* Sidebar */
        nav.sidebar {
            position: fixed;
            top: 0;
            left: 0;
            bottom: 0;
            width: 260px;
            background: rgba(0, 0, 0, 0.3);
            padding: 40px 25px;
            display: flex;
            flex-direction: column;
            gap: 28px;
            box-shadow: 4px 0 15px rgba(0, 0, 0, 0.45);
            transition: width 0.3s ease;
            z-index: 1000;
        }

        nav.sidebar a {
            color: #dcdce3;
            text-decoration: none;
            font-weight: 600;
            font-size: 1.15rem;
            padding: 12px 18px;
            border-radius: 10px;
            transition: background-color 0.25s ease, color 0.25s ease;
            user-select: none;
        }

        nav.sidebar a:hover,
        nav.sidebar a.active {
            background-color: #5a67d8;
            color: white;
            box-shadow: 0 2px 8px rgba(90, 103, 216, 0.7);
        }

        nav.sidebar .btn-logout {
            margin-top: auto;
            background-color: #e53e3e;
            padding: 12px 18px;
            border-radius: 10px;
            text-align: center;
            font-weight: 700;
            font-size: 1rem;
            cursor: pointer;
            transition: background-color 0.3s ease, box-shadow 0.3s ease;
            color: white;
            user-select: none;
        }

        nav.sidebar .btn-logout:hover {
            background-color: #b32b2b;
            box-shadow: 0 0 12px #b32b2b;
        }

        /* Main content */
        main.content {
            margin-left: 260px;
            padding: 50px 60px;
            flex-grow: 1;
            overflow-y: auto;
            max-height: 100vh;
            scrollbar-width: thin;
            scrollbar-color: rgba(90, 103, 216, 0.7) transparent;
        }
        main.content::-webkit-scrollbar {
            width: 8px;
        }
        main.content::-webkit-scrollbar-track {
            background: transparent;
        }
        main.content::-webkit-scrollbar-thumb {
            background-color: rgba(90, 103, 216, 0.7);
            border-radius: 20px;
            border: 2px solid transparent;
            background-clip: content-box;
        }

        /* Headings */
        h1 {
            text-align: center;
            margin-bottom: 36px;
            font-weight: 700;
            font-size: 2.4rem;
            letter-spacing: 1.1px;
            text-shadow: 0 2px 8px rgba(0, 0, 0, 0.35);
        }

        /* Grid dashboard improvements */
        .grid-dashboard {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 26px;
            max-width: 1000px;
            margin: 0 auto;
        }

        .dashboard-card {
            background: rgba(255, 255, 255, 0.12);
            padding: 32px 28px;
            border-radius: 14px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.13);
            text-align: center;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            cursor: default;
            user-select: none;
        }
        .dashboard-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 18px 40px rgba(0, 0, 0, 0.25);
        }

        .dashboard-card.orange {
            background: #f6ad556e;
            color: #fff;
        }
        .dashboard-card.green {
            background: #48bb786e;
            color: #fff;
        }
        .dashboard-card.blue {
            background: #4299e16e;
            color: #fff;
        }

        .dashboard-card h2 {
            font-size: 3.2rem;
            margin: 0;
            font-weight: 700;
            letter-spacing: 0.5px;
            text-shadow: 0 1px 5px rgba(0, 0, 0, 0.45);
        }

        .dashboard-card p {
            margin-top: 12px;
            font-weight: 700;
            font-size: 1.15rem;
            letter-spacing: 0.9px;
            text-shadow: 0 1px 3px rgba(0, 0, 0, 0.3);
        }

        /* Form & Table Styling */

        label {
            font-weight: 600;
            color: #eee;
            display: block;
            margin-bottom: 8px;
        }

        input[type="text"],
        input[type="number"],
        select,
        input[type="file"],
        textarea {
            width: 100%;
            padding: 12px 15px;
            margin-bottom: 20px;
            border-radius: 8px;
            border: none;
            font-size: 1rem;
            outline: none;
            color: #333;
            resize: vertical;
        }

        input[type="text"]:focus,
        input[type="number"]:focus,
        select:focus,
        input[type="file"]:focus,
        textarea:focus {
            box-shadow: 0 0 8px #9f7aea;
        }

        /* Buttons */
        .btn {
            padding: 10px 20px;
            border-radius: 10px;
            border: none;
            cursor: pointer;
            font-weight: 700;
            font-size: 1rem;
            transition: background-color 0.3s ease;
            display: inline-block;
            text-align: center;
            user-select: none;
            margin-right: 6px;
        }

        .btn-primary {
            background-color: #5a67d8;
            color: #fff;
        }

        .btn-primary:hover {
            background-color: #434190;
        }

        .btn-success {
            background-color: #48bb78;
            color: #fff;
        }

        .btn-success:hover {
            background-color: #2f855a;
        }

        .btn-danger {
            background-color: #e53e3e;
            color: #fff;
        }

        .btn-danger:hover {
            background-color: #9b2c2c;
        }

        /* Error messages */
        .error-message {
            color: #ff6b6b;
            margin-top: -12px;
            margin-bottom: 18px;
            font-weight: 600;
            font-size: 0.9rem;
        }

        /* Success message */
        .success-message {
            max-width: 600px;
            margin: 0 auto 20px;
            background-color: #48bb78;
            padding: 14px 20px;
            border-radius: 12px;
            font-weight: 600;
            color: white;
            text-align: center;
            box-shadow: 0 4px 15px rgba(0,0,0,0.2);
            user-select: none;
        }

        /* Table styling */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background: rgba(255,255,255,0.15);
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 6px 20px rgba(0,0,0,0.1);
        }

        th, td {
            padding: 14px 18px;
            text-align: left;
            border-bottom: 1px solid rgba(255,255,255,0.3);
            color: #f0f0f0;
        }

        th {
            background-color: rgba(0,0,0,0.3);
            font-weight: 600;
        }

        tr:hover {
            background-color: rgba(255,255,255,0.1);
        }

        /* Responsive */
        @media (max-width: 768px) {
            nav.sidebar {
                width: 60px;
                padding: 30px 12px;
            }
            nav.sidebar a {
                font-size: 0;
                padding: 14px 0;
                position: relative;
            }
            nav.sidebar a::after {
                content: attr(title);
                position: absolute;
                left: 70px;
                top: 50%;
                transform: translateY(-50%);
                background: #5a67d8;
                padding: 5px 12px;
                border-radius: 6px;
                white-space: nowrap;
                opacity: 0;
                pointer-events: none;
                transition: opacity 0.2s ease;
                font-size: 0.9rem;
                font-weight: 600;
                color: white;
            }
            nav.sidebar a:hover::after {
                opacity: 1;
            }
            nav.sidebar .btn-logout {
                font-size: 0;
                padding: 14px 0;
            }
            nav.sidebar .btn-logout::after {
                content: "Logout";
                position: absolute;
                left: 70px;
                top: 50%;
                transform: translateY(-50%);
                background: #e53e3e;
                padding: 5px 12px;
                border-radius: 6px;
                white-space: nowrap;
                opacity: 0;
                pointer-events: none;
                transition: opacity 0.2s ease;
                font-size: 0.9rem;
                font-weight: 700;
                color: white;
            }
            main.content {
                margin-left: 60px;
                padding: 30px 20px;
            }
            h1 {
                font-size: 1.8rem;
                margin-bottom: 24px;
            }
            .dashboard-card {
                padding: 20px 15px;
            }
            .dashboard-card h2 {
                font-size: 2.2rem;
            }
            .dashboard-card p {
                font-size: 1rem;
            }
            .grid-dashboard {
                gap: 18px;
                grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
            }
        }
    </style>

    @stack('styles')
</head>
<body>
    <nav class="sidebar" role="navigation" aria-label="Main Navigation">
        <a href="{{ route('dashboard.index') }}" class="{{ request()->routeIs('dashboard.index') ? 'active' : '' }}" title="Dashboard">Dashboard</a>
        <a href="{{ route('barang.index') }}" class="{{ request()->routeIs('barang.*') ? 'active' : '' }}" title="Barang">Barang</a>
        <a href="{{ route('peminjaman.index') }}" class="{{ request()->routeIs('peminjaman.*') ? 'active' : '' }}" title="Peminjaman">Peminjaman</a>
        <a href="{{ route('kategori.index') }}" class="{{ request()->routeIs('kategori.*') ? 'active' : '' }}" title="Kategori Barang">Kategori Barang</a>
        <a href="{{ route('detail-pengembalian.index') }}" class="{{ request()->routeIs('detail-pengembalian.*') ? 'active' : '' }}" title="Pengembalian">Pengembalian</a>
        <a href="{{ route('laporan.index') }}" class="{{ request()->routeIs('laporan.*') ? 'active' : '' }}" title="Laporan">Laporan</a>
        <a href="{{ route('logout') }}" class="btn-logout" title="Logout">Logout</a>
    </nav>

    <main class="content" role="main" tabindex="-1">
        @if(session('success'))
            <div class="success-message" role="alert">
                {{ session('success') }}
            </div>
        @endif

        @yield('content')
    </main>
</body>
</html>
