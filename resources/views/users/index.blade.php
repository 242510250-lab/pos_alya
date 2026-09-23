@extends('layouts.app')

@section('title', 'Users Management')

@section('content')

<style>

    * {
        box-sizing: border-box;
    }

    body {
        margin: 0;
        padding: 0;
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


    /* ==============================
       NAVBAR
    ============================== */

    .alya-navbar {
        width: 100%;

        background: #fffafa;

        border-bottom: 1px solid #eadada;

        box-shadow:
            0 3px 12px rgba(100, 60, 60, 0.06);
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


    /* ==============================
       CONTAINER
    ============================== */

    .users-container {
        width: 100%;

        max-width: 1150px;

        margin: 0 auto;

        padding:
            30px 18px 50px;
    }


    /* ==============================
       HEADER
    ============================== */

    .users-heading {
        display: flex;

        align-items: center;

        justify-content: space-between;

        margin-bottom: 24px;

        gap: 20px;
    }


    .users-heading h1 {
        margin: 0;

        color: #593d3d;

        font-size: 32px;

        font-weight: 700;
    }


    .users-heading p {
        margin: 7px 0 0;

        color: #987676;

        font-size: 14px;
    }


    /* ==============================
       BUTTON TAMBAH
    ============================== */

    .btn-add-user {
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


    .btn-add-user:hover {
        color: white;

        background:
            linear-gradient(
                135deg,
                #855151,
                #a76767
            );

        transform: translateY(-1px);
    }


    /* ==============================
       SEARCH
    ============================== */

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

        max-width: 520px;
    }


    .search-icon {
        width: 43px;

        height: 40px;

        display: flex;

        align-items: center;

        justify-content: center;

        background: #f8eaea;

        border: 1px solid #dfcaca;

        border-right: none;

        border-radius: 8px 0 0 8px;

        color: #986868;

        font-size: 18px;
    }


    .search-input {
        flex: 1;

        height: 40px;

        border: 1px solid #dfcaca;

        background: #fffdfd;

        color: #624848;

        padding: 0 12px;

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

        padding: 0 18px;

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


    /* ==============================
       TABLE
    ============================== */

    .users-card {
        background: #fffafa;

        border: 1px solid #eadada;

        border-radius: 14px;

        overflow: hidden;

        box-shadow:
            0 7px 20px
            rgba(105, 65, 65, .08);
    }


    .users-card-header {
        padding: 16px 18px;

        border-bottom: 1px solid #eadada;

        background: #fffafa;

        color: #684646;

        font-size: 17px;

        font-weight: 600;
    }


    .users-table-wrapper {
        overflow-x: auto;
    }


    .users-table {
        width: 100%;

        min-width: 750px;

        border-collapse: collapse;
    }


    .users-table th {
        padding: 12px 10px;

        background: #f8eaea;

        border-bottom: 1px solid #e6d1d1;

        color: #704949;

        font-size: 13px;

        font-weight: 700;

        text-align: left;
    }


    .users-table td {
        padding: 12px 10px;

        border-bottom: 1px solid #f0e2e2;

        color: #624848;

        font-size: 13px;
    }


    .users-table tbody tr {
        transition: .15s ease;
    }


    .users-table tbody tr:hover {
        background: #fff5f5;
    }


    .users-table tbody tr:last-child td {
        border-bottom: none;
    }


    .user-name {
        color: #5d4141;

        font-weight: 600;
    }


    .user-email {
        color: #755858;
    }


    /* ==============================
       ROLE
    ============================== */

    .role-badge {
        display: inline-block;

        padding: 5px 10px;

        border-radius: 20px;

        font-size: 11px;

        font-weight: 600;
    }


    .role-admin {
        background: #ead0d0;

        color: #914f4f;
    }


    .role-kasir {
        background: #eadbc9;

        color: #89643f;
    }


    .role-default {
        background: #eee1e1;

        color: #755858;
    }


    /* ==============================
       AKSI
    ============================== */

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


    /* ==============================
       EMPTY
    ============================== */

    .empty-users {
        text-align: center;

        padding: 35px 20px;

        color: #a98787;

        font-size: 13px;
    }


    /* ==============================
       PAGINATION
    ============================== */

    .pagination-area {
        padding: 15px 18px;

        border-top: 1px solid #eadada;

        background: #fffafa;
    }


    /* ==============================
       RESPONSIVE
    ============================== */

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


        .users-heading {
            align-items: flex-start;

            flex-direction: column;
        }


        .users-heading h1 {
            font-size: 27px;
        }


        .search-form {
            max-width: 100%;
        }


        .users-container {
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


            <a
                href="{{ route('admin.users') }}"
                class="active"
            >
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


<!-- =========================================
     MAIN
========================================= -->

<div class="users-container">


    <!-- HEADER -->

    <div class="users-heading">

        <div>

            <h1>
                Users Management
            </h1>

            <p>
                Kelola seluruh akun pengguna
            </p>

        </div>


        <a
            href="{{ route('admin.users.create') }}"
            class="btn-add-user"
        >
            <span>＋</span>
            Tambah User
        </a>

    </div>


    <!-- SEARCH -->

    <div class="search-card">

        <form
            action="{{ route('admin.users') }}"
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
                placeholder="Cari nama atau email"
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

    <div class="users-card">


        <div class="users-card-header">
            Daftar Users
        </div>


        <div class="users-table-wrapper">

            <table class="users-table">

                <thead>

                    <tr>

                        <th style="width: 55px;">
                            No
                        </th>

                        <th>
                            Nama
                        </th>

                        <th>
                            Email
                        </th>

                        <th>
                            Role
                        </th>

                        <th style="width: 140px;">
                            Aksi
                        </th>

                    </tr>

                </thead>


                <tbody>

                    @forelse($users as $index => $user)

                        <tr>

                            <td>
                                {{ $users->firstItem() + $index }}
                            </td>


                            <td>

                                <span class="user-name">
                                    {{ $user->name }}
                                </span>

                            </td>


                            <td>

                                <span class="user-email">
                                    {{ $user->email }}
                                </span>

                            </td>


                            <td>

                                @if($user->role)

                                    @if($user->role->name === 'admin')

                                        <span class="role-badge role-admin">
                                            Admin
                                        </span>

                                    @elseif($user->role->name === 'kasir')

                                        <span class="role-badge role-kasir">
                                            Kasir
                                        </span>

                                    @else

                                        <span class="role-badge role-default">
                                            {{ ucfirst($user->role->name) }}
                                        </span>

                                    @endif

                                @else

                                    <span class="role-badge role-default">
                                        -
                                    </span>

                                @endif

                            </td>


                            <td>

                                <div class="action-buttons">


                                    <!-- EDIT -->

                                    <a
                                        href="{{ route('admin.users.edit', $user->id) }}"
                                        class="btn-action btn-edit"
                                        title="Edit User"
                                    >
                                        ✎
                                    </a>


                                    <!-- DELETE -->

                                    <form
                                        action="{{ route('admin.users.destroy', $user->id) }}"
                                        method="POST"
                                        onsubmit="return confirm('Yakin ingin menghapus user ini?')"
                                    >

                                        @csrf

                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="btn-action btn-delete"
                                            title="Hapus User"
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
                                colspan="5"
                                class="empty-users"
                            >
                                Belum ada data pengguna.
                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>


        @if($users instanceof \Illuminate\Contracts\Pagination\LengthAwarePaginator)

            <div class="pagination-area">

                {{ $users->links() }}

            </div>

        @endif


    </div>

</div>

@endsection
