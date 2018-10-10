<?php

namespace Mwteam\Blog\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BlogComment extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'blog_article_id',
        'parent_id',
        'name',
        'email',
        'mobile',
        'body',
        'approved',
    ];

    public function article()
    {
        return $this->belongsTo(BlogArticle::class, 'blog_article_id');
    }
}
