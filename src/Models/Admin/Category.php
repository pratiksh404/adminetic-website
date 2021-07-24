<?php

namespace Adminetic\Website\Models\Admin;

use Adminetic\Website\Traits\HasSlug;
use Illuminate\Support\Facades\Cache;
use drh2so4\Thumbnail\Traits\Thumbnail;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Category extends Model
{
    use LogsActivity, HasSlug, Thumbnail;

    protected $guarded = [];

    // Forget cache on updating or saving and deleting
    public static function boot()
    {
        parent::boot();

        static::saving(function () {
            self::cacheKey();
        });

        static::deleting(function () {
            self::cacheKey();
        });

        Category::creating(function ($model) {
            $model->position = Category::max('position') + 1;
        });
    }

    // Cache Keys
    private static function cacheKey()
    {
        Cache::has('categories') ? Cache::forget('categories') : '';
    }

    // Logs
    protected static $logName = 'category';

    protected $parentColumn = 'parent_id';

    public function parent()
    {
        return $this->belongsTo(Category::class, $this->parentColumn);
    }

    public function children()
    {
        return $this->hasMany(Category::class, $this->parentColumn);
    }

    public function allchildren()
    {
        return $this->children()->with('allchildren');
    }
}
