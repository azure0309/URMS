<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\PartnerInformationModel;
use App\PartnerInformationBackupModel;

class PartnerInformationController extends Controller
{
    function show(Request $request)
    {


        $partners = PartnerInformationModel::all();

        return view('partner_info',
            ['all_partner_info' => $partners]);
    }

    function add_page()
    {
        return view('partner_info_store');
    }

    function store(Request $request)
    {
        $country = $request->input('country');
        $partner_name = $request->input('partner_name');
        $address = $request->input('address');
        $phone = $request->input('phone');
        $email = $request->input('email');
        $pmn_code = $request->input('pmn_code');

        if (!empty($country) && !empty($partner_name) && !empty($address) && !empty($phone) && !empty($email) && !empty($pmn_code)) {
            $add_partner_info = new PartnerInformationModel;
            $add_partner_info->country = strtoupper($country);
            $add_partner_info->partner_name = strtoupper($partner_name);
            $add_partner_info->address = $address;
            $add_partner_info->phone = $phone;
            $add_partner_info->email = $email;
            $add_partner_info->pmn_code = $pmn_code;
            $add_partner_info->save();
        }
        return redirect('/invoice/partner_information');
    }

    function delete(Request $request)
    {
        $id = $request->input('id');
        $old_partner = PartnerInformationModel::where('id', $id)->get();

        foreach ($old_partner as $partner) {
            $partner_backup = new PartnerInformationBackupModel;
            $partner_backup->country = $partner['country'];
            $partner_backup->partner_name = $partner['partner_name'];
            $partner_backup->address = $partner['address'];
            $partner_backup->phone = $partner['phone'];
            $partner_backup->email = $partner['email'];
            $partner_backup->pmn_code = $partner['pmn_code'];
            $partner_backup->save();
        }


        $partner = PartnerInformationModel::find($id);
        $partner->delete();
        return redirect('/invoice/partner_information')->with('delete', 'Deleted successfully');
    }

    function edit_show(Request $request)
    {
        $id = $request->input('id');
        $partner = PartnerInformationModel::where('id', $id)->get();
        return view('partner_info_edit',
            ['partner' => $partner]
        );
    }

    function edit(Request $request)
    {
        $id = $request->input('id');
        $country = $request->input('country');
        $partner_name = $request->input('partner_name');
        $address = $request->input('address');
        $phone = $request->input('phone');
        $email = $request->input('email');
        $pmn_code = $request->input('pmn_code');

//        print_r($id);
        $partner = PartnerInformationModel::find($id);
        $partner->country = strtoupper($country);
        $partner->partner_name = strtoupper($partner_name);
        $partner->address = $address;
        $partner->phone = $phone;
        $partner->email = $email;
        $partner->pmn_code = $pmn_code;
        $partner->save();

        return redirect('/invoice/partner_information');

    }
}
