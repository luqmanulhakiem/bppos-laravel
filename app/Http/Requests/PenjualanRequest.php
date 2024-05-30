<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PenjualanRequest extends FormRequest
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
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'metode' => 'nullable',
            'no_nota' => 'required',
            'id_pelanggan' => 'required',
            'id_kasir' => 'nullable',
            'tgl_penjualan' => 'required',
            'sub_total' => 'required',
            'diskon_sub' => 'required',
            'grand_total' => 'required',
            'tgl_pengambilan' => 'required',
            'bayar' => 'required',
            'sisa' => 'required',
            'status_bayar' => 'nullable',
            'catatan' => 'nullable',
        ];
    }
}
