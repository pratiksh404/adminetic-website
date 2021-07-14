<?php

namespace App\Models\Admin;

use App\Traits\HasSlug;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Package extends Model
{
    use LogsActivity, HasSlug;

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
        Cache::has('packages') ? Cache::forget('packages') : '';
    }

    // Logs
    protected static $logName = 'package';

    // Casts
    protected $casts = [
        'features' => 'array'
    ];

    // Accessors

    public function getPackageTimeAttribute($attribute)
    {
        return [
            1 => 'Per Hour',
            2 => 'Per Day',
            3 => 'Per Week',
            4 => 'Per Month',
            5 => 'Per Year',
            6 => 'Custom Plan'
        ][$attribute];
    }
}
