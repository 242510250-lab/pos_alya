@extends('layouts.app')

@section('title', 'Users')

@section('content')

@include('layouts.navbar')

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<style>
body{
    background:#f4f6f9;
}

.page-title{
    font-weight:700;
}

.card{
    border:none;
    border-radius:15px;
    box-shadow:0 5px 15px rgba(0,0,0,.08);
}

.table thead{
    background:#0d6efd;
    color:#fff;
}

.table tbody tr:hover{
    background:#f8f9fa;
}

.btn{
    border-radius:10px;
}

.search-box{
    max-width:400px;
}

.pagination{
    margin-bottom:0;
}
</style>

<div class="container py-4">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h2 class="page-title">Users Management</h2>
            <p class="text-muted mb-0">
                Kelola seluruh akun pengguna
            </p>
        </div>

        <a href="{{ route('admin.users.create') }}" class="btn btn-primary">
            <i class="bi bi-person-plus-fill"></i>
            Tambah User
        </a>

    </div>

    <div class="card mb-4">

        <div class="card-body">

            <form action="{{ route('admin.users') }}" method="GET">

                <div class="input-group search-box">

                    <span class="input-group-text">
                        <i class="bi bi-search"></i>
                    </span>

                    <input
                        type="text"
                        name="search"
                        value="{{ request('search') }}"
                        class="form-control"
                        placeholder="Cari nama atau email">

                    <button class="btn btn-primary">
                        Cari
                    </button>

                </div>

            </form>

        </div>

    </div>

    <div class="card">

        <div class="card-header bg-white">
            <h5 class="mb-0">
                Daftar Users
            </h5>
        </div>

        <div class="table-responsive">

            <table class="table table-hover align-middle mb-0">

                <thead>

                <tr>

                    <th width="5%">No</th>

                    <th>Nama</th>

                    <th>Email</th>

                    <th width="15%">Role</th>

                    <th width="20%" class="text-center">Aksi</th>

                </tr>

                </thead>

                <tbody>

                @forelse($users as $user)

                <tr>

                    <td>
                        {{ $users->firstItem()+$loop->index }}
                    </td>

                    <td>
                        <strong>{{ $user->name }}</strong>
                    </td>

                    <td>
                        {{ $user->email }}
                    </td>

                    <td>

                        @if($user->role->name=='admin')

                            <span class="badge bg-danger">
                                Admin
                            </span>

                        @else

                            <span class="badge bg-success">
                                {{ ucfirst($user->role->name) }}
                            </span>

                        @endif

                    </td>

                    <td>

                        <div class="d-flex justify-content-center gap-2">

                            <a href="{{ route('admin.users.edit',$user) }}"
                               class="btn btn-warning btn-sm">

                                <i class="bi bi-pencil-square"></i>

                            </a>

                            <form
                                action="{{ route('admin.users.destroy',$user) }}"
                                method="POST">

                                @csrf
                                @method('DELETE')

                                <button
                                    class="btn btn-danger btn-sm"
                                    onclick="return confirm('Yakin ingin menghapus user ini?')">

                                    <i class="bi bi-trash"></i>

                                </button>

                            </form>

                        </div>

                    </td>

                </tr>

                @empty

                <tr>

                    <td colspan="5" class="text-center text-muted py-4">

                        <i class="bi bi-inbox fs-3 d-block mb-2"></i>

                        Tidak ada data user.

                    </td>

                </tr>

                @endforelse

                </tbody>

            </table>

        </div>

        <div class="card-footer bg-white d-flex justify-content-between align-items-center">

            <small class="text-muted">

                Showing {{ $users->firstItem() ?? 0 }}
                -
                {{ $users->lastItem() ?? 0 }}
                of
                {{ $users->total() }}
                users

            </small>

            {{ $users->links('pagination::bootstrap-5') }}

        </div>

    </div>

</div>

@endsection