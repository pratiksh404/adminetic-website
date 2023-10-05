<?php

namespace Adminetic\Website\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function __construct(array $attributes = [])
    {
        $this->table = config('website.table_prefix', 'website') . '_messages';

        parent::__construct($attributes);
    }
}
