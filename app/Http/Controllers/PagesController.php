<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class PagesController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('real_time_monitor');
    }
    public function dashboard()
    {
        $user = User::find(auth::user()->id);
        if ($user->permission < 7) {
            return redirect('/real_time_monitor');
        }
        return view('dashboard');
    }
    public function dashboard_users()
    {
        return view('users');
    }
    public function dashboard_log()
    {
        return view('log');
    }
    public function traffic()
    {
        return view('traffic');
    }
    public function report()
    {
        return view('report');
    }
    public function invoice()
    {
        return view('invoice');
    }
    public function reference_rp()
    {
        return view('reference_rp');
    }
    public function threshold()
    {
        return view('threshold');
    }
    public function vip_subscriber()
    {
        return view('vip_subscriber');
    }
    public function outbound_nrt()
    {
        return view('outbound_nrt');
    }
    public function outbound_tap()
    {
        return view('outbound_tap');
    }
    public function inbound_nrt()
    {
        return view('inbound_nrt');
    }
    public function inbound_tap()
    {
        return view('inbound_tap');
    }
    public function stp_transaction()
    {
        return view('stp_transaction');
    }
    public function reference_rp_history()
    {
        return view('reference_rp_history');
    }
    public function call_center()
    {
        return view('call_center');
    }
    public function hotline()
    {
        return view('hotline');
    }
}
