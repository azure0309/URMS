@extends('layouts.main')
@section('content')
    <div style="margin: 3%;" class="card">
        <div class="card-header container-fluid">
            <div class="row">
                <div class="col-lg-3">
                    <div class="row">
                        <div class="service_type col-lg-6">
                            <H3 style="margin-top: 5%; margin-left: 10%; margin-bottom: 5%;">Service Type</H3>
                            <div class="funkyradio">
                                <div style="margin-top: 30px;" class="funkyradio-primary">
                                    <input type="radio" name="radio" onclick="inbound()" id="radio1" checked/>
                                    <label for="radio1">INBOUND</label>
                                </div>
                                <div class="funkyradio-danger">
                                    <input style="margin-top: 1px" type="radio" name="radio" onclick="outbound()"
                                           id="radio2"/>
                                    <label for="radio2">OUTBOUND</label>
                                </div>
                            </div>
                        </div>
                        <div class="level_top col-lg-6">
                            <h3 style="margin-top: 5%; margin-left: 30px; margin-bottom: 2%;">Level</h3>
                            <div style="margin-left: 30px; margin-top: 30px;">
                                <input style="margin-left: 1%" type="checkbox" name="level_1">
                                <label>Level 1</label>
                            </div>
                            <div style="margin-left: 30px;">
                                <input style="margin-left: 1%" type="checkbox" name="level_2">
                                <label>Level 2</label>
                            </div>
                            <div style="margin-left: 30px">
                                <input style="margin-left: 1%" type="checkbox" name="level_3">
                                <label>Level 3</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="row">
                        <div class="time_range col">
                            <h4>Time Range</h4>
                            <div class="tab">
                                <button style="border-top-left-radius: 10px;" class="tablinks"
                                        onclick="openCity(event, 'Daily')"
                                        id="defaultOpen">Daily
                                </button>
                                <button style="border-bottom-left-radius: 10px;" class="tablinks"
                                        onclick="openCity(event, 'Custom')">
                                    Custom
                                </button>

                            </div>

                            <div id="Daily" class="tabcontent">

                                <form action="" method="get">
                                    <div class="form-group">
                                        <input style="cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 80%"
                                               name="date_first" id="datepicker"/>
                                        <i class="fa fa-calendar"></i>&nbsp;
                                        <input class="btn btn-primary btn-xs" style="margin-top: 3%; float: left;"
                                               type="submit">
                                    </div>
                                </form>
                            </div>


                            <div id="Custom" class="tabcontent">
                                <form action="" method="get">
                                    <input id="reportrange" name="date_second"
                                           style="cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 80%">
                                    <i class="fa fa-calendar"></i>&nbsp;
                                    <span></span> <i class="fa fa-caret-down"></i>
                                    <input class="btn btn-primary btn-xs" style="margin-top: 3%; float: left;"
                                           type="submit">
                                </form>
                            </div>

                        </div>
                        
                    </div>

                </div>
                <div style='background-color: white' class='col-lg-5'>
                                <center>
                                    <h3 style="margin-top: 2%; margin-left: -15%; margin-bottom: 2%;">Record Type</h3>
                                </center>
                                <div class="row">
                                    <div class="col" style="margin-left: 10%; float: right;">
                                        <h5>Traffic</h5>
                                        <div class="row">
                                            <div style="width: 120px; float: left;">
                                                <div style="float: left">
                                                    <input type="checkbox" name="overall">
                                                    <label style="font-size: 12px">OVERALL TOTAL</label>
                                                </div>
                                                <div style="float: left;">
                                                    <input type="checkbox" name="moc_voice">
                                                    <label style="font-size: 12px">MOC VOICE</label>
                                                </div>
                                                <div style="float: left;">
                                                    <input type="checkbox" name="moc_sms">
                                                    <label style="font-size: 12px">MOC SMS</label>
                                                </div>
                                            </div>

                                            <div style="width: 100px; float: right;">
                                                <div style="float: left">
                                                    <input type="checkbox" name="gprs">
                                                    <label style="font-size: 12px">GPRS</label>
                                                </div>
                                                <div style="float: left;">
                                                    <input type="checkbox" name="mtc_voice">
                                                    <label style="font-size: 12px">MTC VOICE</label>
                                                </div>
                                                <div style="float: left;">
                                                    <input type="checkbox" name="mtc_sms">
                                                    <label style="font-size: 12px">MTC SMS</label>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="col" style="float: left">
                                        <h5>Quality</h5>
                                        <div class="row">
                                            <div style="width: 120px; float: left;">
                                                <div style="float: left">
                                                    <input type="checkbox" name="voice_lu">
                                                    <label style="font-size: 12px">VOICE LU</label>

                                                </div>
                                                <div style="float: left;">
                                                    <input type="checkbox" name="gprs_lu">
                                                    <label style="font-size: 12px">GPRS LU</label>
                                                </div>
                                                <div style="float: left;">
                                                    <input type="checkbox" name="voice_sai">
                                                    <label style="font-size: 12px">VOICE SAI</label>
                                                </div>
                                                <div style="float: left;">
                                                    <input type="checkbox" name="gprs_sai">
                                                    <label style="font-size: 12px">GPRS SAI</label>
                                                </div>
                                            </div>

                                            <div style="width: 120px; float: left;">
                                                <div style="float: left">
                                                    <input type="checkbox" name="voice_prn">
                                                    <label style="font-size: 12px">VOICE PRN</label>
                                                </div>
                                                <div style="float: left;">
                                                    <input type="checkbox" name="gprs_prn">
                                                    <label style="font-size: 12px">GPRS_PRN</label>
                                                </div>
                                                <div style="float: left;">
                                                    <input type="checkbox" name="smsc_mo">
                                                    <label style="font-size: 12px">SMSC MO</label>
                                                </div>
                                                <div style="float: left;">
                                                    <input type="checkbox" name="smsc_mt">
                                                    <label style="font-size: 12px">SMSC MT</label>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                            </div>
            </div>


        </div>
        {{--    <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for names.." title="Type in a name">--}}
        <div class="card-body">
            <div id="inbound-table"
                 class="table table-striped table-bordered table-hover"
                 style="height: 680px; width: 94%; margin: 3%; overflow: scroll">


                <table id="datatable-buttons" width="90%">
                    <thead class="thead-light">
                    <tr>
                        <th>RegDate</th>
                        <th>HPMN Code</th>
                        <th>Country</th>
                        <th>HPMN Name</th>
                        <th>GSM</th>
                        <th>GPRS</th>
                        <th>CAMEL</th>
                        <th>LTE</th>
                        <th class="overall">Overall Total Records</th>
                        <th>Overall Total No. IMSI</th>
                        <th>Overall Total Duration</th>
                        <th>Overall Total Volume</th>
                        <th>MOC Voice Records</th>
                        <th>MOC Local Call Records</th>
                        <th>MOC Call Home Records</th>
                        <th>MOC International Call Records</th>
                        <th>MOC Voice Charged Duration</th>
                        <th>MOC Voice No. IMSI</th>
                        <th>MOC SMS Records</th>
                        <th>MOC SMS No. IMSI</th>
                        <th>MTC Voice Records</th>
                        <th>MTC Voice Charged Duration</th>
                        <th>MTC Voice No. IMSI</th>
                        <th>MTC SMS Records</th>
                        <th>MTC SMS No. IMSI</th>
                        <th>GPRS Records</th>
                        <th>GPRS Charged Volume</th>
                        <th>GPRS No. IMSI</th>
                        <th>VLR NUMBER INBOUND</th>
                        <th>Update Location Total Request</th>
                        <th>Update Location Success Inbound</th>
                        <th>Update Location Failed Inbound</th>
                        <th>Update Location Error 8</th>
                        <th>Update Location Error 34</th>
                        <th>Update Location Error 36</th>
                        <th>Update Location Error 1</th>
                        <th>Update Location Error 35</th>
                        <th>Update Location Error 27</th>
                        <th>Update Location Error 32</th>
                        <th>Update Location Error 31</th>
                        <th>Update Location Error 5</th>
                        <th>Update Location Error 6</th>
                        <th>Update Location Error 21</th>
                        <th>Update Location Error 13</th>
                        <th>Update Location Error 2</th>
                        <th>Update Location Error 16</th>
                        <th>Update Location Error Other</th>
                        <th>Update Location Inbound Success Ratio</th>
                        <th>SGSN Number Inbound</th>
                        <th>GPRS Update Location Total Request</th>
                        <th>GPRS Update Location Success Inbound</th>
                        <th>GPRS Update Location Failed Inbound</th>
                        <th>GPRS Update Location Error 8</th>
                        <th>GPRS Update Location Error 1</th>
                        <th>GPRS Update Location Error 34</th>
                        <th>GPRS Update Location Error 36</th>
                        <th>GPRS Update Location Error 27</th>
                        <th>GPRS Update Location Error 35</th>
                        <th>GPRS Update Location Error 6</th>
                        <th>GPRS Update Location Error 5</th>
                        <th>GPRS Update Location Error Other</th>
                        <th>GPRS Update Location Success Ratio</th>
                        <th>CS SAI TOTAL REQUEST</th>
                        <th>CS SENDAUTH SUCCESS</th>
                        <th>CS SENDAUTH FAILURE</th>
                        <th>CS ERROR CODE_1</th>
                        <th>CS ERROR CODE 34</th>
                        <th>CS ERROR CODE 8</th>
                        <th>CS ERROR CODE 36</th>
                        <th>CS ERROR CODE 27</th>
                        <th>CS ERROR CODE 32</th>
                        <th>CS ERROR CODE 2</th>
                        <th>CS ERROR CODE 31</th>
                        <th>CS ERROR CODE 5</th>
                        <th>CS ERROR CODE 6</th>
                        <th>CS ERROR CODE 21</th>
                        <th>CS ERROR CODE 16</th>
                        <th>CS ERROR CODE 35</th>
                        <th>CS ERROR CODE 13</th>
                        <th>CS ERROR CODE OTHER</th>
                        <th>PS SAI TOTAL REQUEST</th>
                        <th>PS SENDAUTH SUCCESS</th>
                        <th>PS SENDAUTH FAILURE</th>
                        <th>PS ERROR CODE 1</th>
                        <th>PS ERROR CODE 34</th>
                        <th>PS ERROR CODE 8</th>
                        <th>PS ERROR CODE 36</th>
                        <th>PS ERROR CODE 27</th>
                        <th>PS ERROR CODE 2</th>
                        <th>PS ERROR CODE 31</th>
                        <th>PS ERROR CODE 32</th>
                        <th>PS ERROR CODE 6</th>
                        <th>PS ERROR CODE 9</th>
                        <th>PS ERROR CODE 13</th>
                        <th>PS ERROR CODE 5</th>
                        <th>PS ERROR CODE OTHER</th>
                        <th>MO SMS SUBTOTAL</th>
                        <th>MO SMS TOTAL REQUEST</th>
                        <th>MO SMS SUCCESS</th>
                        <th>MO SMS FAILURE</th>
                        <th>MO SMS ERROR 32</th>
                        <th>MO SMS ERROR 34</th>
                        <th>MO SMS ERROR 21</th>
                        <th>MO SMS ERROR 1</th>
                        <th>MO SMS ERROR 36</th>
                        <th>MO SMS ERROR 8</th>
                        <th>MO SMS ERROR 13</th>
                        <th>MO SMS ERROR 27</th>
                        <th>MO SMS ERROR 9</th>
                        <th>MO SMS ERROR 5</th>
                        <th>MO SMS ERROR OTHER</th>
                        <th>MT SMS SUBTOTAL</th>
                        <th>MT SMS TOTAL REQUEST</th>
                        <th>MT SMS SUCCESS</th>
                        <th>MT SMS FAILURE</th>
                        <th>MT SMS ERROR 27</th>
                        <th>MT SMS ERROR 6</th>
                        <th>MT SMS ERROR 5</th>
                        <th>MT SMS ERROR 31</th>
                        <th>MT SMS ERROR 32</th>
                        <th>MT SMS ERROR 9</th>
                        <th>MT SMS ERROR 34</th>
                        <th>MT SMS ERROR 21</th>
                        <th>MT SMS ERROR 8</th>
                        <th>MT SMS ERROR 1</th>
                        <th>MT SMS ERROR 36</th>
                        <th>MT SMS ERROR 33</th>
                        <th>MT SMS ERROR OTHER</th>
                        <th>PRN_SUBTOTAL</th>
                        <th>PRN TOTAL REQUEST</th>
                        <th>PRN SUCCESS NUMBER</th>
                        <th>PRN FAILURE NUMBER</th>
                        <th>PRN ERROR CODE 27</th>
                        <th>PRN ERROR CODE 34</th>
                        <th>PRN ERROR CODE 36</th>
                        <th>PRN ERROR CODE 8</th>
                        <th>PRN ERROR CODE 1</th>
                        <th>PRN ERROR CODE 31</th>
                        <th>PRN ERROR CODE 21</th>
                        <th>PRN ERROR CODE 6</th>
                        <th>PRN ERROR CODE OTHER</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($inbound as $value)
                        <tr class="table table-hover">
                            <td>{{ $value->regdate }}</td>
                            <td>{{ $value->hpmn_code }}</td>
                            <td>{{ $value->country }}</td>
                            <td>{{ $value->hpmn_name }}</td>
                            <td>{{ $value->gsm }}</td>
                            <td>{{ $value->gprs }}</td>
                            <td>{{ $value->camel }}</td>
                            <td>{{ $value->lte }}</td>
                            <td>{{ $value->over_all_total_records }}</td>
                            <td>{{ $value->overall_total_imsi }}</td>
                            <td>{{ $value->overall_total_duration }}</td>
                            <td>{{ $value->overall_total_volume }}</td>
                            <td>{{ $value->moc_voice_records }}</td>
                            <td>{{ $value->moc_local_call_records }}</td>
                            <td>{{ $value->moc_home_records }}</td>
                            <td>{{ $value->moc_international_call_records }}</td>
                            <td>{{ $value->moc_voice_charged_duration }}</td>
                            <td>{{ $value->moc_voice_no_imsi }}</td>
                            <td>{{ $value->moc_sms_records }}</td>
                            <td>{{ $value->moc_sms_no_imsi }}</td>
                            <td>{{ $value->mtc_voice_records }}</td>
                            <td>{{ $value->mtc_voice_charged_duration }}</td>
                            <td>{{ $value->mtc_voice_no_imsi }}</td>
                            <td>{{ $value->mtc_sms_records }}</td>
                            <td>{{ $value->mtc_sms_no_imsi }}</td>
                            <td>{{ $value->gprs_records }}</td>
                            <td>{{ $value->gprs_charged_volume }}</td>
                            <td>{{ $value->gprs_no_imsi }}</td>
                            <td>{{ $value->vlr_num_inbound }}</td>
                            <td>{{ $value->ul_total_request }}</td>
                            <td>{{ $value->ul_success_inbound }}</td>
                            <td>{{ $value->ul_failed_inbound }}</td>
                            <td>{{ $value->error_code_8 }}</td>
                            <td>{{ $value->error_code_34 }}</td>
                            <td>{{ $value->error_code_36 }}</td>
                            <td>{{ $value->error_code_1 }}</td>
                            <td>{{ $value->error_code_35 }}</td>
                            <td>{{ $value->error_code_27 }}</td>
                            <td>{{ $value->error_code_32 }}</td>
                            <td>{{ $value->error_code_31 }}</td>
                            <td>{{ $value->error_code_5 }}</td>
                            <td>{{ $value->error_code_6 }}</td>
                            <td>{{ $value->error_code_21 }}</td>
                            <td>{{ $value->error_code_13 }}</td>
                            <td>{{ $value->error_code_2 }}</td>
                            <td>{{ $value->error_code_16 }}</td>
                            <td>{{ $value->error_code_other }}</td>
                            <td>{{ $value->ul_inbound_success_ratio }}</td>
                            <td>{{ $value->sgsn_number_inbound }}</td>
                            <td>{{ $value->gprs_ul_total_request }}</td>
                            <td>{{ $value->gprs_ul_success_inbound }}</td>
                            <td>{{ $value->gprs_ul_failed_inbound }}</td>
                            <td>{{ $value->gprs_error_code_8 }}</td>
                            <td>{{ $value->gprs_error_code_1 }}</td>
                            <td>{{ $value->gprs_error_code_34 }}</td>
                            <td>{{ $value->gprs_error_code_36 }}</td>
                            <td>{{ $value->gprs_error_code_27 }}</td>
                            <td>{{ $value->gprs_error_code_35 }}</td>
                            <td>{{ $value->gprs_error_code_6 }}</td>
                            <td>{{ $value->gprs_error_code_5 }}</td>
                            <td>{{ $value->gprs_error_code_other }}</td>
                            <td>{{ $value->cs_sai_total_request  }}</td>
                            <td>{{ $value->cs_sendauth_success   }}</td>
                            <td>{{ $value->cs_sendauth_failure   }}</td>
                            <td>{{ $value->cs_error_code_1       }}</td>
                            <td>{{ $value->cs_error_code_34      }}</td>
                            <td>{{ $value->cs_error_code_8       }}</td>
                            <td>{{ $value->cs_error_code_36      }}</td>
                            <td>{{ $value->cs_error_code_27      }}</td>
                            <td>{{ $value->cs_error_code_32      }}</td>
                            <td>{{ $value->cs_error_code_2       }}</td>
                            <td>{{ $value->cs_error_code_31      }}</td>
                            <td>{{ $value->cs_error_code_5       }}</td>
                            <td>{{ $value->cs_error_code_6       }}</td>
                            <td>{{ $value->cs_error_code_21      }}</td>
                            <td>{{ $value->cs_error_code_16      }}</td>
                            <td>{{ $value->cs_error_code_35      }}</td>
                            <td>{{ $value->cs_error_code_13      }}</td>
                            <td>{{ $value->cs_error_code_other   }}</td>
                            <td>{{ $value->ps_sai_total_request  }}</td>
                            <td>{{ $value->ps_sendauth_success   }}</td>
                            <td>{{ $value->ps_sendauth_failure   }}</td>
                            <td>{{ $value->ps_error_code_1       }}</td>
                            <td>{{ $value->ps_error_code_34      }}</td>
                            <td>{{ $value->ps_error_code_8       }}</td>
                            <td>{{ $value->ps_error_code_36      }}</td>
                            <td>{{ $value->ps_error_code_27      }}</td>
                            <td>{{ $value->ps_error_code_2       }}</td>
                            <td>{{ $value->ps_error_code_31      }}</td>
                            <td>{{ $value->ps_error_code_32      }}</td>
                            <td>{{ $value->ps_error_code_6       }}</td>
                            <td>{{ $value->ps_error_code_9       }}</td>
                            <td>{{ $value->ps_error_code_13      }}</td>
                            <td>{{ $value->ps_error_code_5       }}</td>
                            <td>{{ $value->ps_error_code_other   }}</td>
                            <td>{{ $value->mo_sms_subtotal       }}</td>
                            <td>{{ $value->mo_sms_total_request  }}</td>
                            <td>{{ $value->mo_sms_success        }}</td>
                            <td>{{ $value->mo_sms_failure        }}</td>
                            <td>{{ $value->mo_sms_error_32       }}</td>
                            <td>{{ $value->mo_sms_error_34       }}</td>
                            <td>{{ $value->mo_sms_error_21       }}</td>
                            <td>{{ $value->mo_sms_error_1        }}</td>
                            <td>{{ $value->mo_sms_error_36       }}</td>
                            <td>{{ $value->mo_sms_error_8        }}</td>
                            <td>{{ $value->mo_sms_error_13       }}</td>
                            <td>{{ $value->mo_sms_error_27       }}</td>
                            <td>{{ $value->mo_sms_error_9        }}</td>
                            <td>{{ $value->mo_sms_error_5        }}</td>
                            <td>{{ $value->mo_sms_error_other    }}</td>
                            <td>{{ $value->mt_sms_subtotal       }}</td>
                            <td>{{ $value->mt_sms_total_request  }}</td>
                            <td>{{ $value->mt_sms_success        }}</td>
                            <td>{{ $value->mt_sms_failure        }}</td>
                            <td>{{ $value->mt_sms_error_27       }}</td>
                            <td>{{ $value->mt_sms_error_6        }}</td>
                            <td>{{ $value->mt_sms_error_5        }}</td>
                            <td>{{ $value->mt_sms_error_31       }}</td>
                            <td>{{ $value->mt_sms_error_32       }}</td>
                            <td>{{ $value->mt_sms_error_9        }}</td>
                            <td>{{ $value->mt_sms_error_34       }}</td>
                            <td>{{ $value->mt_sms_error_21       }}</td>
                            <td>{{ $value->mt_sms_error_8        }}</td>
                            <td>{{ $value->mt_sms_error_1        }}</td>
                            <td>{{ $value->mt_sms_error_36       }}</td>
                            <td>{{ $value->mt_sms_error_33       }}</td>
                            <td>{{ $value->mt_sms_error_other    }}</td>
                            <td>{{ $value->prn_subtotal          }}</td>
                            <td>{{ $value->prn_total_request     }}</td>
                            <td>{{ $value->prn_success_number    }}</td>
                            <td>{{ $value->prn_failure_number    }}</td>
                            <td>{{ $value->prn_error_code_27     }}</td>
                            <td>{{ $value->prn_error_code_34     }}</td>
                            <td>{{ $value->prn_error_code_36     }}</td>
                            <td>{{ $value->prn_error_code_8      }}</td>
                            <td>{{ $value->prn_error_code_1      }}</td>
                            <td>{{ $value->prn_error_code_31     }}</td>
                            <td>{{ $value->prn_error_code_21     }}</td>
                            <td>{{ $value->prn_error_code_6      }}</td>
                            <td>{{ $value->prn_error_code_other  }}</td>


                        </tr>
                    @endforeach
                    </tbody>


                </table>
            </div>
            <div id="outbound-table" class="table table-striped table-bordered table-hover"
                 style="height: 680px; width: 94%; margin: 3%; overflow: scroll">
                <table id="myTable" class="table-fixed">
                    <thead class="thead-light">
                    <th>REGDATE</th>
                    <th>HPMN CODE</th>
                    <th>COUNTRY</th>
                    <th>HPMN NAME</th>
                    <th>GSM</th>
                    <th>GPRS</th>
                    <th>CAMEL</th>
                    <th>LTE</th>
                    <th>OVERALL TOTAL RECORDS</th>
                    <th>OVERALL TOTAL IMSI</th>
                    <th>OVERALL TOTAL DURATION</th>
                    <th>OVERALL TOTAL VOLUME</th>
                    <th>MOC VOICE RECORDS</th>
                    <th>MOC LOCAL CALL_RECORDS</th>
                    <th>MOC HOME CALL</th>
                    <th>MOC INTERNATIONAL CALL</th>
                    <th>MOC VOICE CHARGED DURATION</th>
                    <th>MOC VOICE NO_IMSI</th>
                    <th>MOC SMS RECORDS</th>
                    <th>MOC SMS NO IMSI</th>
                    <th>MTC VOICE RECORDS</th>
                    <th>MTC VOICE CHARGED DURATION</th>
                    <th>MTC VOICE NO IMSI</th>
                    <th>MTC SMS RECORDS</th>
                    <th>MTC SMS NO IMSI</th>
                    <th>GPRS RECORDS</th>
                    <th>GPRS CHARGED VOLUME</th>
                    <th>GPRS NO IMSI</th>


                    </thead>
                    @foreach($outbound as $value)
                        <tr class="table table-hover">
                            <td>{{ $value->regdate }}</td>
                            <td>{{ $value->hpmn_code }}</td>
                            <td>{{ $value->country }}</td>
                            <td>{{ $value->hpmn_name }}</td>
                            <td>{{ $value->gsm }}</td>
                            <td>{{ $value->gprs }}</td>
                            <td>{{ $value->camel }}</td>
                            <td>{{ $value->lte }}</td>
                            <td>{{ $value->overall_total_records  }} </td>
                            <td>{{ $value->overall_total_imsi     }} </td>
                            <td>{{ $value->overall_total_duration }} </td>
                            <td>{{ $value->overall_total_volume   }} </td>
                            <td>{{ $value->moc_voice_records      }} </td>

                            <td>{{ $value->moc_local_call_records }}</td>
                            <td>{{ $value->moc_home_call }}</td>
                            <td>{{ $value->moc_international_call }}</td>
                            <td>{{ $value->moc_voice_charged_duration }}</td>
                            <td>{{ $value->moc_voice_no_imsi }}</td>
                            <td>{{ $value->moc_sms_records }}</td>
                            <td>{{ $value->moc_sms_no_imsi }}</td>
                            <td>{{ $value->mtc_voice_records }}</td>
                            <td>{{ $value->mtc_voice_charged_duration }}</td>
                            <td>{{ $value->mtc_voice_no_imsi }}</td>
                            <td>{{ $value->mtc_sms_records }}</td>
                            <td>{{ $value->mtc_sms_no_imsi }}</td>
                            <td>{{ $value->gprs_records }}</td>
                            <td>{{ $value->gprs_charged_volume }}</td>
                            <td>{{ $value->gprs_no_imsi }}</td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>




@endsection

@push('traffic')
    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

    <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>

    <script>
        $("input:checkbox:not(:checked)").each(function () {
            var column = "table ." + $(this).attr("name");
            $(column).hide();
        });

        $("input:checkbox").click(function () {
            var column = "table ." + $(this).attr("name");
            $(column).toggle();
        });
    </script>
    <script>
        $(document).ready(function () {
            $('#datetable-buttons').DataTable()
        });

        document.getElementById("defaultOpen").click();

        function openCity(evt, range) {
            var i, tabcontent, tablinks;
            tabcontent = document.getElementsByClassName("tabcontent");
            for (i = 0; i < tabcontent.length; i++) {
                tabcontent[i].style.display = "none";
            }
            tablinks = document.getElementsByClassName("tablinks");
            for (i = 0; i < tablinks.length; i++) {
                tablinks[i].className = tablinks[i].className.replace(" active", "");
            }
            document.getElementById(range).style.display = "block";
            evt.currentTarget.className += " active";
        }

        // Get the element with id="defaultOpen" and click on it


        document.getElementById("radio1").click();

        function inbound() {
            document.getElementById('inbound-table').style.display = 'block';
            document.getElementById('outbound-table').style.display = 'none';

        }

        function outbound() {
            document.getElementById('inbound-table').style.display = 'none';
            document.getElementById('outbound-table').style.display = 'block';
        }


    </script>
{{--    <script type="text/javascript">--}}
{{--        $(function () {--}}

{{--            var start = moment().subtract(29, 'days');--}}
{{--            var end = moment();--}}

{{--            function cb(start, end) {--}}
{{--                $('#reportrange span').html(start.format('YYYY-MM-DD') + ' , ' + end.format('YYYY-MM-DD'));--}}
{{--            }--}}

{{--            $('#reportrange').daterangepicker({--}}
{{--                startDate: start,--}}
{{--                endDate: end,--}}
{{--                ranges: {--}}
{{--                    'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],--}}
{{--                    'Last 7 Days': [moment().subtract(7, 'days'), moment().subtract(1, 'days')],--}}
{{--                    'Last 30 Days': [moment().subtract(29, 'days'), moment()],--}}
{{--                    'This Month': [moment().startOf('month'), moment().endOf('month')],--}}
{{--                    'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]--}}
{{--                }--}}
{{--            }, cb);--}}

{{--            cb(start, end);--}}
{{--        });--}}
{{--    </script>--}}
    <script>
        $('#datepicker').datepicker({
            uiLibrary: 'bootstrap'
        });
    </script>
@endpush