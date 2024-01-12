<?php

namespace App\Http\Requests\Review;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
            'author_name' => 'required|string|min:3',
            'email' => 'required|email',
            'comment' => 'required|string|min:8',
            'advantages' => 'nullable|string|min:5',
            'disadvantages' => 'nullable|string|min:5',
            'rating' => 'nullable|integer|min:0|max:5',
            'recommend' => 'nullable|in:on',
            'product_id' => 'required|exists:products,id'
        ];
    }
}
