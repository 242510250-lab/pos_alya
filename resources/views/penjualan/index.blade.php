@extends('layouts.app')

@section('title', 'Penjualan')

@section('content')

<style>
    * {
        box-sizing: border-box;
    }

    body {
        margin: 0;
        background:
            radial-gradient(
                circle at top left,
                rgba(214, 166, 166, 0.16),
                transparent 28%
            ),
            radial-gradient(
                circle at bottom right,
                rgba(193, 143, 143, 0.13),
                transparent 28%
            ),
            #fcf6f6;

        color: #5c4444;

        font-family:
            Arial,
            Helvetica,
            sans-serif;
    }


    /* =========================
       NAVBAR
    ========================= */

    .alya-navbar {
        width: 100%;

        background: #fffafa;

        border-bottom: 1px solid #eadada;

        box-shadow:
            0 3px 12px
            rgba(100, 60, 60, 0.06);
    }

    .alya-navbar-inner {
        max-width: 1150px;

        min-height: 65px;

        margin: 0 auto;

        padding: 0 18px;

        display: flex;

        align-items: center;
    }

    .alya-brand {
        color: #704949;

        text-decoration: none;

        font-family:
            Georgia,
            'Times New Roman',
            serif;

        font-size: 21px;

        font-weight: 600;

        margin-right: 24px;

        white-space: nowrap;
    }

    .alya-menu {
        display: flex;

        align-items: center;

        gap: 2px;

        flex: 1;
    }

    .alya-menu a {
        color: #755656;

        text-decoration: none;

        padding: 9px 11px;

        border-radius: 8px;

        font-size: 14px;

        transition: .2s ease;
    }

    .alya-menu a:hover {
        background: #f6e5e5;

        color: #925c5c;
    }

    .alya-menu a.active {
        background: #f1dddd;

        color: #925c5c;

        font-weight: 600;
    }

    .alya-logout {
        border: none;

        border-radius: 8px;

        padding: 9px 18px;

        background:
            linear-gradient(
                135deg,
                #966060,
                #b87979
            );

        color: white;

        font-size: 14px;

        cursor: pointer;

        transition: .2s ease;
    }

    .alya-logout:hover {
        background:
            linear-gradient(
                135deg,
                #855151,
                #a76767
            );
    }


    /* =========================
       CONTAINER
    ========================= */

    .penjualan-container {
        width: 100%;

        max-width: 1150px;

        margin: 0 auto;

        padding:
            30px 18px 50px;
    }


    /* =========================
       HEADER
    ========================= */

    .penjualan-heading {
        display: flex;

        align-items: center;

        justify-content: space-between;

        gap: 20px;

        margin-bottom: 25px;
    }

    .penjualan-heading h1 {
        margin: 0;

        color: #593d3d;

        font-size: 32px;

        font-weight: 700;
    }

    .penjualan-heading p {
        margin: 7px 0 0;

        color: #987676;

        font-size: 14px;
    }


    /* =========================
       TAMBAH PENJUALAN
    ========================= */

    .btn-add-penjualan {
        display: inline-flex;

        align-items: center;

        justify-content: center;

        gap: 7px;

        padding: 10px 17px;

        border-radius: 9px;

        background:
            linear-gradient(
                135deg,
                #966060,
                #b87979
            );

        color: white;

        text-decoration: none;

        font-size: 14px;

        font-weight: 600;

        box-shadow:
            0 5px 12px
            rgba(145, 87, 87, .18);

        transition: .2s ease;
    }

    .btn-add-penjualan:hover {
        color: white;

        background:
            linear-gradient(
                135deg,
                #855151,
                #a76767
            );

        transform: translateY(-1px);
    }


    /* =========================
       SEARCH
    ========================= */

    .search-card {
        background: #fffafa;

        border: 1px solid #eadada;

        border-radius: 14px;

        padding: 16px;

        margin-bottom: 24px;

        box-shadow:
            0 7px 20px
            rgba(105, 65, 65, .08);
    }

    .search-form {
        display: flex;

        width: 100%;
    }

    .search-icon {
        width: 45px;

        height: 40px;

        display: flex;

        align-items: center;

        justify-content: center;

        border: 1px solid #dfcaca;

        border-right: none;

        border-radius: 8px 0 0 8px;

        background: #fffdfd;

        color: #a36d6d;

        font-size: 17px;
    }

    .search-input {
        flex: 1;

        height: 40px;

        border: 1px solid #dfcaca;

        border-left: none;

        background: #fffdfd;

        color: #624848;

        padding: 0 13px;

        outline: none;

        font-size: 13px;
    }

    .search-input:focus {
        border-color: #b47a7a;

        box-shadow:
            0 0 0 2px
            rgba(180, 122, 122, .10);
    }

    .search-input::placeholder {
        color: #b89b9b;
    }

    .btn-search {
        height: 40px;

        padding: 0 19px;

        border: none;

        border-radius: 0 8px 8px 0;

        background:
            linear-gradient(
                135deg,
                #966060,
                #b87979
            );

        color: white;

        font-size: 13px;

        cursor: pointer;
    }

    .btn-search:hover {
        background: #855151;
    }


    /* =========================
       TABLE CARD
    ========================= */

    .penjualan-card {
        background: #fffafa;

        border: 1px solid #eadada;

        border-radius: 14px;

        overflow: hidden;

        box-shadow:
            0 7px 20px
            rgba(105, 65, 65, .08);
    }

    .penjualan-card-header {
        padding: 16px 18px;

        background: #fffafa;

        border-bottom: 1px solid #eadada;

        color: #684646;

        font-size: 17px;

        font-weight: 600;
    }


    /* =========================
       TABLE
    ========================= */

    .penjualan-table-wrapper {
        overflow-x: auto;
    }

    .penjualan-table {
        width: 100%;

        border-collapse: collapse;

        min-width: 950px;
    }

    .penjualan-table th {
        padding: 12px 10px;

        background: #f8eaea;

        border-bottom: 1px solid #e6d1d1;

        color: #704949;

        font-size: 13px;

        font-weight: 700;

        text-align: left;

        white-space: nowrap;
    }

    .penjualan-table td {
        padding: 11px 10px;

        border-bottom: 1px solid #f0e2e2;

        color: #624848;

        font-size: 13px;

        vertical-align: middle;
    }

    .penjualan-table tbody tr {
        transition: .15s ease;
    }

    .penjualan-table tbody tr:hover {
        background: #fff5f5;
    }

    .penjualan-table tbody tr:last-child td {
        border-bottom: none;
    }


    /* =========================
       TANGGAL
    ========================= */

    .tanggal {
        color: #765b5b;

        white-space: nowrap;
    }


    /* =========================
       KASIR
    ========================= */

    .kasir {
        color: #704949;

        font-weight: 500;
    }


    /* =========================
       TOTAL
    ========================= */

    .total-pembayaran {
        color: #9b5e5e;

        font-weight: 700;

        white-space: nowrap;
    }


    /* =========================
       METODE
    ========================= */

    .badge-metode {
        display: inline-flex;

        align-items: center;

        justify-content: center;

        padding: 5px 10px;

        border-radius: 7px;

        font-size: 11px;

        font-weight: 700;

        text-transform: uppercase;

        white-space: nowrap;
    }

    .metode-cash {
        background: #c59b78;

        color: white;
    }

    .metode-qris {
        background: #d6a0a0;

        color: #653f3f;
    }

    .metode-transfer {
        background: #b88989;

        color: white;
    }


    /* =========================
       STATUS
    ========================= */

    .badge-status {
        display: inline-flex;

        align-items: center;

        justify-content: center;

        padding: 5px 10px;

        border-radius: 7px;

        font-size: 11px;

        font-weight: 700;

        text-transform: uppercase;

        white-space: nowrap;
    }

    .status-completed {
        background: #9a7777;

        color: white;
    }

    .status-open {
        background: #d8b070;

        color: #5e431f;
    }


    /* =========================
       ACTION
    ========================= */

    .action-buttons {
        display: flex;

        align-items: center;

        gap: 7px;
    }

    .btn-action {
        width: 34px;

        height: 32px;

        border: none;

        border-radius: 8px;

        display: inline-flex;

        align-items: center;

        justify-content: center;

        text-decoration: none;

        cursor: pointer;

        font-size: 14px;

        transition: .2s ease;
    }

    .btn-view {
        background: #b88989;

        color: white;
    }

    .btn-view:hover {
        background: #996d6d;

        color: white;
    }

    .btn-edit {
        background: #c18a4d;

        color: white;
    }

    .btn-edit:hover {
        background: #a8733e;

        color: white;
    }

    .btn-delete {
        background: #ad6969;

        color: white;
    }

    .btn-delete:hover {
        background: #925252;

        color: white;
    }


    /* =========================
       EMPTY
    ========================= */

    .empty-data {
        text-align: center;

        padding: 50px 20px;

        color: #a98787;

        font-size: 14px;
    }

    .empty-icon {
        font-size: 35px;

        margin-bottom: 10px;

        opacity: .75;
    }


    /* =========================
       FOOTER
    ========================= */

    .table-footer {
        padding: 13px 18px;

        background: #fffafa;

        border-top: 1px solid #eadada;

        color: #987676;

        font-size: 12px;
    }

    .pagination-wrapper {
        padding: 15px 18px;

        border-top: 1px solid #eadada;

        background: #fffafa;
    }


    /* =========================
       RESPONSIVE
    ========================= */

    @media (max-width: 750px) {

        .alya-navbar-inner {
            flex-wrap: wrap;

            padding: 12px 15px;
        }

        .alya-brand {
            width: 100%;

            margin-bottom: 7px;
        }

        .alya-menu {
            overflow-x: auto;

            padding-bottom: 3px;
        }

        .alya-logout {
            margin-left: 8px;
        }

        .penjualan-heading {
            flex-direction: column;

            align-items: flex-start;
        }

        .penjualan-heading h1 {
            font-size: 27px;
        }

        .penjualan-container {
            padding:
                22px 15px 40px;
        }
    }

