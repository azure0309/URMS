<?php

namespace App\Http\Controllers;

use App\SimThresholdModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\SimUsageModel;
use App\SimInfoModel;

class TestNumbersController extends Controller
{
    function get_numbers_from_country($country){
        $numbers = SimInfoModel::where('country', $country)->pluck('prod_no');
        return $numbers;
    }
    function get_numbers($country, $operator){
        $numbers = SimInfoModel::where('country', $country)
            ->where('name', $operator)->pluck('prod_no');
        return $numbers;
    }
    function show(Request $request)
    {
        $req_country = $request->input('country');
        $req_operator = $request->input('operator');
        $req_number = $request->input('bynumber');
        $req_month = $request->input('bymonth');
        $req_status = $request->input('status');
        $all_usages = [];
        if(!empty($req_country) && empty($req_operator) && empty($req_number) && empty($req_month)){
            $numbers = $this->get_numbers_from_country($req_country);
            foreach ($numbers as $number){
                $get_usages = SimUsageModel::where('prod_no', $number)->get();
                foreach ($get_usages as $usage){
                    array_push($all_usages, $usage);
                }
            }
        }
        elseif (!empty($req_country) && !empty($req_operator) && empty($req_number) && empty($req_month)){
            $numbers = $this->get_numbers($req_country, $req_operator);
            foreach ($numbers as $number){
                $get_usages = SimUsageModel::where('prod_no', $number)->get();
                foreach ($get_usages as $usage){
                    array_push($all_usages, $usage);
                }
            }
        }
        elseif (!empty($req_country) && !empty($req_operator) && empty($req_number) && !empty($req_month)){
            $numbers = $this->get_numbers($req_country, $req_operator);
            foreach ($numbers as $number){
                $get_usages = SimUsageModel::where('prod_no', $number)
                    ->where('bill_month', $req_month)->get();
                foreach ($get_usages as $usage){
                    array_push($all_usages, $usage);
                }
            }
        }
        elseif (empty($req_country) && empty($req_operator) && empty($req_number) && !empty($req_month)){
            $all_usages = SimUsageModel::where('bill_month', $req_month)->get();
        }
//        elseif (empty($req_country) && empty($req_operator) && empty($req_number) && empty($req_month)){
//            $all_usages = SimUsageModel::all();
//        }
        elseif (empty($req_country) && empty($req_operator) && !empty($req_number) && empty($req_month)){
            $all_usages = SimUsageModel::where('prod_no', $req_number)->get();
        }
        elseif (empty($req_country) && empty($req_operator) && empty($req_number) && empty($req_month) && !empty($req_status)){
            $all_usages = SimUsageModel::where('bill_status', strtoupper($req_status))->get();
        }


        $select_country = SimInfoModel::where('country', '!=', 'SERVICE_PROVIDER')->pluck('country');
        $select_operator = SimInfoModel::pluck('name');

        $currentMonth = intval(date('Ym', strtotime("-1 month")));

        $last_month = SimUsageModel::where('bill_month', $currentMonth)->get();

        foreach ($last_month as $usage){
            $country = SimInfoModel::where('prod_no', $usage['prod_no'])->pluck('country');
            $operator = SimInfoModel::where('prod_no', $usage['prod_no'])->pluck('name');
            $isInThreshold = SimThresholdModel::where('cust_urag', $country)->where('cust_name', $operator)->count();
            if($isInThreshold == 0){
                $get_id = SimUsageModel::where('prod_no', $usage['prod_no'])
                    ->where('bill_month', $currentMonth)->pluck('id');
                $number_status = SimUsageModel::find($get_id[0]);
                $number_status->status = 'UNCALCULATED';
                $number_status->save();
            }else{
                $get_id = SimUsageModel::where('prod_no', $usage['prod_no'])
                    ->where('bill_month', $currentMonth)->pluck('id');
                $number_status = SimUsageModel::find($get_id[0]);
                $number_status->status = NULL;
                $number_status->save();
            }
        }



        return view('partner_operators',
            [
                'countries' => $select_country,
                'operators'=>$select_operator,
                'last_month' => $last_month,
                'usages' => $all_usages
            ]);
    }
}
