<?php

namespace Mwteam\Blog\App\Http\Requests;

use App\Helpers\PackageHelper;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Mwteam\Blog\App\Models\BlogArticle;
use Mwteam\Blog\App\Models\BlogCategory;
use Mwteam\Blog\App\Models\BlogTag;

class BlogArticleStoreRequest extends FormRequest
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
        $this->maxImageSize = PackageHelper::getConfig('blog.validation.image.laravel.max');
        $categories = [-1 => 0] + BlogCategory::where('language', config('app.locale'))->pluck('id')->all();
        $tags = BlogTag::where('language', config('app.locale'))->pluck('id')->all();
        $parents = [-1 => 0] + BlogArticle::whereNull('parent_id')->pluck('id')->all();

        return [
            'category' => [
                'nullable',
                Rule::in($categories),
            ],
            'tags.*' => [
                'nullable',
                Rule::in($tags),
            ],
            'index_image' => 'nullable|image|max:' . $this->maxImageSize,
            'language' => 'required|in:fa,en,ar',
            'parent' => [
                'nullable',
                Rule::in($parents),
            ],
            'title' => 'required|between:5,190',
            'description' => 'nullable|max:190',
            'body' => 'required|min:20',
        ];
    }

    public function messages()
    {
        return [
            'category.in' => 'دسته بندی انتخابی مجاز نمی باشد.',
            'tags.*.in' => 'برچسب انتخابی مجاز نمی باشد.',
            'index_image.image' => 'فایل انتخابی برای تصویر شاخص معتبر نمی باشد.',
            'index_image.max' => "حجم تصویر نمی تواند بیشتر از {$this->maxImageSize} مگابایت باشد.",
            'language.required' => 'انتخاب زبان مقاله اجباری است.',
            'language.in' => 'زبان انتخابی مجاز نمی باشد.',
            'parent.in' => 'مقاله انتخابی مجاز نمی باشد.',
            'title.required' => 'وارد کردن عنوان اجباری می باشد.',
            'title.between' => 'طول عنوان باید بین 5 تا 190 کاراکتر باشد.',
            'description.max' => 'حداکثر طول خلاصه مقاله 190 کاراکتر می باشد.',
            'body.required' => 'وارد کردن عنوان اجباری است.',
            'body.min' => 'متن مقاله باید حداقل 20 کاراکتر باشد.',
        ];
    }
}
