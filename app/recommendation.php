<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class recommendation extends Model
{
    protected $table = 'recommendations';
    use SoftDeletes;

    public function recouser()
    {
        return $this->hasOne('App\users', 'id', 'user_id');
    }
}
