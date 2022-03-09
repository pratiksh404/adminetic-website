<?php

namespace Adminetic\Website\Models\Admin;

use drh2so4\Thumbnail\Traits\Thumbnail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Spatie\Activitylog\Traits\LogsActivity;

class Video extends Model
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

        Video::creating(function ($model) {
            $model->position = Video::max('position') + 1;
        });
    }

    // Cache Keys
    private static function cacheKey()
    {
        Cache::has('videos') ? Cache::forget('videos') : '';
    }

    // Appends
    protected $appends = ['video_html', 'network_thumbnail'];

    // Logs
    protected static $logName = 'video';

    public function getVideoHtmlAttribute()
    {
        if (isset($this->url)) {
            return preg_replace("/\s*[a-zA-Z\/\/:\.]*youtube.com\/watch\?v=([a-zA-Z0-9\-_]+)([a-zA-Z0-9\/\*\-\_\?\&\;\%\=\.]*)/i", '<iframe width="420" height="315" src="//www.youtube.com/embed/$1" frameborder="0" allowfullscreen></iframe>', $this->url);
        }
    }
    public function getNetworkThumbnailAttribute()
    {
        return isset($this->thumbnail) ? url('storage/' . $this->thumbnail) : null;
    }
}
