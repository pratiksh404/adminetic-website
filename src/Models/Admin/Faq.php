<?php

namespace App\Models\Admin;

use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Faq extends Model
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

        Faq::creating(function ($model) {
            $model->position = Faq::max('position') + 1;
        });
    }

    // Cache Keys
    private static function cacheKey()
    {
        Cache::has('faqs') ? Cache::forget('faqs') : '';
    }

    // Logs
    protected static $logName = 'faq';
}
