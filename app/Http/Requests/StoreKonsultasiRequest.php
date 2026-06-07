<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreKonsultasiRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth('karyawan')->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'topik_konsultasi' => 'required|string|max:255',
            'pesan' => 'required|string',
        ];
    }
    
    public function messages(): array
    {
        return [
            'topik_konsultasi.required' => 'Topik konsultasi wajib diisi.',
            'topik_konsultasi.max' => 'Topik konsultasi tidak boleh lebih dari 255 karakter.',
            'pesan.required' => 'Pesan konsultasi wajib diisi.',
        ];
    }
}
