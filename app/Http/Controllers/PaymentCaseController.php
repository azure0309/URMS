<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\SimThresholdModel;

class PaymentCaseController extends Controller
{
    function show(Request $request)
    {
        $cust_urag = $request->input('country');
        $cust_name = $request->input('operator');
        $install_address = null;
        $prod_cd = $request->input('prod_cd');
        $ncmv = $request->input('ncmv');
        $currency = $request->input('currency');
        $note = $request->input('note');
        if (!empty($cust_urag) && !empty($cust_name) && !empty($prod_cd) && !empty($ncmv) && !empty($currency) && !empty($note)) {
            $add_payment_case = new SimThresholdModel;
            $add_payment_case->cust_urag = $cust_urag;
            $add_payment_case->cust_name = $cust_name;
            $add_payment_case->prod_cd = $prod_cd;
            $add_payment_case->ncmv = $ncmv;
            $add_payment_case->currency = $currency;
            $add_payment_case->note = $note;
            $add_payment_case->save();
        }
        $payment_cases = SimThresholdModel::all();
//        print_r($payment_cases);
        return view('payment_case',
            [
                'payment_cases' => $payment_cases,
            ]);
    }

    function add_page(Request $request)
    {
        return view('payment_case_store');
    }

}
