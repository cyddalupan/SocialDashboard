<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class instagramFilters extends Model
{
    use SoftDeletes;
    
    protected $table = 'instagramFilter';

    protected $dates = ['deleted_at'];
}
