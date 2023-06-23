<?php

namespace Adminetic\Website\Models\Admin;

use Adminetic\Website\Models\Admin\Product;
use Spatie\Activitylog\LogOptions;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Attribute extends Model
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
        Cache::has('attributes') ? Cache::forget('attributes') : '';
    }

    // Logs
    protected static $logName = 'attribute';

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults();
    }

    // Casts
    protected $casts = [
        'values' => 'array',
    ];

    // Relationships
    public function products()
    {
        return $this->belongsToMany(Product::class)->withPivot('values')->withTimestamps();
    }
}
