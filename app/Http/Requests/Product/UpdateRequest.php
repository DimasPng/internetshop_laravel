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
            'hit'=>'',
            'uri_product'=> [
                'required', 'regex:/^[a-zA-Z0-9-_]/u', 'min:3'
            ]
        ];
    }

    public function messages(): array
    {
        return [
            'title.min' => 'Название товара должно быть больше 5 символов',
            'title.required' => 'Это поле обязательно для заполнения',
            'description.required' => 'Это поле обязательно для заполнения',
            'description.min' => 'Название товара должно быть больше 10 символов',
            'price.required' => 'Это поле обязательно для заполнения',
            'quantity.required' => 'Это поле обязательно для заполнения',
            'images.max' => 'Не более 20 изображений. Максимальный вес файла 2048кб.',
            'uri_product.required' => 'Это обязательное поле.',
            'uri_product.min' => 'URI должно быть больше 3х символов',
            'uri_product.regex' => 'Только латынские буквы, цифры, тире - и нижнее подчеркивание _',
        ];
    }
}
