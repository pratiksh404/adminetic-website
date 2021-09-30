<?php

namespace Adminetic\Website\Models\Admin;

use Adminetic\Website\Traits\HasSlug;
use drh2so4\Thumbnail\Traits\Thumbnail;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Team extends Model
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

        Team::creating(function ($model) {
            $model->position = Team::max('position') + 1;
        });
    }

    // Cache Keys
    private static function cacheKey()
    {
        Cache::has('teams') ? Cache::forget('teams') : '';
    }

    // Logs
    protected static $logName = 'team';

    // Casts
    protected $casts = [
        'phone' => 'array'
    ];
}
