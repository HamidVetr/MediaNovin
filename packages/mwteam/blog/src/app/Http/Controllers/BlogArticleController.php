<?php

namespace Mwteam\Blog\App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Morilog\Jalali\CalendarUtils;
use Mwteam\Blog\App\Http\Requests\BlogArticleStoreRequest;
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
            $articles = BlogArticle::with(['author', 'editor'])->latest()->paginate(10);
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
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function store(BlogArticleStoreRequest $request)
    {
        $this->authorize('create', BlogArticle::class);
        $input = $request->all();
        $hasChildWithTheSameLanguage = false;

        if ($input['parent'] > 0) {
            $parentArticle = BlogArticle::with('children')->findOrFail($input['parent']);
            if ($input['language'] == $parentArticle->language) {
                $hasChildWithTheSameLanguage = true;
            } else {
                foreach ($parentArticle->children as $child) {
                    if ($input['language'] == $child->language) {
                        $hasChildWithTheSameLanguage = true;
                        break;
                    }
                }
            }
        }else{
            $input['parent'] = null;
        }

        if (!$hasChildWithTheSameLanguage){
            if($indexImage = $request->file('index_image')){
                $name = time() . $indexImage->getClientOriginalName();
                $indexImage->move('blogArticleIndexImages', $name);
                $input['image'] = $name;
            }

            $article = BlogArticle::create([
                'blog_category_id' => $input['category'] < 0 ? null : $input['category'],
                'author_id' => auth()->user()->getAuthIdentifier(),
                'parent_id' => $input['parent'],
                'language' => $input['language'],
                'image' => $input['image'],
                'title' => $input['title'],
                'slug' => str_replace(' ', '-', trim($input['title'], ' /\\')),
                'description' => $input['description'],
                'body' => $input['body'],
            ]);

            if ($article){
                $article->tags()->attach($input['tags']);
                Session::flash('success', 'مقاله با موفقیت ساخته شد.');
                return redirect(route('dashboard.blog.articles.index'));
            }else{
                Session::flash('danger', 'مشکلی در ساخت مقاله رخ داد. لطفاً بعداً تلاش نمایید.');
                return redirect(route('dashboard.blog.articles.index'));
            }
        }else{
            Session::flash('danger', 'مقاله انتخابی با این زبان وجود دارد.');
            return redirect()->back()->withInput($request->all());
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param BlogArticle $article
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit(BlogArticle $blogArticle)
    {
        dd($blogArticle);
        $this->authorize('edit', BlogArticle::class);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param BlogArticle $article
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(Request $request, BlogArticle $blogArticle)
    {
        $this->authorize('edit', BlogArticle::class);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param BlogArticle $article
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy(BlogArticle $blogArticle)
    {
        $this->authorize('delete', BlogArticle::class);
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
                $articles->where('fa_title', 'like', "%{$title}%");
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

            return $articles->latest()->paginate(10);
        }else{
            return false;
        }
    }
}
