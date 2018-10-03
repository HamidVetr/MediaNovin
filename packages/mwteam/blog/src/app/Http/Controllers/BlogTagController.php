<?php

namespace Mwteam\Blog\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Mwteam\Blog\App\Models\BlogTag;

class BlogTagController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('Blog::dashboard.tags.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
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
        //
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param BlogTag $blogTag
     * @return \Illuminate\Http\Response
     */
    public function destroy(BlogTag $blogTag)
    {
        //
    }
}
