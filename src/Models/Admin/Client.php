<?php

namespace Adminetic\Website\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Spatie\Activitylog\Traits\LogsActivity;

class Client extends Model
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
        Cache::has('clients') ? Cache::forget('clients') : '';
    }

    // Logs
    protected static $logName = 'client';

    // Appends
    protected $appends = ['network_image'];

    // Accessors
    public function getNetworkImageAttribute()
    {
        return isset($this->image) ? url('storage/'.$this->image) : null;
    }
}
