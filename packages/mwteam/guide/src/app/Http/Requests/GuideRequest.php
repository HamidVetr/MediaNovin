<?php

namespace Mwteam\Guide\App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Mwteam\Guide\App\Models\Guide;
use Mwteam\Guide\App\Models\GuideCategory;

class GuideRequest extends FormRequest
{
    protected $maxImageSize;
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
        // [-1 => 0] is for when the user chose no categories
        $categories = [-1 => 0] + GuideCategory::where('language', config('app.locale'))->pluck('id')->all();
        $parents = [-1 => 0] + Guide::whereNull('parent_id')->pluck('id')->all();

        return [
            'guide_category_id' => [
                'nullable',
                Rule::in($categories),
            ],
            'language' => 'required|in:fa,en,ar',
            'parent_id' => [
                'nullable',
                Rule::in($parents),
            ],
            'title' => 'required|between:5,190',
            'body' => 'required|min:20',
        ];
    }

    public function messages()
    {
        return [
            'guide_category_id.in' => 'دسته بندی انتخابی مجاز نمی باشد.',
            'language.required' => 'انتخاب زبان راهنما اجباری است.',
            'language.in' => 'زبان انتخابی مجاز نمی باشد.',
            'parent_id.in' => 'راهنمای انتخابی مجاز نمی باشد.',
            'title.required' => 'وارد کردن عنوان اجباری می باشد.',
            'title.between' => 'طول عنوان باید بین 5 تا 190 کاراکتر باشد.',
            'body.required' => 'وارد کردن عنوان اجباری است.',
            'body.min' => 'متن راهنما باید حداقل 20 کاراکتر باشد.',
        ];
    }
}
