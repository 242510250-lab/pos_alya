@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
@include('layouts.navbar')

<style>
body{
    background:#f4f6f9;
}

.dashboard-title{
    font-weight:700;
}

.card-dashboard{
    border:none;
    border-radius:15px;
    box-shadow:0 5px 15px rgba(0,0,0,.08);
    transition:.3s;
}

.card-dashboard:hover{
    transform:translateY(-4px);
}

.icon-box{
    font-size:45px;
    opacity:.25;
}

.table thead{
    background:#0d6efd;
    color:white;
}

.table tbody tr:hover{
    background:#f8f9fa;
}

.card{
    border:none;
    border-radius:15px;
}

.card-header{
    background:white;
    font-weight:600;
    border-bottom:1px solid #eee;
}

.badge-stock{
    padding:7px 12px;
    border-radius:30px;
}
</style>

<link rel="stylesheet"
href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<div class="container py-4">

@if(auth()->user()->role->name == 'admin')

<div class="mb-4">
    <h2 class="dashboard-title">Dashboard</h2>
    <p class="text-muted">
        {{ $TanggalHariIni->translatedFormat('l, d F Y') }}
    </p>
</div>

<div class="row g-4 mb-5">

    <div class="col-lg-3 col-md-6">
        <div class="card card-dashboard bg-primary text-white">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <small>Total Penjualan</small>
                    <h3 class="fw-bold">
                        Rp {{ number_format($ringkasan['total_penjualan']) }}
                    </h3>
                </div>

                <i class="bi bi-cash-stack icon-box"></i>

            </div>
        </div>
    </div>

    <div class="col-lg-3 col-md-6">
        <div class="card card-dashboard bg-success text-white">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <small>Total Transaksi</small>
                    <h3 class="fw-bold">
                        {{ $ringkasan['total_transaksi'] }}
                    </h3>
                </div>

                <i class="bi bi-cart-check icon-box"></i>

            </div>
        </div>
    </div>

    <div class="col-lg-3 col-md-6">
        <div class="card card-dashboard bg-warning">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <small>Pembayaran Tunai</small>
                    <h3 class="fw-bold">
                        Rp {{ number_format($ringkasan['total_cash']) }}
                    </h3>
                </div>

                <i class="bi bi-wallet2 icon-box"></i>

            </div>
        </div>
    </div>

    <div class="col-lg-3 col-md-6">
        <div class="card card-dashboard bg-danger text-white">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <small>Pembayaran Non Tunai</small>
                    <h3 class="fw-bold">
                        Rp {{ number_format($ringkasan['total_non_tunai']) }}
                    </h3>
                </div>

                <i class="bi bi-credit-card icon-box"></i>

            </div>
        </div>
    </div>

</div>

@endif


<div class="row">

    <div class="col-lg-6 mb-4">

        <div class="card shadow">

            <div class="card-header">
                📦 Produk Stok Rendah
            </div>

            <div class="card-body p-0">

                <table class="table table-hover align-middle mb-0">

                    <thead>
                    <tr>
                        <th>No</th>
                        <th>Produk</th>
                        <th>Stok</th>
                    </tr>
                    </thead>

                    <tbody>

                    @forelse($produkStokRendah as $index=>$produk)

                    <tr>

                        <td>
                            {{ $produkStokRendah->firstItem()+$index }}
                        </td>

                        <td>{{ $produk->nama }}</td>

                        <td>

                            @if($produk->stok==0)

                            <span class="badge bg-danger badge-stock">
                                Habis
                            </span>

                            @else

                            <span class="badge bg-warning text-dark badge-stock">
                                {{ $produk->stok }}
                            </span>

                            @endif

                        </td>

                    </tr>

                    @empty

                    <tr>
                        <td colspan="3" class="text-center text-success">
                            Semua stok aman
                        </td>
                    </tr>

                    @endforelse

                    </tbody>

                </table>

            </div>

            <div class="card-footer">
                {{ $produkStokRendah->links('pagination::bootstrap-5') }}
            </div>

        </div>

    </div>



    <div class="col-lg-6 mb-4">

        <div class="card shadow">

            <div class="card-header">
                ❌ Produk Habis Stok
            </div>

            <div class="card-body p-0">

                <table class="table table-hover align-middle mb-0">

                    <thead>
                    <tr>
                        <th>No</th>
                        <th>Produk</th>
                        <th>Stok</th>
                    </tr>
                    </thead>

                    <tbody>

                    @forelse($produkTerlaris as $index=>$produk)

                    <tr>

                        <td>
                            {{ $produkTerlaris->firstItem()+$index }}
                        </td>

                        <td>{{ $produk->nama }}</td>

                        <td>

                            <span class="badge bg-danger badge-stock">
                                {{ $produk->stok }}
                            </span>

                        </td>

                    </tr>

                    @empty

                    <tr>
                        <td colspan="3" class="text-center">
                            Tidak ada produk habis stok
                        </td>
                    </tr>

                    @endforelse

                    </tbody>

                </table>

            </div>

            <div class="card-footer">
                {{ $produkTerlaris->links('pagination::bootstrap-5') }}
            </div>

        </div>

    </div>

</div>



<div class="card shadow mt-4">

    <div class="card-header">

        🔥 Best Seller Products

    </div>

    <div class="card-body p-0">

        <table class="table table-hover align-middle mb-0">

            <thead>

            <tr>

                <th>Produk</th>

                <th>Stok</th>

                <th>Total Terjual</th>

            </tr>

            </thead>

            <tbody>

            @forelse($produkTerlarisAsli as $produk)

            <tr>

                <td>{{ $produk->nama }}</td>

                <td>

                    @if($produk->stok==0)

                    <span class="badge bg-danger">
                        Habis
                    </span>

                    @elseif($produk->stok<=10)

                    <span class="badge bg-warning text-dark">
                        {{ $produk->stok }}
                    </span>

                    @else

                    <span class="badge bg-success">
                        {{ $produk->stok }}
                    </span>

                    @endif

                </td>

                <td>

                    <span class="badge bg-primary">
                        {{ $produk->total_terjual }}
                    </span>

                </td>

            </tr>

            @empty

            <tr>

                <td colspan="3" class="text-center">

                    Belum ada data penjualan

                </td>

            </tr>

            @endforelse

            </tbody>

        </table>

    </div>

</div>

<form action="{{ route('logout') }}" method="POST" id="logout-form" class="d-none">
    @csrf
</form>

</div>

@endsection