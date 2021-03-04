<?php

namespace App\Http\Controllers;

use App\ClosePaymentModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\SendInvoiceModel;

class PartnerActionController extends Controller
{
    function show(Request $request){
        $id = $request->input('id');
        $payment = SendInvoiceModel::where('id', $id)->get();
        $year_date = $request->input('year_date');
        return view('partner_invoice_action',
        ['payment' => $payment,
            'year_date' => $year_date]);
    }
    function close_whole_payment($id)
    {


        $id_info = SendInvoiceModel::find($id);

        $id_info->status = 'CONFIRMED';
        $id_info->save();

        $to_discount = SendInvoiceModel::where('id', $id)->get();
        foreach ($to_discount as $item) {
            if (ClosePaymentModel::where('msisdn', $item['msisdn'])
                ->where('bill_month', $item['bill_month'])
                ->exists()) {
                $id_close = ClosePaymentModel::where('msisdn', $item['msisdn'])
                    ->where('bill_month', $item['bill_month'])->pluck('id');
//                print_r($id_close);
                $last_payment = ClosePaymentModel::where('msisdn', $item['msisdn'])
                    ->where('bill_month', $item['bill_month'])->pluck('total');

                $duplicate = ClosePaymentModel::find($id_close[0]);
//                print_r($duplicate);
                $duplicate->total = $last_payment[0] + $item['payment'];
                $duplicate->status = 'CONFIRMED';
                $duplicate->save();
            } else {
                $close_payment = new ClosePaymentModel();
                $close_payment->country = $item['country'];
                $close_payment->operator = $item['operator'];
                $close_payment->msisdn = $item['msisdn'];
                $close_payment->total = $item['payment'];
                $close_payment->bill_month = $item['bill_month'];
                $close_payment->status = 'CONFIRMED';
                $close_payment->save();
            }
        }
    }

    function discount($id, $discount)
    {
        $close_payment = new ClosePaymentModel();
        $to_discount = SendInvoiceModel::where('id', $id)->get();


        foreach ($to_discount as $item) {
            $new_payment = $item['payment'] - $discount;
//            echo $item;
            $id_info = SendInvoiceModel::find($id);
            $id_info->payment = $new_payment;
            $id_info->status = 'DISCOUNTED';
            $id_info->save();

            $close_payment = new ClosePaymentModel();
            $close_payment->country = $item['country'];
            $close_payment->operator = $item['operator'];
            $close_payment->msisdn = $item['msisdn'];
            $close_payment->total = $discount;
            $close_payment->bill_month = $item['bill_month'];
            $close_payment->status = 'DISCOUNTED';
            $close_payment->save();
        }

    }

    function action(Request $request){
        $id = $request->input('id');
        $discount = $request->input('discount');
        $year_date = $request->input('bill_month');
        if (!empty($id) && !empty($discount)){
//            echo 'discount';
            $this->discount($id, $discount);
        }elseif (!empty($id) && empty($discount)){
//            echo 'whole';
            $this->close_whole_payment($id);
        }

        $url = '/invoice/partner?year_date=' . $year_date;
        return redirect($url);
    }
}
