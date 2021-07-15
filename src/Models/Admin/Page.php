<?php

namespace Adminetic\Website\Models\Admin;

use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use drh2so4\Thumbnail\Traits\Thumbnail;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Page extends Model
{
    use LogsActivity, Sluggable, SluggableScopeHelpers, Thumbnail;

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

        Page::creating(function ($model) {
            $model->position = Page::max('position') + 1;
        });
    }

    // Cache Keys
    private static function cacheKey()
    {
        Cache::has('pages') ? Cache::forget('pages') : '';
    }

    // Logs
    protected static $logName = 'page';

    // Casts
    protected $casts = [
        'meta_keywords' => 'array'
    ];

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    // Accessors
    public function getTypeAttribute($attribute)
    {
        return [
            1 => 'Event',
            2 => 'Case Study',
            3 => 'Vacancy Announcement',
            4 => 'Custom Page'
        ][$attribute];
    }
}
