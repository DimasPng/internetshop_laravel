<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
            'title' => 'required|string|min:5',
            'description' => 'required|string|min:10',
            'price' => 'required|integer',
            'quantity' => 'required|integer',
            'images' => 'array|max:20',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'category_id' => 'exists:categories,id',
            'is_published' => '',
        ];
    }

    public function messages()
    {
        return [
            'title.min' => 'Название товара должно быть больше 5 символов',
            'title.required' => 'Это поле обязательно для заполнения',
            'description.required' => 'Это поле обязательно для заполнения',
            'description.min' => 'Название товара должно быть больше 10 символов',
            'price.required' => 'Это поле обязательно для заполнения',
            'quantity.required' => 'Это поле обязательно для заполнения',
            'images.max' => 'Не более 20 изображений. Максимальный вес файла 2048кб.',
        ];
    }
}
