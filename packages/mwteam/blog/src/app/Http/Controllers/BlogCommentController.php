<?php

namespace Mwteam\Blog\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Mwteam\Blog\App\Models\BlogComment;

class BlogCommentController extends Controller
{
    public function __construct()
    {
        //
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $comments = BlogComment::with('article')->whereHas('article')->paginate(10);
        $this->authorize('index', BlogComment::class);
        return view('Blog::dashboard.comments.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param BlogComment $blogComment
     * @return \Illuminate\Http\Response
     */
    public function edit(BlogComment $blogComment)
    {
        $this->authorize('edit', BlogComment::class);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param BlogComment $blogComment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BlogComment $blogComment)
    {
        $this->authorize('index', BlogComment::class);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param BlogComment $blogComment
     * @return \Illuminate\Http\Response
     */
    public function destroy(BlogComment $blogComment)
    {
        $this->authorize('delete', BlogComment::class);
    }

    public function reply(BlogComment $blogComment)
    {
        $this->authorize('reply', BlogComment::class);
    }

    public function approve(BlogComment $blogComment)
    {
        $this->authorize('approve', BlogComment::class);
    }
}
