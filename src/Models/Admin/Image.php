<?php

namespace Adminetic\Website\Models\Admin;

use Spatie\Activitylog\LogOptions;
use Illuminate\Support\Facades\Cache;
use drh2so4\Thumbnail\Traits\Thumbnail;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Image extends Model
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

        Image::creating(function ($model) {
            $model->position = Image::max('position') + 1;
        });
    }

    // Cache Keys
    private static function cacheKey()
    {
        Cache::has('images') ? Cache::forget('images') : '';
    }

    // Logs
    protected static $logName = 'image';

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults();
    }

    // Appends
    protected $appends = ['network_image'];

    // Accessors
    public function getTypeAttribute($attribute)
    {
        return [
            1 => 'Normal',
            2 => 'Horizontal',
            3 => 'Vertical',
            4 => 'Slider',
        ][$attribute];
    }

    // Relations
    public function gallery()
    {
        return $this->belongsTo(Gallery::class, 'gallery_id');
    }

    // Scopes
    public function scopeNormal($query)
    {
        return $query->where('type', 1);
    }

    public function scopeHorizontal($query)
    {
        return $query->where('type', 2);
    }

    public function scopeVertical($query)
    {
        return $query->where('type', 3);
    }

    public function scopeSlider($query)
    {
        return $query->where('type', 4);
    }
    // Accessors
    public function getNetworkImageAttribute()
    {
        return isset($this->image) ? url('storage/' . $this->image) : null;
    }
}
