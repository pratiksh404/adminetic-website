<?php

namespace Adminetic\Website\Models\Admin;

use Spatie\MediaLibrary\HasMedia;
use Spatie\Activitylog\LogOptions;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\MediaLibrary\InteractsWithMedia;

class Counter extends Model implements HasMedia
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
        Cache::has('counters') ? Cache::forget('counters') : '';
    }

    // Logs
    protected static $logName = 'counter';

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults();
    }

    // Accessor
    public function getTypeAttribute($attribute)
    {
        return in_array($attribute ?? null, [1, 2]) ?
            [
                1 => 'Number',
                2 => 'Percentage',
            ][$attribute] : null;
    }
}
