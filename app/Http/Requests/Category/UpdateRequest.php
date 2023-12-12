<?php

namespace App\Http\Requests\Category;

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
        $thisCategory = $this->route('category');

        return [
            'name' => 'required|unique:categories,name,' . $thisCategory->id,
            'uri_category' => [
                'required', 'regex:/^[a-zA-Z0-9-_]/u', 'min:3'
            ],
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
            'uri_category.min' => 'URI должно быть больше 3х символов',
            'uri_category.regex' => 'Только латынские буквы, цифры, тире - и нижнее подчеркивание _',
        ];
    }

}
