<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'thumbnail' => 'nullable|image',
            'name' => 'required|string',
            'about' => 'required|string',
            'headman' => 'required|string',
            'people' => 'required|integer',
            'agricultural_area' => 'required',
            'total_area' => 'nullable',
            'images' => 'nullable|array',
            'images.*' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ];
    }

    public function attributes(): array
    {
        return [
            'thumbnail' => 'Thumbnail',
            'name' => 'Nama',
            'about' => 'Tentang Desa',
            'headman' => 'Kepala Desa',
            'people' => 'Jumlah Penduduk',
            'agricultural_area' => 'Luas Pertanian',
            'total_area' => 'Luas Total',
            'images' => 'Gambar',
        ];
    }
}
