<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\SimThresholdModel;

class PaymentCaseController extends Controller
{
    function show()
    {
        $payment_cases = SimThresholdModel::all();
//        print_r($payment_cases);
        return view('payment_case',
            [
                'payment_cases' => $payment_cases,
            ]);
    }
}
