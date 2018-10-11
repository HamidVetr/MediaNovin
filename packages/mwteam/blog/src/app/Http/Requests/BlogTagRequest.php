<?php

namespace Mwteam\Blog\App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Mwteam\Blog\App\Models\BlogTag;

class BlogTagRequest extends FormRequest
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
        $parents = [-1 => 0] + BlogTag::whereNull('parent_id')->pluck('id')->all();

        $rules = [
            'name' => 'required|between:5,190|unique:blog_tags,name',
            'language' => 'required|in:fa,en,ar',
            'parent_id' => [
                'nullable',
                Rule::in($parents),
            ],
        ];

        if (isset($this->blogTag)){
            $rules['name'] = 'required|between:5,190|unique:blog_tags,name,' . $this->blogTag->id;
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'name.required' => 'وارد کردن نام برچسب اجباری است.',
            'name.between' => 'طول نام برچسب باید بین 5 تا 190 کاراکتر باشد.',
            'name.unique' => 'برچسب وارد شده تکراری می باشد.',
            'language.required' => 'انتخاب زبان برچسب اجباری است.',
            'language.in' => 'زبان انتخابی مجاز نمی باشد.',
            'parent_id.in' => 'برچسب انتخابی مجاز نمی باشد.',
        ];
    }
}
