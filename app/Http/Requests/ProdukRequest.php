<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProdukRequest extends FormRequest
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
            'nama'=>'required',
            'harga'=>'required|integer',
            'foto'=>'nullable|file|mimes:jpeg,png',
            'stok'=>'required|integer',
        ];
    }

    public function messages(): array
    {
        return [
            'required' => 'Kolom :attribute Anda Kosong Wajib Di Isi.',
            'unique' => ':Attribute sudah ada dalam database.',
            'max' => ':Attribute maksimal 255 karakter.',
            'mimes' => ':Attribute harus berextensi JPEG, PNG',
            'nullable' => ':Attribute harus berupa angka (toleransi_keterlambatan), teks (catatan), atau kode warna (warna).',
            'time' => ':Attribute harus berupa waktu yang tepat',

            
        ];
    }

}
