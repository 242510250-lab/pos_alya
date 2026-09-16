<?php

namespace App\Http\Controllers;

use App\Http\Requests\Produk\StoreRequest;
use App\Http\Requests\Produk\UpdateRequest;
use App\Http\Requests\SearchRequest;
use App\Models\Produk;
use App\Models\JenisProduk;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProdukController extends Controller
{
    use AuthorizesRequests;


    public function index(SearchRequest $request)
    {
        $keyword = $request->input('search');

        $products = Produk::when($keyword, function ($query) use ($keyword) {
            $query->where('nama', 'like', "%{$keyword}%");
        })
        ->orderBy('nama')
        ->paginate(10)
        ->withQueryString();

        return view('produk.index', compact('products'));
    }


    public function create()
    {
        $produk = new Produk();
        $jenisProduks = JenisProduk::orderBy('nama_jenis')->get();

        return view('produk.create', compact('produk', 'jenisProduks'));
    }


    public function store(StoreRequest $request)
    {
        $data = [
            'user_id' => Auth::id(),
            'jenis_produk_id' => $request->jenis_produk_id,
            'nama' => $request->nama,
            'harga_beli' => $request->harga_beli,
            'harga_jual' => $request->harga_jual,
            'stok' => $request->stok,
            'foto' => null,
        ];


        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('produk', 'public');
        }


        Produk::create($data);


        return redirect()
            ->route('produk.index')
            ->with('success', 'Product created successfully.');
    }



    public function edit(Produk $produk)
    {
        $jenisProduks = JenisProduk::orderBy('nama_jenis')->get();

        return view('produk.edit', compact('produk', 'jenisProduks'));
    }



    public function update(UpdateRequest $request, Produk $produk)
    {
        $data = [
            'user_id' => Auth::id(),
            'jenis_produk_id' => $request->jenis_produk_id,
            'nama' => $request->nama,
            'harga_beli' => $request->harga_beli,
            'harga_jual' => $request->harga_jual,
            'stok' => $request->stok,
        ];


        if ($request->hasFile('foto')) {

            if ($produk->foto && Storage::disk('public')->exists($produk->foto)) {
                Storage::disk('public')->delete($produk->foto);
            }

            $data['foto'] = $request->file('foto')->store('produk', 'public');

        }


        $produk->update($data);


        return redirect()
            ->route('produk.index')
            ->with('success', 'Product updated successfully.');
    }



    public function destroy(Produk $produk)
    {

        if ($produk->foto && Storage::disk('public')->exists($produk->foto)) {
            Storage::disk('public')->delete($produk->foto);
        }


        $produk->delete();


        return redirect()
            ->route('produk.index')
            ->with('success', 'Product deleted successfully.');
    }
}