<?php

namespace App\Http\Controllers;

use App\ClosePaymentModel;
use App\SendInvoiceModel;
use App\threshold;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\SimUsageModel;
use App\SimThresholdModel;
use App\SimInfoModel;
use App\CurrencyModel;

class PartnerUsageController extends Controller
{
    function get_prod_name($number)
    {
        $message = '';
        $prod_name = SimInfoModel::where('prod_no', '=', $number)->pluck('prod_name');
        if ($prod_name[0] == 'Roaming Partner Test') {
            $message = 'Roaming Partner Test';
        } elseif ($prod_name[0] == 'Roaming Service Test') {
            $message = 'Roaming Service Test';
        }
        return $message;
    }

    function get_month_numbers($request)
    {
        $numbers = [];
        if (!empty($request)) {
            $currentMonth = $request;
        } else {
            $currentMonth = intval(date('Ym', strtotime("-1 month")));
        }
        $select = SimUsageModel::where('bill_month', $currentMonth)->pluck('prod_no');
        foreach ($select as $item) {
            $get_prod_name = $this->get_prod_name($item);
            if (strtoupper($get_prod_name) == 'ROAMING PARTNER TEST') {
                array_push($numbers, $item);
            }
        }
        return $numbers;
    }

    function get_payment_of_number($number, $request)
    {
        if (!empty($request)) {
            $currentMonth = $request;
        } else {
            $currentMonth = intval(date('Ym', strtotime("-1 month")));
        }
        $payment_each_number = SimUsageModel::where('prod_no', $number)
            ->where('bill_month', $currentMonth)
            ->pluck('tot_bill_amt');

        return floatval($payment_each_number[0]);

    }

    function get_threshold_type($number)
    {
        $operator = SimInfoModel::where('prod_no', $number)->pluck('name');
        $country = SimInfoModel::where('prod_no', $number)->pluck('country');
        $threshold_type = SimThresholdModel::where('cust_urag', $country)
            ->where('cust_name', $operator)
            ->pluck('note');
        return $threshold_type;
    }

    function list_of_partner_numbers_payments($request)
    {
        $total_sim = array();
        $per_sim = array();
        $total_sim_payment = array();
        $per_sim_payment = array();

        $get_last_month_numbers = $this->get_month_numbers($request);
        foreach ($get_last_month_numbers as $item) {
            $threshold_of_number = $this->get_threshold_type($item);
            if (count($threshold_of_number) > 0) {
                if (strtoupper($threshold_of_number[0]) == 'TOTAL SIM') {
                    array_push($total_sim, $item);
                } elseif (strtoupper($threshold_of_number[0]) == 'PER SIM') {
                    array_push($per_sim, $item);
                }
            }
        }
        foreach ($total_sim as $sim) {
            $currentMonth = intval(date('Ym', strtotime("-1 month")));
            $operator = SimInfoModel::where('prod_no', $sim)->pluck('name');
            $country = SimInfoModel::where('prod_no', $sim)->pluck('country');
            $payment_of_number = $this->get_payment_of_number($sim, $request);
//            print(gettype($payment_of_number));
            array_push($total_sim_payment, ['country' => $country[0], 'operator' => $operator[0], 'prod_no' => $sim, 'payment' => $payment_of_number, 'bill_month' => $currentMonth]);
        }
        foreach ($per_sim as $sim) {
            $operator = SimInfoModel::where('prod_no', $sim)->pluck('name');
            $payment_of_number = $this->get_payment_of_number($sim, $request);
            array_push($per_sim_payment, [$operator[0] => [$sim => $payment_of_number]]);
        }
        return ['total_sim_payment' => $total_sim_payment, 'per_sim_payment' => $per_sim];
    }

