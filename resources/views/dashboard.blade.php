@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

@include('layouts.navbar')

<div class="container mt-4">

    <div class="text-center mb-4">
        <h2>Ringkasan Hari Ini</h2>
        <small class="text-muted">
            ({{ $TanggalHariIni->translatedFormat('l, d F Y') }})
        </small>
    </div>

    @can('viewAny', App\Models\User::class)

    {{-- Ringkasan Penjualan --}}
    <div class="row mb-4">
        <div class="col-md-12">
            <h3>Today's Sales</h3>
        </div>

        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Total Penjualan</div>
                <div class="card-body">
                    <h5>Rp {{ number_format($ringkasan['total_penjualan']) }}</h5>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Jumlah Transaksi</div>
                <div class="card-body">
                    <h5>{{ $ringkasan['total_transaksi'] }}</h5>
                </div>
            </div>
        </div>
    </div>

    {{-- Cash & Non Cash --}}
    <div class="row mb-4">
        <div class="col-md-12">
            <h3>Cash & Payment Status</h3>
        </div>

        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Tunai</div>
                <div class="card-body">
                    <h5>Rp {{ number_format($ringkasan['total_cash']) }}</h5>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Non Tunai</div>
                <div class="card-body">
                    <h5>Rp {{ number_format($ringkasan['total_non_tunai']) }}</h5>
                </div>
            </div>
        </div>
    </div>

    @endcan

    {{-- Produk Stok Rendah --}}
    <div class="row mb-4">
        <div class="col-md-12">
            <h3>Produk Stok Rendah</h3>

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama</th>
                        <th>Stok</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($produkStokRendah as $index => $produk)
                        <tr>
                            <td>{{ $produkStokRendah->firstItem() + $index }}</td>
                            <td>{{ $produk->nama }}</td>
                            <td>{{ $produk->stok }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-center text-muted">
                                Semua stok aman
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            {{ $produkStokRendah->links() }}
        </div>
    </div>

    {{-- Produk Terlaris --}}
    <div class="row mb-4">
        <div class="col-md-12">
            <h3>Best Seller Products</h3>

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Stok</th>
                        <th>Unit Terjual</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($produkTerlaris as $produk)
                        <tr>
                            <td>{{ $produk->nama }}</td>
                            <td>{{ $produk->stok }}</td>
                            <td>{{ $produk->total_terjual }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-center text-muted">
                                Belum ada data penjualan
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Logout --}}
    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button class="btn btn-danger">Logout</button>
    </form>
