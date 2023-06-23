<?php

namespace Adminetic\Website\Models\Admin;

use Adminetic\Website\Models\Admin\Category;
use Spatie\MediaLibrary\HasMedia;
use Spatie\Activitylog\LogOptions;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\MediaLibrary\InteractsWithMedia;

class Popup extends Model implements HasMedia
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
        Cache::has('popups') ? Cache::forget('popups') : '';
    }

    // Logs
    protected static $logName = 'popup';

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults();
    }

    protected $casts = [
        'data' => 'array'
    ];

    // Relationships
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Scopes
    public function scopePosition($qry)
    {
        return $qry->orderBy('position');
    }
    public function scopeActive($qry)
    {
        return $qry->where('active', 1);
    }
    public function scopePopup($qry)
    {
        return $qry->where('popup', 1);
    }
}
