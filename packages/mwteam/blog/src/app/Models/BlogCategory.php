<?php

namespace Mwteam\Blog\App\Models;

use Illuminate\Database\Eloquent\Model;
use Morilog\Jalali\Jalalian;

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

    public function jalalianCreatedAt()
    {
        return Jalalian::forge($this->created_at)->format('%d %B %y ساعت H:i');
    }

    public function jalalianUpdatedAt()
    {
        return Jalalian::forge($this->updated_at)->format('%d %B %y ساعت H:i');
    }

    public function children()
    {
        return $this->hasMany(BlogCategory::class, 'parent_id');
    }
}
