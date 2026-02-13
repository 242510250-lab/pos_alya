@extends('layouts.app')

@section('tittle', 'produk')

@section('content')

@include('layouts.navbar')

<h1>Halaman Produk</h1>

@can('create', App\Models\produk::class)
<a href="{{ route('produk.create') }}" method="GET" class="btn btn-primary mb-3">create</a>
@endcan

<form action=""{{ route('produk.index') }} method="GET" class="mb-3">
    <div> class="input-group">
        <input>
        type="text"
        name="search"
        value=""
        class="form-control"
        placeholder="search nama produk"
    >
      <button class="btn btn-outline-secondary" type="submit">
        search
      </button>
    </div>
</form>

<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">User</th>
      <th scope="col">Foto</th>
      <th scope="col">Nama</th>
      <th scope="col">Harga Beli</th>
      <th scope="col">Harga Jual</th>
      <th scope="col">Stok</th>
      <th scope="col">Aksi</th>
    </tr>
  </thead>
  <tbody>
    @forelse ($products as $product)
    <tr>
      <th scope="row">{{ $products->firstitem() + $loop->index }}</th>
      <td>{{ $product->user->name }}</td>
      <td>
        <img src="{{ asset('storage/'.$product->foto) }}"
                 width="100"
                 class="img-thumbnail">
      </td>
      <td>{{ $product->nama }}</td>
      <td>{{ $product->harga_beli }}</td>
      <td>{{ $product->harga_jual }}</td>
      <td>{{ $product->stok }}</td>
      <td class="d-flex gap-1">
        @can('update', $product)
        <a href="{{ route('produk.edit', $product) }}" class="btn btn-warning">Edit</a>
        @endcan
        ||
        @can('delete', $product)
        <form action="{{ route('produk.destory', $product) }}" method="" class="d-inline">
            @csrf
            @method('DELETE')
            <button class="btn btn-danger" onclick="return confirm('apakah anda yakin akan menghapus user ini')">
                Hapus
            </button>
        </form>
    </td>
    </tr>
    @empty
    <tr>
        <td collspan=8><h1>Data tidak tersedia.</h1></td>
    </tr>
    @endforelse
</body>
</table>
{{ $products->links() }}
      <th scope="row">2</th>
      <td>Jacob</td>
      <td>Thornton</td>
      <td>@fat</td>
    </tr>
    <tr>
      <th scope="row">3</th>
      <td>John</td>
      <td>Doe</td>
      <td>@social</td>
    </tr>
  </tbody>
</table>
@endsection