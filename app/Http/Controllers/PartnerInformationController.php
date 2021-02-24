<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\PartnerInformationModel;

class PartnerInformationController extends Controller
{
    function show(Request $request){
        $country = $request->input('country');
        $partner_name = $request->input('partner_name');
        $address = $request->input('address');
        $phone = $request->input('phone');
        $email = $request->input('email');
        $pmn_code = $request->input('pmn_code');

        if(!empty($country) && !empty($partner_name) && !empty($address) && !empty($phone) && !empty($email) && !empty($pmn_code)){
            $add_partner_info = new PartnerInformationModel;
            $add_partner_info->country = strtoupper($country);
            $add_partner_info->partner_name = strtoupper($partner_name);
            $add_partner_info->address = $address;
            $add_partner_info->phone = $phone;
            $add_partner_info->email = $email;
            $add_partner_info->pmn_code = $pmn_code;
            $add_partner_info->save();
        }

        $partners = PartnerInformationModel::all();

        return view('partner_info',
        ['all_partner_info'=>$partners]);
    }
    function add_page(){
        return view('partner_info_store');
    }
}
