<?php

namespace Adminetic\Website\Models\Admin;

use Adminetic\Category\Models\Admin\Category;
use Adminetic\Website\Traits\HasSlug;
use drh2so4\Thumbnail\Traits\Thumbnail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Spatie\Activitylog\Traits\LogsActivity;

class Facility extends Model
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

        Facility::creating(function ($model) {
            $model->position = Facility::max('position') + 1;
        });
    }

    // Cache Keys
    private static function cacheKey()
    {
        Cache::has('facilities') ? Cache::forget('facilities') : '';
    }

    // Logs
    protected static $logName = 'facility';

    // Casts
    protected $casts = [
        'meta_keywords' => 'array',
    ];

    // Relation
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
