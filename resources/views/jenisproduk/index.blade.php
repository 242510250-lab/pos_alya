@extends('layouts.app')

@section('title', 'Jenis Produk')

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
                rgba(214, 166, 166, 0.18),
                transparent 28%
            ),
            radial-gradient(
                circle at bottom right,
                rgba(193, 143, 143, 0.14),
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
        box-shadow: 0 3px 12px rgba(100, 60, 60, 0.06);
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

    .jenis-container {
        width: 100%;
        max-width: 1150px;

        margin: 0 auto;

        padding:
            30px 18px 50px;
    }


    /* =========================
       HEADER
    ========================= */

    .jenis-heading {
        display: flex;
        align-items: center;
        justify-content: space-between;

        gap: 20px;

        margin-bottom: 25px;
    }

    .jenis-heading h1 {
        margin: 0;

        color: #593d3d;

        font-size: 32px;
        font-weight: 700;
    }

    .jenis-heading p {
        margin: 7px 0 0;

        color: #987676;

        font-size: 14px;
    }


    /* =========================
       TAMBAH JENIS
    ========================= */

    .btn-add-jenis {
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

    .btn-add-jenis:hover {
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

    .search-input {
        flex: 1;

        height: 40px;

        border: 1px solid #dfcaca;

        border-radius: 8px 0 0 8px;

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

    .jenis-card {
        background: #fffafa;

        border: 1px solid #eadada;

        border-radius: 14px;

        overflow: hidden;

        box-shadow:
            0 7px 20px
            rgba(105, 65, 65, .08);
    }

    .jenis-card-header {
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

    .jenis-table-wrapper {
        overflow-x: auto;
    }

    .jenis-table {
        width: 100%;

        border-collapse: collapse;

        min-width: 600px;
    }

    .jenis-table th {
        padding: 12px 16px;

        background: #f8eaea;

        border-bottom: 1px solid #e6d1d1;

        color: #704949;

        font-size: 13px;

        font-weight: 700;

        text-align: left;
    }

    .jenis-table td {
        padding: 12px 16px;

        border-bottom: 1px solid #f0e2e2;

        color: #624848;

        font-size: 13px;
    }

    .jenis-table tbody tr {
        transition: .15s ease;
    }

    .jenis-table tbody tr:hover {
        background: #fff5f5;
    }

    .jenis-table tbody tr:last-child td {
        border-bottom: none;
    }


    /* =========================
       NAMA JENIS
    ========================= */

    .jenis-name {
        color: #5d4141;

        font-weight: 600;
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
       FOOTER TABLE
    ========================= */

    .table-footer {
        padding: 13px 18px;

        background: #fffafa;

        border-top: 1px solid #eadada;

        color: #987676;

        font-size: 12px;
    }


    /* =========================
       PAGINATION
    ========================= */

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

        .jenis-heading {
            flex-direction: column;

            align-items: flex-start;
        }

        .jenis-heading h1 {
            font-size: 27px;
        }

        .jenis-container {
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


            <a
                href="{{ url('/jenisproduk') }}"
                class="active"
            >
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


<!-- =========================================
     MAIN
========================================= -->

<div class="jenis-container">


    <!-- HEADER -->

    <div class="jenis-heading">

        <div>

            <h1>
                Jenis Produk
            </h1>

            <p>
                Kelola kategori produk
            </p>

        </div>


        <a
            href="{{ route('jenisproduk.create') }}"
            class="btn-add-jenis"
        >
            <span>＋</span>
            Tambah Jenis
        </a>

    </div>


    <!-- SEARCH -->

    <div class="search-card">

        <form
            action="{{ route('jenisproduk.index') }}"
            method="GET"
            class="search-form"
        >

            <input
                type="text"
                name="cari"
                class="search-input"
                value="{{ request('cari') }}"
                placeholder="Cari nama jenis..."
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

    <div class="jenis-card">


        <div class="jenis-card-header">
            Daftar Jenis Produk
        </div>


        <div class="jenis-table-wrapper">

            <table class="jenis-table">

                <thead>

                    <tr>

                        <th style="width: 80px;">
                            No
                        </th>

                        <th>
                            Nama Jenis
                        </th>

                        <th style="width: 170px;">
                            Aksi
                        </th>

                    </tr>

                </thead>


                <tbody>

                    @forelse($jenisProduks as $index => $jenis)

                        <tr>

                            <td>
                                {{ $jenisProduks->firstItem() + $index }}
                            </td>


                            <td>

                                <span class="jenis-name">
                                    {{ $jenis->nama_jenis }}
                                </span>

                            </td>


                            <td>

                                <div class="action-buttons">

                                    <!-- EDIT -->

                                    <a
                                        href="{{ route('jenisproduk.edit', $jenis->id) }}"
                                        class="btn-action btn-edit"
                                        title="Edit"
                                    >
                                        ✎
                                    </a>


                                    <!-- DELETE -->

                                    <form
                                        action="{{ route('jenisproduk.destroy', $jenis->id) }}"
                                        method="POST"
                                        onsubmit="return confirm('Yakin ingin menghapus jenis produk ini?')"
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

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td
                                colspan="3"
                                class="empty-data"
                            >

                                <div class="empty-icon">
                                    📦
                                </div>

                                Belum ada jenis produk.

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>


        <!-- FOOTER -->

        <div class="table-footer">

            Showing
            {{ $jenisProduks->firstItem() ?? 0 }}
            -
            {{ $jenisProduks->lastItem() ?? 0 }}
            of
            {{ $jenisProduks->total() }}
            jenis

        </div>


        @if($jenisProduks->hasPages())

            <div class="pagination-wrapper">

                {{ $jenisProduks->links() }}

            </div>

        @endif


    </div>

</div>

@endsection
