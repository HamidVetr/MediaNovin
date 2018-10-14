<?php

namespace Mwteam\Guide\App\Http\Controllers;

use App\Http\Controllers\Controller;
use DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Mwteam\Guide\App\Http\Requests\GuideCategoryRequest;
use Mwteam\Guide\App\Models\GuideCategory;
use Illuminate\Http\Request;

class GuideCategoryController extends Controller
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
        $this->authorize('index', GuideCategory::class);

        $search = $this->search($_GET);
        if ($search){
            $categories = $search;
        }else{
            $categories = GuideCategory::with('guides')->orderBy('updated_at', 'DESC')->paginate(10);
        }

        return view('Guide::dashboard.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function create()
    {
        $this->authorize('create', GuideCategory::class);

        $parents = GuideCategory::whereNull('parent_id')->pluck('name', 'id')->all();

        return view('Guide::dashboard.categories.create', compact('parents'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param GuideCategoryRequest $request
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function store(GuideCategoryRequest $request)
    {
        $this->authorize('create', GuideCategory::class);
        $input = $request->all();

        $uniqueness = $this->isUniqueCategoryBasedOnLanguage($input['parent_id'], $input['language']);
        $input['parent_id'] = $uniqueness['parent'];
        $uniqueCategory = $uniqueness['unique'];

        if (!$uniqueCategory){
            Session::flash('danger', 'دسته بندی انتخابی با این زبان وجود دارد.');
            return redirect()->back()->withInput($request->all());
        }else{
            $category = GuideCategory::create([
                'parent_id' => $input['parent_id'],
                'name' => $input['name'],
                'language' => $input['language'],
            ]);

            if ($category){
                Session::flash('success', 'دسته بندی با موفقیت ساخته شد.');
                return redirect(route('dashboard.guide.categories.index'));
            }else{
                Session::flash('danger', 'مشکلی در ساخت دسته بندی رخ داد. لطفاً بعداً تلاش نمایید.');
                return redirect(route('dashboard.guide.categories.index'));
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param GuideCategory $guideCategory
     * @return void
     */
    public function show(GuideCategory $guideCategory)
    {
        dd($guideCategory);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param GuideCategory $guideCategory
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit(GuideCategory $guideCategory)
    {
        $this->authorize('edit', GuideCategory::class);
        $category = $guideCategory;

        $parents = GuideCategory::whereNull('parent_id')->pluck('name', 'id')->all();

        return view('Guide::dashboard.categories.edit', compact('category', 'parents'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param GuideCategoryRequest $request
     * @param GuideCategory $guideCategory
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(GuideCategoryRequest $request, GuideCategory $guideCategory)
    {
        $this->authorize('edit', GuideCategory::class);
        $input = $request->all();

        $uniqueCategory = true;
        if ($input['parent_id'] != $guideCategory->parent_id || $input['language'] != $guideCategory->language) {
            $uniqueness = $this->isUniqueCategoryBasedOnLanguage($input['parent_id'], $input['language']);
            $input['parent_id'] = $uniqueness['parent'];
            $uniqueCategory = $uniqueness['unique'];
        }

        if (!$uniqueCategory){
            Session::flash('danger', 'دسته بندی انتخابی با این زبان وجود دارد.');
            return redirect()->back()->withInput($request->all());
        }else{
            $updateResult = $guideCategory->update([
                'name' => $input['name'],
                'parent_id' => $input['parent_id'],
                'language' => $input['language'],
            ]);

            if ($updateResult){
                Session::flash('success', 'دسته بندی با موفقیت ویرایش شد.');
                return redirect(route('dashboard.guide.categories.index'));
            }else{
                Session::flash('danger', 'مشکلی در ویرایش دسته بندی رخ داد. لطفاً بعداً تلاش نمایید.');
                return redirect(route('dashboard.guide.categories.index'));
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param GuideCategory $guideCategory
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     * @throws \Throwable
     */
    public function destroy(GuideCategory $guideCategory)
    {
        $this->authorize('delete', GuideCategory::class);

        try {
            DB::transaction(function () use ($guideCategory) {
                $guideCategory->guides()->update(['guide_category_id' => 0]);
            }, 3);

            $guideCategory->children->isEmpty() ?: $guideCategory->children()->delete();
            $guideCategory->delete();

            Session::flash('success', "دسته بندی '{$guideCategory->name}' با موفقیت حذف شد.");
        }catch (\Exception $exception){
            Log::debug("Error when deleting articles" . PHP_EOL . $exception->getMessage());
            Session::flash('danger', 'حذف دسته بندی با مشکل مواجه شد. لطفاً بعداً تلاش نمایید.');
        }

        return redirect(route('dashboard.guide.categories.index'));
    }

    private function search($data)
    {
        if (isset($data['name'])) {
            if (isset($data['name']) && $data['name'] != '') {
                $name = $data['name'];
            }

            $categories = GuideCategory::with('guides');

            if (isset($name)){
                $categories->where('name', 'like', "%{$name}%");
            }

            return $categories->orderBy('updated_at', 'DESC')->paginate(10);
        }else{
            return false;
        }
    }

    private function isUniqueCategoryBasedOnLanguage($parent, $language)
    {
        $unique = true;
        if ($parent > 0) {
            $parentCategory = GuideCategory::with('children')->findOrFail($parent);

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
