@extends('layouts.app')

@section('title', 'Jenis Produk')

@section('content')
@include('layouts.navbar')

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h1 class="fw-bold">Jenis Produk</h1>
        <p class="text-muted">Kelola kategori produk</p>
    </div>
    <a href="{{ route('jenisproduk.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> Tambah Jenis
    </a>
</div>

<div class="card mb-4">
    <div class="card-body">
        <form method="GET" class="d-flex gap-2">
            <input type="text" name="cari" value="{{ request('cari') }}"
                   class="form-control" placeholder="Cari nama jenis...">
            <button class="btn btn-primary">Cari</button>
        </form>
    </div>
</div>

<div class="card">
    <div class="card-header bg-white">
        <strong>Daftar Jenis Produk</strong>
    </div>
    <div class="card-body p-0">
        <table class="table mb-0">
            <thead>
                <tr>
                    <th class="ps-3">No</th>
                    <th>Nama Jenis</th>
                    <th class="pe-3">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($jenisProduks as $i => $jenis)
                <tr>
                    <td class="ps-3">{{ $jenisProduks->firstItem() + $i }}</td>
                    <td>{{ $jenis->nama_jenis }}</td>
                    <td class="pe-3">
                        <a href="{{ route('jenisproduk.edit', $jenis) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('jenisproduk.destroy', $jenis) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus jenis ini?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-danger btn-sm">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" class="text-center py-5 text-muted">
                        <div style="font-size: 2rem;">📦</div>
                        Belum ada jenis produk.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="card-footer bg-white d-flex justify-content-between align-items-center">
        <small class="text-muted">
            Showing {{ $jenisProduks->firstItem() ?? 0 }} - {{ $jenisProduks->lastItem() ?? 0 }} of {{ $jenisProduks->total() }} jenis
        </small>
        {{ $jenisProduks->links() }}
    </div>
</div>
@endsection