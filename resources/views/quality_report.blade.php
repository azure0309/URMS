@extends('layouts.main')
@section('content')
    <div style="margin: 3%;" class="card">
        <div class="card-header">
        <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-2">
                        <H4 style="margin-left: 10%">Service Type</H4>
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

                    <div class="col-lg-4">
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
                                            <span></span> <i class="fa fa-caret-down"></i>
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
                    <div class="col-lg-4">
                            <h4>Compared Report</h4>
                            <div style="margin-top: 35px">
                                <form action="" method="get">
                                    <input id="reportrangeComp" name="date_comp"
                                           style="cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 80%">
                                    <i class="fa fa-calendar"></i>
                                    <span></span> <i class="fa fa-caret-down"></i>

                                    <input id="reportrangeCompSec" name="date_comp_s"
                                           style="margin-top: 10px; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 80%">
                                    <i class="fa fa-calendar"></i>&nbsp;
                                    <span></span> <i class="fa fa-caret-down"></i>
                                    <input class="btn btn-primary btn-xs" style="margin-top: 3%; float: right;"
                                           type="submit">
                                </form>
                            </div>
                        </div>
                    <div style="padding: 70px" class="col-lg-2">
                        <button onclick="genPDF()" class="btn btn-danger">Export to PDF</button>
                    </div>
                </div>
            </div>
        </div>
        <div style="height: 1200px" class="card-body">
            <div id="pdfDiv" class="quality container-fluid">
                <div style="height: 60%; margin-top: 2%" class="row">
                    <div style="padding-left: 2%; padding-top: 1%;" class="col-lg-4">
                        <div class="card text-center" style="height: 80%;">
                            <div style="padding-left: 20%" class="lead card-header text-center">
                                <p style="font-family: 'Times New Roman', Serif, Times; float: left"
                                >LU attemts operator</p>
                                <p style="float: left; font-family: 'Times New Roman', Times, serif; color: #2ba5c6; margin-left: 2px;"
                                >INBOUND TADIG</p>  <br>
                            </div>
                            <div style="padding-top: 5%; padding-left: 20%" class="card-body">
                                <p
                                   style="margin-left: 25%; font-size: 24px; color: #f4bb41; font-family: 'Arial Black', Serif; float: left;">
                                    @php
                                        {{$num = (int)$count;
                                          echo $num;}}
                                    @endphp
                                </p>
                                <p style=" margin-left: 2%; margin-top: 1px; font-size: 22px; color: #0382bc; font-family: 'Times New Roman', Times, serif; float: left;">
                                    @php
                                        {{$num = (int)$count;
                                          $ref_cnt = (int)$ref_count;
                                          if ($num == 0 || $ref_cnt == 0){
                                            echo "No data found in database";
                                          }else{
                                               $num_precent = $num / $ref_cnt * 100;
                                               echo "(" . substr($num_precent, 0, 4) . "%)";
                                          }
                                          //echo $ref_cnt;
                                          //echo $tot_rec;
                                          }}
                                    @endphp
                                </p>
                                <table class="text-left" width="350">
                                    <tr>
                                        <td>Update Location Success Ratio</td>
                                        <td>
                                            @php
                                                {{echo substr($ul_inbound_success_ratio, 0, 4);}}
                                            @endphp
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>GPRS Update Location Success Ratio</td>
                                        <td>
                                            @php
                                                {{echo substr($gprs_ul_inbound_success_ratio, 0, 4);}}
                                            @endphp
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>CS SAI Success Ratio</td>
                                        <td>
                                            @php
                                                {{echo substr($cs_success_ratio, 0, 4);}}
                                            @endphp
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>PS SAI Success Ratio</td>
                                        <td>
                                            @php
                                                {{echo substr($ps_success_ratio, 0, 4);}}
                                            @endphp
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>SMSC MO Success Ratio</td>
                                        <td>
                                            @php
                                                {{echo substr($mo_success_ratio, 0, 4);}}
                                            @endphp
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>SMSC MT Success Ratio</td>
                                        <td>
                                            @php
                                                {{echo substr($mt_success_ratio, 0, 4);}}
                                            @endphp
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>PRN Success Ratio</td>
                                        <td>
                                            @php
                                                {{echo substr($prn_success_ratio, 0, 4);}}
                                            @endphp
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>


                    </div>
                    <div style="padding-right: 2%; padding-top: 1%;" class="col-lg-8">
                        <table class="table table-sm"  border="1">
                            <thead>
                            <th>VPMN Code</th>
                            <th>VPMN Name</th>
                            <th>GSM</th>
                            <th>GPRS</th>
                            <th>CAMEL</th>
                            <th>LTE</th>
                            <th>Update Location Success Ratio</th>
                            <th>GPRS Update Location Success Ratio</th>
                            <th>CS SAI Success Ratio</th>
                            <th>PS SAI Success Ratio</th>
                            <th>SMSC MO Success Ratio</th>
                            <th>SMSC MT Success Ratio</th>
                            <th>PRN Success Ratio</th>
                            <th>Deep Analysis</th>
                            </thead>
                            <tbody>
                            @foreach($quality_top as $value)
                                <tr>
                                    <td>{{$value->hpmn_code}}</td>
                                    <td style="width: 100px">{{$value->hpmn_name}}</td>
                                    <td style="width: 70px">{{$value->gsm}}</td>
                                    <td style="width: 70px">{{$value->gprs}}</td>
                                    <td style="width: 70px">{{$value->camel}}</td>
                                    <td style="width: 70px">{{$value->lte}}</td>
                                    <td>{{$value->ul_inbound_success_ratio}}</td>
                                    <td>{{$value->gprs_ul_inbound_success_ratio}}</td>
                                    <td>{{$value->cs_success_ratio}}</td>
                                    <td>{{$value->ps_success_ratio}}</td>
                                    <td>{{$value->mo_success_ratio}}</td>
                                    <td>{{$value->mt_success_ratio}}</td>
                                    <td>{{$value->prn_success_ratio}}</td>
                                    <td>
                                        <button style="border-radius: 10px" class="btn btn-sm btn-success"></button>
                                    </td>

                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div style="height: 40%;" class="row">
                    <div class="col-5">
                        <div style="margin-left: -10%; height: 100%; width: 700px" id="chart_div">

                        </div>
                    </div>
                    <div id="testDiv" style="padding-top: 50px;" class="col-7">
                        <table class="table table-sm" border=1">
                            <thead>
                            <th>KPI Indicator</th>
                            <th>Normal</th>
                            <th>Warning</th>
                            <th>Minor</th>
                            <th>Critical</th>
                            </thead>
                            <tr>
                                <td>Update Location Inbound Success Ratio</td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-success"></button>
                                    @php
                                        {{echo $ul_inbound_success_ratio_normal;}}
                                    @endphp
                                </td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-info"></button>
                                    @php
                                        {{echo $ul_inbound_success_ratio_warning;}}
                                    @endphp
                                </td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-warning"></button>
                                    @php
                                        {{echo $ul_inbound_success_ratio_minor;}}
                                    @endphp
                                </td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-danger"></button>
                                    @php
                                        {{echo $ul_inbound_success_ratio_crit;}}
                                    @endphp
                                </td>
                            </tr>
                            <tr>
                                <td>GPRS Update Location Inbound Success Ratio</td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-success"></button>
                                    @php
                                        {{echo $gprs_ul_inbound_success_ratio_normal;}}
                                    @endphp
                                </td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-info"></button>
                                    @php
                                        {{echo $gprs_ul_inbound_success_ratio_warning;}}
                                    @endphp
                                </td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-warning"></button>
                                    @php
                                        {{echo $gprs_ul_inbound_success_ratio_minor;}}
                                    @endphp
                                </td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-danger"></button>
                                    @php
                                        {{echo $gprs_ul_inbound_success_ratio_crit;}}
                                    @endphp
                                </td>
                            </tr>
                            <tr>
                                <td>CS SAI Success Ratio</td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-success"></button>
                                    @php
                                        {{echo $cs_success_ratio_normal;}}
                                    @endphp
                                </td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-info"></button>
                                    @php
                                        {{echo $cs_success_ratio_warning;}}
                                    @endphp
                                </td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-warning"></button>
                                    @php
                                        {{echo $cs_success_ratio_minor;}}
                                    @endphp
                                </td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-danger"></button>
                                    @php
                                        {{echo $cs_success_ratio_crit;}}
                                    @endphp
                                </td>
                            </tr>
                            <tr>
                                <td>PS SAI Success Ratio</td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-success"></button>
                                    @php
                                        {{echo $ps_success_ratio_normal;}}
                                    @endphp
                                </td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-info"></button>
                                    @php
                                        {{echo $ps_success_ratio_warning;}}
                                    @endphp
                                </td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-warning"></button>
                                    @php
                                        {{echo $ps_success_ratio_minor;}}
                                    @endphp
                                </td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-danger"></button>
                                    @php
                                        {{echo $ps_success_ratio_crit;}}
                                    @endphp
                                </td>
                            </tr>
                            <tr>
                                <td>SMSC MO Success Ratio</td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-success"></button>
                                    @php
                                        {{echo $mo_success_ratio_normal;}}
                                    @endphp
                                </td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-info"></button>
                                    @php
                                        {{echo $mo_success_ratio_warning;}}
                                    @endphp
                                </td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-warning"></button>
                                    @php
                                        {{echo $mo_success_ratio_minor;}}
                                    @endphp
                                </td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-danger"></button>
                                    @php
                                        {{echo $mo_success_ratio_crit;}}
                                    @endphp
                                </td>
                            </tr>
                            <tr>
                                <td>SMSC MT Success Ratio</td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-success"></button>
                                    @php
                                        {{echo $mt_success_ratio_normal;}}
                                    @endphp
                                </td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-info"></button>
                                    @php
                                        {{echo $mt_success_ratio_warning;}}
                                    @endphp
                                </td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-warning"></button>
                                    @php
                                        {{echo $mt_success_ratio_minor;}}
                                    @endphp
                                </td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-danger"></button>
                                    @php
                                        {{echo $mt_success_ratio_crit;}}
                                    @endphp
                                </td>
                            </tr>
                            <tr>
                                <td>CS PRN Success Ratio</td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-success"></button>
                                    @php
                                        {{echo $prn_success_ratio_normal;}}
                                    @endphp
                                </td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-info"></button>
                                    @php
                                        {{echo $prn_success_ratio_warning;}}
                                    @endphp
                                </td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-warning"></button>
                                    @php
                                        {{echo $prn_success_ratio_minor;}}
                                    @endphp
                                </td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-danger"></button>
                                    @php
                                        {{echo $prn_success_ratio_crit;}}
                                    @endphp
                                </td>
                            </tr>
                        </table>

                    </div>
                </div>
                <div style="height: 40%;" class="row">
                    <div class="col-7">

                    </div>
                    <div class="col-5">
                        <table border="1" class="table table-sm">
                            <thead>
                            <th>Check Points</th>
                            <th style="width: 15%;">Suspected</th>
                            <th>Tadig</th>
                            </thead>
                            <tbody>
                            <tr>
                                <td>CS Location Update</td>
                                <td>
                                    <button class="btn btn-sm btn-danger"></button>
                                </td>
                                <td>
                                    @php
                                        {{echo $cs_lu;}}
                                    @endphp
                                </td>
                            </tr>
                            <tr>
                                <td>PS Location Update</td>
                                <td>
                                    <button class="btn btn-sm btn-danger"></button>
                                </td>
                                <td>
                                    @php
                                        {{echo $ps_lu;}}
                                    @endphp
                                </td>
                            </tr>
                            <tr>
                                <td>MOC</td>
                                <td>
                                    <button class="btn btn-sm btn-danger"></button>
                                </td>
                                <td>
                                    @php
                                        {{echo $moc;}}
                                    @endphp
                                </td>
                            </tr>
                            <tr>
                                <td>MTC</td>
                                <td>
                                    <button class="btn btn-sm btn-danger"></button>
                                </td>
                                <td>
                                    @php
                                        {{echo $mtc;}}
                                    @endphp
                                </td>
                            </tr>
                            <tr>
                                <td>PDP Creation</td>
                                <td>
                                    <button class="btn btn-sm btn-danger"></button>
                                </td>
                                <td>
                                    @php
                                        {{echo $pdp;}}
                                    @endphp
                                </td>
                            </tr>
                            <tr>
                                <td>SMSMO</td>
                                <td>
                                    <button class="btn btn-sm btn-danger"></button>
                                </td>
                                <td>
                                    @php
                                        {{echo $smsmo;}}
                                    @endphp
                                </td>
                            </tr>
                            <tr>
                                <td>SMSMT</td>
                                <td>
                                    <button class="btn btn-sm btn-danger"></button>
                                </td>
                                <td>
                                    @php
                                        {{echo $smsmt;}}
                                    @endphp
                                </td>
                            </tr>
                            <tr>
                                <td>SoR</td>
                                <td>
                                    <button class="btn btn-sm btn-danger"></button>
                                </td>
                                <td>
                                    @php
                                        {{echo $sor;}}
                                    @endphp
                                </td>
                            </tr>
                            <tr>
                                <td>M2M</td>
                                <td>
                                    <button class="btn btn-sm btn-danger"></button>
                                </td>
                                <td>
                                    @php
                                        {{echo $m2m_f + $m2m_s;}}
                                    @endphp
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection

