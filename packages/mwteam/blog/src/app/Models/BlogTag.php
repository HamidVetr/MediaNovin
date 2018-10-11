<?php

namespace Mwteam\Blog\App\Models;

use Illuminate\Database\Eloquent\Model;
use Morilog\Jalali\Jalalian;

class BlogTag extends Model
{
    protected $fillable = [
        'parent_id',
        'name',
        'language',
    ];

    public function articles()
    {
        return $this->belongsToMany(BlogArticle::class, 'blog_article_blog_tag', 'blog_tag_id', 'blog_article_id');
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
