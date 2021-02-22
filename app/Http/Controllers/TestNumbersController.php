<?php

namespace App\Http\Controllers;

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

        $country = $request->input('country');
        $operator = $request->input('operator');

//        echo $country;
//        echo $operator;

        $findNumbersOfCountry = SimInfoModel::where('country', $country)
            ->where('name', $operator)->pluck('prod_no');

        $info = $this->findNumbersOfCountry($findNumbersOfCountry);

        $test_array = ['col1'=>'tuguldur', 'col2'=>'oyuka'];


        return view('partner_operators',
            [
                'countries' => $select_country,
                'operators'=>$select_operator,
                'infos'=> $info,
                'test_array'=>$test_array
            ]);
    }
}