    function sum_total_payments($total_numbers_list)
    {
        $sum_array = array();
        foreach ($total_numbers_list as $number) {

            $country_operator = $number['country'] . '_' . $number['operator'];

            if (array_key_exists($country_operator, $sum_array)) {
                $old_payment = $sum_array[$country_operator]['payment'];
                $new_payment = $old_payment + $number['payment'];
                $sum_array[$country_operator] = [
                    'country' => $number['country'],
                    'operator' => $number['operator'],
                    'payment' => $new_payment,
                    'bill_month' => $number['bill_month']
                ];
            } else {
                $sum_array[$country_operator] = [
                    'country' => $number['country'],
                    'operator' => $number['operator'],
                    'payment' => $number['payment'],
                    'bill_month' => $number['bill_month']
                ];
            }
//            print_r($number);
        }
        return $sum_array;
    }

    function store($request)
    {
        $list = $this->list_of_partner_numbers_payments($request);
        $grouped = $this->sum_total_payments($list['total_sim_payment']);
        $lower_operators = [];
        $higher_operators = [];
        $search_from_list = [];
        foreach ($grouped as $item) {
            $limit = SimThresholdModel::where('cust_urag', $item['country'])
                ->where('cust_name', $item['operator'])->pluck('ncmv');
            $currency = SimThresholdModel::where('cust_urag', $item['country'])
                ->where('cust_name', $item['operator'])->pluck('currency');
            $get_currency = CurrencyModel::where('currency', $currency)->pluck('amount');
            $converted_limit = $limit[0] * $get_currency[0];
            if ($item['payment'] >= $converted_limit) {
                $country_operator = $item['country'] . '_' . $item['operator'];
                array_push($higher_operators, $country_operator);
            } else {
                $country_operator = $item['country'] . '_' . $item['operator'];
                array_push($lower_operators, $country_operator);
            }
        }

        $total_sim_payments = $list['total_sim_payment'];
        $per_sim_payments = $list['per_sim_payment'];

//        print_r($higher_operators);
        foreach ($total_sim_payments as $payment) {
            if (in_array($payment['country'] . '_' . $payment['operator'], $higher_operators)) {
                $send_invoice = new SendInvoiceModel();
                $send_invoice->country = $payment['country'];
                $send_invoice->operator = $payment['operator'];
                $send_invoice->msisdn = $payment['prod_no'];
                $send_invoice->total = $payment['payment'];
                if (empty($request)) {
                    $send_invoice->bill_month = $payment['bill_month'];
                } else {
                    $send_invoice->bill_month = $request;
                }
                $send_invoice->bill_month = $request;
                $send_invoice->currency = $currency[0];

//                echo $send_invoice->country . ' ';
//                echo $send_invoice->operator . ' ';
//                echo $send_invoice->msisdn . ' ';
//                echo $send_invoice->total . ' ';
//                echo $send_invoice->bill_month . ' ';
//                echo $send_invoice->currency . ' ';

                $select_invoice = SendInvoiceModel::where('country', $payment['country'])
                    ->where('operator', $payment['operator'])
                    ->where('msisdn', $payment['prod_no'])
                    ->where('bill_month', $request)
                    ->count();
//                echo $select_invoice;
                if ($select_invoice == 0) {
                    $send_invoice->save();
                }
            }
        }


        foreach ($total_sim_payments as $payment) {
            if (in_array($payment['country'] . '_' . $payment['operator'], $lower_operators)) {

                $close_payment = new ClosePaymentModel();
                $close_payment->country = $payment['country'];
                $close_payment->operator = $payment['operator'];
                $close_payment->msisdn = $payment['prod_no'];
                $close_payment->total = $payment['payment'];
                if (empty($request)) {
                    $close_payment->bill_month = $payment['bill_month'];
                } else {
                    $close_payment->bill_month = $request;
                }
                $close_payment->currency = $currency[0];

                $select = ClosePaymentModel::where('country', $payment['country'])
                    ->where('operator', $payment['operator'])
                    ->where('msisdn', $payment['prod_no'])
//                ->where('total', $payment['payment'])
                    ->where('bill_month', $request)
//                    ->where('currency', $currency[0])
                    ->count();
//            print_r($select);

//                echo $close_payment->country . ' ';
//                echo $close_payment->operator . ' ';
//                echo $close_payment->msisdn . ' ';
//                echo $close_payment->total;
//                echo $close_payment->bill_month . ' ';
//                echo $close_payment->currency . ' ';
                if ($select == 0) {
                    $close_payment->save();
                }
//
            }

        }
    }

