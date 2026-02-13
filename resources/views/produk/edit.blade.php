@extends('layouts.app')

@section('tittle', 'Edit Produk')

@section('content')
<h4>Edit Produk</h4>

<form action="{{ route('produk.update'. $produk) }}" 
      method="POST"
      enctype="multipart/form-data">
      @method('PUT')
    @include('produk_form')
</form>
@endsection