<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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
            'title' => 'required|string',
            'desc' => 'required|string',
            'category_id' => 'exists:categories,id',
            'comment_able' => 'in:on,off,0,1',
            'images' => 'nullable',
            'images.*' => 'image',
            'small_desc' => 'nullable|min:50',
            'status' => 'nullable|in:0,1'
        ];
    }
}
