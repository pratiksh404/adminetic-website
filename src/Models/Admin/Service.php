<?php

namespace Adminetic\Website\Models\Admin;

use Adminetic\Website\Models\Admin\Inquiry;
use Spatie\MediaLibrary\HasMedia;
use Spatie\Activitylog\LogOptions;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
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
        'data' => 'array'
    ];

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
}
