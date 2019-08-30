@extends('layouts.main')
@section('content')
<div class="card">
    <div class="card-header">

    </div>
    <div class="card-body">
        <!-- <div class="container-fluid"> -->
          <table class="table-sm table-bordered nowrap" id="outbound-nrt-table">
              <thead>
                  <tr>
                    <th>NRT_seq_num</th>
                    <th>time</th>
                    <th>IMSI</th>
                    <th>MSISDN</th>
                    <th>called number</th>
                    <th>calling number</th>
                    <th>dialed number</th>
                    <th>local time</th>
                    <th>time zone</th>
                    <th>duration</th>
                    <th>VLR number</th>
                    <th>IMEI</th>
                    <th>service type</th>
                    <th>charge</th>
                  </tr>
              </thead>
              <tfoot>
                  <tr>
                    <th>NRT_seq_num</th>
                    <th>time</th>
                    <th>IMSI</th>
                    <th>MSISDN</th>
                    <th>called number</th>
                    <th>calling number</th>
                    <th>dialed number</th>
                    <th>local time</th>
                    <th>time zone</th>
                    <th>duration</th>
                    <th>VLR number</th>
                    <th>IMEI</th>
                    <th>service type</th>
                    <th>charge</th>
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
        var outbound_nrt_table = $('#outbound-nrt-table').DataTable({
            "processing": true,
            "serverSide": true,
            "lengthMenu": [[100, 300, 600, 900], [100, 300, 600, 900]],
            "scrollY": "500px",
            "scrollX": true,
            "ajax": {
                  url: "{{ url('/outbound-nrt/show')}}",
                  type: "POST"
            },
            "columns": [
                  { data: "cdr_file_name" },
                  { data: "processed_time" },
                  { data: "bc_cs_imsi" },
                  { data: "bc_cs_msisdn" },
                  { data: "bc_ds_called_number" },
                  { data: "bc_co_calling_number" },
                  { data: "bc_ds_dialled_digits" },
                  { data: "bc_ces_local_tstamp" },
                  { data: "bc_ces_utc_toffset" },
                  { data: "bc_total_call_event_duration" },
                  { data: "lc_nl_rec_entity_code" },
                  { data: "ei_imei" },
                  { data: "su_bs_sc_tele_svc_code" },
                  { data: "su_ch_cd_charge" }
            ],
            "initComplete": function () {
                this.api().columns().every(function () {
                    var column = this;
                    var input = document.createElement("input");
                    input.style.cssText = 'width:100%; height:20px;';
                    $(input).appendTo($(column.footer()).empty())
                    .on('change', function () {
                        column.search($(this).val(), false, false, true).draw();
                    });
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
                                  outbound_nrt_table.ajax.reload();
                              }
                            }
                          ]
        });
});
</script>
@endpush
