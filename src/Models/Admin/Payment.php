<?php

namespace Adminetic\Website\Models\Admin;

use App\Models\User;
use Adminetic\Website\Models\Admin\Customer;
use Spatie\Activitylog\LogOptions;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Payment extends Model
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
        Cache::has('payments') ? Cache::forget('payments') : '';
    }

    // Logs
    protected static $logName = 'payment';

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults();
    }

    protected $fillable = ['particular', 'amount', 'type', 'paymentable_type'];

    public function paymentable(): MorphTo
    {
        return $this->morphTo();
    }

    // Accessors
    public function getTypeAttribute($attribute)
    {
        return in_array($attribute ?? null, [1, 2])
            ? [
                1 => 'Income',
                2 => 'Expense'
            ][$attribute]
            : null;
    }

    // Helper Method
    public function getTypeColor()
    {
        $attribute = $this->getRawOriginal('type');
        return in_array($attribute ?? null, [1, 2])
            ? [
                1 => 'success',
                2 => 'danger'
            ][$attribute]
            : null;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
