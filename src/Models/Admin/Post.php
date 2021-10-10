<?php

namespace Adminetic\Website\Models\Admin;

use Adminetic\Category\Models\Admin\Category;
use Adminetic\Website\Traits\PostTrait;
use Conner\Tagging\Taggable;
use CyrildeWit\EloquentViewable\Contracts\Viewable;
use CyrildeWit\EloquentViewable\InteractsWithViews;
use drh2so4\Thumbnail\Traits\Thumbnail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Cache;
use Spatie\Activitylog\Traits\LogsActivity;

class Post extends Model implements Viewable
{
    use LogsActivity, PostTrait, Taggable, InteractsWithViews, Thumbnail;

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
        Cache::has('posts') ? Cache::forget('posts') : '';
    }

    // Logs
    protected static $logName = 'post';

    // Casts
    protected $casts = [
        'meta_keywords' => 'array',
    ];

    // Appends
    protected $appends = ['video_html'];

    // Accessors
    public function getStatusAttribute($attribute)
    {
        return $attribute <= 3 ? [
            1 => 'Draft',
            2 => 'Pending',
            3 => 'Published',
        ][$attribute] : 'N/A';
    }

    public function getVideoHtmlAttribute()
    {
        if (isset($this->video)) {
            return preg_replace("/\s*[a-zA-Z\/\/:\.]*youtube.com\/watch\?v=([a-zA-Z0-9\-_]+)([a-zA-Z0-9\/\*\-\_\?\&\;\%\=\.]*)/i", '<iframe width="420" height="315" src="//www.youtube.com/embed/$1" frameborder="0" allowfullscreen></iframe>', $this->video);
        }
    }

    // Relation
    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    // Helper Function
    public function statusColor()
    {
        return $this->getRawOriginal('status') == 1 ? 'danger' : ($this->getRawOriginal('status') == 2 ? 'warning' : 'success');
    }
}
