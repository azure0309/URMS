<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Datatables;
use App\outbound_nrt;
use App\outbound_tap;
use App\inbound_nrt;
use App\inbound_tap;
use App\reference;
use App\stp_transaction;
use App\reference_rp_history;
use DB;
class DBQueryController extends Controller
{
          public function out_nrt_show(Request $request)
          {

              $outbound_nrt = outbound_nrt::select([
                                    'CDR_FILE_NAME',
                                    'PROCESSED_TIME',
                                    'BC_CS_IMSI',
                                    'BC_CS_MSISDN',
                                    'BC_DS_CALLED_NUMBER',
                                    'BC_CO_CALLING_NUMBER',
                                    'BC_DS_DIALLED_DIGITS',
                                    'BC_CES_LOCAL_TSTAMP',
                                    'BC_CES_UTC_TOFFSET',
                                    'BC_TOTAL_CALL_EVENT_DURATION',
                                    'LC_NL_REC_ENTITY_CODE',
                                    'EI_IMEI',
                                    'SU_BS_SC_TELE_SVC_CODE',
                                    'SU_CH_CD_CHARGE'
              ]);

          return DataTables::of($outbound_nrt)
                      ->filterColumn('name', function($query, $keyword) {
                          $sql = "name  like ?";
                          $query->whereRaw($sql, ["%{$keyword}%"]);
                      })
                      ->toJson();
          }
          public function out_tap_show(Request $request)
          {

              $outbound_tap = outbound_tap::select([
                                  'SUBSCRIPTION_KEY',
                                  'CDR_SEQ_NUMBER',
                                  'PROD_NO',
                                  'USE_STRT_DTTM',
                                  'CDR_KD_CD',
                                  'CALLING_NO',
                                  'USE_TRGT_NO',
                                  'MCO_CD',
                                  'USE_SEC',
                                  'USE_BYTE',
                                  'TOT_MGCV_USE_QTY',
                                  'TOT_RTNG_AMT',
                                  'BILL_MARK_ID',
                                  'UPLOAD_USE_BYTE',
                                  'DOWNLOAD_USE_BYTE',
                                  'MPS_SWTCH_CD',
                                  'ROAMING_TYPE',
                                  'RTNG_CREATION_DTTM'
              ]);

          return DataTables::of($outbound_tap)
                      ->filterColumn('name', function($query, $keyword) {
                          $sql = "name  like ?";
                          $query->whereRaw($sql, ["%{$keyword}%"]);
                      })
                      ->toJson();
          }
          public function in_nrt_show(Request $request)
          {

              $inbound_nrt = inbound_nrt::select([
                                      'PROD_NO',
                                      'USE_STRT_DTTM',
                                      'ICHR_NO',
                                      'INCMG_NO',
                                      'IMSI_NO',
                                      'PROD_CD',
                                      'CALLING_NO',
                                      'MCN_NO',
                                      'USE_SEC',
                                      'USE_BYTE',
                                      'TOT_MGCV_USE_QTY',
                                      'TOT_RTNG_AMT',
                                      'SYS_CREATION_DATE',
                                      'LOCATION_INFO',
                                      'RTNG_CREATION_DTTM',
                                      'UPLOAD_USE_BYTE',
                                      'DOWNLOAD_USE_BYTE',
                                      'SGSN_ADDRESS',
                                      'RECIPIENT',
                                      'NRT_FILE_SEQ_NUM',
                                      'SERVICE_TYPE',
                                      'CDR_SEQ_NUMBER'
              ]);

          return DataTables::of($inbound_nrt)
                      ->filterColumn('name', function($query, $keyword) {
                          $sql = "name  like ?";
                          $query->whereRaw($sql, ["%{$keyword}%"]);
                      })
                      ->toJson();
          }
          public function in_tap_show(Request $request)
          {
            $start_date = $request->input('start_date');
            $end_date = $request->input('end_date');
            $from = date($start_date);
            $to = date($end_date);
            // return $from . " " . $to;
              $inbound_tap = inbound_tap::select([
                                  'SUBSCRIPTION_KEY',
                                  'PROD_NO',
                                  'ICHR_NO',
                                  'INCMG_NO',
                                  'IMSI_NO',
                                  'PROD_CD',
                                  'CALLING_NO',
                                  'USE_SEC',
                                  'USE_BYTE',
                                  'TOT_MGCV_USE_QTY',
                                  'TOT_RTNG_AMT',
                                  'LOCATION_INFO',
                                  'USE_STRT_DTTM',
                                  'RTNG_CREATION_DTTM',
                                  'UPLOAD_USE_BYTE',
                                  'DOWNLOAD_USE_BYTE',
                                  'SGSN_ADDRESS',
                                  'GGSN_ADDRESS',
                                  'RECIPIENT',
                                  'TAP_FILE_SEQ_NUM',
                                  'RAP_FILE_SEQ_NUM',
                                  'NRT_FILE_SEQ_NUM'
              ])->whereBetween('CALL_DTL_CORR_YMD', [$from, $to]);


          return DataTables::of($inbound_tap)
                      ->filterColumn('name', function($query, $keyword) {
                          $sql = "name  like ?";
                          $query->whereRaw($sql, ["%{$keyword}%"]);
                      })
                      ->toJson();
          }
          public function stp_transaction_show(Request $request)
          {
              $start_date = $request->input('start_date');
              $end_date = $request->input('end_date');
              $stp_transaction = stp_transaction::select([
                                    // 'COUNTRY',
                                    // 'OPERATOR',
                                    'TADIG',
                                    // 'IMSI_GT',
                                    // 'GT_PREFIX',
                                    // 'TIME_ZONE',
                                    // 'PRIORITY',
                                    'REGDATE',
                                    'RECVTIME',
                                    'OTID',
                                    'DTID',
                                    'OPC',
                                    'DPC',
                                    'CALLINGSSN',
                                    'CALLINGGT',
                                    'CALLEDSSN',
                                    'CALLEDGT',
                                    'OPNAME',
                                    'OPRESULT',
                                    'OPERROR',
                                    'IMSI',
                                    'MSISDN',
                                    'VLR',
                                    'HLR',
                                    'MSC',
                                    'SGSN',
                                    'OPCODE',
                                    'OPERROR1',
                                    'BARRING',
                                    'SCADDR',
                                    'DESTADDR',
                                    'ORIGADDR',
                                    'INBOUND',
                                    'OCS'
              ])->whereBetween('regdate', [$start_date, $end_date]);

          return DataTables::of($stp_transaction)
                      ->filterColumn('name', function($query, $keyword) {
                          $sql = "name  like ?";
                          $query->whereRaw($sql, ["%{$keyword}%"]);
                      })
                      ->toJson();
          }
          public function reference_rp_history_show(Request $request)
          {

              $reference_rp_history = reference_rp_history::select([
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

          return DataTables::of($reference_rp_history)
                      ->filterColumn('name', function($query, $keyword) {
                          $sql = "name  like ?";
                          $query->whereRaw($sql, ["%{$keyword}%"]);
                      })->addColumn('action', function ($reference_rp_history) {
                      return '<a href="#" id="'.$reference_rp_history->tadig.'" class="btn btn-danger btn-xs reference-edit" data-toggle="modal" data-target="#reference-edit">
                                <i class="glyphicon glyphicon-edit"></i>Edit</a>';
                      })
                      ->toJson();
          }
          public function reference_rp_history_edit(Request $request)
          {
                    $tadig = $request->input('tadig');
                    $data = reference_rp_history::find($tadig);
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
                          'node_gt' => $data->node_gt
                    );
                    echo json_encode($output);
          }
          public function reference_rp_history_update(Request $request)
          {
            $tadig = $request->input('tadig');
            // DB::statement("INSERT INTO REFERENCE_RP_HISTORY SELECT * FROM REFERENCE_RP_CURRENT where TADIG = '$tadig'");
            if ($request->input('status') == 'Active') {
                    $data = new Reference;
                    $data->continent             = $request->input('continent');
                    $data->country               = $request->input('country');
                    $data->operator              = $request->input('operator');
                    $data->tadig                 = $request->input('tadig');
                    $data->priority              = $request->input('priority');
                    $data->gt_prefix             = $request->input('gt_prefix');
                    $data->imsi_gt               = $request->input('imsi_gt');
                    $data->node_gt               = $request->input('node_gt');
                    $data->time_zone             = $request->input('time_zone');
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
                  return redirect('reference-rp-history');
            }
            else {
              reference_rp_history::where('tadig', $tadig)
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
                        return redirect('reference-rp-history');
              }
          }
}
