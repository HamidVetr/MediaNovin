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
        if ($this->search($_GET)){
            return $this->search($_GET);
        }else{
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
                $userIDs = User::adminOrSuperAdmin()->whereRaw("CONCAT_WS (' ', first_name, last_name) like '%{$data['user']}%'")->select('id')->get();
                return $userIDs;
            }

            if ($data['title'] != '') {
                $title = $data['title'];
            }


            $articles = BlogArticle::with(['author', 'editor'])->whereBetween('created_at', [$fromDate, $toDate])->paginate(10);
        }else{
            return false;
        }
    }
}
