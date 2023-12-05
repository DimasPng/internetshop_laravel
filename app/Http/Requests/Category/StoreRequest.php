<?php

namespace App\Http\Requests\Category;

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
    public function rules($id = null): array
    {
        return [
            'name'=>'required|unique:categories,name|min:3' . $id,
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Пожалуйста, введите название категории.',
            'name.unique' => 'Категория с таким названием уже существует.',
            'name.min' => 'Название категории должно быть больше 3х симоволов'
        ];
    }
}
