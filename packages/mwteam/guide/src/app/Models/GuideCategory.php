<?php

namespace Mwteam\Guide\App\Models;

use Illuminate\Database\Eloquent\Model;
use Morilog\Jalali\Jalalian;

class GuideCategory extends Model
{
    protected $fillable = [
        'parent_id',
        'name',
        'language',
    ];

    public function guides()
    {
        return $this->hasMany(Guide::class, 'guide_category_id');
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
        return $this->hasMany(GuideCategory::class, 'parent_id');
    }
}
