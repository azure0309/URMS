<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();
// Route::get('/register', 'RegisterController@register')->name('register');
Route::get('/real-time-monitor', 'PagesController@index')->name('real-time-monitor');
Route::get('/dashboard', 'PagesController@dashboard_users')->name('dashboard');
Route::get('/dashboard/users', 'PagesController@dashboard_users')->name('dashboard/users');
Route::get('/dashboard/user-log', 'PagesController@dashboard_log')->name('dashboard/user-log');
Route::get('/call-center', 'PagesController@call_center')->name('call-center');
Route::get('/hotline', 'PagesController@hotline')->name('hotline');
Route::get('/daily_report', 'PagesController@daily_report')->name('daily_report');
Route::get('/report/traffic_report', 'PagesController@traffic_report')->name('traffic_report');
Route::get('/report/quality_report', 'PagesController@quality_report')->name('quality_report');
Route::get('/report', 'PagesController@report')->name('report');
Route::get('/reference-rp', 'PagesController@reference_rp')->name('reference-rp');
Route::get('/threshold', 'PagesController@threshold')->name('/threshold');
Route::get('/vip-subscriber', 'PagesController@vip_subscriber')->name('/vip-subscriber');
Route::get('/outbound-nrt', 'PagesController@outbound_nrt')->name('/outbound-nrt');
Route::get('/outbound-tap', 'PagesController@outbound_tap')->name('/outbound-tap');
Route::get('/inbound-nrt', 'PagesController@inbound_nrt')->name('/inbound-nrt');
Route::get('/inbound-tap', 'PagesController@inbound_tap')->name('/inbound-tap');
Route::get('/stp-transaction', 'PagesController@stp_transaction')->name('/stp-transaction');
Route::get('/reference-rp-history', 'PagesController@reference_rp_history')->name('/reference-rp-history');
Route::post('/dashboard/show',['uses'=>'DashboardController@show', 'as' => '/dashboard/show']);
Route::post('/dashboard/edit',['uses'=>'DashboardController@edit', 'as' => '/dashboard/edit']);
Route::post('/dashboard/update',['uses'=>'DashboardController@update', 'as' => '/dashboard/update']);
Route::post('/dashboard/delete',['uses'=>'DashboardController@delete', 'as' => '/dashboard/delete']);
Route::post('/real-time-monitor/show',['uses'=>'AlarmController@show', 'as' => '/real-time-monitor/show']);
Route::post('/real-time-monitor/edit',['uses'=>'AlarmController@edit', 'as' => '/real-time-monitor/edit']);
Route::post('/real-time-monitor/update',['uses'=>'AlarmController@update', 'as' => '/real-time-monitor/update']);
Route::post('/real-time-monitor/check',['uses'=>'AlarmController@check', 'as' => '/real-time-monitor/check']);
Route::post('/reference-rp/show',['uses'=>'ReferenceController@reference_show', 'as' => '/reference-rp/show']);
Route::post('/reference-rp/edit',['uses'=>'ReferenceController@reference_edit', 'as' => '/reference-rp/edit']);
Route::post('/reference-rp/update',['uses'=>'ReferenceController@reference_update', 'as' => '/reference-rp/update']);
Route::post('/reference-rp/store',['uses'=>'ReferenceController@reference_store', 'as' => '/reference-rp/store']);
Route::post('/reference-rp/delete',['uses'=>'ReferenceController@reference_delete', 'as' => '/reference-rp/delete']);
Route::post('/threshold/show',['uses'=>'ReferenceController@threshold_show', 'as' => '/threshold/show']);
Route::post('/threshold/edit',['uses'=>'ReferenceController@threshold_edit', 'as' => '/threshold/edit']);
Route::post('/threshold/update',['uses'=>'ReferenceController@threshold_update', 'as' => '/threshold/update']);
Route::post('/vip-subscriber/show',['uses'=>'ReferenceController@vip_sub_show', 'as' => '/vip-subscriber/show']);
Route::post('/vip-subscriber/edit',['uses'=>'ReferenceController@vip_sub_edit', 'as' => '/vip-subscriber/edit']);
Route::post('/vip-subscriber/update',['uses'=>'ReferenceController@vip_sub_update', 'as' => '/vip-subscriber/update']);
Route::post('/vip-subscriber/store',['uses'=>'ReferenceController@vip_sub_store', 'as' => '/vip-subscriber/store']);
Route::post('/vip-subscriber/delete',['uses'=>'ReferenceController@vip_sub_delete', 'as' => '/vip-subscriber/delete']);
Route::post('/outbound-nrt/show',['uses'=>'DBQueryController@out_nrt_show', 'as' => '/outbound-nrt/show']);
Route::post('/outbound-tap/show',['uses'=>'DBQueryController@out_tap_show', 'as' => '/outbound-tap/show']);
Route::post('/inbound-nrt/show',['uses'=>'DBQueryController@in_nrt_show', 'as' => '/inbound-nrt/show']);
Route::post('/inbound-tap/show',['uses'=>'DBQueryController@in_tap_show', 'as' => '/inbound-tap/show']);
Route::post('/stp-transaction/show',['uses'=>'DBQueryController@stp_transaction_show', 'as' => '/stp-transaction/show']);
Route::post('/reference-rp-history/show',['uses'=>'DBQueryController@reference_rp_history_show', 'as' => '/reference-rp-history/show']);
Route::post('/reference-rp-history/edit',['uses'=>'DBQueryController@reference_rp_history_edit', 'as' => '/reference-rp-history/edit']);
Route::post('/reference-rp-history/update',['uses'=>'DBQueryController@reference_rp_history_update', 'as' => '/reference-rp-history/update']);

Route::post('/sub-analysis/call-center/service-attempt',['uses'=>'SubAnalysisController@service_attempt_show', 'as' => '/sub-analysis/call-center/service-attempt']);
Route::post('/sub-analysis/call-center/status',['uses'=>'SubAnalysisController@sub_status_show', 'as' => '/sub-analysis/call-center/status']);
Route::post('/sub-analysis/call-center/location-status',['uses'=>'SubAnalysisController@sub_location_status', 'as' => '/sub-analysis/call-center/location-status']);
Route::post('/sub-analysis/call-center/network-time-breakdown',['uses'=>'SubAnalysisController@network_time_breakdown', 'as' => '/sub-analysis/call-center/network-time-breakdown']);

Route::post('/sub-analysis/hotline/voice',['uses'=>'SubAnalysisController@hotline_voice_show', 'as' => '/sub-analysis/hotline/voice']);
Route::post('/sub-analysis/hotline/sms',['uses'=>'SubAnalysisController@hotline_sms_show', 'as' => '/sub-analysis/hotline/sms']);
Route::post('/sub-analysis/hotline/data',['uses'=>'SubAnalysisController@hotline_data_show', 'as' => '/sub-analysis/hotline/data']);

Route::get('/daily_report', 'Table_Inbound@daily_tb');
Route::get('/report/traffic_report', 'resultGraph@count_cdr');
Route::get('/report/quality_report', 'quality_result@result_sig');
