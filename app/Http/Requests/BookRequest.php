<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Spatie\FlareClient\Api;

class BookRequest extends FormRequest
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
            //
            'name'=>'required|max:150',
            'description'=>'required|max:250',
            'image'=>'required|max:50',
            'category'=>'required|numeric|exists:categories,id',
            'author'=>'required|numeric|exists:authors,id'
        ];
    }
}
