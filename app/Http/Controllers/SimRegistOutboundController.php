<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\SimInfoModel;
use App\SimInfoBackUpModel;

class SimRegistOutboundController extends Controller
{
    function show(Request $request)
    {
        $info = SimInfoModel::all();
//        print_r($info);
        return view('sim_regist_out',
            ['info' => $info]);
    }

    function add_page()
    {
        return view('sim_outbound_store');
    }

    function store(Request $request)
    {
        $prod_no = $request->input('prod_no');
        $bill_acnt_num = $request->input('bill_acnt_num');
        $custrnm_num = $request->input('custrnm_num');
        $name = $request->input('name');
        $country = $request->input('country');
        $prod_name = $request->input('prod_name');
        $status = $request->input('status');
        $acnt_blnc = $request->input('acnt_blnc');
        $svc_type = $request->input('svc_type');
        $type = $request->input('type');

        if (!empty($prod_no)) {
            $add_sim_outbound = new SimInfoModel();
            $add_sim_outbound->prod_no = $prod_no;
            $add_sim_outbound->bill_acnt_num = $bill_acnt_num;
            $add_sim_outbound->custrnm_num = $custrnm_num;
            $add_sim_outbound->name = $name;
            $add_sim_outbound->country = $country;
            $add_sim_outbound->prod_name = $prod_name;
            $add_sim_outbound->status = $status;
            $add_sim_outbound->acnt_blnc = $acnt_blnc;
            $add_sim_outbound->svc_type = $svc_type;
            $add_sim_outbound->type = $type;
            $add_sim_outbound->save();
        }
        return redirect('/simregister/outbound');
    }

    function delete(Request $request)
    {
        $id = $request->input('id');
        $old_sim = SimInfoModel::where('id', $id)->get();

        foreach ($old_sim as $sim) {
            $sim_backup = new SimInfoBackUpModel;
            $sim_backup->prod_no = $sim['prod_no'];
            $sim_backup->bill_acnt_num = $sim['bill_acnt_num'];
            $sim_backup->custrnm_num = $sim['custrnm_num'];
            $sim_backup->name = $sim['name'];
            $sim_backup->country = $sim['country'];
            $sim_backup->prod_name = $sim['prod_name'];
            $sim_backup->status = $sim['status'];
            $sim_backup->acnt_blnc = $sim['acnt_blnc'];
            $sim_backup->svc_type = $sim['svc_type'];
            $sim_backup->type = $sim['type'];
            $sim_backup->save();
        }

        $sim = SimInfoModel::find($id);
        $sim->delete();

        return redirect('/simregister/outbound')->with('delete', 'Deleted successfully');
    }

    function edit_show(Request $request)
    {
        $id = $request->input('id');
        $sim = SimInfoModel::where('id', $id)->get();
        return view('sim_outbound_edit',
            ['sim' => $sim]);
    }

    function edit(Request $request)
    {
        $id = $request->input('id');
        $prod_no = $request->input('prod_no');
        $bill_acnt_num = $request->input('bill_acnt_num');
        $custrnm_num = $request->input('custrnm_num');
        $name = $request->input('name');
        $country = $request->input('country');
        $prod_name = $request->input('prod_name');
        $status = $request->input('status');
        $acnt_blnc = $request->input('acnt_blnc');
        $svc_type = $request->input('svc_type');
        $type = $request->input('type');

        $sim = SimInfoModel::find($id);
        $sim->prod_no = $prod_no;
        $sim->bill_acnt_num = $bill_acnt_num;
        $sim->custrnm_num = $custrnm_num;
        $sim->name = $name;
        $sim->country = $country;
        $sim->prod_name = $prod_name;
        $sim->status = $status;
        $sim->acnt_blnc = $acnt_blnc;
        $sim->svc_type = $svc_type;
        $sim->type = $type;
        $sim->save();

        return redirect('/simregister/outbound');
    }
}
