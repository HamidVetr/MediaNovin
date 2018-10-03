<?php

namespace Mwteam\Blog\App\Models;

use Illuminate\Database\Eloquent\Model;

class BlogTag extends Model
{
    protected $fillable = [
        'fa_name',
        'en_name',
    ];

    public function articles()
    {
        return $this->belongsToMany(BlogArticle::class, 'blog_article_blog_tag', 'blog_tag_id', 'blog_article_id');
    }
}
