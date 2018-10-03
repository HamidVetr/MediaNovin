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
        'fa_title',
        'en_title',
        'fa_slug',
        'en_slug',
        'fa_description',
        'en_description',
        'fa_body',
        'en_body',
        'comments',
    ];

    public function comments()
    {
        return $this->hasMany(BlogComment::class, 'blog_article_id');
    }

    public function category()
    {
        return $this->belongsTo(BlogCategory::class, 'blog_category_id');
    }

    public function tags()
    {
        return $this->belongsToMany(BlogTag::class, 'blog_article_blog_tag', 'blog_article_id', 'blog_tag_id');
    }
}
