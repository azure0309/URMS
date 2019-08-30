@extends('layouts.main')
@section('content')
<div class="card">
    <div class="card-header">
      <div class="row">
        <div class="col">
          <form>
            <div class="input-group mb-3 input-group-sm">
              <div class="input-group-prepend">
                <span class="input-group-text">IMSI/MSISDN</span>
              </div>
              <input type="text" class="form-control" id="imsi-in">
              <div class="input-group-append">
                <input type="button" class="btn btn-success" id="imsi-search" value="Search">
              </div>
            </div>
          </form>
        </div>
        <div class="col">
          <form>
            <div class="input-group mb-3 input-group-sm">
              <div class="input-group-prepend">
                <span class="input-group-text">Roaming Flag</span>
              </div>
              <input type="text" class="form-control" readonly>
            </div>
          </form>
        </div>
        <div class="col">
          <form>
            <div class="input-group mb-3 input-group-sm">
              <div class="input-group-prepend">
                <span class="input-group-text">HLR Status</span>
              </div>
              <input type="text" class="form-control" readonly>
            </div>
          </form>
        </div>
        <div class="col">
          <form>
            <div class="input-group mb-3 input-group-sm">
              <div class="input-group-prepend">
                <span class="input-group-text">VLR number</span>
              </div>
              <input type="text" class="form-control" readonly>
            </div>
          </form>
        </div>
      </div>
    </div>
    <!-- style="display:none" -->
    <div id="imsi-show" style="display:none">
      <div class="card-body">
        <table class="table-sm text-center">
          <thead>
            <!-- <tr>
              <th colspan="2">Table color description</th>
            </tr> -->
            <tr>
              <th>Color</th>
              <th>Description</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td class="bg-success"></td>
              <td>Normal</td>
            </tr>
            <tr>
              <td class="bg-danger"></td>
              <td>Fault</td>
            </tr>
            <tr>
              <td class="bg-secondary"></td>
              <td>No user or Traffic</td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="card-body">
        <div class="row">
          <div class="col-sm-2">
                <div class="container">
                  <h6><b>Status</b></h6>
                  <i class="fa fa-map-marker"></i> Location <br>
                    <b><p id="imsi-country"></p></b>
                  <i class="fa fa-signal"></i> Current network<br>
                    <b><p id="imsi-operator"></p></b>
                  <i class="fa fa-calendar"></i> Trip Start
                    <b><p id="imsi-attachtime"></p></b>
                </div>
          </div>
          <div class="col-sm-4">
                <div id="network-time-breakdown">
                </div>
          </div>
          <div class="col-sm-6">
                <table class="table-sm table-bordered cell-border text-center" id="service-attempt-table">
                    <thead class="bg-success">
                        <tr>
                          <th rowspan="3">Country</th>
                          <th rowspan="3">Operator</th>
                          <th colspan="18">Service attempt</th>
                        </tr>
                        <tr>
                          <th rowspan="2">CS Reg</th>
                          <th colspan="2">Voice</th>
                          <th colspan="2">SMS</th>
                          <th colspan="3">Data</th>
                        </tr>
                        <tr>
                          <th>MOC</th>
                          <th>MTC</th>
                          <th>MO</th>
                          <th>MT</th>
                          <th>2G & 3G Reg</th>
                          <th>4G Reg</th>
                          <th>DATA</th>
                        </tr>
                    </thead>
                </table>
              </div>
        </div>
      </div>
      <div class="card">
          <div class="card-header">
            <div class="row">
              <div class="col-sm-3">
                <form>
                  <div class="input-group mb-3 input-group-sm">
                    <div class="input-group-prepend">
                      <span class="input-group-text">COUNTRY</span>
                    </div>
                    <input type="text" class="form-control" id="country-in">
                    <div class="input-group-append">
                      <input type="button" class="btn btn-success" id="country-search" value="Search">
                    </div>
                  </div>
                </form>
              </div>
              <div class="col-sm-3">
                <form>
                  <div class="input-group mb-3 input-group-sm">
                    <div class="input-group-prepend">
                      <span class="input-group-text">Time Range</span>
                    </div>
                    <select class="form-control">
                      <option>Daily</option>
                      <option>Weekly</option>
                      <option>Monthly</option>
                      <option>Quarterly</option>
                    </select>
                  </div>
                </form>
              </div>
            </div>
          </div>
          <div class="card-body">
                <div class="card">
                  <div class="card-body">
                    <table class="table-sm table-bordered cell-border text-center" id="sub-status-table">
                        <thead class="bg-success">
                            <tr>
                              <th rowspan="3">Country</th>
                              <th rowspan="3">Operator</th>
                              <th colspan="4">Roaming Service Status</th>
                              <th colspan="16">KPI</th>
                            </tr>
                            <tr>
                              <th rowspan="2">Voice & SMS</th>
                              <th colspan="2">Data</th>
                              <th rowspan="2">Prepaid Roaming</th>
                              <th rowspan="2">CS Reg %</th>
                              <th rowspan="2">Total Sub</th>
                              <th colspan="4">Voice</th>
                              <th colspan="4">SMS</th>
                              <th colspan="6">Data</th>
                            </tr>
                            <tr>
                              <th>2G & 3G</th>
                              <th>4G(LTE)</th>
                              <th>MOC</th>
                              <th>Total Sub</th>
                              <th>MTC</th>
                              <th>Total Sub</th>
                              <th>SMSMO(%)</th>
                              <th>Total Sub</th>
                              <th>SMSMT(%)</th>
                              <th>Total Sub</th>
                              <th>2G & 3G Reg %</th>
                              <th>Total Sub</th>
                              <th>4G Reg %</th>
                              <th>Total Sub</th>
                              <th>Data</th>
                              <th>Total Sub</th>
                            </tr>
                        </thead>
                    </table>
                  </div>
                </div>
            </div>
        </div>
  </div>
