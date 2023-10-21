<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreTransactionRequest extends FormRequest
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
            'kode_inv' => 'required',
            'nama_petugas' => 'required',
            'nama_pelanggan' => 'required',
            'status' => 'required',
            'jatuh_tempo' => 'nullable',
            'keterangan' => 'required',
            'total' => 'required',
            'nama_barang.*' => 'required',
            'harga_jual.*' => 'required',
            'qty.*' => 'required',
            'disc_perc.*' => 'required',
            'disc_rp.*' => 'required',
            'subtotal.*' => 'required',
        ];
    }
}
