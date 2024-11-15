<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Penjualan</title>
    <link rel="stylesheet" href="{{ asset('/css/styles.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css">
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <h2>Dashboard Penjualan</h2>
        <ul>
            <li><a href="{{ url(Auth::user()->role.'/halaman') }}">Home</a></li>
            <li><a href="{{ url(Auth::user()->role.'/produk') }}">Produk</a></li>
            <li><a href="#">Penjualan</a></li>
            <li><a href="{{ url(Auth::user()->role.'/laporan') }}">Laporan</a></li>
            <li>
                <form action="{{ url('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="text-decoration-none bg-transparent border-0 text-white" style="font-size: 18px;">Logout</button>
                </form>
            </li>
        </ul>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <header>
            <h1>Selamat Datang di Dashboard Penjualan</h1>
        </header>

        <!-- Stats Cards -->
        <div class="cards">
            <div class="card">
                <h3>Total Produk</h3>
                <p id="total-products"> {{ $totalProducts }}</p>
            </div>
            <div class="card">
                <h3>Penjualan Hari Ini</h3>
                <p id="sales-today">{{$salesToday}}</p>
            </div>
            <div class="card">
                <h3>Total Pendapatan</h3>
                <p id="total-revenue">{{$totalRevenue}}</p>
            </div>
            <div class="card">
                <h3>Pengguna Terdaftar</h3>
                <p id="registered-users">{{$registeredUsers}}</p>
            </div>
        </div>

        <div class="alert alert-primary" role="alert">
            A simple primary alert—check it out!
        </div>

        <!-- Sales Chart -->
        <div id="chart">
            <h2>Grafik Penjualan Bulanan</h2>
           <!-- <canvas id="salesChart"></canvas> -->
           {!!$chart->container() !!}
        </div>
    </div>

    <!--<script src="script.js"></script>-->
    <!-- Ini adalah script untuk memanggil Larapex (wajib) -->
    <script src="{{ $chart->cdn() }}"></script>
    {{ $chart->script() }}

    <!--<script src="script.js"></script>-->
</body>
</html>
