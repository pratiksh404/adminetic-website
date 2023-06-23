<?php

namespace Adminetic\Website\Models\Admin;

use Spatie\MediaLibrary\HasMedia;
use Spatie\Activitylog\LogOptions;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\MediaLibrary\InteractsWithMedia;

class Facility extends Model implements HasMedia
{
    use LogsActivity, InteractsWithMedia;

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
    }

    // Cache Keys
    private static function cacheKey()
    {
        Cache::has('facilities') ? Cache::forget('facilities') : '';
    }

    // Logs
    protected static $logName = 'facility';

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults();
    }

    // Relationships
    public function category()
    {
        return $this->belongsTo(Category::class);
    }


    protected $casts = [
        'data' => 'array'
    ];


    // Scopes
    public function scopePosition($qry)
    {
        return $qry->orderBy('position');
    }
    public function scopeActive($qry)
    {
        return $qry->where('active', 1);
    }
    public function scopeFeatured($qry)
    {
        return $qry->where('featured', 1);
    }
}
