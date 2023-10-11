<?php

namespace Adminetic\Website\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\SchemaOrg\Schema;
use Spatie\SchemaOrg\SoftwareApplication;

class Software extends Model implements HasMedia
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
        Cache::has('software') ? Cache::forget('software') : '';
    }

    // Logs
    protected static $logName = 'software';

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults();
    }

    protected $appends = ['banner'];

    protected $casts = [
        'data' => 'array',
    ];

    public function __construct(array $attributes = [])
    {
        $this->table = config('website.table_prefix', 'website').'_softwares';

        parent::__construct($attributes);
    }

    // Accessors
    public function getBannerAttribute()
    {
        return ! is_null($this->getFirstMedia('banner')) ? $this->getFirstMediaUrl('banner') : logoBanner();
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
        $modules = isset($this->data['modules']) ? $this->data['modules'] : null;
        $schema = Schema::softwareApplication()
            ->name($this->meta_name ?? $this->name)
            ->author(title())
            ->description($this->meta_description ?? $this->excerpt)
            ->image($this->banner)
            ->if(! is_null($modules), function (SoftwareApplication $schema) use ($modules) {
                $schema->email(collect($modules)->pluck('name')->toArray());
            })
            ->url(route('website.software', ['software' => $this->slug]))
            ->keywords($this->meta_keywords);

        return $schema->toScript();
    }
    
}
