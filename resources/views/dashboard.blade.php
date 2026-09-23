@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

<style>
    /* ================================
       GLOBAL
    ================================= */

    body {
        margin: 0;
        background: #fdf4f4;
        color: #5b4141;
        font-family: Arial, Helvetica, sans-serif;
    }

    .dashboard-wrapper {
        min-height: 100vh;
        background:
            radial-gradient(
                circle at 0% 0%,
                rgba(201, 149, 149, .16),
                transparent 25%
            ),
            radial-gradient(
                circle at 100% 100%,
                rgba(216, 165, 165, .16),
                transparent 25%
            ),
            #fdf6f6;
    }


    /* ================================
       NAVBAR
    ================================= */

    .alya-navbar {
        background: #fffafa;
        border-bottom: 1px solid #ead7d7;
        box-shadow: 0 3px 12px rgba(100, 60, 60, .06);
    }

    .alya-navbar-inner {
        max-width: 1150px;
        margin: auto;
        min-height: 70px;

        display: flex;
        align-items: center;
        justify-content: space-between;

        padding: 0 20px;
    }

    .alya-brand {
        color: #754b4b;
        font-family: Georgia, serif;
        font-size: 21px;
        text-decoration: none;
        font-weight: 600;
        margin-right: 28px;
    }

    .alya-menu {
        display: flex;
        align-items: center;
        gap: 4px;
        flex: 1;
    }

    .alya-menu a {
        color: #725555;
        text-decoration: none;
        padding: 9px 12px;
        border-radius: 8px;
        font-size: 14px;
        transition: .2s ease;
    }

    .alya-menu a:hover {
        background: #f7e4e4;
        color: #965f5f;
    }

    .alya-menu a.active {
        background: #f3dddd;
        color: #925b5b;
        font-weight: 600;
    }

    .alya-logout {
        border: none;
        background: #9c6262;
        color: white;
        padding: 9px 18px;
        border-radius: 8px;
        font-size: 14px;
        cursor: pointer;
        transition: .2s;
    }

    .alya-logout:hover {
        background: #815050;
        transform: translateY(-1px);
    }


    /* ================================
       MAIN
    ================================= */

    .dashboard-container {
        max-width: 1150px;
        margin: auto;
        padding: 30px 20px 50px;
    }


    /* ================================
       WELCOME
    ================================= */

    .welcome-alert {
        background: #f0dfdf;
        border: 1px solid #dcbcbc;
        color: #744b4b;
        padding: 12px 16px;
        border-radius: 9px;
        margin-bottom: 25px;
        font-size: 14px;
    }

    .dashboard-heading {
        margin-bottom: 25px;
    }

    .dashboard-heading h1 {
        margin: 0;
        color: #593d3d;
        font-size: 32px;
        font-weight: 700;
    }

    .dashboard-heading p {
        margin: 7px 0 0;
        color: #9a7777;
        font-size: 14px;
    }


    /* ================================
       STATISTICS
    ================================= */

    .stats-grid {
        display: grid;
        grid-template-columns:
            repeat(4, 1fr);

        gap: 20px;

        margin-bottom: 35px;
    }

    .stat-card {
        position: relative;
        min-height: 135px;

        border-radius: 16px;
        padding: 20px;

        overflow: hidden;

        color: white;

        box-shadow:
            0 8px 20px
            rgba(105, 65, 65, .13);

        transition: .25s ease;
    }

    .stat-card:hover {
        transform: translateY(-4px);
        box-shadow:
            0 13px 25px
            rgba(105, 65, 65, .18);
    }

    .stat-card::after {
        content: "";

        position: absolute;

        width: 100px;
        height: 100px;

        right: -30px;
        bottom: -45px;

        border-radius: 50%;

        background: rgba(255,255,255,.10);
    }

    .stat-title {
        position: relative;
        z-index: 2;

        font-size: 13px;
        margin-bottom: 7px;
        opacity: .95;
    }

    .stat-value {
        position: relative;
        z-index: 2;

        font-size: 24px;
        font-weight: 700;

        line-height: 1.2;
    }

    .stat-icon {
        position: absolute;

        right: 18px;
        top: 50%;

        transform: translateY(-50%);

        font-size: 40px;

        opacity: .20;

        z-index: 1;
    }

    /* warna kartu */

    .stat-sales {
        background:
            linear-gradient(
                135deg,
                #9b6262,
                #bd8585
            );
    }

    .stat-transactions {
        background:
            linear-gradient(
                135deg,
                #9b6f76,
                #bd8b93
            );
    }

    .stat-cash {
        background:
            linear-gradient(
                135deg,
                #b58262,
                #cf9b78
            );
    }

    .stat-noncash {
        background:
            linear-gradient(
                135deg,
                #805656,
                #a86d6d
            );
    }


    /* ================================
       TABLE AREA
    ================================= */

    .tables-grid {
        display: grid;
        grid-template-columns:
            repeat(2, 1fr);

        gap: 24px;
    }

    .dashboard-card {
        background: #fffafa;

        border: 1px solid #eadada;

        border-radius: 14px;

        overflow: hidden;

        box-shadow:
            0 7px 20px
            rgba(105, 65, 65, .08);
    }

    .dashboard-card-header {
        padding: 15px 18px;

        border-bottom:
            1px solid #ecdcdc;

        background: #fffafa;

        color: #694646;

        font-size: 15px;
        font-weight: 600;
    }

    .dashboard-card-header.low-stock {
        color: #956d43;
    }

    .dashboard-card-header.empty-stock {
        color: #985959;
    }

    .dashboard-table-wrapper {
        overflow-x: auto;
    }

    .dashboard-table {
        width: 100%;
        border-collapse: collapse;
    }

    .dashboard-table th {
        padding: 12px 9px;

        background: #f8eaea;

        color: #704949;

        font-size: 13px;

        text-align: left;

        font-weight: 700;
    }

    .dashboard-table td {
        padding: 11px 9px;

        border-bottom:
            1px solid #f0e2e2;

        color: #624848;

        font-size: 13px;
    }

    .dashboard-table tbody tr {
        transition: .15s;
    }

    .dashboard-table tbody tr:hover {
        background: #fff5f5;
    }

    .dashboard-table tbody tr:last-child td {
        border-bottom: none;
    }


    /* ================================
       STOCK BADGES
    ================================= */

    .stock-low {
        display: inline-block;

        min-width: 30px;

        padding: 5px 9px;

        text-align: center;

        border-radius: 20px;

        background: #d7a15c;

        color: white;

        font-size: 12px;
        font-weight: 600;
    }

    .stock-empty {
        display: inline-block;

        min-width: 30px;

        padding: 5px 9px;

        text-align: center;

        border-radius: 20px;

        background: #a96565;

        color: white;

        font-size: 12px;
        font-weight: 600;
    }

    .empty-message {
        text-align: center;

        padding: 25px;

        color: #a88787;

        font-size: 13px;
    }


    /* ================================
       RESPONSIVE
    ================================= */

    @media (max-width: 900px) {

        .stats-grid {
            grid-template-columns:
                repeat(2, 1fr);
        }

        .tables-grid {
            grid-template-columns: 1fr;
        }
    }


    @media (max-width: 650px) {

        .alya-navbar-inner {
            flex-wrap: wrap;
            padding: 12px 15px;
        }

        .alya-brand {
            width: 100%;
            margin-bottom: 8px;
        }

        .alya-menu {
            overflow-x: auto;
            order: 2;
        }

        .alya-logout {
            order: 1;
        }

        .dashboard-container {
            padding: 22px 15px 40px;
        }

        .stats-grid {
            grid-template-columns: 1fr;
        }

        .dashboard-heading h1 {
            font-size: 27px;
        }
    }
