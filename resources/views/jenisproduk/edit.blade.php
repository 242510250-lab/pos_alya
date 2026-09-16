@extends('layouts.app')

@section('title', 'Edit Jenis Produk')

@section('content')
<h1 class="fw-bold mb-4">Edit Jenis Produk</h1>

<div class="card">
    <div class="card-body">
        <form action="{{ route('jenisproduk.update', $jenisProduk) }}" method="POST">
            @csrf @method('PUT')
            <div class="mb-3">
                <label class="form-label">Nama Jenis</label>
                <input type="text" name="nama_jenis" value="{{ old('nama_jenis', $jenisProduk->nama_jenis) }}"
                       class="form-control">
                @error('nama_jenis') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
            </div>
            <button class="btn btn-primary">Update</button>
            <a href="{{ route('jenisproduk.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>
@endsection