</div>
@endsection
@push('scripts')
<script>
$(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        function search_imsi(imsi) {
            $.ajax({
             type: "POST",
             url: "{{ url('/sub-analysis/call-center/location-status')}}",
             data: {imsi:imsi},
             success: function(data){
               var json = JSON.parse(data);
               if (json != null) {
                 $('#imsi-country').text(json.country);
                 $('#imsi-operator').text(json.operator);
                 $('#imsi-attachtime').text(json.attachtime);
               }
               else{
                 $('#imsi-country').text("no data");
                 $('#imsi-operator').text("no data");
                 $('#imsi-attachtime').text("no data");
               }
             }
           });
           $.ajax({
            type: "POST",
            url: "{{ url('/sub-analysis/call-center/network-time-breakdown')}}",
            data: {imsi:imsi},
            success: function(data){
              var json_data = JSON.parse(data);
              var result = [];
              var dataArr = [];
              const title = ['info','value'];
              dataArr.push(title);
              var count = 1;
              for(var i in json_data){
                  if (json_data[i].detachtime == null && count == 1) {
                            var currentdate = new Date();
                            var datetime = currentdate.getFullYear() + "" +
                                           currentdate.getDate() + "" +
                                           currentdate.getMonth() + "" +
                                           currentdate.getHours() + "" +
                                           currentdate.getMinutes() + "" +
                                           currentdate.getSeconds();
                            //console.log(datetime);
                            //json_data[i].value = datetime - json_data[i].attachtime;
                            json_data[i].value = 2000;
                            //console.log(json_data[i].value);
                            //result.push([i, json_data[i]]);
                            dataArr.push([json_data[i].operator + ': ' + json_data[i].attachtime + '-' + datetime, json_data[i].value]);
                            //dataArr.push(result);
                      count ++;
                  }
                  else if(json_data[i].detachtime != null) {
                      json_data[i].value = json_data[i].detachtime - json_data[i].attachtime;
                      //result.push([i, json_data[i]]);
                      dataArr.push([json_data[i].operator + ': ' + json_data[i].attachtime + '-' + json_data[i].detachtime, json_data[i].value]);
                      //dataArr.push(result);
                  }
                  //json_data[i].push({"value": value});


                  //console.log(json_data[i]);
                  //console.log(json_data[i].detachtime);
                  //console.log(json_data[i].detachtime - json_data[i].attachtime);
                  //console.log(result[i]);
                }
              //console.log(result);
              //console.log(dataArr);
              //document.getElementById("demo").innerHTML = result;

                  google.charts.load('current', {'packages':['corechart']});
                  google.charts.setOnLoadCallback(drawChart);

                  function drawChart() {

                    // var data = google.visualization.arrayToDataTable([
                    //   ['Task', 'Hours per Day'],
                    //   ['Work', 11],
                    //   ['Eat',      2],
                    //   ['Commute',  2],
                    //   ['Watch TV', 2],
                    //   ['Sleep',    7]
                    // ]);
                    var data = google.visualization.arrayToDataTable(dataArr);
                    // var data = new google.visualization.DataTable();
                    //     data.addColumn('string', 'Topping');
                    //     data.addColumn('number', 'Slices');
                    //     data.addRows(result);

                    var options = {
                      title: 'Network time breakdown',
                      pieHole: 0.3
                    };

                    var chart = new google.visualization.PieChart(document.getElementById('network-time-breakdown'));
                    chart.draw(data, options);
                  }
            }
          });
          $('#service-attempt-table').DataTable({
              "processing": true,
              "serverSide": true,
              // "lengthMenu": [[100, 300, 600, 900], [100, 300, 600, 900]],

              "scrollY": "250px",
              "searching": false,
              "lengthChange": false,
              "ajax": {
                    url: "{{ url('/sub-analysis/call-center/service-attempt')}}",
                    type: "POST",
                    data: {imsi:imsi}
              },
              "columns": [
                    { data: "country"},
                    { data: "operator" },
                    { data: "cs_reg" },
                    { data: "moc" },
                    { data: "mtc" },
                    { data: "smsmo" },
                    { data: "smsmt" },
                    { data: "gprs_reg" },
                    { data: "lte_reg" },
                    { data: "data" }
              ]
          });
           function search_country(imsi, country) {
                  $('#sub-status-table').DataTable({
                      "processing": true,
                      "serverSide": true,
                      "scrollY": "250px",
                      "scrollX": true,
                      "searching": false,
                      "lengthChange": false,
                      "ajax": {
                            url: "{{ url('/sub-analysis/call-center/status')}}",
                            type: "POST",
                            data: {imsi:imsi, country:country}
                      },
                      "columns": [
                                    { data: "country" },
                                    { data: "operator" },
                                    { data: "voice_sms" },
                                    { data: "gprs" },
                                    { data: "lte" },
                                    { data: "prepaid_roam" },
                                    { data: "cs_reg" },
                                    { data: "cs_total_sub" },
                                    { data: "moc" },
                                    { data: "moc_total_sub" },
                                    { data: "mtc" },
                                    { data: "mtc_total_sub" },
                                    { data: "smsmo" },
                                    { data: "smo_total_sub" },
                                    { data: "smsmt" },
                                    { data: "smt_total_sub" },
                                    { data: "kpi_gprs" },
                                    { data: "kpi_gprs_total_sub" },
                                    { data: "kpi_lte_reg" },
                                    { data: "kpi_lte_reg_total" },
                                    { data: "kpi_data" },
                                    { data: "kpi_data_total" }
                      ]
                  });
          }
          search_imsi.search_country = search_country;
          //search_country(imsi,"");
          // Highcharts.chart('network-time-breakdown', {
          //                     chart: {
          //                       plotBackgroundColor: null,
          //                       plotBorderWidth: null,
          //                       plotShadow: false,
          //                       type: 'pie'
          //                     },
          //                     title: {
          //                       text: 'Network time breakdown'
          //                     },
          //                     tooltip: {
          //                       pointFormat: '{series.name}:</b>{point.dat}'
          //                     },
          //                     plotOptions: {
          //                       pie: {
          //                         allowPointSelect: true,
          //                         cursor: 'pointer',
          //                         dataLabels: {
          //                           enabled: true,
          //                           format: '<b>{point.name}:</b> {point.dat}',
          //                           style: {
          //                             color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
          //                           }
          //                         }
          //                       }
          //                     },
          //                     series: [{
          //                       name: 'Date',
          //                       colorByPoint: true,
          //                       data: [{
          //                         name: 'Airtel , Bharti',
          //                         y: 20,
          //                         dat: '2019/4/8',
          //                         sliced: true,
          //                         selected: true
          //                       }, {
          //                         name: 'AT&T',
          //                         dat: '2019/4/6',
          //                         y: 18
          //                       }, {
          //                         name: 'BASE NV/SA',
          //                         dat: '2019/4/5',
          //                         y: 21
          //                       }, {
          //                         name: 'Bouygues Telecom',
          //                         dat: '2019/4/2',
          //                         y: 20
          //                       }, {
          //                         name: 'China Mobile',
          //                         dat: '2019/3/21',
          //                         y: 25
          //                       }]
          //                     }]
          //                   });
        }
        $(document).on('click', '#imsi-search', function() {
              var imsi = $('#imsi-in').val();
              if(imsi != '')
              {
                $('#service-attempt-table').DataTable().destroy();
                $('#sub-status-table').DataTable().destroy();
                search_imsi(imsi);
                search_imsi.search_country(imsi,'');
                $('#imsi-show').show();
              }
              else
              {
               alert("IMSI is Required");
              }

          });
          $(document).on('click', '#country-search', function() {
                var imsi = $('#imsi-in').val();
                var country = $('#country-in').val();
                if(country != '')
                {
                  $('#sub-status-table').DataTable().destroy();
                  search_imsi.search_country(imsi,country);
                }
                else
                {
                 alert("Country is Required");
                }

            });
});
</script>
@endpush
