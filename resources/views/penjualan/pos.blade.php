@extends('layouts.app')

@section('title', 'POS')

@section('content')

@if(session('errors'))
    <div class="alert alert-danger">
        {{ session('errors') }}
    </div>
@endif

<h4 class="mb-3">
    {{ $mode === 'edit' ? 'Edit Penjualan' : 'Tambah Penjualan' }}
</h4>


<div class="row">

    {{-- --------------------- PRODUK --------------------- --}}
    <div class="col-md-6">
        <div class="card">
            <div class="card-body" style="max-height:70vh; overflow:auto">
                <div class="mb-3">
                    <form method="GET" action="{{ route('penjualan.create') }}">
                        <input type="text"
                               name="search"
                               value="{{ request('search') }}"
                               class="form-control"
                               placeholder="Cari produk..."
                               onkeyup="this.form.submit()">
                    </form>
                            </div>
        @foreach ($products as $product)
                <form method="post" action="{{ route('item-penjualan.store', $sale->id) }}" class="row mb-2">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">

            <div class="col-7">
                <button class="btn btn-outline-primary w-100 text-start p-2 {{ $sale->status == 'CANCELLED' ? 'disabled' : '' }}">
                    <div class="d-flex align-items-center gap-2">

                        {{-- Gambar produk --}}
                        <img src="{{ asset('storage/products/foto.jpg') }}"
                             alt="Gambar"
                             class="rounded-circle"
                             style="width:45px; height:45px; object-fit:cover;">

                        {{-- Nama & harga --}}
                        <div class="fw-semibold"> {{ $product->nama }}</div>
                            <small class="text-muted">Rp {{ number_format($product->harga_jual) }}</small>
                        </div>

                    </div>
                </button>
            </div>
            <div class="col-3">
    <input type="number" name="quantity" value="1" min="1"
           class="form-control {{ $sale->status == 'CANCELLED' ? 'disabled' : '' }}">
</div>

<div class="col-2">
    <button class="btn btn-primary w-100 {{ $sale->status == 'CANCELLED' ? 'disabled' : '' }}">+</button>
</div>
</div>
</form>
@endforeach
</div>
</div>
{{-- --------------------- KERANJANG --------------------- --}}
<div class="col-md-6">
    <div class="card">
        <table class="table table-bordered mb-0">
            <thead>
                <tr>
                    <th>Produk</th>
                    <th>Harga</th>
                    <th>Qty</th>
                    <th>Subtotal</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($sale->itemPenjualan as $item)
                    <tr>
                        <td>{{ $item->produk->nama }}</td>
                        <td>Rp. {{ number _format($item->produk->harga_jual) }}</td>
                        <td>
                            <form method="POST" action="{{ route('item-penjualan.update', $item->id) }}">
                                @csrf @method('PUT')
                                <input type="number" name="quantity"
                                       value="{{ $item->kuantitas }}"
                                       class="form-control form-control-sm">
                            </form>
                        </td>
                        <td>Rp {{ number_format($item->subtotal) }}</td>
                        <td>
                    </tr>
                @empty
                    
                @endforelse
                <tr>
                    <td>coki-coki</td>
                    <td>
                        <form method="" action="">
                            @csrf @method('PUT')
                            <input type="number" name="quantity"
                                   value=""
                                   class="form-control form-control-sm">
                        </form>
                    </td>
                    <td>Rp {{ number_format($item->subtotal) }}</td>
                    <td>
                        @can('delete', $item)
                        <form method="POST" action="{{ route('item-penjualan.destroy', $item->id) }}">
                            @csrf @method('DELETE')
                            <button class="btn btn-danger btn-sm">Hapus</button>
                        </form>
                        @endcan
                    </td>
                                </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center text-muted">
                                            keranjang kosong
                                        </td>
                                    </tr>
                                @endforelse
        </tbody>
    </table>

    <div class="card-footer">
        <strong>Rp {{ number_format($sale->total_pembayaran) }}</strong>

        <form method="POST" 
        action="{{ route('penjualan.update', $sale->id) }}" 
        submit="return confirm('Apakah anda yakin akan menyelesaikan transaksi ini?')" class="mt-2">
            @csrf
            @method('PUT')
            <select name="payment_method" class="form-select mb-2">
                <option value="">Pilih Pembayaran</option>
                <option value="CASH">Cash</option>
                <option value="QRIS">QRIS</option>
            </select>

            <button class="btn btn-success w-100 {{ $sale->status == 'CANCELLED' ? 'disabled' : '' }}">
                Checkout
            </button>
        </form>
        @can('delete', $sale)
        <form section="{{ route('penjualan.destroy', $sale->id) }}"
              method="POST"
              submit="return confirm('Apakah anda yakin akan membatalkan transaksi ini?')">
            @csrf
            @method('DELETE')
            <button class="btn btn-outline-danger w-100">
                Batal Transaksi
            </button>
        </form>
        @endcan
    </div>
                </tr>
            </tbody>
        </table>
    </div>
</div>
        </form>
    </div>
    @endsection