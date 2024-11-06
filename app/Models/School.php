<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\SoftDeletes;

class School extends Eloquent
{
    use SoftDeletes;

    protected $fillable = ['name', 'email', 'phone', 'address', 'logo'];
}
