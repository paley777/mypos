<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreBarangMasukRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nama_penerima' => 'required',
            'nama_supplier' => 'required',
            'nama_barang' => 'required',
            'jumlah_beli' => 'required',
            'keterangan' => 'required',
            'status' => 'required',
            'harga_beli_satuan' => 'required',
            'harga_beli_total' => 'required',
        ];
    }
}
