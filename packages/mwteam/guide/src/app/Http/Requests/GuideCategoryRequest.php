<?php

namespace Mwteam\Guide\App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Mwteam\Guide\App\Models\GuideCategory;

class GuideCategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $parents = [-1 => 0] + GuideCategory::whereNull('parent_id')->pluck('id')->all();
        $rules = [
            'name' => 'required|between:5,190|unique:blog_categories,name',
            'language' => 'required|in:fa,en,ar',
            'parent_id' => [
                'nullable',
                Rule::in($parents),
            ],
        ];

        if (isset($this->guideCategory)){
            $rules['name'] = 'required|between:5,190|unique:guide_categories,name,' . $this->guideCategory->id;
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'name.required' => 'وارد کردن نام دسته بندی اجباری است.',
            'name.between' => 'طول نام دسته بندی باید بین 5 تا 190 کاراکتر باشد.',
            'name.unique' => 'دسته بندی وارد شده تکراری می باشد.',
            'language.required' => 'انتخاب زبان دسته بندی اجباری است.',
            'language.in' => 'زبان انتخابی مجاز نمی باشد.',
            'parent_id.in' => 'دسته بندی انتخابی مجاز نمی باشد.',
        ];
    }
}
