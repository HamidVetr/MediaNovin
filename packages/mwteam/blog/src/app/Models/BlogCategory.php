<?php

namespace Mwteam\Blog\App\Models;

use Illuminate\Database\Eloquent\Model;

class BlogCategory extends Model
{
    protected $fillable = [
        'parent_id',
        'name',
        'language',
    ];

    public function articles()
    {
        return $this->hasMany(BlogArticle::class, 'blog_category_id');
    }
}