</style>


<div class="dashboard-wrapper">


    <!-- =================================
         NAVBAR
    ================================== -->

    <nav class="alya-navbar">

        <div class="alya-navbar-inner">

            <a
                href="{{ url('/dashboard') }}"
                class="alya-brand"
            >
                Alya Story
            </a>


            <div class="alya-menu">

                <a
                    href="{{ url('/dashboard') }}"
                    class="active"
                >
                    Dashboard
                </a>

                <a href="{{ url('/admin/users') }}">
                    Users
                </a>

                <a href="{{ url('/jenisproduk') }}">
                    Jenis Produk
                </a>

                <a href="{{ url('/produk') }}">
                    Produk
                </a>

                <a href="{{ url('/penjualan') }}">
                    Penjualan
                </a>

            </div>


            <form
                action="{{ route('logout') }}"
                method="POST"
            >

                @csrf

                <button
                    type="submit"
                    class="alya-logout"
                >
                    Logout
                </button>

            </form>

        </div>

    </nav>


    <!-- =================================
         MAIN CONTENT
    ================================== -->

    <main class="dashboard-container">


        <!-- WELCOME -->

        @if(session('success'))

            <div class="welcome-alert">
                {{ session('success') }}
            </div>

        @endif


        <!-- JUDUL -->

        <div class="dashboard-heading">

            <h1>
                Dashboard
            </h1>

            <p>
                {{ now()->translatedFormat('l, d F Y') }}
            </p>

        </div>


        <!-- =================================
             STATISTICS
        ================================== -->

        <div class="stats-grid">


            <!-- TOTAL PENJUALAN -->

            <div class="stat-card stat-sales">

                <div class="stat-title">
                    Total Penjualan
                </div>

                <div class="stat-value">

                    Rp
                    {{ number_format($totalPenjualan ?? 0, 0, ',', '.') }}

                </div>

                <div class="stat-icon">
                    ♡
                </div>

            </div>


            <!-- TOTAL TRANSAKSI -->

            <div class="stat-card stat-transactions">

                <div class="stat-title">
                    Total Transaksi
                </div>

                <div class="stat-value">

                    {{ $totalTransaksi ?? 0 }}

                </div>

                <div class="stat-icon">
                    🛒
                </div>

            </div>


            <!-- PEMBAYARAN TUNAI -->

            <div class="stat-card stat-cash">

                <div class="stat-title">
                    Pembayaran Tunai
                </div>

                <div class="stat-value">

                    Rp
                    {{ number_format($totalTunai ?? 0, 0, ',', '.') }}

                </div>

                <div class="stat-icon">
                    ♧
                </div>

            </div>


            <!-- PEMBAYARAN NON TUNAI -->

            <div class="stat-card stat-noncash">

                <div class="stat-title">
                    Pembayaran Non Tunai
                </div>

                <div class="stat-value">

                    Rp
                    {{ number_format($totalNonTunai ?? 0, 0, ',', '.') }}

                </div>

                <div class="stat-icon">
                    ▣
                </div>

            </div>

        </div>


        <!-- =================================
             TABLES
        ================================== -->

        <div class="tables-grid">


            <!-- PRODUK STOK RENDAH -->

            <div class="dashboard-card">

                <div class="dashboard-card-header low-stock">

                    📦
                    Produk Stok Rendah

                </div>


                <div class="dashboard-table-wrapper">

                    <table class="dashboard-table">

                        <thead>

                            <tr>

                                <th style="width: 70px;">
                                    No
                                </th>

                                <th>
                                    Produk
                                </th>

                                <th style="width: 90px;">
                                    Stok
                                </th>

                            </tr>

                        </thead>


                        <tbody>

                            @forelse(($produkStokRendah ?? collect()) as $index => $produk)

                                <tr>

                                    <td>
                                        {{ $index + 1 }}
                                    </td>

                                    <td>
                                        {{ $produk->nama }}
                                    </td>

                                    <td>

                                        <span class="stock-low">

                                            {{ $produk->stok }}

                                        </span>

                                    </td>

                                </tr>

                            @empty

                                <tr>

                                    <td
                                        colspan="3"
                                        class="empty-message"
                                    >
                                        Tidak ada produk dengan stok rendah.
                                    </td>

                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

            </div>


            <!-- PRODUK HABIS -->

            <div class="dashboard-card">

                <div class="dashboard-card-header empty-stock">

                    ❌
                    Produk Habis Stok

                </div>


                <div class="dashboard-table-wrapper">

                    <table class="dashboard-table">

                        <thead>

                            <tr>

                                <th style="width: 70px;">
                                    No
                                </th>

                                <th>
                                    Produk
                                </th>

                                <th style="width: 90px;">
                                    Stok
                                </th>

                            </tr>

                        </thead>


                        <tbody>

                            @forelse(($produkHabisStok ?? collect()) as $index => $produk)

                                <tr>

                                    <td>
                                        {{ $index + 1 }}
                                    </td>

                                    <td>
                                        {{ $produk->nama }}
                                    </td>

                                    <td>

                                        <span class="stock-empty">

                                            {{ $produk->stok }}

                                        </span>

                                    </td>

                                </tr>

                            @empty

                                <tr>

                                    <td
                                        colspan="3"
                                        class="empty-message"
                                    >
                                        Tidak ada produk yang habis.
                                    </td>

                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

            </div>


        </div>

    </main>

</div>

@endsection
