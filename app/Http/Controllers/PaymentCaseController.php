<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\reference;
use App\SimThresholdModel;
use App\CurrencyModel;
use App\SimInfoModel;

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
        $reference_country = SimInfoModel::distinct()->orderBy('country')->pluck('country');
        $reference_operator = SimInfoModel::distinct()->orderBy('name')->pluck('name');
        $currency = CurrencyModel::all();
        $threshold_type = SimThresholdModel::groupBy('note')->pluck('note');
        $prod_cd = SimThresholdModel::groupBy('prod_cd')->pluck('prod_cd');
        return view('payment_case_store',
            [
                'prod_cd' => $prod_cd,
                'country' => $reference_country,
                'operator' => $reference_operator,
                'currency' => $currency,
                'threshold_type' => $threshold_type
            ]);
    }

    function edit_page(Request $request)
    {
        $id = $request->input('id');
        $payment_case = SimThresholdModel::where('id', $id)->get();
        return view('payment_case_edit',
            [
                'payment_case' => $payment_case
            ]);
    }

    function edit(Request $request)
    {
        $id = $request->input('id');
        $cust_urag = $request->input('cust_urag');
        $cust_name = $request->input('cust_name');
        $prod_cd = $request->input('prod_cd');
        $ncmv = $request->input('ncmv');
        $currency = $request->input('currency');
        $note = $request->input('note');

        $payment_case = SimThresholdModel::find($id);
        $payment_case->cust_urag = $cust_urag;
        $payment_case->cust_name = $cust_name;
        $payment_case->prod_cd = $prod_cd;
        $payment_case->ncmv = $ncmv;
        $payment_case->currency = $currency;
        $payment_case->note = $note;
        $payment_case->save();

        return redirect('/invoice/payment_case');
    }
}
