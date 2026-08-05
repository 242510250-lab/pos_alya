@extends('layouts.app')

@section('title', 'Edit Produk')

@section('content')
<h4>Edit Produk</h4>

<form action="{{ route('produk.update', $produk->id) }}" 
      method="POST"
      enctype="multipart/form-data">

    @csrf
    @method('PUT')

    @include('produk._form')

    <button type="submit" class="btn btn-primary">
        Update
    </button>
</form>
@endsection