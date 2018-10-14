<?php

namespace Mwteam\Guide\App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Morilog\Jalali\Jalalian;

class Guide extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'guide_category_id',
        'author_id',
        'editor_id',
        'parent_id',
        'language',
        'title',
        'body',
    ];

    public function category()
    {
        return $this->belongsTo(GuideCategory::class, 'guide_category_id');
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

    public function children()
    {
        return $this->hasMany(Guide::class, 'parent_id');
    }
}
