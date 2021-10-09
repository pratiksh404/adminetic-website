<?php

namespace Adminetic\Website\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Spatie\Activitylog\Traits\LogsActivity;

class Gallery extends Model
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
    }

    // Cache Keys
    private static function cacheKey()
    {
        Cache::has('galleries') ? Cache::forget('galleries') : '';
    }

    // Logs
    protected static $logName = 'gallery';

    protected $casts = [
        'url' => 'array',
    ];

    // Accessors
    public function getTypeAttribute($attribute)
    {
        return [
            1 => 'Image',
            2 => 'Video',
        ][$attribute];
    }

    // Scopes
    public function scopeImageGallery($query)
    {
        return $query->where('type', 1);
    }

    public function scopeVideoGallery($query)
    {
        return $query->where('type', 2);
    }

    // Relations
    public function images()
    {
        return $this->hasMany(Image::class);
    }
}
