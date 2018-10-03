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
        return $this->hasMany(BlogArticle::class, 'blog_tag_id');
    }
}
