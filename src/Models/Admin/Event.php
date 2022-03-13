<?php

namespace Adminetic\Website\Models\Admin;

use drh2so4\Thumbnail\Traits\Thumbnail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Event extends Model
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
        Cache::has('events') ? Cache::forget('events') : '';
    }

    // Logs
    protected static $logName = 'event';

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults();
    }

    // Casts
    protected $casts = [
        'meta_keywords' => 'array',
    ];

    // Appends
    protected $appends = ['network_image'];

    // Accessors
    public function getNetworkImageAttribute()
    {
        return isset($this->image) ? url('storage/'.$this->image) : null;
    }

    // Relation
    public function gallery()
    {
        return $this->belongsTo(Gallery::class, 'gallery_id');
    }
}
