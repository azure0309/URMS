<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Datatables;
use App\t_status;
use App\t_service_attempt;
use App\t_status_per_imsi;
use App\stp_transaction;
use App\reference;
use App\roaming_active_user;
use DB;
class SubAnalysisController extends Controller
{
  public function sub_location_status(Request $request)
  {
      $imsi = $request->input('imsi');
      $date = date("Ymdhis");
      $data = DB::table('T_ROAMING_ACTIVE_USERS')->select('ATTACHTIME','COUNTRY','OPERATOR')
                  ->where('imsi',$imsi)
                  ->join('REFERENCE_RP_CURRENT', 'T_ROAMING_ACTIVE_USERS.TADIG', '=', 'REFERENCE_RP_CURRENT.TADIG')
                  ->orderBy('ATTACHTIME', 'desc')->where('ATTACHTIME', '>', $date)->first();
      return json_encode($data);

      // return $date;
  }
  public function network_time_breakdown(Request $request)
  {
      $imsi = $request->input('imsi');
      $date = date("Ymdhis");
      $data = DB::table('T_ROAMING_ACTIVE_USERS')->select('ATTACHTIME','DETACHTIME','OPERATOR')
                  ->where('imsi',$imsi)
                  ->join('REFERENCE_RP_CURRENT', 'T_ROAMING_ACTIVE_USERS.TADIG', '=', 'REFERENCE_RP_CURRENT.TADIG')->where('ATTACHTIME', '>', $date)->get();
      // $data = DB::statement("select ATTACHTIME, DETACHTIME, OPERATOR from T_ROAMING_ACTIVE_USERS join REFERENCE_RP_CURRENT on REFERENCE_RP_CURRENT.TADIG = T_ROAMING_ACTIVE_USERS.TADIG
      //                        where to_char(ATTACHTIME, 'yyyyMMDDHH24MISS') >= to_char(sysdate-1, 'yyyyMMDDHH24MISS')");
      return json_encode($data);
  }
  public function service_attempt_show(Request $request)
  {
      $imsi = $request->input('imsi');
      $to_date = date("Ymd");
      $from_date = $to_date - 30;
      $t_service_attempt = t_service_attempt::select([
                          'COUNTRY',
                          'OPERATOR',
                          'CS_REG',
                          'MOC',
                          'MTC',
                          'SMSMO',
                          'SMSMT',
                          'GPRS_REG',
                          'LTE_REG',
                          'DATA',
      ])->where('imsi', $imsi)->whereBetween('reg_date', [$from_date, $to_date]);
      //return $date;
      return DataTables::of($t_service_attempt)
              ->filterColumn('name', function($query, $keyword) {
                  $sql = "name  like ?";
                  $query->whereRaw($sql, ["%{$keyword}%"]);
              })
              ->toJson();
              // ->setRowClass(function ($t_service_attempt) {
              //     if ($t_service_attempt->cs_reg == 0) {
              //           return 'bg-light text-dark';
              //     }
              //     if ($t_service_attempt->moc == 'Critical') {
              //           return 'bg-danger text-white';
              //     }
              //     if ($t_service_attempt->mtc == 'Major') {
              //           return 'bg-warning text-dark';
              //     }
              //     if ($t_service_attempt->smsmo == 'Minor') {
              //           return 'bg-info text-white';
              //     }
              //     if ($t_service_attempt->smsmt == 'Critical') {
              //           return 'bg-danger text-white';
              //     }
              //     if ($t_service_attempt->gprs_reg == 'Major') {
              //           return 'bg-warning text-dark';
              //     }
              //     if ($t_service_attempt->lte_reg == 'Minor') {
              //           return 'bg-info text-white';
              //     }
              //     if ($t_service_attempt->data == 'Minor') {
              //           return 'bg-info text-white';
              //     }
              // })
    }
    public function sub_status_show(Request $request)
    {
      $imsi = $request->input('imsi');
      $country = $request->input('country');
      $t_status = t_status::select([
                          'COUNTRY',
                          'OPERATOR',
                          'VOICE_SMS',
                          'GPRS',
                          'LTE',
                          'PREPAID_ROAM',
                          'CS_REG',
                          'CS_TOTAL_SUB',
                          'MOC',
                          'MOC_TOTAL_SUB',
                          'MTC',
                          'MTC_TOTAL_SUB',
                          'SMSMO',
                          'SMO_TOTAL_SUB',
                          'SMSMT',
                          'SMT_TOTAL_SUB',
                          'KPI_GPRS',
                          'KPI_GPRS_TOTAL_SUB',
                          'KPI_LTE_REG',
                          'KPI_LTE_REG_TOTAL',
                          'KPI_DATA',
                          'KPI_DATA_TOTAL'
      ])->where('imsi', $imsi)->where('country',$country);

  return DataTables::of($t_status)
              ->filterColumn('name', function($query, $keyword) {
                  $sql = "name  like ?";
                  $query->whereRaw($sql, ["%{$keyword}%"]);
              })
              ->toJson();
    }
    public function hotline_voice_show(Request $request)
    {
      $imsi = $request->input('imsi');
      $t_status_per_imsi = t_status_per_imsi::select([
                          'CDATE',
                          'IMSI',
                          'LOCATION',
                          'NETWORK',
                          'GSM',
                          'CAMEL',
                          'LU_SUC',
                          'LU_FAIL',
                          'PRN_SUC',
                          'PRN_FAIL',
                          'MOC_LOCAL',
                          'MOC_HOME',
                          'MOC_INT',
                          'MTC'
      ])->where('imsi', $imsi);

  return DataTables::of($t_status_per_imsi)
              ->filterColumn('name', function($query, $keyword) {
                  $sql = "name  like ?";
                  $query->whereRaw($sql, ["%{$keyword}%"]);
              })
              ->toJson();
    }
    public function hotline_sms_show(Request $request)
    {
      $imsi = $request->input('imsi');
      $t_status_per_imsi = t_status_per_imsi::select([
                          'CDATE',
                          'IMSI',
                          'LOCATION',
                          'NETWORK',
                          'GSM',
                          'LU_SUC',
                          'LU_FAIL',
                          'SMSMO_SUC',
                          'SMSMO_FAIL',
                          'SMSMT_SUC',
                          'SMSMT_FAIL'
      ])->where('imsi', $imsi);

  return DataTables::of($t_status_per_imsi)
              ->filterColumn('name', function($query, $keyword) {
                  $sql = "name  like ?";
                  $query->whereRaw($sql, ["%{$keyword}%"]);
              })
              ->toJson();
    }
    public function hotline_data_show(Request $request)
    {
      $imsi = $request->input('imsi');
      $t_status_per_imsi = t_status_per_imsi::select([
                          'CDATE',
                          'IMSI',
                          'LOCATION',
                          'NETWORK',
                          'GPRS',
                          'LTE',
                          'PS_LU_SUC',
                          'PS_LU_FAIL',
                          'S1MODE_LU_SUC',
                          'S1MODE_LU_FAIL',
                          'US_GPRS'
      ])->where('imsi', $imsi);

  return DataTables::of($t_status_per_imsi)
              ->filterColumn('name', function($query, $keyword) {
                  $sql = "name  like ?";
                  $query->whereRaw($sql, ["%{$keyword}%"]);
              })
              ->toJson();
    }
}
