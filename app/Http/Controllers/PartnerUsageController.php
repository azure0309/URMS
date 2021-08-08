<?php

namespace App\Http\Controllers;

use App\ClosePaymentModel;
use App\SendInvoiceModel;
use App\threshold;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\SimUsageModel;
use App\SimThresholdModel;
use App\SimInfoModel;
use App\CurrencyModel;
use App\PartnerInformationModel;
use phpDocumentor\Reflection\Location;

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
//            if (strtoupper($get_prod_name) == 'ROAMING PARTNER TEST') {
                array_push($numbers, $item);
//            }
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
        $uncalculated = array();
        $total_sim_payment = array();
        $per_sim_payment = array();
        $uncalculated_sim_payment = array();

        $get_last_month_numbers = $this->get_month_numbers($request);
        foreach ($get_last_month_numbers as $item) {
            $threshold_of_number = $this->get_threshold_type($item);
            if (count($threshold_of_number) > 0) {
                if (strtoupper($threshold_of_number[0]) == 'TOTAL SIM') {
                    array_push($total_sim, $item);
                } elseif (strtoupper($threshold_of_number[0]) == 'PER SIM') {
                    array_push($per_sim, $item);
                }
            }else{
                array_push($uncalculated, $item);
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
//            $operator = SimInfoModel::where('prod_no', $sim)->pluck('name');
            $payment_of_number = $this->get_payment_of_number($sim, $request);

            $currentMonth = intval(date('Ym', strtotime("-1 month")));
            $operator = SimInfoModel::where('prod_no', $sim)->pluck('name');
            $country = SimInfoModel::where('prod_no', $sim)->pluck('country');
//            $payment_of_number = $this->get_payment_of_number($sim, $request);

            array_push($per_sim_payment, ['country' => $country[0], 'operator' => $operator[0], 'prod_no' => $sim, 'payment' => $payment_of_number, 'bill_month' => $currentMonth]);
//            array_push($per_sim_payment, ['country' => $country[0], 'operator' => $operator[0], 'prod_no' => $sim, 'payment' => $payment_of_number, 'bill_month' => $currentMonth]);
        }
        foreach ($uncalculated as $sim) {
//            $operator = SimInfoModel::where('prod_no', $sim)->pluck('name');
            $payment_of_number = $this->get_payment_of_number($sim, $request);

            $currentMonth = intval(date('Ym', strtotime("-1 month")));
            $operator = SimInfoModel::where('prod_no', $sim)->pluck('name');
            $country = SimInfoModel::where('prod_no', $sim)->pluck('country');
//            $payment_of_number = $this->get_payment_of_number($sim, $request);

            array_push($uncalculated_sim_payment, ['country' => $country[0], 'operator' => $operator[0], 'prod_no' => $sim, 'payment' => $payment_of_number, 'bill_month' => $currentMonth]);
//            array_push($per_sim_payment, ['country' => $country[0], 'operator' => $operator[0], 'prod_no' => $sim, 'payment' => $payment_of_number, 'bill_month' => $currentMonth]);
        }
        return ['total_sim_payment' => $total_sim_payment, 'per_sim_payment' => $per_sim_payment, 'uncalculated_sim_payment' => $uncalculated_sim_payment];
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
        $converted_limit = 0;
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
//        print_r($total_sim_payments);
        $per_sim_payments = $list['per_sim_payment'];
//        print_r($per_sim_payments);
        $uncalculated_sim_payment = $list['uncalculated_sim_payment'];
//        print_r($uncalculated_sim_payment);

        foreach($per_sim_payments as $payment){
            $limit = SimThresholdModel::where('cust_urag', $payment['country'])
                ->where('cust_name', $payment['operator'])->pluck('ncmv');
            $threshold_type = SimThresholdModel::where('cust_urag', $payment['country'])
                ->where('cust_name', $payment['operator'])->pluck('note');
            $currency = SimThresholdModel::where('cust_urag', $payment['country'])
                ->where('cust_name', $payment['operator'])->pluck('currency');
            $get_currency = CurrencyModel::where('currency', $currency)->pluck('amount');
            $converted_limit = $limit[0] * $get_currency[0];

//            echo $payment['payment'];
            if ($payment['payment'] >= $converted_limit){
                $send_invoice = new SendInvoiceModel();
                $send_invoice->country = $payment['country'];
                $send_invoice->operator = $payment['operator'];
                $send_invoice->msisdn = $payment['prod_no'];
                $send_invoice->payment = $payment['payment'];
                $send_invoice->currency = $currency[0];
                $send_invoice->currency_amt = $get_currency[0];
                $send_invoice->limit = $converted_limit;
                $send_invoice->ncmv = $limit[0];
                $send_invoice->note = $threshold_type[0];
                if (empty($request)) {
                    $send_invoice->bill_month = $payment['bill_month'];
                } else {
                    $send_invoice->bill_month = $request;
                }
                $send_invoice->bill_month = $request;

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
            }else{
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
            }
        }

        foreach($uncalculated_sim_payment as $payment){
            $default_limit = 20;
            $threshold_type = 'Not in Payment Case';
            $currency = 'USD';
            $get_currency = CurrencyModel::where('currency', $currency)->pluck('amount');
            $converted_limit = $default_limit * $get_currency[0];

//            echo $payment['payment'];
            if ($payment['payment'] >= $converted_limit){
                $send_invoice = new SendInvoiceModel();
                $send_invoice->country = $payment['country'];
                $send_invoice->operator = $payment['operator'];
                $send_invoice->msisdn = $payment['prod_no'];
                $send_invoice->payment = $payment['payment'];
                $send_invoice->currency = 'USD';
                $send_invoice->currency_amt = $get_currency[0];
                $send_invoice->limit = $converted_limit;
                $send_invoice->ncmv = $default_limit;
                $send_invoice->note = $threshold_type;
                $send_invoice->iscalculated = 'UNCALCULATED';
                if (empty($request)) {
                    $send_invoice->bill_month = $payment['bill_month'];
                } else {
                    $send_invoice->bill_month = $request;
                }
                $send_invoice->bill_month = $request;

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
            }else{
                $close_payment = new ClosePaymentModel();
                $close_payment->country = $payment['country'];
                $close_payment->operator = $payment['operator'];
                $close_payment->msisdn = $payment['prod_no'];
                $close_payment->total = $payment['payment'];
                $close_payment->iscalculated = 'UNCALCULATED';
                if (empty($request)) {
                    $close_payment->bill_month = $payment['bill_month'];
                } else {
                    $close_payment->bill_month = $request;
                }

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
            }
        }

        foreach ($total_sim_payments as $payment) {
            if (in_array($payment['country'] . '_' . $payment['operator'], $higher_operators)) {

                $limit = SimThresholdModel::where('cust_urag', $payment['country'])
                    ->where('cust_name', $payment['operator'])->pluck('ncmv');
                $threshold_type = SimThresholdModel::where('cust_urag', $payment['country'])
                    ->where('cust_name', $payment['operator'])->pluck('note');
                $currency = SimThresholdModel::where('cust_urag', $payment['country'])
                    ->where('cust_name', $payment['operator'])->pluck('currency');
                $get_currency = CurrencyModel::where('currency', $currency)->pluck('amount');
                $converted_limit = $limit[0] * $get_currency[0];

                $send_invoice = new SendInvoiceModel();
                $send_invoice->country = $payment['country'];
                $send_invoice->operator = $payment['operator'];
                $send_invoice->msisdn = $payment['prod_no'];
                $send_invoice->payment = $payment['payment'];
                $send_invoice->currency = $currency[0];
                $send_invoice->currency_amt = $get_currency[0];
                $send_invoice->limit = $converted_limit;
                $send_invoice->ncmv = $limit[0];
                $send_invoice->note = $threshold_type[0];
                if (empty($request)) {
                    $send_invoice->bill_month = $payment['bill_month'];
                } else {
                    $send_invoice->bill_month = $request;
                }
                $send_invoice->bill_month = $request;

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


//        if(ClosePaymentModel::where('country', $country)
//            ->where('operator', $operator)
//            ->exists())
//        {
//            $last_discount = $isCountryInClose = ClosePaymentModel::where('country', $country)
//                ->where('operator', $operator)
//                ->pluck('total');
//            $new_discount = $last_discount[0] + $total;
//            $last_discounted_operator = ClosePaymentModel::where('country', $country)
//                ->where('operator', $operator)
//                ->pluck('id');
//            $find_last_operator = ClosePaymentModel::find($last_discounted_operator[0]);
//            $find_last_operator->total = $new_discount;
//            $find_last_operator->status = 'CONFIRMED';
//            $find_last_operator->save();
//
//            $invoice_id = SendInvoiceModel::where('country', $country)
//                ->where('operator', $operator)
//                ->where('msisdn', $msisdn)
//                ->where('payment', $total)
//                ->where('bill_month', $bill_month)
//                ->pluck('id');
//            $delete_invoice = SendInvoiceModel::find($invoice_id[0]);
//            $delete_invoice->status = 'CONFIRMED';
//            $delete_invoice->save();
//        }else {
//            $close_payment->country = $country;
//            $close_payment->operator = $operator;
//            $close_payment->msisdn = $msisdn;
//            $close_payment->total = $total;
//            $close_payment->bill_month = $bill_month;
//            $close_payment->status = 'CONFIRMED';
//            $close_payment->save();
//
//            $invoice_id = SendInvoiceModel::where('country', $country)
//                ->where('operator', $operator)
//                ->where('msisdn', $msisdn)
//                ->where('payment', $total)
//                ->where('bill_month', $bill_month)
//                ->pluck('id');
//            $delete_invoice = SendInvoiceModel::find($invoice_id[0]);
//            $delete_invoice->status = 'CONFIRMED';
//            $delete_invoice->save();
///        }
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

//        $new_total = $total - $discount;
//        $invoice_id = SendInvoiceModel::where('country', $country)
//            ->where('operator', $operator)
//            ->where('msisdn', $msisdn)
//            ->where('payment', $total)
//            ->where('bill_month', $bill_month)
//            ->pluck('id');
//
//        $send_invoice = SendInvoiceModel::find($invoice_id[0]);
//        $send_invoice->payment = $new_total;
//        $send_invoice->status = 'DISCOUNTED';
//        $send_invoice->save();
//
//        if(ClosePaymentModel::where('country', $country)
//            ->where('operator', $operator)
//            ->exists())
//        {
//            $last_discount = $isCountryInClose = ClosePaymentModel::where('country', $country)
//                ->where('operator', $operator)
//                ->pluck('total');
//            $new_discount = $last_discount[0] + $discount;
//            $last_discounted_operator = ClosePaymentModel::where('country', $country)
//                ->where('operator', $operator)
//                ->pluck('id');
//            $find_last_operator = ClosePaymentModel::find($last_discounted_operator[0]);
//            $find_last_operator->total = $new_discount;
//            $find_last_operator->save();
//        }else{
//            $close_payment->country = $country;
//            $close_payment->operator = $operator;
//            $close_payment->msisdn = $msisdn;
//            $close_payment->total = $discount;
//            $close_payment->bill_month = $bill_month;
//            $close_payment->status = 'DISCOUNTED';
//            $close_payment->save();
//        }
//
//
//        $isCountryInClose = ClosePaymentModel::where('country', $country)
//            ->where('operator', $operator)
//            ->pluck('id');
//            $last_discount = $isCountryInClose = ClosePaymentModel::where('country', $country)
//                ->where('operator', $operator)
//                ->pluck('total');
////            $new_discount = $discount + $last_discount[0];
////            $close_payment = ClosePaymentModel::find($isCountryInClose[0]);
////            $close_payment->total = $new_discount;
////            $close_payment->save();
    }

    function show(Request $request)
    {
        $partner_info = [];
        $sum_amt = 0;
        $limit = 0;
        if ($request->input('action') == 'InvoicePDF') {

            $country = $request->input('country');
            $operator = $request->input('operator');
            $limit = $request->input('limit');

            $isPartnerRegistered = PartnerInformationModel::where('country', strtoupper($country))
                ->where('partner_name', strtoupper($operator))->count();
            if ($isPartnerRegistered == 0) {
                echo "
<script>alert('Энэ partner-ийн мэдээлэл байхгүй байна. Мэдээллийг нэмнэ үү');</script>

                    <script>window.location.href='/invoice/partner_information/add;
                        </script>";
            } else {
                $partner_info = PartnerInformationModel::where('country', strtoupper($country))
                    ->where('partner_name', strtoupper($operator))->get();
                $sum_amt = SendInvoiceModel::where('country', strtoupper($country))
                    ->where('operator', strtoupper($operator))
                    ->groupBy('country')
                    ->groupBy('operator')
                    ->sum('payment');
            }
        }
        $year_date = $request->input('year_date');

        if(date('d') < 10){
            $currentMonth = intval(date('Ym', strtotime("-2 month")));
        }else{
            $currentMonth = intval(date('Ym', strtotime("-1 month")));
        }

        if (empty($year_date)) {
            $year_date = $currentMonth;
        }

        $this->store($year_date);

        $close_payment = ClosePaymentModel::where('bill_month', $year_date)->get();
        $send_invoice = SendInvoiceModel::where('bill_month', $year_date)
            ->where(function ($query) {
                $query->where('status', null)
                    ->Orwhere('status', 'DISCOUNTED');
            })
            ->orderBy('operator')
            ->get();
//        $group_invoice = $this->sum_total_payments($send_invoice);
//        $total_invoice_list = [];
//        foreach ($group_invoice as $item) {
//            $limit = SimThresholdModel::where('cust_urag', $item['country'])
//                ->where('cust_name', $item['operator'])->pluck('ncmv');
//            $currency = SimThresholdModel::where('cust_urag', $item['country'])
//                ->where('cust_name', $item['operator'])->pluck('currency');
//            $get_currency = CurrencyModel::where('currency', $currency)->pluck('amount');
//            $converted_limit = $limit[0] * $get_currency[0];
//            $item['limit'] = $converted_limit;
////            print_r($item);
//            array_push($total_invoice_list, [
//                'country' => $item['country'],
//                'operator' => $item['operator'],
//                'payment' => $item['payment'],
//                'bill_month' => $item['bill_month'],
//                'limit' => $item['limit']
//            ]);
//        }
//        foreach ($total_invoice_list as $item){
//            print_r($item);
//        }

        return view('partner_invoice',
            [
                'close_payment' => $close_payment,
                'send_invoice' => $send_invoice,
//                'total_invoice_list' => $total_invoice_list,
                'year_date' => $year_date,
                'current_month' => $currentMonth,
                'partner_info' => $partner_info,
                'sum_amount' => $sum_amt,
                'limit' => $limit
            ]
        );
    }


}
