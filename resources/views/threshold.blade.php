@extends('layouts.main')
@section('content')
<div class="card">
    <div class="card-header">
      @include('inc.threshold')
    </div>
    <div class="card-body">
        <!-- <div class="container-fluid"> -->
          <table class="table-sm table-bordered" id="threshold-table">
              <thead>
                  <tr>
                    <th>PRIORITY</th>
                    <th>Voice charge threshold [₮]</th>
                    <th>SMS charge threshold [₮]</th>
                    <th>Data charge threshold [₮]</th>
                    <th>Charge  summary threshold [₮]</th>
                    <th>Rate summary threshold [Score]</th>
                    <th>Inboind _Charge  summary threshold [₮]</th>
                    <th>Inbound_Rate summary threshold [Score]</th>
                    <th>Voice duratian to rate [Min]</th>
                    <th>SMS count to rate [Num]</th>
                    <th>Data usage to rate [MB]</th>
                    <th>Voice usage threshold [Min]</th>
                    <th>SMS usage threshold [Num]</th>
                    <th>Data usage threshold [MB]</th>
                    <th>MOC count [Num]</th>
                    <th>MTC count [Num]</th>
                    <th>SMS count [Num]</th>
                    <th>Data count [Num]</th>
                    <th>Voice Service check by unique IMSI_Day time_3h</th>
                    <th>SMS Service check by unique IMSI_Day time_3h</th>
                    <th>GPRS service check by unique IMSI_Day time_3h</th>
                    <th>LTE service check by unique IMSI_Day time_3h</th>
                    <th>Voice Service check by unique IMSI_Night time_3h</th>
                    <th>SMS Service check by unique IMSI_Night time_3h</th>
                    <th>GPRS service check by unique IMSI_Night time_3h</th>
                    <th>LTE service check by unique IMSI_Night time_3h</th>
                    <th>Voice Service check by unique IMSI_24h</th>
                    <th>SMS Service check by unique IMSI_24h</th>
                    <th>GPRS service check by unique IMSI_24h</th>
                    <th>LTE service check by unique IMSI_24h</th>
                    <th>Service success rate by day time [%]</th>
                    <th>Service success rate by night time [%]</th>
                    <th>KPI check by unique IMSI attempt_5Min</th>
                    <th>KPI check by unique IMSI attempt_1H</th>
                    <th>KPI check by unique IMSI attempt_24H</th>
                    <th>Action</th>
                  </tr>
              </thead>
              <tfoot>
                  <tr>
                    <th>PRIORITY</th>
                    <th>Voice charge threshold [₮]</th>
                    <th>SMS charge threshold [₮]</th>
                    <th>Data charge threshold [₮]</th>
                    <th>Charge  summary threshold [₮]</th>
                    <th>Rate summary threshold [Score]</th>
                    <th>Inboind _Charge  summary threshold [₮]</th>
                    <th>Inbound_Rate summary threshold [Score]</th>
                    <th>Voice duratian to rate [Min]</th>
                    <th>SMS count to rate [Num]</th>
                    <th>Data usage to rate [MB]</th>
                    <th>Voice usage threshold [Min]</th>
                    <th>SMS usage threshold [Num]</th>
                    <th>Data usage threshold [MB]</th>
                    <th>MOC count [Num]</th>
                    <th>MTC count [Num]</th>
                    <th>SMS count [Num]</th>
                    <th>Data count [Num]</th>
                    <th>Voice Service check by unique IMSI_Day time_3h</th>
                    <th>SMS Service check by unique IMSI_Day time_3h</th>
                    <th>GPRS service check by unique IMSI_Day time_3h</th>
                    <th>LTE service check by unique IMSI_Day time_3h</th>
                    <th>Voice Service check by unique IMSI_Night time_3h</th>
                    <th>SMS Service check by unique IMSI_Night time_3h</th>
                    <th>GPRS service check by unique IMSI_Night time_3h</th>
                    <th>LTE service check by unique IMSI_Night time_3h</th>
                    <th>Voice Service check by unique IMSI_24h</th>
                    <th>SMS Service check by unique IMSI_24h</th>
                    <th>GPRS service check by unique IMSI_24h</th>
                    <th>LTE service check by unique IMSI_24h</th>
                    <th>Service success rate by day time [%]</th>
                    <th>Service success rate by night time [%]</th>
                    <th>KPI check by unique IMSI attempt_5Min</th>
                    <th>KPI check by unique IMSI attempt_1H</th>
                    <th>KPI check by unique IMSI attempt_24H</th>
                    <th class="non_searchable"></th>
                  </tr>
              </tfoot>
          </table>
        <!-- </div> -->
    </div>
    <div class="card-footer">

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
        var threshold_table = $('#threshold-table').DataTable({
            "processing": true,
            "serverSide": true,
            "scrollX": "500px",
            "ajax": {
                  url: "{{ url('/threshold/show')}}",
                  type: "POST"
            },
            "columns": [
                { data: "group_id" },
                { data: "voice_charge" },
                { data: "sms_charge" },
                { data: "data_charge"},
                { data: "charge_summery"},
                { data: "rate_sum_sc"},
                { data: "in_charge_sum"},
                { data: "in_rate_sum"},
                { data: "voice_dur_rate"},
                { data: "sms_count_rate"},
                { data: "data_usage_rate" },
                { data: "voice_usage" },
                { data: "sms_usage" },
                { data: "data_usage"},
                { data: "moc_count"},
                { data: "mtc_count"},
                { data: "sms_count"},
                { data: "data_count"},
                { data: "voice_check_dtime"},
                { data: "sms_check_dtime"},
                { data: "gprs_check_dtime" },
                { data: "lte_check_dtime" },
                { data: "voice_check_ntime" },
                { data: "sms_check_ntime"},
                { data: "gprs_check_ntime"},
                { data: "lte_check_ntime"},
                { data: "voice_check_24h"},
                { data: "sms_check_24h"},
                { data: "gprs_check_24h"},
                { data: "lte_check_24h"},
                { data: "success_rate_dtime"},
                { data: "success_rate_ntime"},
                { data: "kpi_check_5m"},
                { data: "kpi_check_1h"},
                { data: "kpi_check24h"},
                { data: 'action', name: 'action', orderable: false, searchable: false}
            ],
            "initComplete": function () {
                this.api().columns().every(function () {
                    var column = this;
                    var columnClass = column.footer().className;
                    if(columnClass != 'non_searchable'){
                    var input = document.createElement("input");
                    input.style.cssText = 'width:100%; height:20px;';
                    $(input).appendTo($(column.footer()).empty())
                    .on('change', function () {
                        column.search($(this).val(), false, false, true).draw();
                    });
                  }
                });
            },
            dom: "<'row'<'col-sm-2'l><'col-sm-3'B><'col-sm-7'f>>" +
                 "<'row'<'col-sm-12'tr>>" + "<'row'<'col-sm-5'i><'col-sm-7'p>>",
                  buttons: [{
                              extend: 'colvis',
                              "className": 'btn-sm'
                            },
                            {
                              extend: 'collection',
                              "className": 'btn-sm',
                              text: 'Export',
                              buttons: [ 'csv','excel', 'pdf']
                            },
                            {
                              text: ' Refresh',
                              "className": 'threshold-refresh btn-sm fa fa-refresh',
                              action: function ( e, dt, node, config ) {
                                  threshold_table.ajax.reload();
                              }
                            }
                          ]
        });
        $(document).on('click', '.threshold-edit', function() {
            var group_id = $(this).attr("id");
               $.ajax({
               type: "POST",
               url: "{{ url('/threshold/edit')}}",
               data: {group_id:group_id},
               success: function(data){
                 var response = JSON.parse(data);
                            $('#edit-priority').val(group_id);
                            $('#edit-voice-charge').val(response.voice_charge);
                            $('#edit-sms-charge').val(response.sms_charge);
                            $('#edit-data-charge').val(response.data_charge);
                            $('#edit-charge-summery').val(response.charge_summery);
                            $('#edit-rate-sum-sc').val(response.rate_sum_sc);
                            $('#edit-in-charge-sum').val(response.in_charge_sum);
                            $('#edit-in-rate-sum').val(response.in_rate_sum);
                            $('#edit-voice-dur-rate').val(response.voice_dur_rate);
                            $('#edit-sms-count-rate').val(response.sms_count_rate);
                            $('#edit-data-usage-rate').val(response.data_usage_rate);
                            $('#edit-voice-usage').val(response.voice_usage);
                            $('#edit-sms-usage').val(response.sms_usage);
                            $('#edit-data-usage').val(response.data_usage);
                            $('#edit-moc-count').val(response.moc_count);
                            $('#edit-mtc-count').val(response.mtc_count);
                            $('#edit-sms-count').val(response.sms_count);
                            $('#edit-data-count').val(response.data_count);
                            $('#edit-voice-check-dtime').val(response.voice_check_dtime);
                            $('#edit-sms-check-dtime').val(response.sms_check_dtime);
                            $('#edit-gprs-check-dtime').val(response.gprs_check_dtime);
                            $('#edit-lte-check-dtime').val(response.lte_check_dtime);
                            $('#edit-voice-check-ntime').val(response.voice_check_ntime);
                            $('#edit-sms-check-ntime').val(response.sms_check_ntime);
                            $('#edit-gprs-check-ntime').val(response.gprs_check_ntime);
                            $('#edit-lte-check-ntime').val(response.lte_check_ntime);
                            $('#edit-voice-check-24h').val(response.voice_check_24h);
                            $('#edit-sms-check-24h').val(response.sms_check_24h);
                            $('#edit-gprs-check-24h').val(response.gprs_check_24h);
                            $('#edit-lte-check-24h').val(response.lte_check_24h);
                            $('#edit-success-rate-dtime').val(response.success_rate_dtime);
                            $('#edit-success-rate-ntime').val(response.success_rate_ntime);
                            $('#edit-kpi-check-5m').val(response.kpi_check_5m);
                            $('#edit-kpi-check-1h').val(response.kpi_check_1h);
                            $('#edit-kpi-check24h').val(response.kpi_check24h);
               }
               });
            });
        $(document).on('click', '#edit-threshold-save', function() {
          var group_id = $('#edit-priority').val();
          var voice_charge = $('#edit-voice-charge').val();
          var sms_charge = $('#edit-sms-charge').val();
          var data_charge = $('#edit-data-charge').val();
          var charge_summery = $('#edit-charge-summery').val();
          var rate_sum_sc = $('#edit-rate-sum-sc').val();
          var in_charge_sum = $('#edit-in-charge-sum').val();
          var in_rate_sum = $('#edit-in-rate-sum').val();
          var voice_dur_rate = $('#edit-voice-dur-rate').val();
          var sms_count_rate = $('#edit-sms-count-rate').val();
          var data_usage_rate = $('#edit-data-usage-rate').val();
          var voice_usage = $('#edit-voice-usage').val();
          var sms_usage = $('#edit-sms-usage').val();
          var data_usage = $('#edit-data-usage').val();
          var moc_count = $('#edit-moc-count').val();
          var mtc_count = $('#edit-mtc-count').val();
          var sms_count = $('#edit-sms-count').val();
          var data_count = $('#edit-data-count').val();
          var voice_check_dtime = $('#edit-voice-check-dtime').val();
          var sms_check_dtime = $('#edit-sms-check-dtime').val();
          var gprs_check_dtime = $('#edit-gprs-check-dtime').val();
          var lte_check_dtime = $('#edit-lte-check-dtime').val();
          var voice_check_ntime = $('#edit-voice-check-ntime').val();
          var sms_check_ntime = $('#edit-sms-check-ntime').val();
          var gprs_check_ntime = $('#edit-gprs-check-ntime').val();
          var lte_check_ntime = $('#edit-lte-check-ntime').val();
          var voice_check_24h = $('#edit-voice-check-24h').val();
          var sms_check_24h = $('#edit-sms-check-24h').val();
          var gprs_check_24h = $('#edit-gprs-check-24h').val();
          var lte_check_24h = $('#edit-lte-check-24h').val();
          var success_rate_dtime = $('#edit-success-rate-dtime').val();
          var success_rate_ntime = $('#edit-success-rate-ntime').val();
          var kpi_check_5m = $('#edit-kpi-check-5m').val();
          var kpi_check_1h = $('#edit-kpi-check-1h').val();
          var kpi_check24h = $('#edit-kpi-check24h').val();
              $.ajax({
               type: "POST",
               url: "{{ url('/threshold/update')}}",
               data: { group_id:group_id, voice_charge:voice_charge, sms_charge:sms_charge,
                      data_charge:data_charge, charge_summery:charge_summery, rate_sum_sc:rate_sum_sc, in_charge_sum:in_charge_sum,
                      in_rate_sum:in_rate_sum, voice_dur_rate: voice_dur_rate,sms_count_rate:sms_count_rate,
                      data_usage_rate:data_usage_rate, voice_usage:voice_usage, sms_usage:sms_usage, data_usage:data_usage,
                      moc_count:moc_count, mtc_count:mtc_count, sms_count:sms_count, data_count:data_count,
                      voice_check_dtime:voice_check_dtime, sms_check_dtime:sms_check_dtime, gprs_check_dtime:gprs_check_dtime,
                      lte_check_dtime:lte_check_dtime, voice_check_ntime:voice_check_ntime, sms_check_ntime:sms_check_ntime,
                      gprs_check_ntime:gprs_check_ntime,
                      lte_check_ntime:lte_check_ntime, voice_check_24h:voice_check_24h, sms_check_24h:sms_check_24h,
                      gprs_check_24h:gprs_check_24h, lte_check_24h:lte_check_24h, success_rate_dtime:success_rate_dtime,
                      success_rate_ntime:success_rate_ntime, kpi_check_5m:kpi_check_5m, kpi_check_1h:kpi_check_1h,
                      kpi_check24h:kpi_check24h},
               success: function(){
                 alert("Data saved");
               }
             });
          });
});
</script>
@endpush
