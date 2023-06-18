<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditUserRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            // 'name' => 'required|unique:users|max:20',
            // 'email' => 'required|unique:users',
            // 'name' =>'required|unique:users,name,'.$this->user->id,
            // 'email' =>'required|unique:users,email,'.$this->user->id,
            // 'password' => 'required',
            'name' => 'required|unique:users,name,'.$this->id,
            'email' => 'required|unique:users,email,'.$this->id,
            
            
        ];
        
    }
}
