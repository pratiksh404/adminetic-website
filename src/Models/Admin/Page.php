<?php

namespace Adminetic\Website\Models\Admin;

use Spatie\Activitylog\LogOptions;
use Illuminate\Support\Facades\Cache;
use drh2so4\Thumbnail\Traits\Thumbnail;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Page extends Model
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

        Page::creating(function ($model) {
            $model->position = Page::max('position') + 1;
        });
    }

    // Cache Keys
    private static function cacheKey()
    {
        Cache::has('pages') ? Cache::forget('pages') : '';
    }

    // Logs
    protected static $logName = 'page';

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults();
    }

    // Casts
    protected $casts = [
        'meta_keywords' => 'array',
    ];

    // Appends
    protected $appends = ['video_embed', 'network_image'];

    //Accessors
    public function getVideoEmbedAttribute()
    {
        return isset($this->video) ? preg_replace(
            "/\s*[a-zA-Z\/\/:\.]*youtu(be.com\/watch\?v=|.be\/)([a-zA-Z0-9\-_]+)([a-zA-Z0-9\/\*\-\_\?\&\;\%\=\.]*)/i",
            '<iframe src="//www.youtube.com/embed/$2" allowfullscreen></iframe>',
            $this->video
        ) : null;
    }

    public function getNetworkImageAttribute()
    {
        return isset($this->image) ? url('storage/'.$this->image) : null;
    }

    // Accessors
    public function getTypeAttribute($attribute)
    {
        return [
            1 => 'Event',
            2 => 'Case Study',
            3 => 'Vacancy Announcement',
            4 => 'Custom Page',
        ][$attribute];
    }
}
