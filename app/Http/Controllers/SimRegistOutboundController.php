<?php

namespace App\Http\Controllers;

use App\reference;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\SimInfoOutboundBackupModel;
use App\SimInfoOutboundModel;

class SimRegistOutboundController extends Controller
{
    function show(Request $request)
    {
        $info = SimInfoOutboundModel::all();
//        print_r($info);
        return view('sim_regist_out',
            ['info' => $info]);
    }

    function add_page()
    {
        $reference_country = reference::distinct()->orderBy('country')->pluck('country');
        $reference_operator = reference::distinct()->orderBy('operator')->pluck('operator');
        return view('sim_outbound_store', ['country'=>$reference_country, 'operator'=>$reference_operator]);
    }

    function store(Request $request)
    {
        $tadig = $request->input('tadig');
        $country = $request->input('country');
        $operator = $request->input('operator');
        $msisdn = $request->input('msisdn');
        $imsi = $request->input('imsi');
        $icc_id = $request->input('icc_id');
        $pin_1 = $request->input('pin_1');
        $puk_1 = $request->input('puk_1');
        $card_status = $request->input('card_status');
        $card_location = $request->input('card_location');
        $dt = $request->input('dt');

        if (!empty($tadig)) {
            $add_sim_outbound = new SimInfoOutboundModel();
            $add_sim_outbound->tadig = $tadig;
            $add_sim_outbound->operator = $operator;
            $add_sim_outbound->country = $country;
            $add_sim_outbound->msisdn = $msisdn;
            $add_sim_outbound->imsi = $imsi;
            $add_sim_outbound->icc_id = $icc_id;
            $add_sim_outbound->pin_1 = $pin_1;
            $add_sim_outbound->puk_1 = $puk_1;
            $add_sim_outbound->card_status = $card_status;
            $add_sim_outbound->card_location = $card_location;
            $add_sim_outbound->dt = $dt;
            $add_sim_outbound->save();
        }
        return redirect('/simregister/outbound');
    }

    function delete(Request $request)
    {
        $id = $request->input('id');
        $old_sim = SimInfoOutboundModel::where('id', $id)->get();

        foreach ($old_sim as $sim) {
            $sim_backup = new SimInfoOutboundBackupModel;
            $sim_backup->tadig = $sim['tadig'];
            $sim_backup->operator = $sim['operator'];
            $sim_backup->country = $sim['country'];
            $sim_backup->msisdn = $sim['msisdn'];
            $sim_backup->imsi = $sim['imsi'];
            $sim_backup->icc_id = $sim['icc_id'];
            $sim_backup->pin_1 = $sim['pin_1'];
            $sim_backup->puk_1 = $sim['puk_1'];
            $sim_backup->card_status = $sim['card_status'];
            $sim_backup->card_location = $sim['card_location'];
            $sim_backup->dt = $sim['dt'];
            $sim_backup->save();
        }

        $sim = SimInfoOutboundModel::find($id);
        $sim->delete();

        return redirect('/simregister/outbound')->with('delete', 'Deleted successfully');
    }

    function edit_show(Request $request)
    {
        $id = $request->input('id');
        $sim = SimInfoOutboundModel::where('id', $id)->get();
        return view('sim_outbound_edit',
            ['sim' => $sim]);
    }

    function edit(Request $request)
    {
        $id = $request->input('id');
        $tadig = $request->input('tadig');
        $operator = $request->input('operator');
        $country = $request->input('country');
        $msisdn = $request->input('msisdn');
        $imsi = $request->input('imsi');
        $icc_id = $request->input('icc_id');
        $pin_1 = $request->input('pin_1');
        $puk_1 = $request->input('puk_1');
        $card_status = $request->input('card_status');
        $card_location = $request->input('card_location');
        $dt = $request->input('dt');

        $sim = SimInfoOutboundModel::find($id);
        $sim->tadig = $tadig;
        $sim->operator = $operator;
        $sim->country = $country;
        $sim->msisdn = $msisdn;
        $sim->imsi = $imsi;
        $sim->icc_id = $icc_id;
        $sim->pin_1 = $pin_1;
        $sim->puk_1 = $puk_1;
        $sim->card_status = $card_status;
        $sim->card_location = $card_location;
        $sim->dt = $dt;
        $sim->save();

        return redirect('/simregister/outbound');
    }
}
