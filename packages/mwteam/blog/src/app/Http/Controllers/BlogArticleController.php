<?php

namespace Mwteam\Blog\App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Morilog\Jalali\CalendarUtils;
use Mwteam\Blog\App\Http\Requests\BlogArticleRequest;
use Mwteam\Blog\App\Models\BlogArticle;
use Mwteam\Blog\App\Models\BlogCategory;
use Mwteam\Blog\App\Models\BlogTag;
use Validator;

class BlogArticleController extends Controller
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
        $this->authorize('index', BlogArticle::class);

        $search = $this->search($_GET);
        if ($search){
            $articles = $search;
        }else{
            $articles = BlogArticle::with(['author', 'editor'])->orderBy('updated_at', 'DESC')->paginate(10);
        }

        return view('Blog::dashboard.articles.index', compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function create()
    {
        $this->authorize('create', BlogArticle::class);

        $categories = BlogCategory::where('language', config('app.locale'))->pluck('name', 'id')->all();

        $tags = BlogTag::where('language', config('app.locale'))->pluck('name', 'id')->all();

        $parents = BlogArticle::whereNull('parent_id')->pluck('title', 'id')->all();

        return view('Blog::dashboard.articles.create', compact('categories', 'tags', 'parents'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param BlogArticleRequest $request
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function store(BlogArticleRequest $request)
    {
        $this->authorize('create', BlogArticle::class);
        $input = $request->all();

        $uniqueness = $this->isUniqueArticleBasedOnLanguage($input['parent_id'], $input['language']);
        $input['parent_id'] = $uniqueness['parent'];
        $uniqueArticle = $uniqueness['unique'];

        if (!$uniqueArticle){
            Session::flash('danger', 'مقاله انتخابی با این زبان وجود دارد.');
            return redirect()->back()->withInput($request->all());
        }else{
            if($indexImage = $request->file('index_image')){
                $name = time() . $indexImage->getClientOriginalName();
                $indexImage->move('blogArticleIndexImages', $name);
                $input['image'] = $name;
            }else{
                $input['image'] = null;
            }

            $article = BlogArticle::create([
                'blog_category_id' => $input['blog_category_id'] < 0 ? null : $input['blog_category_id'],
                'author_id' => auth()->user()->getAuthIdentifier(),
                'parent_id' => $input['parent_id'],
                'language' => $input['language'],
                'image' => $input['image'],
                'title' => $input['title'],
                'slug' => str_replace(' ', '-', trim($input['title'], ' /\\')),
                'description' => $input['description'],
                'body' => $input['body'],
            ]);

            if ($article){
                !isset($input['tags']) ?: $article->tags()->attach($input['tags']);
                Session::flash('success', 'مقاله با موفقیت ساخته شد.');
                return redirect(route('dashboard.blog.articles.index'));
            }else{
                Session::flash('danger', 'مشکلی در ساخت مقاله رخ داد. لطفاً بعداً تلاش نمایید.');
                return redirect(route('dashboard.blog.articles.index'));
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param BlogArticle $article
     * @return \Illuminate\Http\Response
     */
    public function show(BlogArticle $blogArticle)
    {
        dd($blogArticle);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param BlogArticle $blogArticle
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit(BlogArticle $blogArticle)
    {
        $this->authorize('edit', BlogArticle::class);

        $article = $blogArticle;

        $categories = BlogCategory::where('language', config('app.locale'))->pluck('name', 'id')->all();

        $tags = BlogTag::where('language', config('app.locale'))->pluck('name', 'id')->all();

        $parents = BlogArticle::whereNull('parent_id')->pluck('title', 'id')->all();

        return view('Blog::dashboard.articles.edit', compact('article', 'categories', 'tags', 'parents'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param BlogArticleRequest $request
     * @param BlogArticle $blogArticle
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(BlogArticleRequest $request, BlogArticle $blogArticle)
    {
        $this->authorize('edit', BlogArticle::class);
        $input = $request->all();

        $uniqueArticle = true;
        if ($input['parent_id'] != $blogArticle->parent_id || $input['language'] != $blogArticle->language) {
            $uniqueness = $this->isUniqueArticleBasedOnLanguage($input['parent_id'], $input['language']);
            $input['parent_id'] = $uniqueness['parent'];
            $uniqueArticle = $uniqueness['unique'];
        }

        if (!$uniqueArticle){
            Session::flash('danger', 'مقاله انتخابی با این زبان وجود دارد.');
            return redirect()->back()->withInput($request->all());
        }else{
            if($indexImage = $request->file('index_image')){
                $currentImagePath = public_path("blogArticleIndexImages/{$blogArticle->image}");
                if(File::exists($currentImagePath)) {
                    File::delete($currentImagePath);
                }
                $name = time() . $indexImage->getClientOriginalName();
                $indexImage->move('blogArticleIndexImages', $name);
                $input['image'] = $name;
            }else{
                $input['image'] = $blogArticle->image;
            }

            $updateResult = $blogArticle->update([
                'blog_category_id' => $input['blog_category_id'] < 0 ? null : $input['blog_category_id'],
                'editor_id' => auth()->user()->getAuthIdentifier(),
                'parent_id' => $input['parent_id'],
                'language' => $input['language'],
                'image' => $input['image'],
                'title' => $input['title'],
                'slug' => str_replace(' ', '-', trim($input['title'], ' /\\')),
                'description' => $input['description'],
                'body' => $input['body'],
            ]);

            if ($updateResult){
                $blogArticle->tags()->sync($input['tags']);
                Session::flash('success', 'مقاله با موفقیت ویرایش شد.');
                return redirect(route('dashboard.blog.articles.index'));
            }else{
                Session::flash('danger', 'مشکلی در ویرایش مقاله رخ داد. لطفاً بعداً تلاش نمایید.');
                return redirect(route('dashboard.blog.articles.index'));
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param BlogArticle $blogArticle
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     * @throws \Throwable
     */
    public function destroy(BlogArticle $blogArticle)
    {
        $this->authorize('delete', BlogArticle::class);
        try {
            DB::transaction(function () use ($blogArticle) {
                $blogArticle->children->isEmpty() ?: $blogArticle->children()->delete();
                $blogArticle->delete();
            }, 3);
            Session::flash('success', "مقاله '{$blogArticle->title}' با موفقیت حذف شد.");
        }catch (\Exception $exception){
            Log::debug("Error when deleting articles" . PHP_EOL . $exception->getMessage());
            Session::flash('danger', 'حذف مقاله با مشکل مواجه شد. لطفاً بعداً تلاش نمایید.');
        }

        return redirect(route('dashboard.blog.articles.index'));
    }

    public function uploadInline(Request $request)
    {
        $this->validate($request, [
            'upload' => 'required|mimes:jpeg,png,bmp,jpg'
        ]);

        $validator = Validator::make($request->all(), [
            'upload' => 'required|mimes:jpeg,png,bmp,jpg'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'uploaded' => false,
                'message' => 'فایل انتخابی مجاز نمی باشد.'
            ]);
        }

        $name = '';

        if($file = $request->file('upload')){
            $name = time() . $file->getClientOriginalName();
            $file->move('inlinePhotos', $name);
        }

        $url = env('APP_URL') . '/inlinePhotos/' . $name;

        return response()->json([
            'uploaded' => true,
            'url' => $url
        ]);
    }

    private function search($data)
    {
        if (isset($data['title']) || isset($data['user']) || isset($data['formDate']) || isset($data['toDate'])) {
            if ($data['fromDate'] != '') {
                if (CalendarUtils::isValidateJalaliDate(...explode('/', $data['fromDate']))) {
                    $fromDate = implode('-', CalendarUtils::toGregorian(...explode('/', $data['fromDate']))) . ' 00:00:00';
                }
            }

            if ($data['toDate'] != '') {
                if (CalendarUtils::isValidateJalaliDate(...explode('/', $data['toDate']))) {
                    $toDate = implode('-', CalendarUtils::toGregorian(...explode('/', $data['toDate']))) . ' 23:59:59';
                }
            }

            if ($data['user'] != '') {
                $userIDs = User::adminOrSuperAdmin()->whereRaw("CONCAT_WS (' ', first_name, last_name) like '%{$data['user']}%'")->select('id')->get()->toArray();

                $users = array_map(function($userID){
                    return $userID['id'];
                }, $userIDs);
            }

            if ($data['title'] != '') {
                $title = $data['title'];
            }

            $articles = BlogArticle::with(['author', 'editor']);

            if (isset($title)){
                $articles->where('title', 'like', "%{$title}%");
            }

            if (isset($fromDate) && isset($toDate)) {
                $articles->whereBetween('created_at', [$fromDate, $toDate]);
            }elseif (isset($fromDate)){
                $articles->where('created_at', '>=', $fromDate);
            }elseif (isset($toDate)){
                $articles->where('created_at', '<=', $toDate);
            }

            if (isset($users)) {
                $articles->whereIn('author_id', $users);
            }

            return $articles->orderBy('updated_at', 'DESC')->paginate(10);
        }else{
            return false;
        }
    }

    private function isUniqueArticleBasedOnLanguage($parent, $language)
    {
        $unique = true;
        if ($parent > 0) {
            $parentArticle = BlogArticle::with('children')->findOrFail($parent);

            if ($language == $parentArticle->language) {
                $unique = false;
            } else {
                foreach ($parentArticle->children as $child) {
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
