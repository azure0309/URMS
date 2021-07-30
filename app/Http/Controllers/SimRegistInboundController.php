<?php

namespace App\Http\Controllers;

use App\reference;
use App\SimInfoInboundModel;
use App\SimInfoModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\SimInfoInboundBackupModel;
use phpDocumentor\Reflection\DocBlock\Tags\Reference\Url;

class SimRegistInboundController extends Controller
{
    function show(Request $request)
    {
        $info = SimInfoInboundModel::all();
//        print_r($info);
        return view('sim_regist_in',
            ['info' => $info]);
    }

    function add_page()
    {
        $reference_country = reference::distinct()->orderBy('country')->pluck('country');
        $reference_operator = reference::distinct()->orderBy('operator')->pluck('operator');
        return view('sim_inbound_store', ['country'=>$reference_country, 'operator'=>$reference_operator]);
    }

    function store(Request $request){
        $tadig = $request->input('tadig');
        $operator = $request->input('operator');
        $country = $request->input('country');
        $agreement = $request->input('agreement');
        $msisdn = $request->input('msisdn');
        $imsi = $request->input('imsi');
        $icc_id = $request->input('icc_id');
        $pin_1 = $request->input('pin_1');
        $puk_1 = $request->input('puk_1');
        $type = $request->input('type');
        $post_pps = $request->input('post_pps');
        $card_status = $request->input('card_status');
        $card_location = $request->input('card_location');
        $dt = $request->input('dt');

        if(!empty($tadig) && !empty($msisdn) && !empty($country) && !empty($operator)){
            $add_sim_inbound = new SimInfoInboundModel();
            $add_sim_inbound->tadig = $tadig;
            $add_sim_inbound->operator = $operator;
            $add_sim_inbound->country = $country;
            $add_sim_inbound->agreement = $agreement;
            $add_sim_inbound->msisdn = $msisdn;
            $add_sim_inbound->imsi = $imsi;
            $add_sim_inbound->icc_id = $icc_id;
            $add_sim_inbound->pin_1 = $pin_1;
            $add_sim_inbound->puk_1 = $puk_1;
            $add_sim_inbound->type = $type;
            $add_sim_inbound->post_pps = $post_pps;
            $add_sim_inbound->card_status = $card_status;
            $add_sim_inbound->card_location = $card_location;
            $add_sim_inbound->dt = $dt;
            $add_sim_inbound->save();
        }
        return redirect('simregister/inbound');
    }

    function delete(Request $request){
        $id = $request->input('id');
        $old_sim = SimInfoInboundModel::where('id', $id)->get();

        foreach ($old_sim as $sim){
            $sim_backup = new SimInfoInboundBackupModel;
            $sim_backup->tadig = $sim['tadig'];
            $sim_backup->operator = $sim['operator'];
            $sim_backup->country = $sim['country'];
            $sim_backup->agreement = $sim['agreement'];
            $sim_backup->msisdn = $sim['msisdn'];
            $sim_backup->imsi = $sim['imsi'];
            $sim_backup->icc_id = $sim['icc_id'];
            $sim_backup->pin_1 = $sim['pin_1'];
            $sim_backup->puk_1 = $sim['puk_1'];
            $sim_backup->type = $sim['type'];
            $sim_backup->post_pps = $sim['post_pps'];
            $sim_backup->card_status = $sim['card_status'];
            $sim_backup->card_location = $sim['card_location'];
            $sim_backup->dt = $sim['dt'];
            $sim_backup->save();
        }

        $sim = SimInfoInboundModel::find($id);
        $sim->delete();

        return redirect('/simregister/inbound')->with('delete', 'Deleted successfully');
    }

    function edit_show(Request $request){
        $id = $request->input('id');
        $sim = SimInfoInboundModel::where('id', $id)->get();
        return view('sim_inbound_edit',
            ['sim' => $sim]);
    }

    function edit(Request $request){
        $id = $request->input('id');
        $tadig = $request->input('tadig');
        $operator = $request->input('operator');
        $country = $request->input('country');
        $agreement = $request->input('agreement');
        $msisdn = $request->input('msisdn');
        $imsi = $request->input('imsi');
        $icc_id = $request->input('icc_id');
        $pin_1 = $request->input('pin_1');
        $puk_1 = $request->input('puk_1');
        $type = $request->input('type');
        $post_pps = $request->input('post_pps');
        $card_status = $request->input('card_status');
        $card_location = $request->input('card_location');
        $dt = $request->input('dt');

        $sim =SimInfoInboundModel::find($id);
        $sim->tadig = $tadig;
        $sim->operator = $operator;
        $sim->country = $country;
        $sim->agreement = $agreement;
        $sim->msisdn = $msisdn;
        $sim->imsi = $imsi;
        $sim->icc_id = $icc_id;
        $sim->pin_1 = $pin_1;
        $sim->puk_1 = $puk_1;
        $sim->type = $type;
        $sim->post_pps = $post_pps;
        $sim->card_status = $card_status;
        $sim->card_location = $card_location;
        $sim->dt = $dt;
        $sim->save();

        return redirect('/simregister/inbound');
    }
}
