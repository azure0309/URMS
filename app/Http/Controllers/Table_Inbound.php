<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Table_Inbound extends Controller
{
  public function daily_tb(Request $request)
  {
    /*
     * Энд бичигдсэн утгууд нь traffic хуудсанд харагдах тухайн өдрийн CDR, Signaling бичлэгүүдийг
     * ямар нэгэн шүүлтүүргүйгээр татаж веб хуудсанд хүснэгт байдлаар харуулах зорилготой.
     *
     * REPORT_INBOUND_ болон REPORT_OUTBOUND table-үүдээс өгөгдлүүдийг татаж тус тусд нь хувьсагчид
     * хадгалаад дараа нь 2-ууланг нь зэрэг view-рүү буцаах үйлдэл байгаа.
     * */
    $f_date = $request->input('date_first');
    $s_date = $request->input('date_second');


      $inbound['inbound'] = DB::table('REPORT_INBOUND')
          ->where('regdate', '=', date('Y-m-d', strtotime("-1 days")))
          ->get();
      $outbound['outbound'] = DB::table('REPORT_OUTBOUND')
          ->where('regdate', '=', date('Y-m-d', strtotime("-1 days")))
          ->get();
    if(!is_null($f_date)){
      $inbound['inbound'] = DB::table('REPORT_INBOUND')
          ->where('regdate', '=', date('Y-m-d', strtotime($f_date)))
          ->get();
      $outbound['outbound'] = DB::table('REPORT_OUTBOUND')
          ->where('regdate', '=', date('Y-m-d', strtotime($f_date)))
          ->get();
    }
    if(!is_null($s_date)){
      $f_date_second = date('Y-m-d', strtotime(substr($s_date, 0, 10)));
      $s_date_second = date('Y-m-d', strtotime(substr($s_date, 14)));

      $inbound['inbound'] = DB::table('REPORT_INBOUND')
          ->whereBetween('regdate', array($f_date_second, $s_date_second))
          ->orderBy('regdate')
          ->get();
      $outbound['outbound'] = DB::table('REPORT_OUTBOUND')
          ->whereBetween('regdate', array($f_date_second, $s_date_second))
          ->orderBy('regdate')
          ->get();
    }




    return view('/daily_report', $inbound, $outbound);


  }
}

