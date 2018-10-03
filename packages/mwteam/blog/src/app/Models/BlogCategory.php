<?php

namespace Mwteam\Blog\App\Models;

use Illuminate\Database\Eloquent\Model;

class BlogCategory extends Model
{
    protected $fillable = [
        'fa_name',
        'en_name',
    ];

    public function articles()
    {
        return $this->hasMany(BlogArticle::class, 'blog_category_id');
    }
}
