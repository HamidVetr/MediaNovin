<?php

namespace Mwteam\Blog\App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Morilog\Jalali\Jalalian;

class BlogArticle extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'blog_category_id',
        'author_id',
        'editor_id',
        'image',
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

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function editor()
    {
        return $this->belongsTo(User::class, 'editor_id');
    }

    public function jalalianCreatedAt()
    {
        return Jalalian::forge($this->created_at)->format('%d %B %y ساعت H:i');
    }

    public function jalalianUpdatedAt()
    {
        return Jalalian::forge($this->updated_at)->format('%d %B %y ساعت H:i');
    }
}
