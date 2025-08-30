<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClientRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array {
        return [
            'name' => 'required|string|max:150',
            'email'=> 'nullable|email',
            'phone'=> 'nullable|string|max:50',
            'address'=>'nullable|string|max:500'
        ];
    }
}
