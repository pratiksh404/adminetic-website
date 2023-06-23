<?php

namespace Adminetic\Website\Models\Admin;

use Adminetic\Website\Models\Admin\Career;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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
