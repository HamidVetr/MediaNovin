<?php

namespace Mwteam\Blog\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BlogArticle extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'blog_category_id',
        'author',
        'editor',
        'title',
        'slug',
        'description',
        'body',
        'comments',
    ];

    public function comments()
    {
        return $this->hasMany(BlogComment::class, 'blog_article_id');
    }

    public function category()
    {
        $this->belongsTo(BlogCategory::class, 'blog_category_id');
    }

    public function tags()
    {
        $this->hasMany(BlogTag::class, 'blog_article_id');
    }
}
