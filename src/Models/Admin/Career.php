<?php

namespace Adminetic\Website\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\SchemaOrg\Schema;

class Career extends Model
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
        Cache::has('careers') ? Cache::forget('careers') : '';
        Cache::has('latest_careers') ? Cache::forget('latest_careers') : '';
    }

    // Logs
    protected static $logName = 'career';

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults();
    }

    public function __construct(array $attributes = [])
    {
        $this->table = config('website.table_prefix', 'website').'_careers';

        parent::__construct($attributes);
    }

    // Appends
    protected $casts = [
        'summary' => 'array',
    ];

    // Relationship
    public function applications()
    {
        return $this->hasMany(Application::class);
    }

    // Accessors
    public function getGroupAttribute($attribute)
    {
        return ! is_null($attribute) ? (config('website.career_group', [
            1 => 'REASEARCHERS/STAFF',
            2 => 'FIELD STAFF',
            3 => 'INTERN/VOLUNTEERS',
        ])[$attribute]) : null;
    }

    // Methods
    public function shortListed()
    {
        return Application::where('career_id', $this->id)->where('short_listed', 1)->latest()->get();
    }

    // Methods
    public function selected()
    {
        return Application::where('career_id', $this->id)->where('selected', 1)->latest()->get();
    }

    public function searchSchema()
    {
        $schema = Schema::jobPosting()
            ->title($this->name)
            ->name($this->name)
            ->url(route('website.career', ['career' => $this->slug]))
            ->alternateName($this->designation)
            ->jobLocation($this->location)
            ->baseSalary($this->salary)
            ->datePosted($this->created_at)
            ->description($this->excerpt)
            ->directApply(true)
            ->estimatedSalary($this->salary)
            ->occupationalCategory(config('website.career_group')[$this->group ?? 1]);

        return $schema->toScript();
    }

    // Accessors
    public function getImageAttribute()
    {
        return ! is_null($this->getFirstMedia('image')) ? $this->getFirstMediaUrl('image') : asset('adminetic/static/placeholder.jpg');
    }
}
