<?php

namespace Adminetic\Website\Models\Admin;

use Spatie\Activitylog\LogOptions;
use Illuminate\Support\Facades\Cache;
use drh2so4\Thumbnail\Traits\Thumbnail;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Counter extends Model
{
    use LogsActivity, Thumbnail;

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
        Cache::has('counters') ? Cache::forget('counters') : '';
    }

    // Logs
    protected static $logName = 'counter';

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults();
    }
}
