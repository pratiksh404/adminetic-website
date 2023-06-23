<?php

namespace Adminetic\Website\Models\Admin;

use Spatie\MediaLibrary\HasMedia;
use Spatie\Activitylog\LogOptions;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\MediaLibrary\InteractsWithMedia;

class Testimonial extends Model implements HasMedia
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
        Cache::has('testimonials') ? Cache::forget('testimonials') : '';
    }

    // Logs
    protected static $logName = 'testimonial';

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults();
    }

    // Scope
    public function scopeApproved($qry)
    {
        return $qry->where('approved', 1);
    }
}
