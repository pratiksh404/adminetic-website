<?php

namespace Adminetic\Website\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Feature extends Model implements HasMedia
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
        Cache::has('features') ? Cache::forget('features') : '';
        Cache::has('home_features') ? Cache::forget('home_features') : '';
    }

    // Logs
    protected static $logName = 'feature';

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults();
    }
    protected $casts = [
        'data' => 'array',
    ];

    public function __construct(array $attributes = [])
    {
        $this->table = config('website.table_prefix', 'website').'_features';

        parent::__construct($attributes);
    }

    // Relationships
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Scopes
    public function scopePosition($qry)
    {
        return $qry->orderBy('position');
    }

    public function scopeActive($qry)
    {
        return $qry->where('active', 1);
    }

    public function scopeFeatured($qry)
    {
        return $qry->where('featured', 1);
    }

    // Scopes
    public function scopeHomeFeatures($query, $limit = 3)
    {
        return $query->orderBy('position')->take($limit ?? 3);
    }

        // Accessors
    public function getImageAttribute()
    {
        return ! is_null($this->getFirstMedia('image')) ? $this->getFirstMediaUrl('image') : asset('adminetic/static/placeholder.jpg');
    }

    public function getIconImageAttribute()
    {
        return ! is_null($this->getFirstMedia('icon_image')) ? $this->getFirstMediaUrl('icon_image') : asset('adminetic/static/placeholder.jpg');
    }
}
