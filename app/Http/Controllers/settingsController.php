<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\settings;

class settingsController extends Controller
{
    public function change_keyword(Request $request){

        $settings = settings::find(1);
        $settings->value = $request->input('keyword');
        $settings->save();

        echo 'save';
    }

    public function update_instagram_keyword(Request $request){

        $settings = settings::find(2);
        $settings->value = $request->input('keyword');
        $settings->save();

        echo 'save';
    }
    
}
