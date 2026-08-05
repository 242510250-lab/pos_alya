@csrf

<div class="mb-3">
    <label>Foto Produk</label>

    <input type="file"
           name="foto"
           class="form-control">
</div>


<div class="mb-3">
    <label>Nama Produk</label>

    <input type="text"
           name="nama"
           class="form-control"
           value="{{ old('nama', $produk->nama ?? '') }}">

</div>


<div class="mb-3">
    <label>Harga Beli</label>

    <input type="number"
           name="harga_beli"
           class="form-control"
           value="{{ old('harga_beli', $produk->harga_beli ?? '') }}">

</div>


<div class="mb-3">
    <label>Harga Jual</label>

    <input type="number"
           name="harga_jual"
           class="form-control"
           value="{{ old('harga_jual', $produk->harga_jual ?? '') }}">

</div>


<div class="mb-3">
    <label>Stok</label>

    <input type="number"
           name="stok"
           class="form-control"
           value="{{ old('stok', $produk->stok ?? '') }}">

</div>