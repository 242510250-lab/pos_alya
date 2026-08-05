@extends('layouts.app')

@section('title', 'Penjualan')

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
    color:white;
}

.table tbody tr:hover{
    background:#f8f9fa;
}

.btn{
    border-radius:10px;
}

.search-box{
    max-width:450px;
}

.pagination{
    margin-bottom:0;
}
</style>

<div class="container py-4">

    @if(session('errors'))
        <div class="alert alert-danger alert-dismissible fade show">
            {{ session('errors') }}

            <button class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h2 class="page-title">Manajemen Penjualan</h2>
            <p class="text-muted mb-0">
                Kelola seluruh transaksi penjualan
            </p>
        </div>

        <a href="{{ route('penjualan.create') }}" class="btn btn-primary">
            <i class="bi bi-cart-plus"></i>
            Tambah Penjualan
        </a>

    </div>

    <div class="card mb-4">

        <div class="card-body">

            <form action="{{ route('penjualan.index') }}" method="GET">

                <div class="input-group search-box">

                    <span class="input-group-text">
                        <i class="bi bi-search"></i>
                    </span>

                    <input
                        type="text"
                        name="search"
                        value="{{ request('search') }}"
                        class="form-control"
                        placeholder="Cari transaksi...">

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
                Daftar Penjualan
            </h5>
        </div>

        <div class="table-responsive">

            <table class="table table-hover align-middle mb-0">

                <thead>

                <tr>

                    <th>No</th>

                    <th>Tanggal</th>

                    <th>Kasir</th>

                    <th>Total Pembayaran</th>

                    <th>Metode</th>

                    <th>Status</th>

                    <th class="text-center">Aksi</th>

                </tr>

                </thead>

                <tbody>

                @forelse($sales as $sale)

                <tr>

                    <td>
                        {{ $sales->firstItem() + $loop->index }}
                    </td>

                    <td>
                        {{ $sale->created_at->translatedFormat('d M Y H:i') }}
                    </td>

                    <td>
                        <strong>{{ $sale->nama }}</strong>
                    </td>

                    <td class="fw-bold text-success">
                        Rp {{ number_format($sale->total_pembayaran,0,',','.') }}
                    </td>

                    <td>

                        @if(strtolower($sale->metode_pembayaran) == 'cash')

                            <span class="badge bg-success">
                                Cash
                            </span>

                        @else

                            <span class="badge bg-info text-dark">
                                {{ ucfirst($sale->metode_pembayaran) }}
                            </span>

                        @endif

                    </td>

                    <td>

                        @if(strtolower($sale->status) == 'selesai')

                            <span class="badge bg-success">
                                {{ ucfirst($sale->status) }}
                            </span>

                        @elseif(strtolower($sale->status) == 'pending')

                            <span class="badge bg-warning text-dark">
                                {{ ucfirst($sale->status) }}
                            </span>

                        @else

                            <span class="badge bg-secondary">
                                {{ ucfirst($sale->status) }}
                            </span>

                        @endif

                    </td>

                    <td>

                        <div class="d-flex justify-content-center gap-2">

                            <a href="{{ route('penjualan.show',$sale) }}"
                               class="btn btn-info btn-sm text-white">

                                <i class="bi bi-eye"></i>

                            </a>

                            @can('view',$sale)

                            <a href="{{ route('penjualan.edit',$sale) }}"
                               class="btn btn-warning btn-sm">

                                <i class="bi bi-pencil-square"></i>

                            </a>

                            @endcan

                            @can('delete',$sale)

                            <form action="{{ route('penjualan.destroy',$sale) }}"
                                  method="POST">

                                @csrf
                                @method('DELETE')

                                <button
                                    class="btn btn-danger btn-sm"
                                    onclick="return confirm('Yakin ingin menghapus transaksi ini?')">

                                    <i class="bi bi-trash"></i>

                                </button>

                            </form>

                            @endcan

                        </div>

                    </td>

                </tr>

                @empty

                <tr>

                    <td colspan="7" class="text-center py-5">

                        <i class="bi bi-cart-x fs-1 text-secondary"></i>

                        <p class="text-muted mt-3">
                            Belum ada data penjualan.
                        </p>

                    </td>

                </tr>

                @endforelse

                </tbody>

            </table>

        </div>

        <div class="card-footer bg-white d-flex justify-content-between align-items-center">

            <small class="text-muted">

                Showing

                {{ $sales->firstItem() ?? 0 }}

                -

                {{ $sales->lastItem() ?? 0 }}

                of

                {{ $sales->total() }}

                transaksi

            </small>

            {{ $sales->links('pagination::bootstrap-5') }}

        </div>

    </div>

</div>

@endsection