<?php

namespace Mwteam\Blog\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Morilog\Jalali\Jalalian;

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
        'admin_reply',
    ];

    public function article()
    {
        return $this->belongsTo(BlogArticle::class, 'blog_article_id');
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
