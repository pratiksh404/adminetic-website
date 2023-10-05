<?php

namespace Adminetic\Website\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\MediaLibrary\HasMedia;
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

    public function __construct(array $attributes = [])
    {
        $this->table = config('website.table_prefix', 'website') . '_counters';

        parent::__construct($attributes);
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
