@extends('layouts.main')
@section('content')
<div class="card">
    <div class="card-header">
      @include('inc.reference')
    </div>
    <div class="card-body">
        <!-- <div class="container-fluid"> -->
          <table class="table-sm table-bordered nowrap" id="reference-rp-history-table">
              <thead>
                  <tr>
                    <th>CONTINENT</th>
                    <th>COUNTRY</th>
                    <th>OPERATOR</th>
                    <th>TADIG</th>
                    <th>IMSI_GT</th>
                    <th>GT_PREFIX</th>
                    <th>TIME_ZONE</th>
                    <th>PRIORITY</th>
                    <th>GSM</th>
                    <th>GSM_LAUNCH_DATE_IN</th>
                    <th>GSM_LAUNCH_DATE_OUT</th>
                    <th>GPRS</th>
                    <th>GPRS_LAUNCH_DATE_IN</th>
                    <th>GPRS_LAUNCH_DATE_OUT</th>
                    <th>CAMEL</th>
                    <th>CAMEL_LAUNCH_DATE_IN</th>
                    <th>CAMEL_LAUNCH_DATE_OUT</th>
                    <th>LTE</th>
                    <th>LTE_LAUNCH_DATE_IN</th>
                    <th>LTE_LAUNCH_DATE_OUT</th>
                    <th>NRT</th>
                    <th>NRT_LAUNCH_DATE_IN</th>
                    <th>NRT_LAUNCH_DATE_OUT</th>
                    <th>DIRECTION</th>
                    <th>AGREEMENT</th>
                    <th>MEMO</th>
                    <th>MEMO_DATE</th>
                    <th>STATUS</th>
                    <th>STATUS_DATE</th>
                    <th>TAP_SEQ</th>
                    <th>TAP_SEQ_IN</th>
                    <th>NODE_GT</th>
                    <th>Action</th>
                  </tr>
              </thead>
              <tfoot>
                  <tr>
                    <th>CONTINENT</th>
                    <th>COUNTRY</th>
                    <th>OPERATOR</th>
                    <th>TADIG</th>
                    <th>IMSI_GT</th>
                    <th>GT_PREFIX</th>
                    <th>TIME_ZONE</th>
                    <th>PRIORITY</th>
                    <th>GSM</th>
                    <th>GSM_LAUNCH_DATE_IN</th>
                    <th>GSM_LAUNCH_DATE_OUT</th>
                    <th>GPRS</th>
                    <th>GPRS_LAUNCH_DATE_IN</th>
                    <th>GPRS_LAUNCH_DATE_OUT</th>
                    <th>CAMEL</th>
                    <th>CAMEL_LAUNCH_DATE_IN</th>
                    <th>CAMEL_LAUNCH_DATE_OUT</th>
                    <th>LTE</th>
                    <th>LTE_LAUNCH_DATE_IN</th>
                    <th>LTE_LAUNCH_DATE_OUT</th>
                    <th>NRT</th>
                    <th>NRT_LAUNCH_DATE_IN</th>
                    <th>NRT_LAUNCH_DATE_OUT</th>
                    <th>DIRECTION</th>
                    <th>AGREEMENT</th>
                    <th>MEMO</th>
                    <th>MEMO_DATE</th>
                    <th>STATUS</th>
                    <th>STATUS_DATE</th>
                    <th>TAP_SEQ</th>
                    <th>TAP_SEQ_IN</th>
                    <th>NODE_GT</th>
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
        var reference_history_table = $('#reference-rp-history-table').DataTable({
            "processing": true,
            "serverSide": true,
            "lengthMenu": [[100, 300, 600, 900], [100, 300, 600, 900]],
            "scrollY": "500px",
            "scrollX": true,
            "ajax": {
                  url: "{{ url('/reference-rp-history/show')}}",
                  type: "POST"
            },
            "columns": [
                            { data: "continent" },
                            { data: "country" },
                            { data: "operator" },
                            { data: "tadig" },
                            { data: "imsi_gt" },
                            { data: "gt_prefix" },
                            { data: "time_zone" },
                            { data: "priority" },
                            { data: "gsm"},
                            { data: "gsm_launch_date_in" },
                            { data: "gsm_launch_date_out" },
                            { data: "gprs"},
                            { data: "gprs_launch_date_in" },
                            { data: "gprs_launch_date_out" },
                            { data: "camel"},
                            { data: "camel_launch_date_in" },
                            { data: "camel_launch_date_out" },
                            { data: "lte"},
                            { data: "lte_launch_date_in" },
                            { data: "lte_launch_date_out" },
                            { data: "nrt"},
                            { data: "nrt_launch_date_in" },
                            { data: "nrt_launch_date_out" },
                            { data: "direction" },
                            { data: "agreement"},
                            { data: "memo" },
                            { data: "memo_date" },
                            { data: "status" },
                            { data: "status_date" },
                            { data: "tap_seq" },
                            { data: "tap_seq_in" },
                            { data: "node_gt"},
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
                              text: 'Refresh',
                              "className": 'btn-sm',
                              action: function ( e, dt, node, config ) {
                                  reference_history_table.ajax.reload();
                              }
                            }
                          ]
        });
        $(document).on('click', '.reference-edit', function() {
            var tadig = $(this).attr("id");
               $.ajax({
               type: "POST",
               url: "{{ url('/reference-rp-history/edit')}}",
               data: {tadig:tadig},
               success: function(data){
                   var response = JSON.parse(data);
                    $('#edit-ref-continent').val(response.continent);
                    $('#edit-ref-country').val(response.country);
                    $('#edit-ref-operator').val(response.operator);
                    $('#edit-ref-tadig').val(tadig);
                    $('#edit-ref-imsigt').val(response.imsi_gt);
                    $('#edit-ref-gtprefix').val(response.gt_prefix);
                    $('#edit-ref-time-zone').val(response.time_zone);
                    $('#edit-ref-priority').val(response.priority);
                    $('#edit-ref-gsm').val(response.gsm);
                    $('#edit-ref-gsm-in-date').val(response.gsm_launch_date_in);
                    $('#edit-ref-gsm-out-date').val(response.gsm_launch_date_out);
                    $('#edit-ref-gprs').val(response.gprs);
                    $('#edit-ref-gprs-in-date').val(response.gprs_launch_date_in);
                    $('#edit-ref-gprs-out-date').val(response.gprs_launch_date_out);
                    $('#edit-ref-camel').val(response.camel);
                    $('#edit-ref-camel-in-date').val(response.camel_launch_date_in);
                    $('#edit-ref-camel-out-date').val(response.camel_launch_date_out);
                    $('#edit-ref-lte').val(response.lte);
                    $('#edit-ref-lte-in-date').val(response.lte_launch_date_in);
                    $('#edit-ref-lte-out-date').val(response.lte_launch_date_out);
                    $('#edit-ref-nrt').val(response.nrt);
                    $('#edit-ref-nrt-in-date').val(response.nrt_launch_date_in);
                    $('#edit-ref-nrt-out-date').val(response.nrt_launch_date_out);
                    $('#edit-ref-direction').val(response.direction);
                    $('#edit-ref-agreement').val(response.agreement);
                    $('#edit-ref-status').val(response.status);
                    $('#edit-ref-memo').val(response.memo);
                    $('#edit-memo-date').val(response.memo_date);
                    $('#edit-ref-node-gt').val(response.node_gt);
                 }
               });
            });
            $(document).on('click', '#edit-ref-save', function() {
                  var continent = $('#edit-ref-continent').val();
                  var country = $('#edit-ref-country').val();
                  var operator = $('#edit-ref-operator').val();
                  var tadig = $('#edit-ref-tadig').val();
                  var priority = $('#edit-ref-priority').val();
                  var gt_prefix = $('#edit-ref-gtprefix').val();
                  var imsi_gt = $('#edit-ref-imsigt').val();
                  var timezone = $('#edit-ref-time-zone').val();
                  var gsm = $('#edit-ref-gsm').val();
                  var gsm_launch_date_in= $('#edit-ref-gsm-in-date').val();
                  var gsm_launch_date_out = $('#edit-ref-gsm-out-date').val();
                  var gprs = $('#edit-ref-gprs').val();
                  var gprs_launch_date_in = $('#edit-ref-gprs-in-date').val();
                  var gprs_launch_date_out = $('#edit-ref-gprs-out-date').val();
                  var camel = $('#edit-ref-camel').val();
                  var camel_launch_date_in = $('#edit-ref-camel-in-date').val();
                  var camel_launch_date_out = $('#edit-ref-camel-out-date').val();
                  var lte = $('#edit-ref-lte').val();
                  var lte_launch_date_in = $('#edit-ref-lte-in-date').val();
                  var lte_launch_date_out = $('#edit-ref-lte-out-date').val();
                  var nrt = $('#edit-ref-nrt').val();
                  var nrt_launch_date_in = $('#edit-ref-nrt-in-date').val();
                  var nrt_launch_date_out = $('#edit-ref-nrt-out-date').val();
                  var direction = $('#edit-ref-direction').val();
                  var agreement = $('#edit-ref-agreement').val();
                  var status = $('#edit-ref-status').val();
                  var memo = $('#edit-ref-memo').val();
                  var memodate = $('#edit-memo-date').val();
                  var nodegt = $('#edit-ref-node-gt').val();
                  var status = $('#edit-ref-status').val();
                   $.ajax({
                   type: "POST",
                   url: "{{ url('/reference-rp-history/update')}}",
                   data: {continent:continent, country:country,
                          operator:operator,tadig:tadig,priority:priority,
                          gt_prefix:gt_prefix,imsi_gt:imsi_gt,timezone:timezone,
                          gsm:gsm,gsm_launch_date_in:gsm_launch_date_in,gsm_launch_date_out:gsm_launch_date_out,
                          gprs:gprs,gprs_launch_date_in:gprs_launch_date_in,gprs_launch_date_out:gprs_launch_date_out,
                          camel:camel,camel_launch_date_in:camel_launch_date_in,camel_launch_date_out:camel_launch_date_out,
                          lte:lte,lte_launch_date_in:lte_launch_date_in,lte_launch_date_out:lte_launch_date_out,
                          nrt:nrt,nrt_launch_date_in:nrt_launch_date_in,nrt_launch_date_out:nrt_launch_date_out,
                          direction:direction,agreement:agreement,status:status,
                          memo:memo, memodate:memodate, nodegt:nodegt},
                   success: function(data){
                       alert("Data saved");
                     }
                   });
                });
});
</script>
@endpush
