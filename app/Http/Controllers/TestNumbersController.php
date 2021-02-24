<?php

namespace App\Http\Controllers;

use App\SimThresholdModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\SimUsageModel;
use App\SimInfoModel;

class TestNumbersController extends Controller
{
    function getInfo($number)
    {
        $infoArr = [];
        $infos = SimUsageModel::where('prod_no', $number)->get();
        foreach ($infos as $item) {
            array_push($infoArr,
                [
                    'prod_no' => $item['prod_no'],
                    'bill_month' => $item['bill_month'],
                    'tot_bill_amt' => $item['tot_bill_amt'],
                    'over_pym' => $item['over_pym'],
                    'pym_amt' => $item['pym_amt'],
                    'upaid_amt' => $item['upaid_amt'],
                    'bill_status' => $item['bill_status']
                ]);
        }
        return $infoArr;
    }

    function findNumbersOfCountry($array)
    {
        $all_info = [];
        foreach ($array as $number) {
            $info = $this->getInfo($number);
//            print_r($info);
//            array_push($all_info, ['prod_no' => $info['prod_no'],
//                'bill_month' => $info['bill_month'],
//                'tot_bill_amt' => $info['tot_bill_amt'],
//                'over_pym' => $info['over_pym'],
//                'pym_amt' => $info['pym_amt'],
//                'upaid_amt' => $info['upaid_amt'],
//                'bill_status' => $info['bill_status']]);

        }
        return $all_info;
    }

    function show(Request $request)
    {
        $select_country = SimInfoModel::where('country', '!=', 'SERVICE_PROVIDER')->pluck('country');
        $select_operator = SimInfoModel::pluck('name');

        $currentMonth = intval(date('Ym', strtotime("-1 month")));

        $last_month = SimUsageModel::where('bill_month', $currentMonth)->get();

//        foreach ($last_month as $numbers) {
////            $country_info = SimInfoModel::where('prod_no', $last_month)->pluck('country');
//            $operator_info = SimInfoModel::where('prod_no', $last_month)->pluck('name');
//            print_r($operator_info);
//        }
//        $country_nvmc = SimThresholdModel::all('cust_urag', 'cust_name');
//        $country_info = SimInfoModel::where('prod_no', $last_month)->pluck('country');
//        $operator_info = SimInfoModel::where('prod_no', $last_month)->pluck('name');


//        foreach ($country_nvmc as $nvmc){
//            $formatted_name = $nvmc['cust_urag'] . '_' . $nvmc['cust_name'];
//            if($formatted_name == $country_info . '_' . $operator_info){
//                echo $formatted_name;
//            }
//        }


        return view('partner_operators',
            [
                'countries' => $select_country,
                'operators'=>$select_operator,
                'last_month' => $last_month
            ]);
    }
}
