<?php

namespace Adminetic\Website\Models\Admin;

use Spatie\Activitylog\LogOptions;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Testimonial extends Model
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

        Testimonial::creating(function ($model) {
            $model->position = Testimonial::max('position') + 1;
        });
    }

    // Cache Keys
    private static function cacheKey()
    {
        Cache::has('testimonials') ? Cache::forget('testimonials') : '';
    }

    // Logs
    protected static $logName = 'testimonial';

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults();
    }

    // Appends
    protected $appends = ['network_image'];

    // Accessors
    public function getNetworkImageAttribute()
    {
        return isset($this->image) ? url('storage/' . $this->image) : null;
    }
}
