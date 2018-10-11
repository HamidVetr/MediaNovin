<?php

namespace Mwteam\Blog\App\Http\Controllers;

use App\Http\Controllers\Controller;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Mwteam\Blog\App\Http\Requests\BlogCategoryRequest;
use Mwteam\Blog\App\Models\BlogCategory;

class BlogCategoryController extends Controller
{
    public function __construct()
    {
        //
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function index()
    {
        $this->authorize('index', BlogCategory::class);

        $categories = BlogCategory::with('articles')->latest()->paginate(10);

        return view('Blog::dashboard.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function create()
    {
        $this->authorize('create', BlogCategory::class);

        $parents = BlogCategory::whereNull('parent_id')->pluck('name', 'id')->all();

        return view('Blog::dashboard.categories.create', compact('parents'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param BlogCategoryRequest $request
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function store(BlogCategoryRequest $request)
    {
        $this->authorize('create', BlogCategory::class);
        $input = $request->all();

        $uniqueness = $this->isUniqueCategoryBasedOnLanguage($input['parent_id'], $input['language']);
        $input['parent_id'] = $uniqueness['parent'];
        $uniqueCategory = $uniqueness['unique'];

        if (!$uniqueCategory){
            Session::flash('danger', 'دسته بندی انتخابی با این زبان وجود دارد.');
            return redirect()->back()->withInput($request->all());
        }else{
            $category = BlogCategory::create([
                'parent_id' => $input['parent_id'],
                'name' => $input['name'],
                'language' => $input['language'],
            ]);

            if ($category){
                Session::flash('success', 'دسته بندی با موفقیت ساخته شد.');
                return redirect(route('dashboard.blog.categories.index'));
            }else{
                Session::flash('danger', 'مشکلی در ساخت دسته بندی رخ داد. لطفاً بعداً تلاش نمایید.');
                return redirect(route('dashboard.blog.categories.index'));
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param BlogCategory $blogCategory
     * @return \Illuminate\Http\Response
     */
    public function show(BlogCategory $blogCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param BlogCategory $blogCategory
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit(BlogCategory $blogCategory)
    {
        $category = $blogCategory;
        $this->authorize('edit', BlogCategory::class);

        $parents = BlogCategory::whereNull('parent_id')->pluck('name', 'id')->all();

        return view('Blog::dashboard.categories.edit', compact('category', 'parents'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param BlogCategoryRequest $request
     * @param BlogCategory $blogCategory
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(BlogCategoryRequest $request, BlogCategory $blogCategory)
    {
        $this->authorize('edit', BlogCategory::class);
        $input = $request->all();

        $uniqueCategory = true;
        if ($input['parent_id'] != $blogCategory->parent_id || $input['language'] != $blogCategory->language) {
            $uniqueness = $this->isUniqueCategoryBasedOnLanguage($input['parent_id'], $input['language']);
            $input['parent_id'] = $uniqueness['parent'];
            $uniqueCategory = $uniqueness['unique'];
        }

        if (!$uniqueCategory){
            Session::flash('danger', 'دسته بندی انتخابی با این زبان وجود دارد.');
            return redirect()->back()->withInput($request->all());
        }else{
            $updateResult = $blogCategory->update([
                'name' => $input['name'],
                'parent_id' => $input['parent_id'],
                'language' => $input['language'],
            ]);

            if ($updateResult){
                Session::flash('success', 'دسته بندی با موفقیت ویرایش شد.');
                return redirect(route('dashboard.blog.categories.index'));
            }else{
                Session::flash('danger', 'مشکلی در ویرایش دسته بندی رخ داد. لطفاً بعداً تلاش نمایید.');
                return redirect(route('dashboard.blog.categories.index'));
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param BlogCategory $blogCategory
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     * @throws \Throwable
     */
    public function destroy(BlogCategory $blogCategory)
    {
        $this->authorize('delete', BlogCategory::class);
        try {
            DB::transaction(function () use ($blogCategory) {
                $blogCategory->articles()->update(['blog_category_id' => 0]);
            }, 3);

            $blogCategory->children()->delete();
            $blogCategory->delete();

            Session::flash('success', "دسته بندی '{$blogCategory->name}' با موفقیت حذف شد.");
        }catch (\Exception $exception){
            Log::debug("Error when deleting articles" . PHP_EOL . $exception->getMessage());
            Session::flash('danger', 'حذف دسته بندی با مشکل مواجه شد. لطفاً بعداً تلاش نمایید.');
        }

        return redirect(route('dashboard.blog.categories.index'));
    }

    private function isUniqueCategoryBasedOnLanguage($parent, $language)
    {
        $unique = true;
        if ($parent > 0) {
            $parentCategory = BlogCategory::with('children')->findOrFail($parent);

            if ($language == $parentCategory->language) {
                $unique = false;
            } else {
                foreach ($parentCategory->children as $child) {
                    if ($language == $child->language) {
                        $unique = false;
                        break;
                    }
                }
            }
        }else{
            $parent = null;
        }

        return [
            'parent' => $parent,
            'unique' => $unique,
        ];
    }
}
