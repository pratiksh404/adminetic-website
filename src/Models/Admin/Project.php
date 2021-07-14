<?php

namespace App\Models\Admin;

use App\Traits\HasSlug;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Project extends Model
{
    use LogsActivity, HasSlug;

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
        Cache::has('projects') ? Cache::forget('projects') : '';
    }

    // Logs
    protected static $logName = 'project';
}
