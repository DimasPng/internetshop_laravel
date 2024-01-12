<?php

namespace App\Http\Requests\Category;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
        $categoryId = $this->route('category');

        return [
            'name' => ['required', 'string',
                Rule::unique('categories', 'name')->ignore($categoryId->id)
                ],
            'uri_category' => [
                'required', 'regex:/^[a-z0-9-_]+$/u', 'min:3',
                Rule::unique('categories', 'uri_category')->ignore($categoryId->id)
            ],
            'image' => 'image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'top_category' => ''
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Пожалуйста, введите название категории.',
            'name.unique' => 'Название категории должно быть уникальным.',
            'name.min' => 'Название категории должно быть больше 3х симоволов',
            'uri_category.required' => 'Это обязательное поле.',
            'uri_category.unique' => 'URI категории c таким названием уже существует.',
            'uri_category.min' => 'URI должно быть больше 3х символов',
            'uri_category.regex' => 'Только латынские буквы в нижнем регистре, цифры, тире - и нижнее подчеркивание _',
            'image.required' => 'Добавьте изображение товара',
            'image.max' => 'Не более 20 изображений. Максимальный вес файла 2048кб.',
        ];
    }

}
