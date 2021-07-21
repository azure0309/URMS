<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\SimInfoModel;

class SimRegistOutboundController extends Controller
{
    function show(Request $request)
    {
        $info = SimInfoModel::all();
//        print_r($info);
        return view('sim_regist_out',
            ['info' => $info]);
    }
}
