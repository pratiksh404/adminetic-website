<?php

namespace Adminetic\Website\Models\Admin;

use Adminetic\Website\Models\Admin\Service;
use Adminetic\Website\Models\Admin\Software;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Inquiry extends Model
{
    use HasFactory;

    protected $guarded = [];

    // Casts
    protected $casts = [
        'data' => 'array'
    ];

    // Relationships
    public function  product()
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
