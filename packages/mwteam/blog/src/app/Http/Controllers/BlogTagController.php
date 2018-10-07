<?php

namespace Mwteam\Blog\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
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
     */
    public function index()
    {
        $this->authorize('index', BlogTag::class);
        return view('Blog::dashboard.tags.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', BlogTag::class);
        return view('Blog::dashboard.tags.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('create', BlogTag::class);
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
     */
    public function edit(BlogTag $blogTag)
    {
        $this->authorize('edit', BlogTag::class);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param BlogTag $blogTag
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BlogTag $blogTag)
    {
        $this->authorize('edit', BlogTag::class);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param BlogTag $blogTag
     * @return \Illuminate\Http\Response
     */
    public function destroy(BlogTag $blogTag)
    {
        $this->authorize('delete', BlogTag::class);
    }
}
