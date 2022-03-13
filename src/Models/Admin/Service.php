<?php

namespace Adminetic\Website\Models\Admin;

use drh2so4\Thumbnail\Traits\Thumbnail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Service extends Model
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

        Service::creating(function ($model) {
            $model->position = Service::max('position') + 1;
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

    // Casts
    protected $casts = [
        'meta_keywords' => 'array',
    ];

    // Appends
    protected $appends = ['network_icon_image', 'network_image'];

    // Relation
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    // Accessors
    public function getNetworkIconImageAttribute()
    {
        return isset($this->icon_image) ? url('storage/'.$this->icon_image) : null;
    }

    public function getNetworkImageAttribute()
    {
        return isset($this->image) ? url('storage/'.$this->image) : null;
    }
}
