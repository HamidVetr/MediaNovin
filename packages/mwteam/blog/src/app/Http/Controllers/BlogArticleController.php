<?php

namespace Mwteam\Blog\App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Morilog\Jalali\CalendarUtils;
use Mwteam\Blog\App\Models\BlogArticle;

class BlogArticleController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
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

        if (isset($_GET['title']) || isset($_GET['user']) || isset($_GET['formDate']) || isset($_GET['toDate'])){
            if (isset($_GET['fromDate'])) {
                dd(CalendarUtils::isValidateJalaliDate(...explode('/', $_GET['fromDate'])));
                $fromDate = implode('-', CalendarUtils::toGregorian(...explode('/', $_GET['fromDate']))) . ' 00:00:00';
            }

            if (isset($_GET['toDate'])) {
                $toDate = implode('-', CalendarUtils::toGregorian(...explode('/', $_GET['toDate']))) . ' 23:59:59';
            }

            if (isset($_GET['user'])){
                $user_ids = User::whereRaw("CONCAT_WS (' ', first_name, last_name) like '%{$_GET['user']}%'")->select('id')->get();
                dd($user_ids);
            }

        }else {
            $articles = BlogArticle::with(['author', 'editor'])->paginate(10);
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
        return view('Blog::dashboard.articles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
     */
    public function edit(BlogArticle $blogArticle)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param BlogArticle $article
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BlogArticle $blogArticle)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param BlogArticle $article
     * @return \Illuminate\Http\Response
     */
    public function destroy(BlogArticle $blogArticle)
    {
        //
    }
}
