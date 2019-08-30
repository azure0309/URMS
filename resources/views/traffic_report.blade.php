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
        <div style="height: 1700px;" class="card-body">
            <div id='inbound_section' class="container-fluid report_result">
                <div style="height: 400px" class="row">

                    <div style="padding-left: 5%; padding-right: 5%; padding-top: 2%; width: 70%; height: 100%" class="card col-4">
                        <div class="card-header">
                            <center>
                                <h5 class="lead">
                                    <p style="font-family: 'Times New Roman', Serif, Times; float: left"
                                    >records created
                                    <p style="float: left; font-family: 'Times New Roman', Times, serif; color: #2ba5c6; margin-left: 2px;"
                                    >INBOUND TADIG</p>
                                    </p>
                                </h5>
                            </center>
                        </div>
                        <div style="padding-bottom: 35%; padding-left: 10%; padding-right: 10%" class="card-body">
                            <p style="margin-left: 25%; font-size: 24px; color: #f4bb41; font-family: 'Arial Black', Serif; float: left;">
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
                                      }}
                                @endphp
                            </p>
                            <hr class="style8">
                            <p style="font-family: 'Times New Roman',Times, Serif; text-align-last: justify;  font-size: 16px;">
                                Total_Records
                                @php
                                    {{$i_tot_rec = (int)$tot_rec;
                                      echo $i_tot_rec;}}
                                @endphp</p>
                            <p style="font-family: 'Times New Roman',Times, Serif; text-align-last: justify;  font-size: 16px;"
                               class="lead">Total_IMSI
                                @php
                                    {{$i_tot_imsi = (int)$tot_imsi;
                                        echo $i_tot_imsi;}}
                                @endphp
                            </p>
                            <p style="font-family: 'Times New Roman',Times, Serif; text-align-last: justify;  font-size: 16px;"
                               class="lead">Per_IMSI_Records
                                @php
                                    {{$i_tot_rec = (int)$tot_rec;
                                      $i_tot_imsi = (int)$tot_imsi;
                                      if($i_tot_rec == 0){
                                       echo "<p>No data found in database. Check database</p>";
                                      }else{
                                        $per_imsi_rec = $i_tot_rec / $i_tot_imsi;
                                        echo substr($per_imsi_rec, 0, 4);
                                      }
                                      }}
                                @endphp
                            </p>
                        </div>
                    </div>
                    <div style="height: 100%" class="card col-8">
                        <div class="card-header">
                            <p class="lead"
                               style="font-size: 18px; font-family: 'Times New Roman', Times, serif;  color: red">
                                Top 10 Inbound operators</p>
                        </div>
                        <div class="card-body">
                            <table class="table table-sm" width="800" border="1">
                                <thead>
                                <th>VPMN Code</th>
                                <th>VPMN Name</th>
                                <th>Overall Total Records</th>
                                <th>Overall Total Imsi</th>
                                <th>Deep Analysis</th>
                                </thead>
                                <tbody>
                                @foreach($overall_ttl_max as $value)
                                    <tr>
                                        <td>{{ $value->hpmn_code }}</td>
                                        <td>{{ $value->hpmn_name }}</td>
                                        <td>{{ $value->over_all_total_records }}</td>
                                        <td>{{ $value->overall_total_imsi }}</td>
                                        <td>
                                            <button style="margin-left: 10px; border-radius: 50px;"
                                                    class="btn btn-success btn-xs">
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {{--            Page хуудасны 2-р хэсэг буюу Chart үр дүнг харуулах хэсэг--}}
                <div style="margin-top: 2%" class="row">
                    {{--                Service-ээр ялгаж харуулах Pie Chart зурах хэсэг --}}
                    {{--                    <p style=" color: red; float: left">Total Records by Service Type</p>--}}
                    <div class="col">


                        {{--Service-үүдийг Donut Chart зурж мэдээлэл харуулах хэсгийн div хэсэг--}}
                        <div style="margin-bottom: 2%;" class="card">
                            <div style=" margin-bottom: 30px; width: 99%; height: 50%; float: left"
                                 id="donutchart"
                                    >
                            </div>
                        </div>
                        <div style="margin-bottom: 2%" class="card">
                            <div
                                    id="moc_voice"
                                    style=" margin-bottom: 30px; width: 99%; height: 50%; float: left">
                            </div>
                        </div>
                        <div style="margin-bottom: 2%" class="card">
                            <div
                                    id="moc_sms"
                                    style="margin-bottom: 30px; width: 99%; height: 50%; float: left">
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div style="margin-bottom: 2%" class="card">
                            <div
                                    id="gprs_service"
                                    style="margin-bottom: 30px; width: 100%; height: 50%; float: left">
                            </div>
                        </div>
                        <div style="margin-bottom: 2%" class="card">
                            <div
                                    id="mtc_voice"
                                    style="margin-bottom: 30px; width: 99%; height: 50%; float: left">

                            </div>
                        </div>
                        <div style="margin-bottom: 2%" class="card">
                            <div
                                    id="mtc_sms"
                                    style="margin-bottom: 30px; width: 99%; height: 50%; float: left">
                            </div>
                        </div>

                    </div>

                </div>

            </div>
            <div id="outbound-section" class="container-fluid">

            </div>
        </div>
    </div>


@endsection