@push('quality_result')
    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <script type="text/javascript" src="js/jspdf.min.js"></script>

    <script type="text/javascript">
        function genPDF() {
            window.print();
        }
    </script>

    <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
    <script>
        /*
        * Time-Range хэсэг дээр button дарахад Daily, Weekly, Monthly гэх мэт сонголтуудыг нэг нэгээр нь гаргах
        * зарчмаар ажиллана.
        * */
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

        document.getElementById("defaultOpen").click();

        // Get the element with id="defaultOpen" and click on it

    </script>
    <script>

        document.getElementById("radio1").click();

        function inbound() {
            document.getElementById('inbound-section').style.display = 'block';
            document.getElementById('outbound-section').style.display = 'none';

        }

        function outbound() {
            document.getElementById('inbound-section').style.display = 'none';
            document.getElementById('outbound-section').style.display = 'block';
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
{{--                    'Last 30 Days': [moment().subtract(30, 'days'), moment().subtract(1, 'days')],--}}
{{--                    'This Month': [moment().startOf('month'), moment().endOf('month')],--}}
{{--                    'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]--}}
{{--                }--}}
{{--            }, cb);--}}

{{--            cb(start, end);--}}
{{--        });--}}
{{--    </script>--}}

{{--    <script type="text/javascript">--}}
{{--        $(function () {--}}

{{--            var start = moment().subtract(29, 'days');--}}
{{--            var end = moment();--}}

{{--            function cb(start, end) {--}}
{{--                $('#reportrangeComp span').html(start.format('YYYY-MM-DD') + ' , ' + end.format('YYYY-MM-DD'));--}}
{{--            }--}}

{{--            $('#reportrangeComp').daterangepicker({--}}
{{--                startDate: start,--}}
{{--                endDate: end,--}}
{{--                ranges: {--}}
{{--                    'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],--}}
{{--                    'Last 7 Days': [moment().subtract(7, 'days'), moment().subtract(1, 'days')],--}}
{{--                    'Last 30 Days': [moment().subtract(30, 'days'), moment().subtract(1, 'days')],--}}
{{--                    'This Month': [moment().startOf('month'), moment().endOf('month')],--}}
{{--                    'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]--}}
{{--                }--}}
{{--            }, cb);--}}

{{--            cb(start, end);--}}
{{--        });--}}
{{--    </script>--}}
{{--    <script type="text/javascript">--}}
{{--        $(function () {--}}

{{--            var start = moment().subtract(29, 'days');--}}
{{--            var end = moment();--}}

{{--            function cb(start, end) {--}}
{{--                $('#reportrangeCompSec span').html(start.format('YYYY-MM-DD') + ' , ' + end.format('YYYY-MM-DD'));--}}
{{--            }--}}

{{--            $('#reportrangeCompSec').daterangepicker({--}}
{{--                startDate: start,--}}
{{--                endDate: end,--}}
{{--                ranges: {--}}
{{--                    'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],--}}
{{--                    'Last 7 Days': [moment().subtract(7, 'days'), moment().subtract(1, 'days')],--}}
{{--                    'Last 30 Days': [moment().subtract(30, 'days'), moment().subtract(1, 'days')],--}}
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
    <script>
        google.charts.load('current', {'packages': ['corechart']});
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            var data = google.visualization.arrayToDataTable([
                ['Days', 'Update Location SR',
                    'GPRS Update Location SR',
                    'CS SAI SR'],
                ['1', 93.1, 71.8, 56.2],
                ['2', 81.8, 97.1, 49.3],
                ['3', 90, 86.4, 87.9],
                ['4', 76, 90.1, 80],
                ['5', 69.9, 98, 73.9],
                ['6', 96.7, 79.2, 85.3],
                ['7', 80, 94, 100]

            ]);

            var options = {
                legend: {position: 'bottom'},
                hAxis: {
                    title: 'Days', titleTextStyle: {
                        color: '#333',
                        textStyle: {fontsize: 10}
                    }
                },
                vAxis: {textStyle: {fontsize: 10}},
                vAxis: {minValue: 0},
                vAxis: {maxValue: 100}
            };

            var chart = new google.visualization.AreaChart(document.getElementById('chart_div'));
            chart.draw(data, options);
        }
    </script>
@endpush


