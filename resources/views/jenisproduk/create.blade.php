@extends('layouts.app')

@section('title', 'Tambah Jenis Produk')

@section('content')
<h1 class="fw-bold mb-4">Tambah Jenis Produk</h1>

<div class="card">
    <div class="card-body">
        <form action="{{ route('jenisproduk.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label">Nama Jenis</label>
                <input type="text" name="nama_jenis" value="{{ old('nama_jenis') }}"
                       class="form-control" placeholder="Contoh: Baju, Sepatu, Aksesoris">
                @error('nama_jenis') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
            </div>
            <button class="btn btn-primary">Simpan</button>
            <a href="{{ route('jenisproduk.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>
@endsection