@push('report_result')
    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

    <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
    <script type="text/javascript" src="js/jspdf.min.js"></script>

    <script type="text/javascript">
        function genPDF() {
            window.print();
        }
    </script>
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

    {{--    Daily Report Table нь Inbound болон Outbound гэсэн 2 сонголттой байгаа
            учраас radio button дарж тус 2 table-ийг--}}
    {{--    веб-д нэг нэгээр нь харж байгаа--}}
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

    {{--  Google Donut Chart зурах хэсгийн script code. Controller хэсэг өгөгдлийн сангаас өгөгдлөө
      дуудаж шууд ашиглахад бэлдсэн байгаа.
      service нэртэй хувьсагчаар датагаа дуудаж Google API ашиглаж график зурж байгаа.
      --}}


    <script type="text/javascript">
        google.charts.load("current", {packages: ["corechart"]});
        google.charts.setOnLoadCallback(drawChart1);

        function drawChart1() {
            var service = <?php echo $service; ?>;
            var data = google.visualization.arrayToDataTable(service);

            var options = {
                // title: 'Total records by Service',
                height: 300,
                pieHole: 0.4,
                fontSize: 12,
                chartArea: {'width': '80%', 'height': '80%'}
            };

            var chart = new google.visualization.PieChart(document.getElementById('donutchart'));
            chart.draw(data, options);
        }
    </script>


    <script type="text/javascript">
        google.charts.load('current', {'packages': ['bar']});
        google.charts.setOnLoadCallback(drawChart2);

        function drawChart2() {
            var gprs_result =
                <?php echo $gprs_result; ?>;
            var data = google.visualization.arrayToDataTable(gprs_result);

            var options = {
                height: 300,
                width: 610,
                chart: {
                    title: 'GPRS Roaming',
                    subtitle: 'Inbound GPRS',
                    height: 500
                },
                bar: {
                    groupWidth: 0.2
                },
                vAxis: {
                    logScale: 'true'
                }
            };

            var chart = new google.charts.Bar(document.getElementById('gprs_service'));

            chart.draw(data, google.charts.Bar.convertOptions(options));
        }
    </script>

    <script type="text/javascript">
        google.charts.load('current', {'packages': ['bar']});
        google.charts.setOnLoadCallback(drawChart3);

        function drawChart3() {
            var moc_voice_result =
                <?php echo $moc_voice_result; ?>;
            var data = google.visualization.arrayToDataTable(moc_voice_result);

            var options = {
                height: 300,
                width: 610,
                chart: {
                    title: 'Voice Roaming',
                    subtitle: 'Inbound MOC Voice',
                },
                bar: {
                    groupWidth: 0.3
                }
            };

            // var view = new google.visualization.DataView(data);
            // view.setColumns([0, 1,
            //     { calc: "stringify",
            //         sourceColumn: 1,
            //         type: "string",
            //         role: "annotation" },
            //     2]);

            var chart = new google.charts.Bar(document.getElementById('moc_voice'));

            chart.draw(data, google.charts.Bar.convertOptions(options));
        }
    </script>

    <script type="text/javascript">
        google.charts.load('current', {'packages': ['bar']});
        google.charts.setOnLoadCallback(drawChart4);

        function drawChart4() {
            var mtc_voice_result =
                <?php echo $mtc_voice_result; ?>;
            var data = google.visualization.arrayToDataTable(mtc_voice_result);

            var options = {
                height: 300,
                width: 610,
                chart: {
                    // title: 'Voice Roaming',
                    subtitle: 'Inbound MTC Voice',
                },
                bar: {
                    groupWidth: 0.2
                },
                colors: ['#d95f02']
            };

            var chart = new google.charts.Bar(document.getElementById('mtc_voice'));

            chart.draw(data, google.charts.Bar.convertOptions(options));
        }
    </script>


    <script type="text/javascript">
        google.charts.load('current', {'packages': ['bar']});
        google.charts.setOnLoadCallback(drawChart5);

        function drawChart5() {
            var moc_sms_result =
                <?php echo $moc_sms_result; ?>;
            var data = google.visualization.arrayToDataTable(moc_sms_result);

            var options = {
                height: 300,
                width: 610,
                chart: {
                    title: 'SMS Roaming',
                    subtitle: 'Inbound MOC SMS',
                },
                bar: {
                    groupWidth: 0.1
                },
            };

            var chart = new google.charts.Bar(document.getElementById('moc_sms'));

            chart.draw(data, google.charts.Bar.convertOptions(options));
        }
    </script>


    <script type="text/javascript">
        google.charts.load('current', {'packages': ['bar']});
        google.charts.setOnLoadCallback(drawChart6);

        function drawChart6() {
            var mtc_sms_result =
                <?php echo $mtc_sms_result; ?>;
            var data = google.visualization.arrayToDataTable(mtc_sms_result);

            var options = {
                height: 300,
                width: 610,
                chart: {
                    // title: 'SMS Roaming',
                    subtitle: 'Inbound MTC SMS',
                },
                bar: {
                    groupWidth: 0.1
                },
                bars: 'vertical',
                vAxis: {format: 'decimal'},
                colors: ['#d95f02']
            };

            var chart = new google.charts.Bar(document.getElementById('mtc_sms'));

            chart.draw(data, google.charts.Bar.convertOptions(options));
        }
    </script>
    <script>
        $(window).resize(function(){
            drawChart1();
            drawChart2();
            drawChart3();
            drawChart4();
            drawChart5();
            drawChart6();
        })
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


@endpush






