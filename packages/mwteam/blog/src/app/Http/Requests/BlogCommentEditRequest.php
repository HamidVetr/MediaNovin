<?php

namespace Mwteam\Blog\App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BlogCommentEditRequest extends FormRequest
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
        return [
            'name' => 'required',
            'email' => 'nullable|required_without:mobile|email',
            'mobile' => 'nullable|digits_between:8,20',
            'body' => 'required|min:20',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'وارد کردن نام نظر دهنده اجباری است.',
            'email.required_without' => 'یا ایمیل یا موبایل باید وارد شود.',
            'email.email' => 'ایمیل وارد شده معتبر نمی باشد.',
            'mobile.digits_between' => 'شماره موبایل باید بین 8 تا 20 شماره باشد.',
            'body.required' => 'وارد کردن متن پیام اجباری است.',
            'body.min' => 'متن پیام باید حداقل 20 کاراکتر باشد.',
        ];
    }
}
