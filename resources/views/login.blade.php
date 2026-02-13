<!-- memanggil file app.blade.php sebagai layout -->
@extends('layouts.app')

<!-- mengirimkan nilai ke title -->
@section('title', 'inilah halaman ujicoba')

<!-- batas awal isi konten -->
@section('content')

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="card text-center mx-auto mt-5" style="width: 18rem;">
    <div class="card-header">
        Login POS
    </div>

    <div class="card-body">
        <form action="{{ route('auth') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label class="form-label">Email address</label>
                <input type="email" name="email" class="form-control">

                @error('email')
                    <div class="badge text-bg-danger">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control">

                @error('password')
                    <div class="badge text-bg-danger">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary w-100">
                Submit
            </button>
        </form>
    </div>
</div>

<!-- batas akhir isi konten -->
@endsection
