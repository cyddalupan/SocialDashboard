<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class loginCode extends Model {

	
    use SoftDeletes;
    
    protected $table = 'login_codes';
    protected $dates = ['deleted_at'];

}
