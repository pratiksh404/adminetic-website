<?php

namespace Adminetic\Website\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\SchemaOrg\Schema;

class Service extends Model implements HasMedia
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
        Cache::has('services') ? Cache::forget('services') : '';
    }

    // Logs
    protected static $logName = 'service';

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults();
    }

    protected $casts = [
        'data' => 'array',
    ];

    public function __construct(array $attributes = [])
    {
        $this->table = config('website.table_prefix', 'website').'_services';

        parent::__construct($attributes);
    }

    // Relationships
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function inquiries()
    {
        return $this->hasMany(Inquiry::class);
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

    public function searchSchema()
    {
        $schema = Schema::service()
            ->name($this->meta_name ?? $this->name)
            ->description($this->meta_description ?? $this->excerpt)
            ->url(route('website.service', ['service' => $this->slug]))
            ->keywords($this->meta_keywords);

        return $schema->toScript();
    }

    // Accessors
    public function getImageAttribute()
    {
        return ! is_null($this->getFirstMedia('image')) ? $this->getFirstMediaUrl('image') : asset('adminetic/static/blog.gif');
    }

    // Accessors
    public function getIconImageAttribute()
    {
        return ! is_null($this->getFirstMedia('icon_image')) ? $this->getFirstMediaUrl('icon_image') : asset('adminetic/static/blog.gif');
    }
}
