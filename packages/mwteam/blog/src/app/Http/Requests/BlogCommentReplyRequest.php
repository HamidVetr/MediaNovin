<?php

namespace Mwteam\Blog\App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BlogCommentReplyRequest extends FormRequest
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
            'admin-name' => 'required',
            'admin-email' => 'nullable|required_without:mobile|email',
            'admin-mobile' => 'nullable|digits_between:8,20',
            'admin-body' => 'required|min:20',
        ];
    }

    public function messages()
    {
        return [
            'admin-name.required' => 'وارد کردن نام نظر دهنده اجباری است.',
            'admin-email.required_without' => 'یا ایمیل یا موبایل باید وارد شود.',
            'admin-email.email' => 'ایمیل وارد شده معتبر نمی باشد.',
            'admin-mobile.digits_between' => 'شماره موبایل باید بین 8 تا 20 شماره باشد.',
            'admin-body.required' => 'وارد کردن متن پیام اجباری است.',
            'admin-body.min' => 'متن پیام باید حداقل 20 کاراکتر باشد.',
        ];
    }
}
