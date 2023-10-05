<?php

namespace Adminetic\Website\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class History extends Model implements HasMedia
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
        Cache::has('histories') ? Cache::forget('histories') : '';
    }

    // Logs
    protected static $logName = 'history';

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults();
    }

    public function __construct(array $attributes = [])
    {
        $this->table = config('website.table_prefix', 'website') . '_histories';

        parent::__construct($attributes);
    }


    // Accessors
    public function getImageAttribute()
    {
        return !is_null($this->getFirstMedia('image')) ? $this->getFirstMediaUrl('image') : asset('adminetic/static/placeholder.jpg');
    }

    public function scopeActive($qry)
    {
        return $qry->where('active', 1);
    }
}
