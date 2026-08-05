@extends('layouts.app')

@section('title', 'Tambah Produk')

@section('content')

@include('layouts.navbar')

<div class="container py-4">

    <div class="card">

        <div class="card-header">
            <h4>Tambah Produk</h4>
        </div>

        <div class="card-body">

            <form action="{{ route('produk.store') }}"
                  method="POST"
                  enctype="multipart/form-data">

                @csrf

                @include('produk._form')

                <button type="submit" class="btn btn-primary">
                    Simpan Produk
                </button>

                <a href="{{ route('produk.index') }}"
                   class="btn btn-secondary">
                    Kembali
                </a>

            </form>

        </div>

    </div>

</div>

@endsection