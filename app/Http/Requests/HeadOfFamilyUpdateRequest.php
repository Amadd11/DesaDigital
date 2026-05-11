<?php

namespace App\Http\Requests;

use App\Models\HeadOfFamily;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class HeadOfFamilyUpdateRequest extends FormRequest
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
            'name' => 'required|string',
            'email' => 'nullable|string|email|max:255|unique:users,email,' . HeadOfFamily::find($this->route('head_of_family'))->user_id,
            'password' => 'nullable|string|min:8',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'identity_number' => 'required|integer',
            'gender' => 'required|string|in:male,female',
            'date_of_birth' => 'required|date',
            'phone_number' => 'required|string',
            'occupation' => 'required|string',
            'marital_status' => 'required|string|in:single,married',
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'Nama',
            'email' => 'Email',
            'password' => 'Password',
            'profile_picture' => 'Foto Profil',
            'identity_number' => 'Nomor Identitas',
            'gender' => 'Jenis Kelamin',
            'date_of_birth' => 'Tanggal Lahir',
            'phone_number' => 'Nomor Telepon',
            'occupation' => 'Pekerjaan',
            'marital_status' => 'Status Pernikahan',
        ];
    }
}
