<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Yajra\DataTables\Html\Editor\Date;

class resultGraph extends Controller
{

  public function count_cdr(Request $request)
  {
    $date_first = $request->input('date_first');
    $date_second = $request->input('date_second');
    $date_comp = $request->input('date_comp');
    $date_comp_s = $request->input('date_comp_s');

    /*
     * Report_result хуудсын үр дүнгүүдийг өгөгдлийн сангаас татах хэсгүүдийг доор
     * бичсэн байгаа. Доорх өгөгдлүүд нь бүгд UNI_ROAMING DB-ээс өгөгдөл татаж байгаа болно.
     * Report_Result хуудас нь Default харагдацаараа өнөөдрийнхөөс өмнөх өдрийнхийг буюу
     * өчигдрийн мэдээллийг татах /sysdate - 1/ ажиллагаатай. Түүнчлэн Filter
     * хэсгийн Time-Range хэсгээс шаардлагатай өдрийг сонгож өгөгдлийн сангаас өгөгдлийг
     * татаж Web хуудсанд үр дүнгээ харах бүрэн боломжтой юм.
     * */


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

    /*
     * count variable нь тухайн өдрийн нийт CDR бичлэгийг татаж байгаа.
     * */
    $tot_rec = DB::table('REPORT_INBOUND')
        ->where('regdate', '=', date('Y-m-d', strtotime("-1 days")))
        ->sum('report_inbound.over_all_total_records');
    /*
     * Total_records буюу tot_rec variable нь over all total records мэдээлэл буюу өгөгдлийн санд
     * яг ийм нэртэй байгаа баганаас sum хийх буюу бүх мөрийн утгыг нэмж аваад веб хуудсанд харуулах
     * шаардлагатай байгаа.
     * */
    $tot_imsi = DB::table('REPORT_INBOUND')
        ->where('regdate', '=', date('Y-m-d', strtotime("-1 days")))
        ->sum('report_inbound.overall_total_imsi');
    /*
     * Total_IMSI буюу tot_imsi variable нь over all total imsi мэдээлэл буюу өгөгдлийн санд
     * яг ийм нэртэй байгаа баганаас sum хийх буюу бүх мөрийн утгыг нэмж аваад веб хуудсанд харуулах
     * шаардлагатай байгаа.
     * */
    $overall_ttl_max = DB::table('REPORT_INBOUND')
        ->select('hpmn_code',
            'hpmn_name',
            'over_all_total_records',
            'overall_total_imsi')
        ->orderBy('over_all_total_records', 'DESC')
        ->where('regdate', '=', date('Y-m-d', strtotime("-1 days")))
        ->distinct('hpmn_code')
        ->paginate(10);
    /*
     * overall_ttl_max /Overall_total_max_operators/ variable нь тухайн өдрийн хамгийн их CDR үүсгэсэн 10
     * operator-уудыг overall_total_records, over_all_total_imsi болон Tadig-уудын мэдээлэлтэй нь веб хуудсанд
     * хүснэгт байдлаар харуулах зорилготой
     * */


    /*
     * service нэртэй хувьсагч руу өгөгдлийн сангаас шаардлагатай багануудын утгуудыг sum хийж аваад
     * багануудын нэр тус бүрээр array үүсгээд тухайн sum хийж авсан утга бүрийг давталтаар оруулж
     * өгнө.
     * */
    $service = DB::table('REPORT_INBOUND')
        ->select(
            DB::raw('sum(moc_voice_records) as moc_voice_records'),
            DB::raw('sum(mtc_voice_records) as mtc_voice_records'),
            DB::raw('sum(moc_sms_records) as   moc_sms_records'),
            DB::raw('sum(mtc_sms_records) as   mtc_sms_records'),
            DB::raw('sum(gprs_records) as      gprs_records'))
        ->where('regdate', '=', date('Y-m-d', strtotime("-1 days")))
        ->get();

    /* Chart зурахад шаардлагатай өгөгдөл бүрийг тусад нь хадгалах зорилготой array-уудыг
     * энд үүсгэж өгч байна.
     * */
    $moc_voice_records = array('MOC VOICE RECORDS');
    $mtc_voice_records = array('MTC VOICE RECORDS');
    $moc_sms_records = array('MOC SMS RECORDS');
    $mtc_sms_records = array('MTC SMS RECORDS');
    $gprs_records = array('GPRS RECORDS');

    /*
     * Үүсгэсэн array-ууд руу тус бүрт давталтаар өгөгдлийн сангаас авсан утгуудаа оруулж өгнө.
     * */

    foreach ($service as $key => $value) {
      $moc_voice_records[++$key] = (int)$value->moc_voice_records;
    };

    foreach ($service as $key => $value) {
      $mtc_voice_records[++$key] = (int)$value->mtc_voice_records;
    };
    foreach ($service as $key => $value) {
      $moc_sms_records[++$key] = (int)$value->moc_sms_records;
    };
    foreach ($service as $key => $value) {
      $mtc_sms_records[++$key] = (int)$value->mtc_sms_records;
    };
    foreach ($service as $key => $value) {
      $gprs_records[++$key] = (int)$value->gprs_records;
    };

    /*Chart /Google Donut Chart/ зурахад шаардлагатай header data буюу манай тохиолдолд доорх гарчгийг
    үр дүнгийн array-ийн эхэнд утга оноож өгөөд цааш үргэлжлүүлээд array_push method-оор
    өмнөх өгөгдөл бүрийг хадгалж буй array-уудаа залгаж өгнө. */

    $service_result = array(['Services', 'Values']);
    array_push($service_result, $moc_voice_records, $mtc_voice_records, $moc_sms_records,
        $mtc_sms_records, $gprs_records);


    $gprs_service = DB::table('REPORT_INBOUND')
        ->select(
            DB::raw('sum(gprs_records) as gprs_records'),
            DB::raw('sum(gprs_charged_volume) as gprs_charged_volume'),
            DB::raw('sum(gprs_no_imsi) as gprs_no_imsi'))
        ->where('regdate', '=', date('Y-m-d', strtotime("-1 days")))
        ->get();


    $gprs_records = array('GPRS Records');
    $gprs_charged_volume = array('GPRS charged volume');
    $gprs_no_imsi = array('GPRS No IMSI');


    foreach ($gprs_service as $key => $value) {
      $gprs_records[++$key] = (int)$value->gprs_records;
    };


    /*--------------------------------------------------------*/
    foreach ($gprs_service as $key => $value) {
      $gprs_charged_volume[++$key] = (int)$value->gprs_charged_volume / 1024;
    };


    /*-------------------------------------------------------*/
    foreach ($gprs_service as $key => $value) {
      $gprs_no_imsi[++$key] = (int)$value->gprs_no_imsi;
    };


    $gprs_result = array(['Services', date('Y-m-d', strtotime("-1 days"))]);
    array_push($gprs_result, $gprs_records, $gprs_charged_volume, $gprs_no_imsi);

    $moc_voice = DB::table('REPORT_INBOUND')
        ->select(
            DB::raw('sum(moc_voice_records) as moc_voice_records'),
            DB::raw('sum(moc_local_call_records) as moc_local_call_records'),
            DB::raw('sum(moc_home_records) as moc_local_home_records'),
            DB::raw('sum(moc_international_call_records) as moc_international_call_records'),
            DB::raw('sum(moc_voice_charged_duration) as moc_voice_charged_duration'),
            DB::raw('sum(moc_voice_no_imsi) as moc_voice_no_imsi')
        )
        ->where('regdate', '=', date('Y-m-d', strtotime("-1 days")))
        ->get();

    $moc_voice_records = array('Voice');
    $moc_local_call_records = array('Local Call');
    $moc_local_home_records = array('Local Home');
    $moc_international_call_records = array('International');
    $moc_voice_charged_duration = array('Duration');
    $moc_voice_no_imsi = array('No IMSI');


    foreach ($moc_voice as $key => $value) {
      $moc_voice_records[++$key] = (int)$value->moc_voice_records;
    };

    foreach ($moc_voice as $key => $value) {
      $moc_local_call_records[++$key] = (int)$value->moc_local_call_records;
    };
    foreach ($moc_voice as $key => $value) {
      $moc_local_home_records[++$key] = (int)$value->moc_local_home_records;
    };
    foreach ($moc_voice as $key => $value) {
      $moc_international_call_records[++$key] = (int)$value->moc_international_call_records;
    };
    foreach ($moc_voice as $key => $value) {
      $moc_voice_charged_duration[++$key] = (int)$value->moc_voice_charged_duration;
    };
    foreach ($moc_voice as $key => $value) {
      $moc_voice_no_imsi[++$key] = (int)$value->moc_voice_no_imsi;
    };


    $moc_voice_result = array(['Services', date('Y-m-d', strtotime("-1 days"))]);
    array_push($moc_voice_result, $moc_voice_records, $moc_local_call_records,
        $moc_local_home_records, $moc_international_call_records, $moc_voice_charged_duration,
        $moc_voice_no_imsi);


    $mtc_voice = DB::table('REPORT_INBOUND')
        ->select(
            DB::raw('sum(mtc_voice_records) as mtc_voice_records'),
            DB::raw('sum(mtc_voice_charged_duration) as mtc_voice_charged_duration'),
            DB::raw('sum(mtc_voice_no_imsi) as mtc_voice_no_imsi')
        )
        ->where('regdate', '=', date('Y-m-d', strtotime("-1 days")))
        ->get();

    $mtc_voice_records = array('mtc_voice_records');
    $mtc_voice_charged_duration = array('mtc_voice_charged_duration');
    $mtc_voice_no_imsi = array('mtc_voice_no_imsi');


    foreach ($mtc_voice as $key => $value) {
      $mtc_voice_records[++$key] = (int)$value->mtc_voice_records;
    };
    foreach ($mtc_voice as $key => $value) {
      $mtc_voice_charged_duration[++$key] = (int)$value->mtc_voice_charged_duration;
    };
    foreach ($mtc_voice as $key => $value) {
      $mtc_voice_no_imsi[++$key] = (int)$value->mtc_voice_no_imsi;
    };


    $mtc_voice_result = array(['Services', date('Y-m-d', strtotime("-1 days"))]);

    array_push($mtc_voice_result, $mtc_voice_records, $mtc_voice_charged_duration,
        $mtc_voice_no_imsi);


    $moc_sms = DB::table('REPORT_INBOUND')
        ->select(
            DB::raw('sum(moc_sms_records) as moc_sms_records'),
            DB::raw('sum(moc_sms_no_imsi) as moc_sms_no_imsi')

        )
        ->where('regdate', '=', date('Y-m-d', strtotime("-1 days")))
        ->get();

    $moc_sms_records = array('moc_sms_records');
    $moc_sms_no_imsi = array('moc_sms_no_imsi');

    foreach ($moc_sms as $key => $value) {
      $moc_sms_records[++$key] = (int)$value->moc_sms_records;
    }
    foreach ($moc_sms as $key => $value) {
      $moc_sms_no_imsi[++$key] = (int)$value->moc_sms_no_imsi;
    }

    $moc_sms_result = array(['Service', date('Y-m-d', strtotime("-1 days"))]);
    array_push($moc_sms_result, $moc_sms_records, $moc_sms_no_imsi);


    $mtc_sms = DB::table('REPORT_INBOUND')
        ->select(
            DB::raw('sum(mtc_sms_records) as mtc_sms_records'),
            DB::raw('sum(mtc_sms_no_imsi) as mtc_sms_no_imsi')

        )
        ->where('regdate', '=', date('Y-m-d', strtotime("-1 days")))
        ->get();

    $mtc_sms_records = array('mtc_sms_records');
    $mtc_sms_no_imsi = array('mtc_sms_no_imsi');

    foreach ($mtc_sms as $key => $value) {
      $mtc_sms_records[++$key] = (int)$value->mtc_sms_records;
    }
    foreach ($mtc_sms as $key => $value) {
      $mtc_sms_no_imsi[++$key] = (int)$value->mtc_sms_no_imsi;
    }

    $mtc_sms_result = array(['Service', date('Y-m-d', strtotime("-1 days"))]);
    array_push($mtc_sms_result, $mtc_sms_records, $mtc_sms_no_imsi);

    if (!is_null($date_first)) {
      $ref_count = DB::table('REFERENCE_RP_CURRENT')
          ->count();

      /*
       * ref_count variable нь манайд бүртгэгдсэн нийт operator-уудын тоог count хийж
       * татаж байгаа. Нийт operator-уудын тоо нь 100% гэж үзвэл тухайн өдрийн нийт CDR
       * үүссэн operator-ууд 100%-иас хэдэн хувь байгааг тооцоолох шаардлагатай.
       * */
      $count = DB::table('REPORT_INBOUND')
          ->where('regdate', '=', date('Y-m-d', strtotime($date_first)))
          ->count();

      /*
       * count variable нь тухайн өдрийн нийт CDR бичлэгийг татаж байгаа.
       * */
      $tot_rec = DB::table('REPORT_INBOUND')
          ->where('regdate', '=', date('Y-m-d', strtotime($date_first)  ))
          ->sum('report_inbound.over_all_total_records');
      /*
       * Total_records буюу tot_rec variable нь over all total records мэдээлэл буюу өгөгдлийн санд
       * яг ийм нэртэй байгаа баганаас sum хийх буюу бүх мөрийн утгыг нэмж аваад веб хуудсанд харуулах
       * шаардлагатай байгаа.
       * */
      $tot_imsi = DB::table('REPORT_INBOUND')
          ->where('regdate', '=', date('Y-m-d', strtotime($date_first)))
          ->sum('report_inbound.overall_total_imsi');
      /*
       * Total_IMSI буюу tot_imsi variable нь over all total imsi мэдээлэл буюу өгөгдлийн санд
       * яг ийм нэртэй байгаа баганаас sum хийх буюу бүх мөрийн утгыг нэмж аваад веб хуудсанд харуулах
       * шаардлагатай байгаа.
       * */
      $overall_ttl_max = DB::table('REPORT_INBOUND')
          ->select('hpmn_code',
              'hpmn_name',
              'over_all_total_records',
              'overall_total_imsi')
          ->orderBy('over_all_total_records', 'DESC')
          ->where('regdate', '=', date('Y-m-d', strtotime($date_first)))
          ->distinct('hpmn_code')
          ->paginate(10);
      $test = "Hello World!";
      /*
       * overall_ttl_max /Overall_total_max_operators/ variable нь тухайн өдрийн хамгийн их CDR үүсгэсэн 10
       * operator-уудыг overall_total_records, over_all_total_imsi болон Tadig-уудын мэдээлэлтэй нь веб хуудсанд
       * хүснэгт байдлаар харуулах зорилготой
       * */


      /*
       * service нэртэй хувьсагч руу өгөгдлийн сангаас шаардлагатай багануудын утгуудыг sum хийж аваад
       * багануудын нэр тус бүрээр array үүсгээд тухайн sum хийж авсан утга бүрийг давталтаар оруулж
       * өгнө.
       * */
      $service = DB::table('REPORT_INBOUND')
          ->select(
              DB::raw('sum(moc_voice_records) as moc_voice_records'),
              DB::raw('sum(mtc_voice_records) as mtc_voice_records'),
              DB::raw('sum(moc_sms_records) as   moc_sms_records'),
              DB::raw('sum(mtc_sms_records) as   mtc_sms_records'),
              DB::raw('sum(gprs_records) as      gprs_records'))
          ->where('regdate', '=', date('Y-m-d', strtotime($date_first)))
          ->get();

      /* Chart зурахад шаардлагатай өгөгдөл бүрийг тусад нь хадгалах зорилготой array-уудыг
       * энд үүсгэж өгч байна.
       * */
      $moc_voice_records = array('MOC Voice Records');
      $mtc_voice_records = array('MTC Voice Records');
      $moc_sms_records = array('MOC SMS Records');
      $mtc_sms_records = array('MTC SMS Records');
      $gprs_records = array('GPRS Records');

      /*
       * Үүсгэсэн array-ууд руу тус бүрт давталтаар өгөгдлийн сангаас авсан утгуудаа оруулж өгнө.
       * */

      foreach ($service as $key => $value) {
        $moc_voice_records[++$key] = (int)$value->moc_voice_records;
      };

      foreach ($service as $key => $value) {
        $mtc_voice_records[++$key] = (int)$value->mtc_voice_records;
      };
      foreach ($service as $key => $value) {
        $moc_sms_records[++$key] = (int)$value->moc_sms_records;
      };
      foreach ($service as $key => $value) {
        $mtc_sms_records[++$key] = (int)$value->mtc_sms_records;
      };
      foreach ($service as $key => $value) {
        $gprs_records[++$key] = (int)$value->gprs_records;
      };

      /*Chart /Google Donut Chart/ зурахад шаардлагатай header data буюу манай тохиолдолд доорх гарчгийг
      үр дүнгийн array-ийн эхэнд утга оноож өгөөд цааш үргэлжлүүлээд array_push method-оор
      өмнөх өгөгдөл бүрийг хадгалж буй array-уудаа залгаж өгнө. */

      $service_result = array(['Services', 'Values']);
      array_push($service_result, $moc_voice_records, $mtc_voice_records, $moc_sms_records,
          $mtc_sms_records, $gprs_records);


      /*------------*-------------------*----------------*--------------*----------------*--------------*/
      /*------------*-------------------*----------------*--------------*----------------*--------------*/
      /*------------*-------------------*----------------*--------------*----------------*--------------*/
      /*------------*-------------------*----------------*--------------*----------------*--------------*/

      $gprs_service = DB::table('REPORT_INBOUND')
          ->select(
              DB::raw('sum(gprs_records) as gprs_records'),
              DB::raw('sum(gprs_charged_volume) as gprs_charged_volume'),
              DB::raw('sum(gprs_no_imsi) as gprs_no_imsi'))
          ->where('regdate', '=', date('Y-m-d', strtotime($date_first)))
          ->get();


      $gprs_records = array('GPRS Records');
      $gprs_charged_volume = array('GPRS Charged volume');
      $gprs_no_imsi = array('GPRS No IMSI');

      foreach ($gprs_service as $key => $value) {
        $gprs_records[++$key] = (int)$value->gprs_records;
      };

      /*----------------------------------------------------*/


      /*--------------------------------------------------------*/
      foreach ($gprs_service as $key => $value) {
        $gprs_charged_volume[++$key] = (int)$value->gprs_charged_volume / 1024;
      };


      /*-------------------------------------------------------*/
      foreach ($gprs_service as $key => $value) {
        $gprs_no_imsi[++$key] = (int)$value->gprs_no_imsi;
      };


      $gprs_result = array(['Services', $date_first]);
      array_push($gprs_result, $gprs_records, $gprs_charged_volume, $gprs_no_imsi);


//      $gprs_result = array(['Services', $date]);
//      array_push($gprs_result, $gprs_records, $gprs_charged_volume, $gprs_no_imsi);


      $moc_voice = DB::table('REPORT_INBOUND')
          ->select(
              DB::raw('sum(moc_voice_records) as moc_voice_records'),
              DB::raw('sum(moc_local_call_records) as moc_local_call_records'),
              DB::raw('sum(moc_local_home_records) as moc_local_home_records'),
              DB::raw('sum(moc_international_call_records) as moc_international_call_records'),
              DB::raw('sum(moc_voice_charged_duration) as moc_voice_charged_duration'),
              DB::raw('sum(moc_voice_no_imsi) as moc_voice_no_imsi')
          )
          ->where('regdate', '=', date('Y-m-d', strtotime($date_first)))
          ->get();

      $moc_voice_records = array('MOC Voice Records');
      $moc_local_call_records = array('MOC Local Call Records');
      $moc_local_home_records = array('MOC Local Home Records');
      $moc_international_call_records = array('MOC International Call Records');
      $moc_voice_charged_duration = array('MOC Voice Charged Duration');
      $moc_voice_no_imsi = array('MOC Voice No. IMSI');


      foreach ($moc_voice as $key => $value) {
        $moc_voice_records[++$key] = (int)$value->moc_voice_records;
      };

      foreach ($moc_voice as $key => $value) {
        $moc_local_call_records[++$key] = (int)$value->moc_local_call_records;
      };
      foreach ($moc_voice as $key => $value) {
        $moc_local_home_records[++$key] = (int)$value->moc_local_home_records;
      };
      foreach ($moc_voice as $key => $value) {
        $moc_international_call_records[++$key] = (int)$value->moc_international_call_records;
      };
      foreach ($moc_voice as $key => $value) {
        $moc_voice_charged_duration[++$key] = (int)$value->moc_voice_charged_duration;
      };
      foreach ($moc_voice as $key => $value) {
        $moc_voice_no_imsi[++$key] = (int)$value->moc_voice_no_imsi;
      };


      $moc_voice_result = array(['Services', $date_first]);
      array_push($moc_voice_result, $moc_voice_records, $moc_local_call_records,
          $moc_local_home_records, $moc_international_call_records, $moc_voice_charged_duration,
          $moc_voice_no_imsi);


      $mtc_voice = DB::table('REPORT_INBOUND')
          ->select(
              DB::raw('sum(mtc_voice_records) as mtc_voice_records'),
              DB::raw('sum(mtc_voice_charged_duration) as mtc_voice_charged_duration'),
              DB::raw('sum(mtc_voice_no_imsi) as mtc_voice_no_imsi')
          )
          ->where('regdate', '=', date('Y-m-d', strtotime($date_first)))
          ->get();

      $mtc_voice_records = array('mtc_voice_records');
      $mtc_voice_charged_duration = array('mtc_voice_charged_duration');
      $mtc_voice_no_imsi = array('mtc_voice_no_imsi');


      foreach ($mtc_voice as $key => $value) {
        $mtc_voice_records[++$key] = (int)$value->mtc_voice_records;
      };
      foreach ($mtc_voice as $key => $value) {
        $mtc_voice_charged_duration[++$key] = (int)$value->mtc_voice_charged_duration;
      };
      foreach ($mtc_voice as $key => $value) {
        $mtc_voice_no_imsi[++$key] = (int)$value->mtc_voice_no_imsi;
      };


      $mtc_voice_result = array(['Services', $date_first]);

      array_push($mtc_voice_result, $mtc_voice_records, $mtc_voice_charged_duration,
          $mtc_voice_no_imsi);


      $moc_sms = DB::table('REPORT_INBOUND')
          ->select(
              DB::raw('sum(moc_sms_records) as moc_sms_records'),
              DB::raw('sum(moc_sms_no_imsi) as moc_sms_no_imsi')

          )
          ->where('regdate', '=', date('Y-m-d', strtotime($date_first)))
          ->get();

      $moc_sms_records = array('moc_sms_records');
      $moc_sms_no_imsi = array('moc_sms_no_imsi');

      foreach ($moc_sms as $key => $value) {
        $moc_sms_records[++$key] = (int)$value->moc_sms_records;
      }
      foreach ($moc_sms as $key => $value) {
        $moc_sms_no_imsi[++$key] = (int)$value->moc_sms_no_imsi;
      }

      $moc_sms_result = array(['Service', $date_first]);
      array_push($moc_sms_result, $moc_sms_records, $moc_sms_no_imsi);


      $mtc_sms = DB::table('REPORT_INBOUND')
          ->select(
              DB::raw('sum(mtc_sms_records) as mtc_sms_records'),
              DB::raw('sum(mtc_sms_no_imsi) as mtc_sms_no_imsi')

          )
          ->where('regdate', '=', date('Y-m-d', strtotime($date_first)))
          ->get();

      $mtc_sms_records = array('mtc_sms_records');
      $mtc_sms_no_imsi = array('mtc_sms_no_imsi');

      foreach ($mtc_sms as $key => $value) {
        $mtc_sms_records[++$key] = (int)$value->mtc_sms_records;
      }
      foreach ($mtc_sms as $key => $value) {
        $mtc_sms_no_imsi[++$key] = (int)$value->mtc_sms_no_imsi;
      }

      $mtc_sms_result = array(['Service', $date_first]);
      array_push($mtc_sms_result, $mtc_sms_records, $mtc_sms_no_imsi);

    }
    if (!is_null($date_second)) {
//      echo $date_second;
      $f_date_second = date('Y-m-d', strtotime(substr($date_second, 0, 10)));
      $s_date_second = date('Y-m-d', strtotime(substr($date_second, 14)));

      $p_date_second = $f_date_second . ' , ' . $s_date_second;


      $ref_count = DB::table('REFERENCE_RP_CURRENT')
          ->count();

      /*
       * ref_count variable нь манайд бүртгэгдсэн нийт operator-уудын тоог count хийж
       * татаж байгаа. Нийт operator-уудын тоо нь 100% гэж үзвэл тухайн өдрийн нийт CDR
       * үүссэн operator-ууд 100%-иас хэдэн хувь байгааг тооцоолох шаардлагатай.
       * */
      $count = DB::table('REPORT_INBOUND')
          ->whereBetween('regdate', array($f_date_second, $s_date_second))
          ->distinct()
          ->count('hpmn_code');

      /*
       * count variable нь тухайн өдрийн нийт CDR бичлэгийг татаж байгаа.
       * */
      $tot_rec = DB::table('REPORT_INBOUND')
          ->whereBetween('regdate', array($f_date_second, $s_date_second))
          ->sum('report_inbound.over_all_total_records');
      /*
       * Total_records буюу tot_rec variable нь over all total records мэдээлэл буюу өгөгдлийн санд
       * яг ийм нэртэй байгаа баганаас sum хийх буюу бүх мөрийн утгыг нэмж аваад веб хуудсанд харуулах
       * шаардлагатай байгаа.
       * */
      $tot_imsi = DB::table('REPORT_INBOUND')
          ->whereBetween('regdate', array($f_date_second, $s_date_second))
          ->sum('report_inbound.overall_total_imsi');
      /*
       * Total_IMSI буюу tot_imsi variable нь over all total imsi мэдээлэл буюу өгөгдлийн санд
       * яг ийм нэртэй байгаа баганаас sum хийх буюу бүх мөрийн утгыг нэмж аваад веб хуудсанд харуулах
       * шаардлагатай байгаа.
       * */
      $overall_ttl_max = DB::table('REPORT_INBOUND')
          ->select(
              DB::raw('hpmn_code as hpmn_code'),
              DB::raw('hpmn_name as hpmn_name'),
              DB::raw('sum(over_all_total_records) as over_all_total_records'),
              DB::raw('sum(overall_total_imsi) as overall_total_imsi'))
          ->groupBy(['hpmn_code', 'hpmn_name'])
          ->orderBy('over_all_total_records', 'DESC')
          ->whereBetween('regdate', array($f_date_second, $s_date_second))
          ->distinct('hpmn_code')
          ->paginate(10);
      $test = "Hello World!";

      $service = DB::table('REPORT_INBOUND')
          ->select(
              DB::raw('sum(moc_voice_records) as moc_voice_records'),
              DB::raw('sum(mtc_voice_records) as mtc_voice_records'),
              DB::raw('sum(moc_sms_records) as   moc_sms_records'),
              DB::raw('sum(mtc_sms_records) as   mtc_sms_records'),
              DB::raw('sum(gprs_records) as      gprs_records'))
          ->whereBetween('regdate', array($f_date_second, $s_date_second))
          ->get();

      /* Chart зурахад шаардлагатай өгөгдөл бүрийг тусад нь хадгалах зорилготой array-уудыг
       * энд үүсгэж өгч байна.
       * */
      $moc_voice_records = array('MOC VOICE RECORDS');
      $mtc_voice_records = array('MTC VOICE RECORDS');
      $moc_sms_records = array('MOC SMS RECORDS');
      $mtc_sms_records = array('MTC SMS RECORDS');
      $gprs_records = array('GPRS RECORDS');

      /*
       * Үүсгэсэн array-ууд руу тус бүрт давталтаар өгөгдлийн сангаас авсан утгуудаа оруулж өгнө.
       * */

      foreach ($service as $key => $value) {
        $moc_voice_records[++$key] = (int)$value->moc_voice_records;
      };

      foreach ($service as $key => $value) {
        $mtc_voice_records[++$key] = (int)$value->mtc_voice_records;
      };
      foreach ($service as $key => $value) {
        $moc_sms_records[++$key] = (int)$value->moc_sms_records;
      };
      foreach ($service as $key => $value) {
        $mtc_sms_records[++$key] = (int)$value->mtc_sms_records;
      };
      foreach ($service as $key => $value) {
        $gprs_records[++$key] = (int)$value->gprs_records;
      };

      /*Chart /Google Donut Chart/ зурахад шаардлагатай header data буюу манай тохиолдолд доорх гарчгийг
      үр дүнгийн array-ийн эхэнд утга оноож өгөөд цааш үргэлжлүүлээд array_push method-оор
      өмнөх өгөгдөл бүрийг хадгалж буй array-уудаа залгаж өгнө. */

      $service_result = array(['Services', 'Values']);
      array_push($service_result, $moc_voice_records, $mtc_voice_records, $moc_sms_records,
          $mtc_sms_records, $gprs_records);


      /*------------*-------------------*----------------*--------------*----------------*--------------*/
      /*------------*-------------------*----------------*--------------*----------------*--------------*/
      /*------------*-------------------*----------------*--------------*----------------*--------------*/
      /*------------*-------------------*----------------*--------------*----------------*--------------*/

      $gprs_service = DB::table('REPORT_INBOUND')
          ->select(
              DB::raw('sum(gprs_records) as gprs_records'),
              DB::raw('sum(gprs_charged_volume) as gprs_charged_volume'),
              DB::raw('sum(gprs_no_imsi) as gprs_no_imsi'))
          ->whereBetween('regdate', array($f_date_second, $s_date_second))
          ->get();



      $gprs_records = array('GPRS Records');
      $gprs_charged_volume = array('GPRS charged volume');
      $gprs_no_imsi = array('GPRS No IMSI');

      foreach ($gprs_service as $key => $value) {
        $gprs_records[++$key] = (int)$value->gprs_records;
      };

      /*----------------------------------------------------*/



      /*--------------------------------------------------------*/
      foreach ($gprs_service as $key => $value) {
        $gprs_charged_volume[++$key] = (int)$value->gprs_charged_volume / 1024;
      };

      foreach ($gprs_service as $key => $value) {
        $gprs_no_imsi[++$key] = (int)$value->gprs_no_imsi;
      };






      $gprs_result = array(['Services', $p_date_second]);
      array_push($gprs_result, $gprs_records, $gprs_charged_volume, $gprs_no_imsi);


      $moc_voice = DB::table('REPORT_INBOUND')
          ->select(
              DB::raw('sum(moc_voice_records) as moc_voice_records'),
              DB::raw('sum(moc_local_call_records) as moc_local_call_records'),
              DB::raw('sum(moc_local_home_records) as moc_local_home_records'),
              DB::raw('sum(moc_international_call_records) as moc_international_call_records'),
              DB::raw('sum(moc_voice_charged_duration) as moc_voice_charged_duration'),
              DB::raw('sum(moc_voice_no_imsi) as moc_voice_no_imsi')
          )
          ->whereBetween('regdate', array($f_date_second, $s_date_second))
          ->get();

      $moc_voice_records = array('moc_voice_records');
      $moc_local_call_records = array('moc_local_call_records');
      $moc_local_home_records = array('moc_local_home_records');
      $moc_international_call_records = array('moc_international_call_records');
      $moc_voice_charged_duration = array('moc_voice_charged_duration');
      $moc_voice_no_imsi = array('moc_voice_no_imsi');


      foreach ($moc_voice as $key => $value) {
        $moc_voice_records[++$key] = (int)$value->moc_voice_records;
      };

      foreach ($moc_voice as $key => $value) {
        $moc_local_call_records[++$key] = (int)$value->moc_local_call_records;
      };
      foreach ($moc_voice as $key => $value) {
        $moc_local_home_records[++$key] = (int)$value->moc_local_home_records;
      };
      foreach ($moc_voice as $key => $value) {
        $moc_international_call_records[++$key] = (int)$value->moc_international_call_records;
      };
      foreach ($moc_voice as $key => $value) {
        $moc_voice_charged_duration[++$key] = (int)$value->moc_voice_charged_duration;
      };
      foreach ($moc_voice as $key => $value) {
        $moc_voice_no_imsi[++$key] = (int)$value->moc_voice_no_imsi;
      };


      $moc_voice_result = array(['Services', $p_date_second]);
      array_push($moc_voice_result, $moc_voice_records, $moc_local_call_records,
          $moc_local_home_records, $moc_international_call_records, $moc_voice_charged_duration,
          $moc_voice_no_imsi);


      $mtc_voice = DB::table('REPORT_INBOUND')
          ->select(
              DB::raw('sum(mtc_voice_records) as mtc_voice_records'),
              DB::raw('sum(mtc_voice_charged_duration) as mtc_voice_charged_duration'),
              DB::raw('sum(mtc_voice_no_imsi) as mtc_voice_no_imsi')
          )
          ->whereBetween('regdate', array($f_date_second, $s_date_second))
          ->get();

      $mtc_voice_records = array('mtc_voice_records');
      $mtc_voice_charged_duration = array('mtc_voice_charged_duration');
      $mtc_voice_no_imsi = array('mtc_voice_no_imsi');


      foreach ($mtc_voice as $key => $value) {
        $mtc_voice_records[++$key] = (int)$value->mtc_voice_records;
      };
      foreach ($mtc_voice as $key => $value) {
        $mtc_voice_charged_duration[++$key] = (int)$value->mtc_voice_charged_duration;
      };
      foreach ($mtc_voice as $key => $value) {
        $mtc_voice_no_imsi[++$key] = (int)$value->mtc_voice_no_imsi;
      };


      $mtc_voice_result = array(['Services', $p_date_second]);

      array_push($mtc_voice_result, $mtc_voice_records, $mtc_voice_charged_duration,
          $mtc_voice_no_imsi);


      $moc_sms = DB::table('REPORT_INBOUND')
          ->select(
              DB::raw('sum(moc_sms_records) as moc_sms_records'),
              DB::raw('sum(moc_sms_no_imsi) as moc_sms_no_imsi')
          )
          ->whereBetween('regdate', array($f_date_second, $s_date_second))
          ->get();

      $moc_sms_records = array('moc_sms_records');
      $moc_sms_no_imsi = array('moc_sms_no_imsi');

      foreach ($moc_sms as $key => $value) {
        $moc_sms_records[++$key] = (int)$value->moc_sms_records;
      }
      foreach ($moc_sms as $key => $value) {
        $moc_sms_no_imsi[++$key] = (int)$value->moc_sms_no_imsi;
      }

      $moc_sms_result = array(['Service', $p_date_second]);
      array_push($moc_sms_result, $moc_sms_records, $moc_sms_no_imsi);


      $mtc_sms = DB::table('REPORT_INBOUND')
          ->select(
              DB::raw('sum(mtc_sms_records) as mtc_sms_records'),
              DB::raw('sum(mtc_sms_no_imsi) as mtc_sms_no_imsi')

          )
          ->whereBetween('regdate', array($f_date_second, $s_date_second))
          ->get();

      $mtc_sms_records = array('mtc_sms_records');
      $mtc_sms_no_imsi = array('mtc_sms_no_imsi');

      foreach ($mtc_sms as $key => $value) {
        $mtc_sms_records[++$key] = (int)$value->mtc_sms_records;
      }
      foreach ($mtc_sms as $key => $value) {
        $mtc_sms_no_imsi[++$key] = (int)$value->mtc_sms_no_imsi;
      }

      $mtc_sms_result = array(['Service', $p_date_second]);
      array_push($mtc_sms_result, $mtc_sms_records, $mtc_sms_no_imsi);
    }
    if (!is_null($date_comp)) {

//      $time_date_first = date('Y-m-d', strtotime(substr($date_first, 0, 10)));
//      $time_date_second = date('Y-m-d', strtotime(substr($date_second, 14)));
//      $time_date = $time_date_first . ' , ' . $time_date_second;

      $f_date_first = date('Y-m-d', strtotime(substr($date_comp, 0, 10)));
      $f_date_second = date('Y-m-d', strtotime(substr($date_comp, 14)));

      $s_date_first = date('Y-m-d', strtotime(substr($date_comp_s, 0, 10)));
      $s_date_second = date('Y-m-d', strtotime(substr($date_comp_s, 14)));

      $k_date = $f_date_first . ' , ' . $f_date_second;
      $p_date = $s_date_first . ' , ' . $s_date_second;

      $gprs_service = DB::table('REPORT_INBOUND')
          ->select(
              DB::raw('sum(gprs_records) as gprs_records'),
              DB::raw('sum(gprs_charged_volume) as gprs_charged_volume'),
              DB::raw('sum(gprs_no_imsi) as gprs_no_imsi'))
          ->whereBetween('regdate', array($f_date_first, $f_date_second))
          ->get();


      $gprs_service_sec = DB::table('REPORT_INBOUND')
          ->select(
              DB::raw('sum(gprs_records) as gprs_records_sec'),
              DB::raw('sum(gprs_charged_volume) as gprs_charged_volume_sec'),
              DB::raw('sum(gprs_no_imsi) as gprs_no_imsi_sec'))
          ->whereBetween('regdate', array($s_date_first, $s_date_second))
          ->get();

      $gprs_records = array('GPRS Records');
      $gprs_charged_volume = array('GPRS charged volume');
      $gprs_no_imsi = array('GPRS No IMSI');


      foreach ($gprs_service as $key => $value) {
        $gprs_records[++$key] = (int)$value->gprs_records;
      };

      foreach ($gprs_service_sec as $key => $value) {
        $gprs_records_sec = (int)$value->gprs_records_sec;
      };
      /*--------------------------------------------------------*/
      foreach ($gprs_service as $key => $value) {
        $gprs_charged_volume[++$key] = (int)$value->gprs_charged_volume / 1024;
      };

      foreach ($gprs_service_sec as $key => $value) {
        $gprs_charged_volume_sec = (int)$value->gprs_charged_volume_sec / 1024;
      };


      /*-------------------------------------------------------*/
      foreach ($gprs_service as $key => $value) {
        $gprs_no_imsi[++$key] = (int)$value->gprs_no_imsi;
      };

      foreach ($gprs_service_sec as $key => $value) {
        $gprs_no_imsi_sec = (int)$value->gprs_no_imsi_sec;
      };

//
//      $gprs_result = array(['Services', date('Y-m-d', strtotime("-1 days"))]);
//      array_push($gprs_result, $gprs_records, $gprs_charged_volume, $gprs_no_imsi);






      /*-------------------------------------------------------*/





      array_push($gprs_records, $gprs_records_sec);
      array_push($gprs_charged_volume, $gprs_charged_volume_sec);
      array_push($gprs_no_imsi, $gprs_no_imsi_sec);

      $gprs_result = array(['Services', date($k_date), date($p_date)]);
      array_push($gprs_result, $gprs_records, $gprs_charged_volume, $gprs_no_imsi);
    }


    $view = View('/traffic_report')
        ->with('count', $count)
        ->with('ref_count', $ref_count)
        ->with('tot_rec', $tot_rec)
        ->with('tot_imsi', $tot_imsi)
//        -> with(compact($data))
        ->with('overall_ttl_max', $overall_ttl_max)
        ->with('service', json_encode($service_result))
        ->with('gprs_result', json_encode($gprs_result))
        ->with('moc_voice_result', json_encode($moc_voice_result))
        ->with('mtc_voice_result', json_encode($mtc_voice_result))
        ->with('moc_sms_result', json_encode($moc_sms_result))
        ->with('mtc_sms_result', json_encode($mtc_sms_result));

    /*
     * Боловсруулалт хийсэн хувьсагчуудаа нэг view гэсэн хувьсагч руу шууд return буюу буцаахад бэлэн
     * байдлаар утга өгөөд $view нэртэй хувьсагчаа доор бичсэнээр шууд буцааж байгаа.
     * */
    return $view;
  }
}
