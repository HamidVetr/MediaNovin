<?php

namespace Mwteam\Blog\App\Models;

use Illuminate\Database\Eloquent\Model;

class BlogComment extends Model
{
    protected $fillable = [
        'blog_article_id',
        'parent_id',
        'name',
        'email',
        'mobile',
        'body',
    ];

    public function article()
    {
        return $this->belongsTo(BlogArticle::class, 'blog_article_id');
    }
}
