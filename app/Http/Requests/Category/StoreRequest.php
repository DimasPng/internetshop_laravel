<?php

namespace App\Http\Requests\Category;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
        $categoryId = $this->route('category');
        return [
            'name'=>['required','min:3', 'string',
                Rule::unique('categories', 'name')->ignore($categoryId)
                ],
            'uri_category' => [
                'required', 'regex:/^[a-z0-9-_]+$/u', 'min:3',
                Rule::unique('categories', 'uri_category')->ignore($categoryId)
            ],
            'top_category' => ''
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Пожалуйста, введите название категории.',
            'name.unique' => 'Категория с таким названием уже существует.',
            'name.min' => 'Название категории должно быть больше 3х символов',
            'uri_category.required' => 'Это обязательное поле.',
            'uri_category.min' => 'URI должно быть больше 3х символов',
            'uri_category.regex' => 'Только латынские буквы в нижнем регистре, цифры, тире - и нижнее подчеркивание _',
            'uri_category.unique' => 'URI категории с таким названием уже существует.',
        ];
    }
}
