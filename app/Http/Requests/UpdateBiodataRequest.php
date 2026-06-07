<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBiodataRequest extends FormRequest
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
            'nohp' => 'required|numeric|digits_between:10,15',
            'tempatlahir' => 'required|string|max:100',
            'tgllahir' => 'required|date|before:today',
            'tinggi' => 'required|numeric|min:100|max:250',
            'berat' => 'required|numeric|min:30|max:200',
            'goldar' => 'required|in:A,B,AB,O',
            'statusnikah' => 'required|string',
            'pekerjaan' => 'required|string',
            'suku' => 'required|string',
            'pendidikan' => 'required|string',
            'hobi' => 'nullable|string',
            'motto' => 'nullable|string',
            'alamat' => 'required|string',
            'video' => 'nullable|mimetypes:video/mp4,video/x-msvideo,video/mpeg,video/quicktime|max:8024',
        ];
    }
}
