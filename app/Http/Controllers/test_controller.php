<?php

namespace App\Http\Controllers;

use App\ClosePaymentModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\SimUsageModel;
use App\SimThresholdModel;
use App\SimInfoModel;
use App\CurrencyModel;

class test_controller extends Controller
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

    function get_month_numbers(){
        $numbers = [];
        $currentMonth = intval(date('Ym', strtotime("-1 month")));
        $select = SimUsageModel::where('bill_month', $currentMonth)->pluck('prod_no');
        foreach ($select as $item){
            $get_prod_name = $this->get_prod_name($item);
           if(strtoupper($get_prod_name) == 'ROAMING PARTNER TEST'){
               array_push($numbers, $item);
           }
        }
        return $numbers;
    }

    function get_payment_of_number($number){
        $currentMonth = intval(date('Ym', strtotime("-1 month")));
        $payment_each_number = SimUsageModel::where('prod_no', $number)
            ->where('bill_month', $currentMonth)
            ->pluck('tot_bill_amt');
//        print_r(floatval($payment_each_number[0]));
        return floatval($payment_each_number[0]);
    }

    function get_threshold_type($number){
        $operator = SimInfoModel::where('prod_no', $number)->pluck('name');
        $country = SimInfoModel::where('prod_no', $number)->pluck('country');
        $threshold_type = SimThresholdModel::where('cust_urag', $country)
            ->where('cust_name', $operator)
            ->pluck('note');
        return $threshold_type;
    }

    function list_of_partner_numbers_payments(){
        $total_sim = array();
        $per_sim = array();
        $total_sim_payment = array();
        $per_sim_payment = array();

        $get_last_month_numbers = $this->get_month_numbers();
        foreach ($get_last_month_numbers as $item){
            $threshold_of_number = $this->get_threshold_type($item);
            if (count($threshold_of_number) > 0){
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
            $payment_of_number = $this->get_payment_of_number($sim);

            array_push($total_sim_payment, ['country' => $country[0], 'operator' => $operator[0], 'prod_no' => $sim, 'payment' => $payment_of_number, 'bill_month' => $currentMonth]);
        }
        foreach ($per_sim as $sim) {
            $operator = SimInfoModel::where('prod_no', $sim)->pluck('name');
            $payment_of_number = $this->get_payment_of_number($sim);
            array_push($per_sim_payment, [$operator[0] => [$sim => $payment_of_number]]);
        }
        return ['total_sim_payment' => $total_sim_payment, 'per_sim_payment' => $per_sim];
    }

    function sum_total_payments($total_numbers_list){
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

    function store()
    {
        $list = $this->list_of_partner_numbers_payments();
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
        foreach ($total_sim_payments as $payment) {
            if (in_array($payment['country'] . '_' . $payment['operator'], $lower_operators)) {

                $close_payment = new ClosePaymentModel();
                $close_payment->country = $payment['country'];
                $close_payment->operator = $payment['operator'];
                $close_payment->msisdn = $payment['prod_no'];
                $close_payment->total = $payment['payment'];
                $close_payment->bill_month = $payment['bill_month'];
                $close_payment->currency = $currency[0];

                $select = ClosePaymentModel::where('country', $payment['country'])
                    ->where('operator', $payment['operator'])
                    ->where('msisdn', $payment['prod_no'])
//                ->where('total', $payment['payment'])
                    ->where('bill_month', $payment['bill_month'])
//                    ->where('currency', $currency[0])
                    ->count();
//            print_r($select);

//                echo $close_payment->country . ' ';
//                echo $close_payment->operator . ' ';
//                echo $close_payment->msisdn . ' ';
//                echo $close_payment->total . ' ';
//                echo $close_payment->bill_month . ' ';
//                echo $close_payment->currency . ' ';
                if ($select == 0) {
                    $close_payment->save();
                }
//
            }

        }
    }

    function show()
    {
//        $currentMonth = 202011;
        $currentMonth = intval(date('Ym', strtotime("-1 month")));

//        if (date('d') == 10){
        $this->store();
//        }
        $close_payment = ClosePaymentModel::all();

//        print_r($close_payment);
        $payment_per_num = SimUsageModel::where('bill_month', 202011)->pluck('tot_bill_amt');
        return view('partner_invoice', ['close_payment' => $close_payment, 'current_month' => $currentMonth]);
    }
}

