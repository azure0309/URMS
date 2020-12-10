<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\SimUsageModel;
use App\SimThresholdModel;
use App\SimInfoModel;

class PartnerUsageController extends Controller
{
    function get_prod_name($number)
    {
        $prod_name = SimInfoModel::where('PROD_NO', '=', $number)->pluck('PROD_NAME');
        if ($prod_name[0] == 'Roaming Partner Test'){
            $message = 'Roaming Partner Test';
        }elseif($prod_name[0] == 'Roaming Service Test'){
            $message = 'Roaming Service Test';
        }
        return $message;
    }
    function get_last_month_numbers()
    {
        $partner_test_nums = array();
        $currentMonth = 202010;
//        $currentMonth = intval(date('Ym', strtotime("-1 month")));
        $select = SimUsageModel::where('BILL_MONTH', $currentMonth)->pluck('PROD_NO');
        foreach($select as $number){
            $get_prod_name = $this->get_prod_name($number);
            if($get_prod_name == 'Roaming Partner Test'){
                array_push($partner_test_nums, $number);
            }
        }
        return $partner_test_nums;
    }

    function get_payment_of_number($number)
    {
        $currentMonth = 202010;
//        $currentMonth = intval(date('Ym', strtotime("-1 month")));
        $payment_per_num = SimUsageModel::where('PROD_NO', $number)
            ->where('BILL_MONTH', $currentMonth)->pluck('TOT_BILL_AMT');
        return $payment_per_num;
    }

    function get_threshold_type($number)
    {
        $operator = SimInfoModel::where('PROD_NO', $number)->pluck('NAME');
        $country = SimInfoModel::where('PROD_NO', $number)->pluck('COUNTRY');
        $threshold_type = SimThresholdModel::where('CUST_URAG', '=', $country)
            ->where('CUST_NAME', '=', $operator)->pluck('Note');
        return $threshold_type;
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
            $operator = SimInfoModel::where('PROD_NO', $sim)->pluck('NAME');
            $country = SimInfoModel::where('PROD_NO', $sim)->pluck('COUNTRY');
            $payment_of_number = $this->get_payment_of_number($sim);

            array_push($total_sim_payment, ['country'=>$country[0], 'operator' => $operator[0], 'prod_no' => $sim, 'payment' => $payment_of_number[0], 'bill_month'=>$currentMonth]);
        }
        foreach ($per_sim as $sim) {
            $operator = SimInfoModel::where('PROD_NO', $sim)->pluck('NAME');
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

        return view('partner_invoice', ['total_sim_payment'=>$list['total_sim_payment'], 'per_sim_payment'=>$list['per_sim_payment'], 'current_month'=>$currentMonth]);
    }
}
