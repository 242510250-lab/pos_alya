@extends('layouts.app')

@section('title', 'Produk')

@section('content')

@include('layouts.navbar')

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<style>
body{
    background:#f4f6f9;
}

.page-title{
    font-weight:700;
}

.card{
    border:none;
    border-radius:15px;
    box-shadow:0 5px 15px rgba(0,0,0,.08);
}

.table thead{
    background:#0d6efd;
    color:#fff;
}

.table tbody tr:hover{
    background:#f8f9fa;
}

.btn{
    border-radius:10px;
}

.product-img{
    width:60px;
    height:60px;
    object-fit:cover;
    border-radius:10px;
    border:1px solid #ddd;
}

.search-box{
    max-width:450px;
}

.badge{
    font-size:.9rem;
}

.pagination{
    margin-bottom:0;
}
</style>


<div class="container py-4">


    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h2 class="page-title">
                Manajemen Produk
            </h2>

            <p class="text-muted mb-0">
                Kelola seluruh data produk
            </p>
        </div>


        <a href="{{ route('produk.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i>
            Tambah Produk
        </a>

    </div>



    <div class="card mb-4">

        <div class="card-body">


            <form action="{{ route('produk.index') }}" method="GET">

                <div class="input-group search-box">

                    <span class="input-group-text">
                        <i class="bi bi-search"></i>
                    </span>


                    <input
                        type="text"
                        name="search"
                        value="{{ request('search') }}"
                        class="form-control"
                        placeholder="Cari nama produk...">


                    <button class="btn btn-primary">
                        Cari
                    </button>


                </div>

            </form>


        </div>

    </div>



    <div class="card">


        <div class="card-header bg-white">

            <h5 class="mb-0">
                Daftar Produk
            </h5>

        </div>



        <div class="table-responsive">


            <table class="table table-hover align-middle mb-0">


                <thead>

                <tr>

                    <th>No</th>
                    <th>User</th>
                    <th>Foto</th>
                    <th>Nama Produk</th>
                    <th>Harga Beli</th>
                    <th>Harga Jual</th>
                    <th>Stok</th>
                    <th class="text-center">Aksi</th>

                </tr>

                </thead>



                <tbody>


                @forelse($products as $product)


                <tr>


                    <td>
                        {{ $products->firstItem()+$loop->index }}
                    </td>



                    <td>
                        {{ $product->user->name ?? '-' }}
                    </td>



                    <td>

                        @if($product->foto)

                            <img
                                src="{{ asset('storage/'.$product->foto) }}"
                                class="product-img">

                        @else

                            <span class="text-muted">
                                Tidak Ada
                            </span>

                        @endif

                    </td>




                    <td>
                        <strong>
                            {{ $product->nama }}
                        </strong>
                    </td>



                    <td>
                        Rp {{ number_format($product->harga_beli,0,',','.') }}
                    </td>



                    <td>

                        <strong class="text-success">
                            Rp {{ number_format($product->harga_jual,0,',','.') }}
                        </strong>

                    </td>



                    <td>


                        @if($product->stok == 0)

                            <span class="badge bg-danger">
                                Habis
                            </span>


                        @elseif($product->stok <= 10)


                            <span class="badge bg-warning text-dark">
                                {{ $product->stok }}
                            </span>


                        @else


                            <span class="badge bg-success">
                                {{ $product->stok }}
                            </span>


                        @endif


                    </td>



                    <td>


                        <div class="d-flex justify-content-center gap-2">


                            <a
                                href="{{ route('produk.edit',$product) }}"
                                class="btn btn-warning btn-sm">

                                <i class="bi bi-pencil-square"></i>

                            </a>



                            <form
                                action="{{ route('produk.destroy',$product) }}"
                                method="POST">

                                @csrf
                                @method('DELETE')


                                <button
                                    class="btn btn-danger btn-sm"
                                    onclick="return confirm('Yakin ingin menghapus produk ini?')">

                                    <i class="bi bi-trash"></i>

                                </button>


                            </form>


                        </div>


                    </td>


                </tr>



                @empty


                <tr>

                    <td colspan="8" class="text-center py-5">


                        <i class="bi bi-box-seam fs-1 text-secondary"></i>


                        <p class="mt-3 text-muted">
                            Belum ada data produk.
                        </p>


                    </td>


                </tr>


                @endforelse


                </tbody>


            </table>


        </div>




        <div class="card-footer bg-white d-flex justify-content-between align-items-center">


            <small class="text-muted">

                Showing

                {{ $products->firstItem() ?? 0 }}

                -

                {{ $products->lastItem() ?? 0 }}

                of

                {{ $products->total() }}

                products

            </small>



            {{ $products->links('pagination::bootstrap-5') }}



        </div>


    </div>


</div>


@endsection