    function close_whole_payment($country, $operator, $msisdn, $total, $bill_month, $currency)
    {
        $close_payment = new ClosePaymentModel();

        $close_payment->country = $country;
        $close_payment->operator = $operator;
        $close_payment->msisdn = $msisdn;
        $close_payment->total = $total;
        $close_payment->bill_month = $bill_month;
        $close_payment->currency = $currency;
        $close_payment->status = 'FROM_INVOICE';
        $close_payment->save();

        $invoice_id = SendInvoiceModel::where('country', $country)
            ->where('operator', $operator)
            ->where('msisdn', $msisdn)
            ->where('total', $total)
            ->where('bill_month', $bill_month)
            ->where('currency', $currency)
            ->pluck('id');

        $delete_invoice = SendInvoiceModel::find($invoice_id[0]);
        $delete_invoice->status = 'TO_CLOSE';
        $delete_invoice->save();
    }

    function discount($country, $operator, $msisdn, $total, $discount, $bill_month, $currency)
    {
        $close_payment = new ClosePaymentModel();

        $new_total = $total - $discount;
        $invoice_id = SendInvoiceModel::where('country', $country)
            ->where('operator', $operator)
            ->where('msisdn', $msisdn)
            ->where('total', $total)
            ->where('bill_month', $bill_month)
            ->where('currency', $currency)
            ->pluck('id');

        $send_invoice = SendInvoiceModel::find($invoice_id[0]);
        $send_invoice->total = $new_total;
        $send_invoice->status = 'TO_CLOSE';
        $send_invoice->save();

        $close_payment->country = $country;
        $close_payment->operator = $operator;
        $close_payment->msisdn = $msisdn;
        $close_payment->total = $discount;
        $close_payment->bill_month = $bill_month;
        $close_payment->currency = $currency;
        $close_payment->status = 'FROM_INVOICE';
        $close_payment->save();
    }

    function show(Request $request)
    {
        $country = $request->input('country');
        $operator = $request->input('operator');
        $msisdn = $request->input('msisdn');
        $total = $request->input('total');
        $discount = $request->input('discount');
        $bill_month = $request->input('bill_month');
        $currency = $request->input('currency');

//        echo $country;
//        echo $operator;
//        echo $msisdn;
//        echo $total;
//        echo $discount;
//        echo $bill_month;
//        echo $currency;

        if (!empty($country) && !empty($operator) && !empty($msisdn) && !empty($total) && !empty($discount) && !empty($bill_month) && !empty($currency)) {
            $this->discount($country, $operator, $msisdn, $total, $discount, $bill_month, $currency);
        }
        elseif (!empty($country) && !empty($operator) && !empty($msisdn) && !empty($total) && empty($discount) && !empty($bill_month) && !empty($currency)) {
            $this->close_whole_payment($country, $operator, $msisdn, $total, $bill_month, $currency);
        }

        $year_date = $request->input('year_date');
        $currentMonth = intval(date('Ym', strtotime("-1 month")));

        if (empty($year_date)) {
            $year_date = $currentMonth;
        }

        $this->store($year_date);

        $close_payment = ClosePaymentModel::where('bill_month', $year_date)->get();
        $send_invoice = SendInvoiceModel::where('bill_month', $year_date)
            ->where('status', null)->get();

        return view('partner_invoice', ['close_payment' => $close_payment, 'send_invoice' => $send_invoice, 'year_date' => $year_date, 'current_month' => $currentMonth]);
    }


}
