<?php

namespace Adminetic\Website\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    use HasFactory;

    protected $guarded = [];

    // Relationship
    public function career()
    {
        return $this->belongsTo(Career::class);
    }
}