</style>


<!-- =========================================
     NAVBAR
========================================= -->

<nav class="alya-navbar">

    <div class="alya-navbar-inner">

        <a
            href="{{ route('dashboard') }}"
            class="alya-brand"
        >
            Alya Story
        </a>


        <div class="alya-menu">

            <a href="{{ route('dashboard') }}">
                Dashboard
            </a>


            <a href="{{ route('admin.users') }}">
                Users
            </a>


            <a href="{{ url('/jenisproduk') }}">
                Jenis Produk
            </a>


            <a href="{{ url('/produk') }}">
                Produk
            </a>


            <a
                href="{{ url('/penjualan') }}"
                class="active"
            >
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


<!-- =========================================
     MAIN
========================================= -->

<div class="penjualan-container">


    <!-- HEADER -->

    <div class="penjualan-heading">

        <div>

            <h1>
                Manajemen Penjualan
            </h1>

            <p>
                Kelola seluruh transaksi penjualan
            </p>

        </div>


        <a
            href="{{ route('penjualan.create') }}"
            class="btn-add-penjualan"
        >
            <span>🛒</span>
            Tambah Penjualan
        </a>

    </div>


    <!-- SEARCH -->

    <div class="search-card">

        <form
            action="{{ route('penjualan.index') }}"
            method="GET"
            class="search-form"
        >

            <div class="search-icon">
                ⌕
            </div>


            <input
                type="text"
                name="search"
                class="search-input"
                value="{{ request('search') }}"
                placeholder="Cari transaksi..."
            >


            <button
                type="submit"
                class="btn-search"
            >
                Cari
            </button>

        </form>

    </div>


    <!-- TABLE -->

    <div class="penjualan-card">


        <div class="penjualan-card-header">
            Daftar Penjualan
        </div>


        <div class="penjualan-table-wrapper">

            <table class="penjualan-table">

                <thead>

                    <tr>

                        <th style="width: 50px;">
                            No
                        </th>

                        <th>
                            Tanggal
                        </th>

                        <th>
                            Kasir
                        </th>

                        <th>
                            Total Pembayaran
                        </th>

                        <th>
                            Metode
                        </th>

                        <th>
                            Status
                        </th>

                        <th style="width: 140px;">
                            Aksi
                        </th>

                    </tr>

                </thead>


                <tbody>

                    @forelse($sales as $index => $penjualan)

                        <tr>

                            <td>
                                {{ $sales->firstItem() + $index }}
                            </td>


                            <td>

                                <span class="tanggal">

                                    {{ $penjualan->created_at
                                        ? $penjualan->created_at->format('d M Y H:i')
                                        : '-' }}

                                </span>

                            </td>


                            <td>

                                <span class="kasir">

                                    @if(isset($penjualan->user))
                                        {{ $penjualan->user->name }}
                                    @else
                                        -
                                    @endif

                                </span>

                            </td>


                            <td>

                                <span class="total-pembayaran">

                                    Rp
                                    {{ number_format(
                                        $penjualan->total_pembayaran ?? 0,
                                        0,
                                        ',',
                                        '.'
                                    ) }}

                                </span>

                            </td>


                            <td>

                                @php
                                    $metode = strtolower(
                                        $penjualan->metode_pembayaran
                                        ?? $penjualan->metode
                                        ?? ''
                                    );
                                @endphp


                                @if($metode === 'cash')

                                    <span class="badge-metode metode-cash">
                                        Cash
                                    </span>

                                @elseif($metode === 'qris')

                                    <span class="badge-metode metode-qris">
                                        QRIS
                                    </span>

                                @elseif($metode === 'transfer')

                                    <span class="badge-metode metode-transfer">
                                        Transfer
                                    </span>

                                @else

                                    <span class="badge-metode metode-transfer">
                                        {{ $penjualan->metode_pembayaran ?? $penjualan->metode ?? '-' }}
                                    </span>

                                @endif

                            </td>


                            <td>

                                @php
                                    $status = strtolower(
                                        $penjualan->status ?? ''
                                    );
                                @endphp


                                @if($status === 'completed')

                                    <span class="badge-status status-completed">
                                        Completed
                                    </span>

                                @elseif($status === 'open')

                                    <span class="badge-status status-open">
                                        Open
                                    </span>

                                @else

                                    <span class="badge-status status-completed">
                                        {{ $penjualan->status ?? '-' }}
                                    </span>

                                @endif

                            </td>


                            <td>

                                <div class="action-buttons">


                                    {{-- DETAIL --}}

                                    <a
                                        href="{{ route('penjualan.show', $penjualan->id) }}"
                                        class="btn-action btn-view"
                                        title="Lihat"
                                    >
                                        ◉
                                    </a>


                                    {{-- EDIT --}}

                                    @if(
                                        isset($penjualan->status) &&
                                        strtolower($penjualan->status) !== 'completed'
                                    )

                                        <a
                                            href="{{ route('penjualan.edit', $penjualan->id) }}"
                                            class="btn-action btn-edit"
                                            title="Edit"
                                        >
                                            ✎
                                        </a>


                                        {{-- DELETE --}}

                                        <form
                                            action="{{ route('penjualan.destroy', $penjualan->id) }}"
                                            method="POST"
                                            onsubmit="return confirm('Yakin ingin menghapus transaksi ini?')"
                                        >

                                            @csrf

                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                class="btn-action btn-delete"
                                                title="Hapus"
                                            >
                                                🗑
                                            </button>

                                        </form>

                                    @endif

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td
                                colspan="7"
                                class="empty-data"
                            >

                                <div class="empty-icon">
                                    🛒
                                </div>

                                Belum ada transaksi penjualan.

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>


        <!-- FOOTER -->

        <div class="table-footer">

            Showing
            {{ $sales->firstItem() ?? 0 }}
            -
            {{ $sales->lastItem() ?? 0 }}
            of
            {{ $sales->total() }}
            transaksi

        </div>


        @if($sales->hasPages())

            <div class="pagination-wrapper">

                {{ $sales->links() }}

            </div>

        @endif


    </div>

</div>

@endsection
