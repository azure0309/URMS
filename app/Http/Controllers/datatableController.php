<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\datatable;
use DB;
use Illuminate\View\View;
use Yajra\DataTables\DataTables;

class datatableController extends Controller
{

    public function show(Request $request){
        $data = DB::select([
            'FNAME',
            'LNAME',
            'OLD',
            'ID',
            'C_DATE'
        ])->get();

        $view = View('/datatable')
            ->with('data', $data);
        return $view;
    }
}