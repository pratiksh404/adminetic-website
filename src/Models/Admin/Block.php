<?php

namespace Adminetic\Website\Models\Admin;

use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Block extends Model
{
    use LogsActivity;

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

        Block::creating(function ($model) {
            $model->position = Block::max('position') + 1;
        });
    }

    // Cache Keys
    private static function cacheKey()
    {
        Cache::has('blocks') ? Cache::forget('blocks') : '';
    }

    // Logs
    protected static $logName = 'block';
}
