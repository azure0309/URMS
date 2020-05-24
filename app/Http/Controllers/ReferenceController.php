<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Datatables;
use App\reference;
use App\threshold;
use App\vip_subscriber;
use App\reference_rp_history;
use DB;
class ReferenceController extends Controller
{
      public function reference_show(Request $request)
      {

          $reference = Reference::select([
                          'CONTINENT',
                          'COUNTRY',
                          'OPERATOR',
                          'TADIG',
                          'IMSI_GT',
                          'GT_PREFIX',
                          'TIME_ZONE',
                          'PRIORITY',
                          'GSM',
                          'GSM_LAUNCH_DATE_IN',
                          'GSM_LAUNCH_DATE_OUT',
                          'GPRS',
                          'GPRS_LAUNCH_DATE_IN',
                          'GPRS_LAUNCH_DATE_OUT',
                          'CAMEL',
                          'CAMEL_LAUNCH_DATE_IN',
                          'CAMEL_LAUNCH_DATE_OUT',
                          'LTE',
                          'LTE_LAUNCH_DATE_IN',
                          'LTE_LAUNCH_DATE_OUT',
                          'NRT',
                          'NRT_LAUNCH_DATE_IN',
                          'NRT_LAUNCH_DATE_OUT',
                          'DIRECTION',
                          'AGREEMENT',
                          'MEMO',
                          'MEMO_DATE',
                          'STATUS',
                          'STATUS_DATE',
                          'TAP_SEQ',
                          'TAP_SEQ_IN',
                          'NODE_GT'
          ]);

      return DataTables::of($reference)
                  ->filterColumn('name', function($query, $keyword) {
                      $sql = "name  like ?";
                      $query->whereRaw($sql, ["%{$keyword}%"]);
                  })->addColumn('action', function ($reference) {
                  return '<a href="#" id="'.$reference->tadig.'" class="btn btn-danger btn-xs fa fa-pencil-square-o reference-edit" data-toggle="modal" data-target="#reference-edit"> edit</a>
                          <a href="#" id="'.$reference->tadig.'" class="btn btn-danger btn-xs fa fa-times reference-delete" data-toggle="modal" data-target="#reference-delete"> delete</a>';
                  })
                  ->toJson();
      }
      public function reference_store(Request $request)
      {
          $this->validate($request, [
            'country' => 'required',
            'operator' => 'required',
            'tadig' => 'required',
            'priority' => 'required'
          ]);
          if ($request->input('status') == 'Inactive') {
            $data = new reference_rp_history;
            $data->continent             = $request->input('continent');
            $data->country               = $request->input('country');
            $data->operator              = $request->input('operator');
            $data->tadig                 = $request->input('tadig');
            $data->priority              = $request->input('priority');
            $data->gt_prefix             = $request->input('gt_prefix');
            $data->imsi_gt               = $request->input('imsi_gt');
            $data->node_gt               = $request->input('node_gt');
            $data->time_zone             = $request->input('timezone');
            $data->gsm                   = $request->input('gsm');
            $data->gsm_launch_date_in    = $request->input('gsm_launch_date_in');
            $data->gsm_launch_date_out   = $request->input('gsm_launch_date_out');
            $data->gprs                  = $request->input('gprs');
            $data->gprs_launch_date_in   = $request->input('gprs_launch_date_in');
            $data->gprs_launch_date_out  = $request->input('gprs_launch_date_out');
            $data->camel                 = $request->input('camel');
            $data->camel_launch_date_in  = $request->input('camel_launch_date_in');
            $data->camel_launch_date_out = $request->input('camel_launch_date_out');
            $data->lte                   = $request->input('lte');
            $data->lte_launch_date_in    = $request->input('lte_launch_date_in');
            $data->lte_launch_date_out   = $request->input('lte_launch_date_out');
            $data->nrt                   = $request->input('nrt');
            $data->nrt_launch_date_in    = $request->input('nrt_launch_date_in');
            $data->nrt_launch_date_out   = $request->input('nrt_launch_date_out');
            $data->direction             = $request->input('direction');
            $data->agreement             = $request->input('agreement');
            $data->memo                  = $request->input('memo');
            $data->memo_date             = $request->input('memo_date');
            $data->status                = $request->input('status');
            $data->status_date           = date("Y/m/d");
            $data->tap_seq               = null;
            $data->tap_seq_in            = null;
            $data->save();
          }
          else {
            $data = new Reference;
            $data->continent             = $request->input('continent');
            $data->country               = $request->input('country');
            $data->operator              = $request->input('operator');
            $data->tadig                 = $request->input('tadig');
            $data->priority              = $request->input('priority');
            $data->gt_prefix             = $request->input('gt_prefix');
            $data->imsi_gt               = $request->input('imsi_gt');
            $data->node_gt               = $request->input('node_gt');
            $data->time_zone             = $request->input('timezone');
            $data->gsm                   = $request->input('gsm');
            $data->gsm_launch_date_in    = $request->input('gsm_launch_date_in');
            $data->gsm_launch_date_out   = $request->input('gsm_launch_date_out');
            $data->gprs                  = $request->input('gprs');
            $data->gprs_launch_date_in   = $request->input('gprs_launch_date_in');
            $data->gprs_launch_date_out  = $request->input('gprs_launch_date_out');
            $data->camel                 = $request->input('camel');
            $data->camel_launch_date_in  = $request->input('camel_launch_date_in');
            $data->camel_launch_date_out = $request->input('camel_launch_date_out');
            $data->lte                   = $request->input('lte');
            $data->lte_launch_date_in    = $request->input('lte_launch_date_in');
            $data->lte_launch_date_out   = $request->input('lte_launch_date_out');
            $data->nrt                   = $request->input('nrt');
            $data->nrt_launch_date_in    = $request->input('nrt_launch_date_in');
            $data->nrt_launch_date_out   = $request->input('nrt_launch_date_out');
            $data->direction             = $request->input('direction');
            $data->agreement             = $request->input('agreement');
            $data->memo                  = $request->input('memo');
            $data->memo_date             = $request->input('memo_date');
            $data->status                = $request->input('status');
            $data->status_date           = date("Y/m/d");
            $data->tap_seq               = null;
            $data->tap_seq_in            = null;
//            $data->iso_code              = null;
            $data->save();
          }
      }
      public function reference_edit(Request $request)
      {
        $tadig = $request->input('tadig');
        $data = Reference::find($tadig);
        $output = array(
              'continent' => $data->continent,
              'country' => $data->country,
              'operator' => $data->operator,
              'tadig' => $data->tadig,
              'imsi_gt' => $data->imsi_gt,
              'gt_prefix' => $data->gt_prefix,
              'time_zone' => $data->time_zone,
              'priority' => $data->priority,
              'gsm' => $data->gsm,
              'gsm_launch_date_in' => $data->gsm_launch_date_in,
              'gsm_launch_date_out' => $data->gsm_launch_date_out,
              'gprs' => $data->gprs,
              'gprs_launch_date_in' => $data->gprs_launch_date_in,
              'gprs_launch_date_out' => $data->gprs_launch_date_out,
              'camel' => $data->camel,
              'camel_launch_date_in' => $data->camel_launch_date_in,
              'camel_launch_date_out' => $data->camel_launch_date_out,
              'lte' => $data->lte,
              'lte_launch_date_in' => $data->lte_launch_date_in,
              'lte_launch_date_out' => $data->lte_launch_date_out,
              'nrt' => $data->nrt,
              'nrt_launch_date_in' => $data->nrt_launch_date_in,
              'nrt_launch_date_out' => $data->nrt_launch_date_out,
              'direction' => $data->direction,
              'agreement' => $data->agreement,
              'memo' =>  $data->memo,
              'memo_date' =>  $data->memo_date,
              'status' => $data->status,
              'status_date' => $data->status_date,
              'tap_seq' => $data->tap_seq,
              'tap_seq_in' => $data->tap_seq_in,
              'node_gt' => $data->node_gt,
//              'iso_code' => $data->isocode
        );
        echo json_encode($output);
      }
      public function reference_current($request)
      {
        $tadig = $request->input('tadig');
        Reference::where('tadig', $tadig)
            ->update(['continent' => $request->input('continent'),
                      'country' => $request->input('country'),
                      'operator' => $request->input('operator'),
                      'tadig' => $request->input('tadig'),
                      'imsi_gt' => $request->input('imsi_gt'),
                      'gt_prefix' => $request->input('gt_prefix'),
                      'time_zone' => $request->input('time_zone'),
                      'priority' => $request->input('priority'),
                      'gsm' => $request->input('gsm'),
                      'gsm_launch_date_in' => $request->input('gsm_launch_date_in'),
                      'gsm_launch_date_out' => $request->input('gsm_launch_date_out'),
                      'gprs' => $request->input('gprs'),
                      'gprs_launch_date_in' => $request->input('gprs_launch_date_in'),
                      'gprs_launch_date_out' => $request->input('gprs_launch_date_out'),
                      'camel' => $request->input('camel'),
                      'camel_launch_date_in' => $request->input('camel_launch_date_in'),
                      'camel_launch_date_out' => $request->input('camel_launch_date_out'),
                      'lte' => $request->input('lte'),
                      'lte_launch_date_in' => $request->input('lte_launch_date_in'),
                      'lte_launch_date_out' => $request->input('lte_launch_date_out'),
                      'nrt' => $request->input('nrt'),
                      'nrt_launch_date_in' => $request->input('nrt_launch_date_in'),
                      'nrt_launch_date_out' => $request->input('nrt_launch_date_out'),
                      'direction' => $request->input('direction'),
                      'agreement' => $request->input('agreement'),
                      'memo' =>  $request->input('memo'),
                      'memo_date' =>  $request->input('memo_date'),
                      'status' => $request->input('status'),
                      'status_date' => $request->input('status_date'),
                      'tap_seq' => $request->input('tap_seq'),
                      'tap_seq_in' => $request->input('tap_seq_in'),
                      'node_gt' => $request->input('node_gt')]);
                  return redirect('reference-rp');
      }
      public function reference_history($request)
      {
        $tadig = $request->input('tadig');
//        DB::statement("INSERT INTO REFERENCE_RP_HISTORY SELECT * FROM REFERENCE_RP_CURRENT where TADIG = '$tadig'");
//        reference_rp_history::where('tadig', $tadig)->update(['status' => 'Inactive']);
        Reference::where('tadig', $tadig)
            ->update(['continent' => $request->input('continent'),
                      'country' => $request->input('country'),
                      'operator' => $request->input('operator'),
                      'tadig' => $request->input('tadig'),
                      'imsi_gt' => $request->input('imsi_gt'),
                      'gt_prefix' => $request->input('gt_prefix'),
                      'time_zone' => $request->input('time_zone'),
                      'priority' => $request->input('priority'),
                      'gsm' => $request->input('gsm'),
                      'gsm_launch_date_in' => $request->input('gsm_launch_date_in'),
                      'gsm_launch_date_out' => $request->input('gsm_launch_date_out'),
                      'gprs' => $request->input('gprs'),
                      'gprs_launch_date_in' => $request->input('gprs_launch_date_in'),
                      'gprs_launch_date_out' => $request->input('gprs_launch_date_out'),
                      'camel' => $request->input('camel'),
                      'camel_launch_date_in' => $request->input('camel_launch_date_in'),
                      'camel_launch_date_out' => $request->input('camel_launch_date_out'),
                      'lte' => $request->input('lte'),
                      'lte_launch_date_in' => $request->input('lte_launch_date_in'),
                      'lte_launch_date_out' => $request->input('lte_launch_date_out'),
                      'nrt' => $request->input('nrt'),
                      'nrt_launch_date_in' => $request->input('nrt_launch_date_in'),
                      'nrt_launch_date_out' => $request->input('nrt_launch_date_out'),
                      'direction' => $request->input('direction'),
                      'agreement' => $request->input('agreement'),
                      'memo' =>  $request->input('memo'),
                      'memo_date' =>  $request->input('memo_date'),
                      'status' => $request->input('status'),
                      'status_date' => $request->input('status_date'),
                      'tap_seq' => $request->input('tap_seq'),
                      'tap_seq_in' => $request->input('tap_seq_in'),
                      'node_gt' => $request->input('node_gt')]);
                  return redirect('reference-rp');
      }
      public function reference_update(Request $request)
      {
        $tadig = $request->input('tadig');
        $result = Reference::where('tadig', $tadig)->get();
        foreach($result as $data){
            if ($data->continent != $request->input('continent') && $data->continent != null) {
                  $this->reference_history($request);
            }
            elseif ($data->country != $request->input('country') && $data->country != null) {
                  $this->reference_history($request);
            }
            elseif ($data->operator != $request->input('operator') && $data->operator != null) {
                  $this->reference_history($request);
            }
            elseif ($data->tadig != $request->input('tadig') && $data->tadig != null) {
                  $this->reference_history($request);
            }
            elseif ($data->imsi_gt != $request->input('imsi_gt') && $data->imsi_gt != null) {
                  $this->reference_history($request);
            }
            elseif ($data->gt_prefix != $request->input('gt_prefix') && $data->gt_prefix != null) {
                  $this->reference_history($request);
            }
            elseif ($data->time_zone != $request->input('time_zone') && $data->time_zone != null) {
                  $this->reference_history($request);
            }
            elseif ($data->priority != $request->input('priority') && $data->priority != null) {
                  $this->reference_history($request);
            }
            elseif ($data->gsm != $request->input('gsm') && $data->gsm != null) {
                  $this->reference_history($request);
            }
            elseif ($data->gsm_launch_date_in != $request->input('gsm_launch_date_in') && $data->gsm_launch_date_in != null) {
                  $this->reference_history($request);
            }
            elseif ($data->gsm_launch_date_out != $request->input('gsm_launch_date_out') && $data->gsm_launch_date_out != null) {
                  $this->reference_history($request);
            }
            elseif ($data->gprs != $request->input('gprs') && $data->gprs != null) {
                  $this->reference_history($request);
            }
            elseif ($data->gprs_launch_date_in != $request->input('gprs_launch_date_in') && $data->gprs_launch_date_in != null) {
                  $this->reference_history($request);
            }
            elseif ($data->gprs_launch_date_out != $request->input('gprs_launch_date_out') && $data->gprs_launch_date_out != null) {
                  $this->reference_history($request);
            }
            elseif ($data->camel != $request->input('camel') && $data->camel != null) {
                  $this->reference_history($request);
            }
            elseif ($data->camel_launch_date_in != $request->input('camel_launch_date_in') && $data->camel_launch_date_in != null) {
                  $this->reference_history($request);
            }
            elseif ($data->camel_launch_date_out != $request->input('camel_launch_date_out') && $data->camel_launch_date_out != null) {
                  $this->reference_history($request);
            }
            elseif ($data->lte != $request->input('lte') && $data->lte != null) {
                  $this->reference_history($request);
            }
            elseif ($data->lte_launch_date_in != $request->input('lte_launch_date_in') && $data->lte_launch_date_in != null) {
                  $this->reference_history($request);
            }
            elseif ($data->lte_launch_date_out != $request->input('lte_launch_date_out') && $data->lte_launch_date_out != null) {
                  $this->reference_history($request);
            }
            elseif ($data->nrt != $request->input('nrt') && $data->nrt != null) {
                  $this->reference_history($request);
            }
            elseif ($data->nrt_launch_date_in != $request->input('nrt_launch_date_in') && $data->nrt_launch_date_in != null) {
                  $this->reference_history($request);
            }
            elseif ($data->nrt_launch_date_out != $request->input('nrt_launch_date_out') && $data->nrt_launch_date_out != null) {
                  $this->reference_history($request);
            }
            elseif ($data->direction != $request->input('direction') && $data->direction != null) {
                  $this->reference_history($request);
            }
            elseif ($data->agreement != $request->input('agreement') && $data->agreement != null) {
                  $this->reference_history($request);
            }
            elseif ($data->memo != $request->input('memo') && $data->memo != null) {
                  $this->reference_history($request);
            }
            elseif ($data->memo_date != $request->input('memo_date') && $data->memo_date != null) {
                  $this->reference_history($request);
            }
            elseif ($data->status != $request->input('status') && $data->status != null) {
                  $this->reference_history($request);
            }
            elseif ($data->node_gt != $request->input('node_gt') && $data->node_gt != null) {
                  $this->reference_history($request);
            }
            else {
                  $this->reference_current($request);
            }
          }
      }
      public function reference_delete(Request $request)
      {
        $tadig = $request->input('tadig');
//        DB::statement("INSERT INTO REFERENCE_RP_HISTORY SELECT * FROM REFERENCE_RP_CURRENT where TADIG = '$tadig'");
//        reference_rp_history::where('tadig', $tadig)->update(['status' => 'Inactive']);
        Reference::where('tadig', $tadig)->delete();
      }
      public function threshold_show(Request $request)
      {

          $threshold = Threshold::select([
                            'GROUP_ID',
                            'VOICE_CHARGE',
                            'SMS_CHARGE',
                            'DATA_CHARGE',
                            'CHARGE_SUMMERY',
                            'RATE_SUM_SC',
                            'IN_CHARGE_SUM',
                            'IN_RATE_SUM',
                            'VOICE_DUR_RATE',
                            'SMS_COUNT_RATE',
                            'DATA_USAGE_RATE',
                            'VOICE_USAGE',
                            'SMS_USAGE',
                            'DATA_USAGE',
                            'MOC_COUNT',
                            'MTC_COUNT',
                            'SMS_COUNT',
                            'DATA_COUNT',
                            'VOICE_CHECK_DTIME',
                            'SMS_CHECK_DTIME',
                            'GPRS_CHECK_DTIME',
                            'LTE_CHECK_DTIME',
                            'VOICE_CHECK_NTIME',
                            'SMS_CHECK_NTIME',
                            'GPRS_CHECK_NTIME',
                            'LTE_CHECK_NTIME',
                            'VOICE_CHECK_24H',
                            'SMS_CHECK_24H',
                            'GPRS_CHECK_24H',
                            'LTE_CHECK_24H',
                            'SUCCESS_RATE_DTIME',
                            'SUCCESS_RATE_NTIME',
                            'KPI_CHECK_5M',
                            'KPI_CHECK_1H',
                            'KPI_CHECK24H'
          ]);

      return DataTables::of($threshold)
                  ->filterColumn('name', function($query, $keyword) {
                      $sql = "name  like ?";
                      $query->whereRaw($sql, ["%{$keyword}%"]);
                  })->addColumn('action', function ($threshold) {
                  return '<a href="#" id="'.$threshold->group_id.'" class="btn btn-danger btn-xs threshold-edit fa fa-pencil-square-o" data-toggle="modal" data-target="#threshold-edit">  edit</a>';
                  })
                  ->toJson();
      }
      public function threshold_edit(Request $request)
      {
        $group_id = $request->input('group_id');
        $data = Threshold::find($group_id);
        $output = array(
                            'voice_charge' => $data->voice_charge,
                            'sms_charge' => $data->sms_charge,
                            'data_charge' => $data->data_charge,
                            'charge_summery' => $data->charge_summery,
                            'rate_sum_sc' => $data->rate_sum_sc,
                            'in_charge_sum' => $data->in_charge_sum,
                            'in_rate_sum' => $data->in_rate_sum,
                            'voice_dur_rate' => $data->voice_dur_rate,
                            'sms_count_rate' => $data->sms_count_rate,
                            'data_usage_rate' => $data->data_usage_rate,
                            'voice_usage' => $data->voice_usage,
                            'sms_usage' => $data->sms_usage,
                            'data_usage' => $data->data_usage,
                            'moc_count' => $data->moc_count,
                            'mtc_count' => $data->mtc_count,
                            'sms_count' => $data->sms_count,
                            'data_count' => $data->data_count,
                            'voice_check_dtime' => $data->voice_check_dtime,
                            'sms_check_dtime' => $data->sms_check_dtime,
                            'gprs_check_dtime' => $data->gprs_check_dtime,
                            'lte_check_dtime' => $data->lte_check_dtime,
                            'voice_check_ntime' => $data->voice_check_ntime,
                            'sms_check_ntime' => $data->sms_check_ntime,
                            'gprs_check_ntime' => $data->gprs_check_ntime,
                            'lte_check_ntime' => $data->lte_check_ntime,
                            'voice_check_24h' => $data->voice_check_24h,
                            'sms_check_24h' => $data->sms_check_24h,
                            'gprs_check_24h' => $data->gprs_check_24h,
                            'lte_check_24h' => $data->lte_check_24h,
                            'success_rate_dtime' => $data->success_rate_dtime,
                            'success_rate_ntime' => $data->success_rate_ntime,
                            'kpi_check_5m' => $data->kpi_check_5m,
                            'kpi_check_1h' => $data->kpi_check_1h,
                            'kpi_check24h' => $data->kpi_check24h
                        );
        echo json_encode($output);
      }
      public function threshold_update(Request $request)
      {
        $group_id = $request->input('group_id');
        Threshold::where('group_id', $group_id)
            ->update(['voice_charge' =>       $request->input('voice_charge'),
                      'sms_charge' =>         $request->input('sms_charge'),
                      'data_charge' =>        $request->input('data_charge'),
                      'charge_summery' =>     $request->input('charge_summery'),
                      'rate_sum_sc' =>        $request->input('rate_sum_sc'),
                      'in_charge_sum' =>      $request->input('in_charge_sum'),
                      'in_rate_sum' =>        $request->input('in_rate_sum'),
                      'voice_dur_rate' =>     $request->input('voice_dur_rate'),
                      'sms_count_rate' =>     $request->input('sms_count_rate'),
                      'data_usage_rate' =>    $request->input('data_usage_rate'),
                      'voice_usage' =>        $request->input('voice_usage'),
                      'sms_usage' =>          $request->input('sms_usage'),
                      'data_usage' =>         $request->input('data_usage'),
                      'moc_count' =>          $request->input('moc_count'),
                      'mtc_count' =>          $request->input('mtc_count'),
                      'sms_count' =>          $request->input('sms_count'),
                      'data_count' =>         $request->input('data_count'),
                      'voice_check_dtime' =>  $request->input('voice_check_dtime'),
                      'sms_check_dtime' =>    $request->input('sms_check_dtime'),
                      'gprs_check_dtime' =>   $request->input('gprs_check_dtime'),
                      'lte_check_dtime' =>    $request->input('lte_check_dtime'),
                      'voice_check_ntime' =>  $request->input('voice_check_ntime'),
                      'sms_check_ntime' =>    $request->input('sms_check_ntime'),
                      'gprs_check_ntime' =>   $request->input('gprs_check_ntime'),
                      'lte_check_ntime' =>    $request->input('lte_check_ntime'),
                      'voice_check_24h' =>    $request->input('voice_check_24h'),
                      'sms_check_24h' =>      $request->input('sms_check_24h'),
                      'gprs_check_24h' =>     $request->input('gprs_check_24h'),
                      'lte_check_24h' =>      $request->input('lte_check_24h'),
                      'success_rate_dtime' => $request->input('success_rate_dtime'),
                      'success_rate_ntime' => $request->input('success_rate_ntime'),
                      'kpi_check_5m' =>       $request->input('kpi_check_5m'),
                      'kpi_check_1h' =>       $request->input('kpi_check_1h'),
                      'kpi_check24h' =>       $request->input('kpi_check24h')]);
                return redirect('threshold');
      }
      public function vip_sub_store(Request $request)
      {
          $this->validate($request, [
            'msisdn' => 'required',
            'imsi' => 'required'
          ]);
          $data = new vip_subscriber;
          $data->prod_no = $request->input('msisdn');
          $data->imsi_no = $request->input('imsi');
          $data->save();
      }
      public function vip_sub_show(Request $request)
      {

          $vip_subscriber = vip_subscriber::select([
                            'PROD_NO',
                            'IMSI_NO',
          ]);

      return DataTables::of($vip_subscriber)
                  ->filterColumn('name', function($query, $keyword) {
                      $sql = "name  like ?";
                      $query->whereRaw($sql, ["%{$keyword}%"]);
                  })->addColumn('action', function ($vip_subscriber) {
                  return '<a href="#" id="'.$vip_subscriber->prod_no.'" class="btn btn-danger btn-xs vip-edit fa fa-pencil-square-o" data-toggle="modal" data-target="#vip-sub-edit"> edit</a>
                            <a href="#" id="'.$vip_subscriber->prod_no.'" class="btn btn-danger btn-xs vip-delete fa fa-times" data-toggle="modal" data-target="#vip-sub-delete"> delete</a>';
                  })
                  ->toJson();
      }
      public function vip_sub_edit(Request $request)
      {
        $msisdn = $request->input('msisdn');
        $data = vip_subscriber::find($msisdn);
        $output = array('imsi' => $data->imsi_no);
        echo json_encode($output);
      }
      public function vip_sub_update(Request $request)
      {
        $this->validate($request, [
          'msisdn' => 'required',
          'imsi' => 'required'
        ]);
        $msisdn = $request->input('msisdn');
        // $data = vip_subscriber::find($msisdn);
        // $data->imsi_no = $request->input('imsi');
        // $data->save();
        vip_subscriber::where('prod_no', $msisdn)
            ->update(['imsi_no' => $request->input('imsi')]);

      }
      public function vip_sub_delete(Request $request)
      {
        $msisdn = $request->input('msisdn');
        // $data = vip_subscriber::find($msisdn);
        // $data->delete();
        vip_subscriber::where('prod_no', $msisdn)->delete();
      }
}
