@extends('layouts.app')

@section('title', 'Tentang')

@section('content')
@include('layouts.navbar')

<div class="card">
    <div class="card-body">
        <h1 class="fw-bold mb-3">Tentang Alya Story</h1>
        <p class="text-muted">
            Alya Story adalah aplikasi Point of Sale (POS) sederhana untuk membantu
            mengelola data produk, jenis produk, dan transaksi penjualan sehari-hari.
        </p>
        <ul>
            <li>Manajemen Produk & Jenis Produk</li>
            <li>Pencatatan Penjualan</li>
            <li>Manajemen Pengguna (Admin & Kasir)</li>
            <li>Dashboard ringkasan transaksi</li>
        </ul>
    </div>
</div>
@endsection