<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\recommendation;

class cmsController extends Controller
{
    public function add_reco(Request $request)
    {
        $reco = new recommendation;

        $reco->body = $request->input('reco');
        $reco->author = $request->input('username');

        $reco->save();

        echo 'saved';
    }

}
