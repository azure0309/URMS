<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Datatables;
use App\alarm;
use DB;

class AlarmController extends Controller
{
    public function show(Request $request)
    {
        // $from = date('2019/01/13 20:00');
        // $to = date('2019/01/13 21:00');
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');
        // return json_encode($start_date);
        $from = date($start_date);
        $to = date($end_date);
        $alarm = alarm::select([
            'SEVERITY',
            'IMSI',
            'DIR',
            'TADIG',
            'DT',
            'C_TYPE',
            'DETAIL',
            'REG_DATE',
            'STATUS',
            'DESCRIPTION',
            'ID'
        ])->whereBetween('reg_date', [$from, $to]);


        return DataTables::of($alarm)
            ->filterColumn('name', function ($query, $keyword) {
                $sql = "name  like ?";
                $query->whereRaw($sql, ["%{$keyword}%"]);
            })->addColumn('action', function ($alarm) {
                return '<a href="#" id="' . $alarm->id . '" class="btn btn-info btn-xs edit" data-toggle="modal" data-target="#alarm-action">
                            <i class="glyphicon glyphicon-edit"></i>Action</a>';
            })->setRowClass(function ($alarm) {
                if ($alarm->status == 'Clear') {
                    return 'bg-light text-dark';
                }
                if ($alarm->severity == 'Critical') {
                    return 'bg-danger text-white';
                }
                if ($alarm->severity == 'Major') {
                    return 'bg-warning text-dark';
                }
                if ($alarm->severity == 'Minor') {
                    return 'bg-info text-white';
                }
            })
            ->toJson();
    }

    public function edit(Request $request)
    {
        $id = $request->input('id');
        $data = Alarm::find($id);
        $output = array('status' => $data->status, 'description' => $data->description);
        echo json_encode($output);
    }

    public function update(Request $request)
    {
        $id = $request->input('id');
        $data = Alarm::find($id);
        $data->status = $request->input('status');
        $data->description = $request->input('description');
        $data->save();
        return redirect('real-time-monitor');
    }

    public function check(Request $request)
    {
        $total = DB::statement("select count(*) AS TOTAL from RM_ALARM_BILL where to_char(REG_DATE, 'yyyyMMDDHH24MI') >= to_char(sysdate-5/1440, 'yyyyMMDDHH24MI')");
        echo $total['TOTAL'];
        if ($total['TOTAL'] != 0) {
            echo 1;
        } else {
            echo 0;
        }
    }
}
