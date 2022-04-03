<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class twitterFilters extends Model
{
    use SoftDeletes;
    
    protected $table = 'twitterFilter';
    
    protected $dates = ['deleted_at'];
}
