<?php

namespace Mwteam\Blog\App\Http\Controllers;

use App\Http\Controllers\Controller;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Mwteam\Blog\App\Http\Requests\BlogTagRequest;
use Mwteam\Blog\App\Models\BlogTag;

class BlogTagController extends Controller
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
        $this->authorize('index', BlogTag::class);

        $search = $this->search($_GET);
        if ($search){
            $tags = $search;
        }else{
            $tags = BlogTag::with('articles')->orderBy('updated_at', 'DESC')->paginate(10);
        }

        return view('Blog::dashboard.tags.index', compact('tags'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function create()
    {
        $this->authorize('create', BlogTag::class);

        $parents = BlogTag::whereNull('parent_id')->pluck('name', 'id')->all();

        return view('Blog::dashboard.tags.create', compact('parents'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param BlogTagRequest $request
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function store(BlogTagRequest $request)
    {
        $this->authorize('create', BlogTag::class);
        $input = $request->all();

        $uniqueness = $this->isUniqueTagBasedOnLanguage($input['parent_id'], $input['language']);
        $input['parent_id'] = $uniqueness['parent'];
        $uniqueTag = $uniqueness['unique'];

        if (!$uniqueTag){
            Session::flash('danger', 'برچسب انتخابی با این زبان وجود دارد.');
            return redirect()->back()->withInput($request->all());
        }else{
            $category = BlogTag::create([
                'parent_id' => $input['parent_id'],
                'name' => $input['name'],
                'language' => $input['language'],
            ]);

            if ($category){
                Session::flash('success', 'برچسب با موفقیت ساخته شد.');
                return redirect(route('dashboard.blog.tags.index'));
            }else{
                Session::flash('danger', 'مشکلی در ساخت برچسب رخ داد. لطفاً بعداً تلاش نمایید.');
                return redirect(route('dashboard.blog.tags.index'));
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param BlogTag $blogTag
     * @return \Illuminate\Http\Response
     */
    public function show(BlogTag $blogTag)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param BlogTag $blogTag
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit(BlogTag $blogTag)
    {
        $this->authorize('edit', BlogTag::class);
        $tag = $blogTag;

        $parents = BlogTag::whereNull('parent_id')->pluck('name', 'id')->all();

        return view('Blog::dashboard.tags.edit', compact('tag', 'parents'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param BlogTag $blogTag
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(Request $request, BlogTag $blogTag)
    {
        $this->authorize('edit', BlogTag::class);
        $input = $request->all();

        $uniqueTag = true;
        if ($input['parent_id'] != $blogTag->parent_id || $input['language'] != $blogTag->language) {
            $uniqueness = $this->isUniqueTagBasedOnLanguage($input['parent_id'], $input['language']);
            $input['parent_id'] = $uniqueness['parent'];
            $uniqueTag = $uniqueness['unique'];
        }

        if (!$uniqueTag){
            Session::flash('danger', 'برچسب انتخابی با این زبان وجود دارد.');
            return redirect()->back()->withInput($request->all());
        }else{
            $updateResult = $blogTag->update([
                'name' => $input['name'],
                'parent_id' => $input['parent_id'],
                'language' => $input['language'],
            ]);

            if ($updateResult){
                Session::flash('success', 'برچسب با موفقیت ویرایش شد.');
                return redirect(route('dashboard.blog.tags.index'));
            }else{
                Session::flash('danger', 'مشکلی در ویرایش برچسب رخ داد. لطفاً بعداً تلاش نمایید.');
                return redirect(route('dashboard.blog.tags.index'));
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param BlogTag $blogTag
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     * @throws \Throwable
     */
    public function destroy(BlogTag $blogTag)
    {
        $this->authorize('delete', BlogTag::class);

        try {
            DB::transaction(function () use ($blogTag) {
                $blogTag->articles()->detach();
            }, 3);

            $blogTag->children->isEmpty() ?: $blogTag->children()->delete();
            $blogTag->delete();

            Session::flash('success', "برچسب '{$blogTag->name}' با موفقیت حذف شد.");
        }catch (\Exception $exception){
            Log::debug("Error when deleting articles" . PHP_EOL . $exception->getMessage());
            Session::flash('danger', 'حذف برچسب با مشکل مواجه شد. لطفاً بعداً تلاش نمایید.');
        }

        return redirect(route('dashboard.blog.tags.index'));
    }

    private function search($data)
    {
        if (isset($data['name'])) {
            if (isset($data['name']) && $data['name'] != '') {
                $name = $data['name'];
            }

            $tags = BlogTag::with('articles');

            if (isset($name)){
                $tags->where('name', 'like', "%{$name}%");
            }

            return $tags->orderBy('updated_at', 'DESC')->paginate(10);
        }else{
            return false;
        }
    }

    private function isUniqueTagBasedOnLanguage($parent, $language)
    {
        $unique = true;
        if ($parent > 0) {
            $parentTag = BlogTag::with('children')->findOrFail($parent);

            if ($language == $parentTag->language) {
                $unique = false;
            } else {
                foreach ($parentTag->children as $child) {
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
