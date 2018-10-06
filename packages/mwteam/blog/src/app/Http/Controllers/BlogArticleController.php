<?php

namespace Mwteam\Blog\App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use function foo\func;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Morilog\Jalali\CalendarUtils;
use Mwteam\Blog\App\Models\BlogArticle;

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
                $users = [];
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

            return $articles->paginate(10);
        }else{
            return false;
        }
    }
}
