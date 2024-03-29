<?php

namespace Adminetic\Website\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Gallery extends Model implements HasMedia
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
        Cache::has('galleries') ? Cache::forget('galleries') : '';
        Cache::has('slider') ? Cache::forget('slider') : '';
    }

    // Logs
    protected static $logName = 'gallery';

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults();
    }

    protected $casts = [
        'videos' => 'array',
    ];

    public function __construct(array $attributes = [])
    {
        $this->table = config('website.table_prefix', 'website').'_galleries';

        parent::__construct($attributes);
    }

    // Accessors
    public function getImagesAttribute()
    {
        return ! is_null($this->getMedia('images')) ? $this->getMedia('images') : null;
    }
}
