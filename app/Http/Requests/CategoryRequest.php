<?php

namespace App\Http\Requests;

use CodeZero\UniqueTranslation\UniqueTranslationRule;
use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
            'name.*' => ['required', 'string', 'max:100', UniqueTranslationRule::for('categories')->ignore($this->id)],
            'status' => ['required', 'in:1,0'],
            'parent' => [
                'nullable',
                'exists:categories,id',
                function ($attribute, $value, $fail) {
                    if ($this->id && $value == $this->id) {
                        $fail(__('dashboard.parent_cannot_be_same_as_category'));
                    }
                },
            ],
        ];
    }
}
