<?php

namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class SettingsRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Auth::check();
    }

    public function rules(): array
    {
        return [
            'access_price' => 'numeric|required',
            'refresh_price' => 'numeric|required',
            'logo' => 'image|nullable',
            'logo_url' => 'string|nullable',
            'banner' => 'image|nullable',
            'banner_url' => 'string|nullable',
            'delete_images' => 'array|nullable',
        ];
    }
}
