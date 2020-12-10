<?php

namespace App\Http\Controllers;

use App\SimInfoModel;
use App\SimThresholdModel;
use App\SimUsageModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ServiceUsageController extends Controller
{
    function get_prod_name($number)
    {
        $prod_name = SimInfoModel::where('prod_no', '=', $number)->pluck('prod_name');
        if ($prod_name[0] == 'Roaming Partner Test') {
            $message = 'Roaming Partner Test';
        } elseif ($prod_name[0] == 'Roaming Service Test') {
            $message = 'Roaming Service Test';
        }
        return $message;
    }

    function get_last_month_numbers()
    {
        $service_test_nums = array();
        $currentMonth = 202010;
//        $currentMonth = intval(date('Ym', strtotime("-1 month")));
        $select = SimUsageModel::where('bill_month', $currentMonth)->pluck('prod_no');
        foreach ($select as $number) {
            $get_prod_name = $this->get_prod_name($number);
            if ($get_prod_name == 'Roaming Service Test') {
                array_push($service_test_nums, $number);
            }
        }
        return $service_test_nums;
    }

    function get_payment_of_number($number)
    {
        $currentMonth = 202010;
//        $currentMonth = intval(date('Ym', strtotime("-1 month")));
        $payment_per_num = SimUsageModel::where('prod_no', $number)
            ->where('bill_month', $currentMonth)->pluck('tot_bill_amt');
        return $payment_per_num;
    }

    function get_threshold_type($number)
    {
        $operator = SimInfoModel::where('prod_no', $number)->pluck('name');
        $country = SimInfoModel::where('prod_no', $number)->pluck('country');
        $threshold_type = SimThresholdModel::where('cust_urag', '=', $country)
            ->where('cust_name', '=', $operator)->pluck('note');
        return $threshold_type;
    }

    function sum_total_payments($total_numbers_list){
        foreach($total_numbers_list as $number){
            print_r($number);
        }
    }




    function list_of_partner_numbers_payments()
    {
        $currentMonth = 202010;
//        $currentMonth = intval(date('Ym', strtotime("-1 month")));
        $total_sim = array();
        $per_sim = array();
        $total_sim_payment = array();
        $per_sim_payment = array();
        $get_last_month_numbers = $this->get_last_month_numbers();
        foreach ($get_last_month_numbers as $number) {
            $threshold_type = $this->get_threshold_type($number);
            if (strtoupper($threshold_type[0]) == 'TOTAL SIM') {
                array_push($total_sim, $number);
            } elseif (strtoupper($threshold_type[0]) == 'PER SIM') {
                array_push($per_sim, $number);
            }
        }
//    total sim processing by single operator
        foreach ($total_sim as $sim) {
            $operator = SimInfoModel::where('prod_no', $sim)->pluck('name');
            $country = SimInfoModel::where('prod_no', $sim)->pluck('country');
            $payment_of_number = $this->get_payment_of_number($sim);

            array_push($total_sim_payment, ['country' => $country[0], 'operator' => $operator[0], 'prod_no' => $sim, 'payment' => $payment_of_number[0], 'bill_month' => $currentMonth]);
        }
        foreach ($per_sim as $sim) {
            $operator = SimInfoModel::where('prod_no', $sim)->pluck('name');
            $payment_of_number = $this->get_payment_of_number($sim);
            array_push($per_sim_payment, [$operator[0] => [$sim => $payment_of_number[0]]]);
        }

        return ['total_sim_payment' => $total_sim_payment, 'per_sim_payment' => $per_sim];
    }

    function show()
    {

        $currentMonth = 202010;
//        $currentMonth = intval(date('Ym', strtotime("-1 month")));
        $list = $this->list_of_partner_numbers_payments();
        $this->sum_total_payments($list);
        return view('service_invoice', ['total_sim_payment' => $list['total_sim_payment'], 'per_sim_payment'=>$list['per_sim_payment'], 'current_month' => $currentMonth]);
    }
}
