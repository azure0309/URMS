<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class quality_result extends Controller
{
  public function result_sig(Request $request)
  {

    $ref_count = DB::table('REFERENCE_RP_CURRENT')
        ->count();

    /*
     * ref_count variable нь манайд бүртгэгдсэн нийт operator-уудын тоог count хийж
     * татаж байгаа. Нийт operator-уудын тоо нь 100% гэж үзвэл тухайн өдрийн нийт CDR
     * үүссэн operator-ууд 100%-иас хэдэн хувь байгааг тооцоолох шаардлагатай.
     * */
    $count = DB::table('REPORT_INBOUND')
        ->where('regdate', '=', date('Y-m-d', strtotime("-1 days")))
        ->count();

    /***********************************************/
    $ul_success_inbound = DB::table('REPORT_INBOUND')
        ->where('regdate', '=', date('Y-m-d', strtotime("-1 days")))
        ->sum('ul_success_inbound');
    $ul_total_request = DB::table('REPORT_INBOUND')
        ->where('regdate', '=', date('Y-m-d', strtotime("-1 days")))
        ->sum('ul_total_request');
    if($ul_total_request == 0){
        $ul_total_request = 1;
        $ul_inbound_success_ratio = ($ul_success_inbound * 100) / $ul_total_request;
    }

    /**************************************************/

    /************************************************/
    $gprs_ul_success_inbound = DB::table('REPORT_INBOUND')
        ->where('regdate', '=', date('Y-m-d', strtotime("-1 days")))
        ->sum('gprs_ul_success_inbound');
    $gprs_total_request = DB::table('REPORT_INBOUND')
        ->where('regdate', '=', date('Y-m-d', strtotime("-1 days")))
        ->sum('gprs_ul_total_request');
    if($gprs_total_request == 0){
        $gprs_total_request = 1;
        $gprs_ul_inbound_success_ratio = ($gprs_ul_success_inbound * 100) / $gprs_total_request;
    }

    /*************************************************/

    /************************************************/
    $cs_sai_total_request = DB::table('REPORT_INBOUND')
        ->where('regdate', '=', date('Y-m-d', strtotime("-1 days")))
        ->sum('cs_sai_total_request');
    $cs_sendauth_success = DB::table('REPORT_INBOUND')
        ->where('regdate', '=', date('Y-m-d', strtotime("-1 days")))
        ->sum('cs_sendauth_success');

    if($cs_sai_total_request == 0){
        $cs_sai_total_request = 1;
        $cs_success_ratio = ($cs_sendauth_success * 100) / $cs_sai_total_request;
    }
    /**************************************************/

    /***************************************************/
    $ps_sai_total_request = DB::table('REPORT_INBOUND')
        ->where('regdate', '=', date('Y-m-d', strtotime("-1 days")))
        ->sum('ps_sai_total_request');

    $ps_sendauth_success = DB::table('REPORT_INBOUND')
        ->where('regdate', '=', date('Y-m-d', strtotime("-1 days")))
        ->sum('ps_sendauth_success');
    if($ps_sai_total_request == 0){
        $ps_sai_total_request = 1;
        $ps_success_ratio = ($ps_sendauth_success * 100) / $ps_sai_total_request;
    }


    /***************************************************/

    /*****************************************************/
    $mo_sms_total_request = DB::table('REPORT_INBOUND')
        ->where('regdate', '=', date('Y-m-d', strtotime("-1 days")))
        ->sum('mo_sms_total_request');
    $mo_sms_success = DB::table('REPORT_INBOUND')
        ->where('regdate', '=', date('Y-m-d', strtotime("-1 days")))
        ->sum('mo_sms_success');

    if ($mo_sms_total_request == 0){
      $mo_sms_total_request = 1;
      $mo_success_ratio = ($mo_sms_success * 100) / $mo_sms_total_request;
    }

    /******************************************************/

    /*******************************************************/
    $mt_sms_total_request = DB::table('REPORT_INBOUND')
        ->where('regdate', '=', date('Y-m-d', strtotime("-1 days")))
        ->sum('mt_sms_total_request');
    $mt_sms_success = DB::table('REPORT_INBOUND')
        ->where('regdate', '=', date('Y-m-d', strtotime("-1 days")))
        ->sum('mt_sms_success');

    if($mt_sms_total_request == 0){
        $mt_sms_total_request = 1;
        $mt_success_ratio = ($mt_sms_success * 100) / $mt_sms_total_request;
    }

    /*********************************************************/

    /***********************************************************/
    $prn_total_request = DB::table('REPORT_INBOUND')
        ->where('regdate', '=', date('Y-m-d', strtotime("-1 days")))
        ->sum('prn_total_request');
    $prn_success_number = DB::table('REPORT_INBOUND')
        ->where('regdate', '=', date('Y-m-d', strtotime("-1 days")))
        ->sum('prn_success_number');
    if($prn_total_request == 0){
        $prn_total_request = 1;
        $prn_success_ratio = ($prn_success_number * 100) / $prn_total_request;
    }

    /********************************************************/

    $quality_top = DB::table('REPORT_INBOUND')
        ->select('hpmn_code',
            'hpmn_name',
            'gsm',
            'gprs',
            'camel',
            'lte',
            'ul_inbound_success_ratio',
            'gprs_ul_inbound_success_ratio',
            'cs_success_ratio',
            'ps_success_ratio',
            'mo_success_ratio',
            'mt_success_ratio',
            'prn_success_ratio')
        ->orderBy('over_all_total_records', 'DESC')
        ->where('regdate', '=', date('Y-m-d', strtotime("-1 days")))
        ->paginate(10);

    $ul_inbound_success_ratio_normal = DB::table('REPORT_INBOUND')
        ->where('ul_inbound_success_ratio', '>', 95)
        ->where('regdate', '=', date('Y-m-d', strtotime("-1 days")))
        ->count('ul_inbound_success_ratio');

    $ul_inbound_success_ratio_warning = DB::table('REPORT_INBOUND')
        ->where('ul_inbound_success_ratio', '<', 95)
        ->where('ul_inbound_success_ratio', '>', 80)
        ->where('regdate', '=', date('Y-m-d', strtotime("-1 days")))
        ->count('ul_inbound_success_ratio');

    $ul_inbound_success_ratio_minor = DB::table('REPORT_INBOUND')
        ->where('ul_inbound_success_ratio', '<', 80)
        ->where('ul_inbound_success_ratio', '>', 50)
        ->where('regdate', '=', date('Y-m-d', strtotime("-1 days")))
        ->count('ul_inbound_success_ratio');

    $ul_inbound_success_ratio_crit = DB::table('REPORT_INBOUND')
        ->where('ul_inbound_success_ratio', '<', 50)
        ->where('regdate', '=', date('Y-m-d', strtotime("-1 days")))
        ->count('ul_inbound_success_ratio');

    $gprs_ul_inbound_success_ratio_normal = DB::table('REPORT_INBOUND')
        ->where('ul_inbound_success_ratio', '>', 95)
        ->where('regdate', '=', date('Y-m-d', strtotime("-1 days")))
        ->count('gprs_ul_inbound_success_ratio');

    $gprs_ul_inbound_success_ratio_warning = DB::table('REPORT_INBOUND')
        ->where('ul_inbound_success_ratio', '<', 95)
        ->where('ul_inbound_success_ratio', '>', 80)
        ->where('regdate', '=', date('Y-m-d', strtotime("-1 days")))
        ->count('gprs_ul_inbound_success_ratio');

    $gprs_ul_inbound_success_ratio_minor = DB::table('REPORT_INBOUND')
        ->where('ul_inbound_success_ratio', '<', 80)
        ->where('ul_inbound_success_ratio', '>', 50)
        ->where('regdate', '=', date('Y-m-d', strtotime("-1 days")))
        ->count('gprs_ul_inbound_success_ratio');

    $gprs_ul_inbound_success_ratio_crit = DB::table('REPORT_INBOUND')
        ->where('ul_inbound_success_ratio', '<', 50)
        ->where('regdate', '=', date('Y-m-d', strtotime("-1 days")))
        ->count('gprs_ul_inbound_success_ratio');

    $cs_success_ratio_normal = DB::table('REPORT_INBOUND')
        ->where('ul_inbound_success_ratio', '>', 95)
        ->where('regdate', '=', date('Y-m-d', strtotime("-1 days")))
        ->count('cs_success_ratio');
    $cs_success_ratio_warning = DB::table('REPORT_INBOUND')
        ->where('ul_inbound_success_ratio', '<', 95)
        ->where('ul_inbound_success_ratio', '>', 80)
        ->where('regdate', '=', date('Y-m-d', strtotime("-1 days")))
        ->count('cs_success_ratio');

    $cs_success_ratio_minor = DB::table('REPORT_INBOUND')
        ->where('ul_inbound_success_ratio', '<', 80)
        ->where('ul_inbound_success_ratio', '>', 50)
        ->where('regdate', '=', date('Y-m-d', strtotime("-1 days")))
        ->count('cs_success_ratio');

    $cs_success_ratio_crit = DB::table('REPORT_INBOUND')
        ->where('ul_inbound_success_ratio', '<', 50)
        ->where('regdate', '=', date('Y-m-d', strtotime("-1 days")))
        ->count('cs_success_ratio');

    $ps_success_ratio_normal = DB::table('REPORT_INBOUND')
        ->where('ul_inbound_success_ratio', '>', 95)
        ->where('regdate', '=', date('Y-m-d', strtotime("-1 days")))
        ->count('ps_success_ratio');
    $ps_success_ratio_warning = DB::table('REPORT_INBOUND')
        ->where('ul_inbound_success_ratio', '<', 95)
        ->where('ul_inbound_success_ratio', '>', 80)
        ->where('regdate', '=', date('Y-m-d', strtotime("-1 days")))
        ->count('ps_success_ratio');

    $ps_success_ratio_minor = DB::table('REPORT_INBOUND')
        ->where('ul_inbound_success_ratio', '<', 80)
        ->where('ul_inbound_success_ratio', '>', 50)
        ->where('regdate', '=', date('Y-m-d', strtotime("-1 days")))
        ->count('ps_success_ratio');

    $ps_success_ratio_crit = DB::table('REPORT_INBOUND')
        ->where('ul_inbound_success_ratio', '<', 50)
        ->where('regdate', '=', date('Y-m-d', strtotime("-1 days")))
        ->count('ps_success_ratio');

    $mo_success_ratio_normal = DB::table('REPORT_INBOUND')
        ->where('ul_inbound_success_ratio', '>', 95)
        ->where('regdate', '=', date('Y-m-d', strtotime("-1 days")))
        ->count('mo_success_ratio');
    $mo_success_ratio_warning = DB::table('REPORT_INBOUND')
        ->where('ul_inbound_success_ratio', '<', 95)
        ->where('ul_inbound_success_ratio', '>', 80)
        ->where('regdate', '=', date('Y-m-d', strtotime("-1 days")))
        ->count('mo_success_ratio');

    $mo_success_ratio_minor = DB::table('REPORT_INBOUND')
        ->where('ul_inbound_success_ratio', '<', 80)
        ->where('ul_inbound_success_ratio', '>', 50)
        ->where('regdate', '=', date('Y-m-d', strtotime("-1 days")))
        ->count('mo_success_ratio');

    $mo_success_ratio_crit = DB::table('REPORT_INBOUND')
        ->where('ul_inbound_success_ratio', '<', 50)
        ->where('regdate', '=', date('Y-m-d', strtotime("-1 days")))
        ->count('mo_success_ratio');

    $mt_success_ratio_normal = DB::table('REPORT_INBOUND')
        ->where('ul_inbound_success_ratio', '>', 95)
        ->where('regdate', '=', date('Y-m-d', strtotime("-1 days")))
        ->count('mt_success_ratio');
    $mt_success_ratio_warning = DB::table('REPORT_INBOUND')
        ->where('ul_inbound_success_ratio', '<', 95)
        ->where('ul_inbound_success_ratio', '>', 80)
        ->where('regdate', '=', date('Y-m-d', strtotime("-1 days")))
        ->count('mt_success_ratio');

    $mt_success_ratio_minor = DB::table('REPORT_INBOUND')
        ->where('ul_inbound_success_ratio', '<', 80)
        ->where('ul_inbound_success_ratio', '>', 50)
        ->where('regdate', '=', date('Y-m-d', strtotime("-1 days")))
        ->count('mt_success_ratio');

    $mt_success_ratio_crit = DB::table('REPORT_INBOUND')
        ->where('ul_inbound_success_ratio', '<', 50)
        ->where('regdate', '=', date('Y-m-d', strtotime("-1 days")))
        ->count('mt_success_ratio');
    $prn_success_ratio_normal = DB::table('REPORT_INBOUND')
        ->where('ul_inbound_success_ratio', '>', 95)
        ->where('regdate', '=', date('Y-m-d', strtotime("-1 days")))
        ->count('mt_success_ratio');
    $prn_success_ratio_warning = DB::table('REPORT_INBOUND')
        ->where('ul_inbound_success_ratio', '<', 95)
        ->where('ul_inbound_success_ratio', '>', 80)
        ->where('regdate', '=', date('Y-m-d', strtotime("-1 days")))
        ->count('mt_success_ratio');

    $prn_success_ratio_minor = DB::table('REPORT_INBOUND')
        ->where('ul_inbound_success_ratio', '<', 80)
        ->where('ul_inbound_success_ratio', '>', 50)
        ->where('regdate', '=', date('Y-m-d', strtotime("-1 days")))
        ->count('mt_success_ratio');

    $prn_success_ratio_crit = DB::table('REPORT_INBOUND')
        ->where('ul_inbound_success_ratio', '<', 50)
        ->where('regdate', '=', date('Y-m-d', strtotime("-1 days")))
        ->count('mt_success_ratio');


    $moc = DB::table('REPORT_INBOUND')
        ->select('REPORT_INBOUND.*',
            DB::raw("select *
                       from REPORT_INBOUND
                      where UL_SUCCESS_INBOUND = 0
                        and MOC_VOICE_RECORDS = 0"))
        ->where('regdate', '=', date('Y-m-d', strtotime("-1 days")))
        ->where([['gprs_records', '=', 0], ['moc_sms_records', '=', 0]])->count();

    $m2m_f = DB::table('REPORT_INBOUND')
          ->select('REPORT_INBOUND.*',
              DB::raw("select *
                       from REPORT_INBOUND
                      where UL_SUCCESS_INBOUND = 0
                        and MOC_VOICE_RECORDS = 0"))
        ->where('regdate', '=', date('Y-m-d', strtotime("-1 days")))
        ->where('gprs_records', '!=', 0)
        ->where('moc_sms_records', '!=', 0)
        ->count();


    $m2m_s = DB::table('REPORT_INBOUND')
        ->select('REPORT_INBOUND.*',
            DB::raw("select *
                       from REPORT_INBOUND
                      where UL_SUCCESS_INBOUND = 0
                        and MTC_VOICE_RECORDS = 0"))
        ->where('regdate', '=', date('Y-m-d', strtotime("-1 days")))
        ->where('gprs_records', '=', 0)
        ->where('mtc_sms_records', '=', 0)
        ->count();

    $mtc = DB::table('REPORT_INBOUND')
        ->select('REPORT_INBOUND.*',
            DB::raw("select *
                       from REPORT_INBOUND
                      where UL_SUCCESS_INBOUND = 0
                        and MTC_VOICE_RECORDS = 0"))
        ->where('regdate', '=', date('Y-m-d', strtotime("-1 days")))
        ->where('gprs_records', '!=', 0)
        ->where('mtc_sms_records', '!=', 0)
        ->count();

    $pdp = DB::table('REPORT_INBOUND')
        ->where('gprs_ul_success_inbound', '=', 0)
        ->where('gprs_records', '!=', 0)
        ->where('regdate', '=', date('Y-m-d', strtotime("-1 days")))
        ->count();

    $smsmo = DB::table('REPORT_INBOUND')
        ->where('mo_success_ratio', '<', 95)
        ->where('UL_SUCCESS_INBOUND', '=', 0)
        ->where('moc_sms_records', '=', 0)
        ->where('regdate', '=', date('Y-m-d', strtotime("-1 days")))
        ->count();

    $smsmt = DB::table('REPORT_INBOUND')
        ->where('mt_success_ratio', '<', 95)
        ->where('UL_SUCCESS_INBOUND', '=', 0)
        ->where('mtc_sms_records', '=', 0)
        ->where('regdate', '=', date('Y-m-d', strtotime("-1 days")))
        ->count();

    $sor = DB::table('REPORT_INBOUND')
        ->where('ul_inbound_success_ratio', '<', 95)
        ->where('moc_voice_records', '=', 0)
        ->where('mtc_voice_records', '=', 0)
        ->where('moc_sms_records', '=', 0)
        ->where('mtc_sms_records', '=', 0)
        ->where('cs_sendauth_failure', '>', 50)
        ->where('regdate', '=', date('Y-m-d', strtotime("-1 days")))
        ->count();

    $cs_lu = DB::table('REPORT_INBOUND')
        ->where('ul_inbound_success_ratio', '<', 95)
        ->where('cs_sai_total_request', '!=', 0)->where('moc_voice_records', '!=', 0)
        ->where('mtc_voice_records', '!=', 0)
        ->where('moc_sms_records',   '!=', 0)
        ->where('mtc_sms_records',   '!=', 0)
        ->where('regdate', '=', date('Y-m-d', strtotime("-1 days")))
        ->count();

    $ps_lu = DB::table('REPORT_INBOUND')
        ->where('gprs_ul_inbound_success_ratio', '<', 95)
        ->where('gprs_records', '=', 0)
        ->where('regdate', '=', date('Y-m-d', strtotime("-1 days")))
        ->count();


    $view = View('quality_report')
        ->with('count', $count)
        ->with('ref_count', $ref_count)
        ->with('ul_inbound_success_ratio', $ul_inbound_success_ratio)
        ->with('gprs_ul_inbound_success_ratio', $gprs_ul_inbound_success_ratio)
        ->with('cs_success_ratio', $cs_success_ratio)
        ->with('ps_success_ratio', $ps_success_ratio)
        ->with('mo_success_ratio', $mo_success_ratio)
        ->with('mt_success_ratio', $mt_success_ratio)
        ->with('prn_success_ratio', $prn_success_ratio)
        ->with('quality_top', $quality_top)
        ->with('ul_inbound_success_ratio_normal', $ul_inbound_success_ratio_normal)
        ->with('ul_inbound_success_ratio_warning', $ul_inbound_success_ratio_warning)
        ->with('ul_inbound_success_ratio_minor', $ul_inbound_success_ratio_minor)
        ->with('ul_inbound_success_ratio_crit', $ul_inbound_success_ratio_crit)
        ->with('gprs_ul_inbound_success_ratio_normal', $gprs_ul_inbound_success_ratio_normal)
        ->with('gprs_ul_inbound_success_ratio_warning', $gprs_ul_inbound_success_ratio_warning)
        ->with('gprs_ul_inbound_success_ratio_minor', $gprs_ul_inbound_success_ratio_minor)
        ->with('gprs_ul_inbound_success_ratio_crit', $gprs_ul_inbound_success_ratio_crit)
        ->with('cs_success_ratio_normal', $cs_success_ratio_normal)
        ->with('cs_success_ratio_warning', $cs_success_ratio_warning)
        ->with('cs_success_ratio_minor', $cs_success_ratio_minor)
        ->with('cs_success_ratio_crit', $cs_success_ratio_crit)
        ->with('ps_success_ratio_normal', $ps_success_ratio_normal)
        ->with('ps_success_ratio_warning', $ps_success_ratio_warning)
        ->with('ps_success_ratio_minor', $ps_success_ratio_minor)
        ->with('ps_success_ratio_crit', $ps_success_ratio_crit)
        ->with('mo_success_ratio_normal', $mo_success_ratio_normal)
        ->with('mo_success_ratio_warning', $mo_success_ratio_warning)
        ->with('mo_success_ratio_minor', $mo_success_ratio_minor)
        ->with('mo_success_ratio_crit', $mo_success_ratio_crit)
        ->with('mt_success_ratio_normal', $mt_success_ratio_normal)
        ->with('mt_success_ratio_warning', $mt_success_ratio_warning)
        ->with('mt_success_ratio_minor', $mt_success_ratio_minor)
        ->with('mt_success_ratio_crit', $mt_success_ratio_crit)
        ->with('prn_success_ratio_normal', $prn_success_ratio_normal)
        ->with('prn_success_ratio_warning', $prn_success_ratio_warning)
        ->with('prn_success_ratio_minor', $prn_success_ratio_minor)
        ->with('prn_success_ratio_crit', $prn_success_ratio_crit)
        ->with('moc', $moc)
        ->with('m2m_f', $m2m_f)
        ->with('m2m_s', $m2m_s)
        ->with('mtc', $mtc)
        ->with('pdp', $pdp)
        ->with('smsmo', $smsmo)
        ->with('smsmt', $smsmt)
        ->with('sor', $sor)
        ->with('cs_lu', $cs_lu)
        ->with('ps_lu', $ps_lu)
        ;

    return $view;
  }
//  public function kpi_indicator(Request $request){
//
//
//    $view = View('quality_report')
//
//    return $view;
//  }
}
