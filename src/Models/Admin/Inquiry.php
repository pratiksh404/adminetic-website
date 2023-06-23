<?php

namespace Adminetic\Website\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inquiry extends Model
{
    use HasFactory;

    protected $guarded = [];

    // Casts
    protected $casts = [
        'data' => 'array',
    ];

    // Relationships
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function software()
    {
        return $this->belongsTo(Software::class);
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
