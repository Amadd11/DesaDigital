<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class SocialAssistanceUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            //
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'name' => 'required|string|max:255',
            'provider' => 'required|string',
            'category' => 'required|string|in:staple,cash,subsidized fuel,health',
            'amount' => 'required|numeric|min:0',
            'description' => 'required',
            'is_available' => 'required|boolean',
        ];
    }

    public function attributes(): array
    {
        return [
            'thumbnail' => 'Thumbnail',
            'name' => 'Name',
            'provider' => 'Penyedia',
            'category' => 'Kategori',
            'amount' => 'Jumlah Bantuan',
            'description' => 'Deskripsi',
            'is_available' => 'Status Ketersediaan',
        ];
    }
}
