<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class users extends Model
{
    protected $table = 'users';
    protected $dates = ['deleted_at'];

    public function recommendation()
    {
        return $this->belongsTo('App\recommendation');
    }
}
