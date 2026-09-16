@csrf

@if (!empty($produk->foto))
<div class="mb-3">
    <label>Foto Saat Ini</label><br>
    <img src="{{ asset('storage/' . $produk->foto) }}" width="150" class="img-thumbnail">
</div>
@endif


<div class="row">

    <div class="col-md-6">

        <div class="mb-3">
            <label>Foto Produk</label>

            <input type="file"
                name="foto"
                onchange="previewImage(this)"
                class="form-control @error('foto') is-invalid @enderror">

            @error('foto')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror

        </div>

    </div>


    <div class="col-md-6">

        <label>Preview Foto</label><br>

        <img id="preview"
             class="img-thumbnail"
             width="150"
             style="display:none;">

    </div>

</div>


<div class="mb-3">
    <label>Jenis Produk</label>

    <select name="jenis_produk_id" class="form-control @error('jenis_produk_id') is-invalid @enderror">
        <option value="">-- Pilih Jenis --</option>
        @foreach($jenisProduks as $jenis)
            <option value="{{ $jenis->id }}"
                {{ old('jenis_produk_id', $produk->jenis_produk_id ?? '') == $jenis->id ? 'selected' : '' }}>
                {{ $jenis->nama_jenis }}
            </option>
        @endforeach
    </select>

    @error('jenis_produk_id')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
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



<button type="submit" class="btn btn-success">
    Simpan
</button>


<a href="{{ route('produk.index') }}" class="btn btn-secondary">
    Kembali
</a>



<script>

function previewImage(input)
{
    const preview = document.getElementById('preview');

    const file = input.files[0];


    if(file)
    {
        preview.src = URL.createObjectURL(file);
        preview.style.display = 'block';
    }
}

</script>