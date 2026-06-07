<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // Anyone can register
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nip' => 'nullable|string|max:50',
            'nama' => 'required|string|max:255',
            'jenkel' => 'required|in:pria,wanita',
            'referensi' => 'required|string|max:100',
            'referensiDetail' => 'nullable|string|max:255',
            'email' => 'required|email|unique:karyawan,email|max:255',
            'password' => 'required|string|min:8',
        ];
    }
    
    public function messages(): array
    {
        return [
            'nama.required' => 'Nama wajib diisi.',
            'jenkel.required' => 'Jenis kelamin wajib dipilih.',
            'referensi.required' => 'Referensi wajib dipilih.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah terdaftar.',
            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password minimal 8 karakter.',
        ];
    }
}
