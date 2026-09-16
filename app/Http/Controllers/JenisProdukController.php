<?php

namespace App\Http\Controllers;

use App\Models\JenisProduk;
use Illuminate\Http\Request;

class JenisProdukController extends Controller
{
    public function index(Request $request)
    {
        $query = JenisProduk::query();

        if ($request->filled('cari')) {
            $query->where('nama_jenis', 'like', '%' . $request->cari . '%');
        }

        $jenisProduks = $query->latest()->paginate(10);

        return view('jenisproduk.index', compact('jenisProduks'));
    }

    public function create()
    {
        return view('jenisproduk.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_jenis' => 'required|string|max:255|unique:jenis_produks,nama_jenis',
        ]);

        JenisProduk::create($request->only('nama_jenis'));

        return redirect()->route('jenisproduk.index')->with('success', 'Jenis produk berhasil ditambahkan.');
    }

    public function edit(JenisProduk $jenisProduk)
    {
        return view('jenisproduk.edit', compact('jenisProduk'));
    }

    public function update(Request $request, JenisProduk $jenisProduk)
    {
        $request->validate([
            'nama_jenis' => 'required|string|max:255|unique:jenis_produks,nama_jenis,' . $jenisProduk->id,
        ]);

        $jenisProduk->update($request->only('nama_jenis'));

        return redirect()->route('jenisproduk.index')->with('success', 'Jenis produk berhasil diperbarui.');
    }

    public function destroy(JenisProduk $jenisProduk)
    {
        $jenisProduk->delete();

        return redirect()->route('jenisproduk.index')->with('success', 'Jenis produk berhasil dihapus.');
    }
}