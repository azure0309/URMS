<?php

namespace App\Http\Controllers;

use App\ClosePaymentModel;
use App\PartnerInformationModel;
use App\SendInvoiceModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PrintInvoiceController extends Controller
{
    function show(Request $request)
    {
        $partner_info = [];
        $send_invoice = [];
        $close_payment = [];
        $year_date = $request->input('year_date');
        $sum_amt = 0;
        $limit = 0;
        if ($request->input('action') == 'InvoicePDF'){

            $country = $request->input('country');
            $operator = $request->input('operator');
            $bill_month = $request->input('bill_month');
//            print_r($country);
//            print_r($operator);
//            print_r($bill_month);
            $limit = $request->input('limit');

            $isPartnerRegistered = PartnerInformationModel::where('country', strtoupper($country))
                ->where('partner_name', strtoupper($operator))->count();
            if($isPartnerRegistered == 0){
                echo "<script>alert('Энэ partner-ийн мэдээлэл байхгүй байна. Мэдээллийг нэмнэ үү');
                    window.location.href='/invoice/partner_information/add';
                        </script>";
            }else{
                $partner_info = PartnerInformationModel::where('country', strtoupper($country))
                    ->where('partner_name', strtoupper($operator))->get();
                $send_invoice = SendInvoiceModel::where('bill_month', $year_date)
                    ->where('country', $country)
                    ->where('operator', $operator)
                    ->where(function($query){
                        $query->where('status', null)
                            ->Orwhere('status', 'DISCOUNTED');
                    })
                    ->get();
                $close_payment = ClosePaymentModel::where('bill_month', $year_date)->get();
                $sum_amt = SendInvoiceModel::where('country', strtoupper($country))
                    ->where('operator', strtoupper($operator))
                    ->groupBy('country')
                    ->groupBy('operator')
                    ->sum('payment');
//                print_r($sum_amt);
            }
        }

        $currentMonth = intval(date('Ym', strtotime("-1 month")));

        if (empty($year_date)) {
            $year_date = $currentMonth;
        }




        return view('invoice_printer',
            [
                'close_payment' => $close_payment,
                'send_invoice' => $send_invoice,
//                'total_invoice_list' => $total_invoice_list,
                'year_date' => $year_date,
                'current_month' => $currentMonth,
                'partner_info' => $partner_info,
                'sum_amount'=> $sum_amt,
                'limit' => $limit
            ]
        );
    }
}
