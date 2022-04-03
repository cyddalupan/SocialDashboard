<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class settings extends Model
{
    use SoftDeletes;
    
    protected $table = 'settings';
    protected $dates = ['deleted_at'];
}
