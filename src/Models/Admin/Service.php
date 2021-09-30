<?php

namespace Adminetic\Website\Models\Admin;

use Adminetic\Website\Traits\HasSlug;
use Adminetic\Category\Traits\HasCategory;
use Illuminate\Support\Facades\Cache;
use drh2so4\Thumbnail\Traits\Thumbnail;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Service extends Model
{
    use LogsActivity, HasSlug, Thumbnail, HasCategory;

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

        Service::creating(function ($model) {
            $model->position = Service::max('position') + 1;
        });
    }

    // Cache Keys
    private static function cacheKey()
    {
        Cache::has('services') ? Cache::forget('services') : '';
    }

    // Logs
    protected static $logName = 'service';

    // Casts
    protected $casts = [
        'meta_keywords' => 'array'
    ];
}
