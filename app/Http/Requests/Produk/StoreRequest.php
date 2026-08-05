<?php

namespace App\Http\Requests\Produk;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'nama' => 'required|string|max:255',
            'harga_beli' => 'required|integer|min:0',
            'harga_jual' => 'required|integer|min:0',
            'stok' => 'required|integer|min:0',
        ];
    }

    /**
     * Custom validation messages.
     */
    public function messages(): array
    {
        return [
            'foto.image' => 'File yang diupload harus berupa gambar.',
            'foto.mimes' => 'Format gambar harus JPG, JPEG, atau PNG.',
            'foto.max' => 'Ukuran gambar maksimal 2 MB.',

            'nama.required' => 'Nama produk wajib diisi.',
            'nama.max' => 'Nama produk maksimal 255 karakter.',

            'harga_beli.required' => 'Harga beli wajib diisi.',
            'harga_beli.integer' => 'Harga beli harus berupa angka.',
            'harga_beli.min' => 'Harga beli tidak boleh kurang dari 0.',

            'harga_jual.required' => 'Harga jual wajib diisi.',
            'harga_jual.integer' => 'Harga jual harus berupa angka.',
            'harga_jual.min' => 'Harga jual tidak boleh kurang dari 0.',

            'stok.required' => 'Stok wajib diisi.',
            'stok.integer' => 'Stok harus berupa angka.',
            'stok.min' => 'Stok tidak boleh kurang dari 0.',
        ];
    }
}