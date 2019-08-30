@extends('layouts.main')
@section('content')
<div class="card">
    <div class="card-header">

    </div>
    <div class="card-body">
        <!-- <div class="container-fluid"> -->
          <table class="table-sm table-bordered nowrap" id="outbound-tap-table">
              <thead>
                  <tr>
                    <th>IMSI</th>
                    <th>TAP_seq_number</th>
                    <th>MSISDN</th>
                    <th>local date & time</th>
                    <th>service type</th>
                    <th>calling number</th>
                    <th>called number</th>
                    <th>TADIG</th>
                    <th>duration</th>
                    <th>byte</th>
                    <th>total duration</th>
                    <th>charge</th>
                    <th>system process time</th>
                    <th>UPLOAD_USE_BYTE</th>
                    <th>DOWNLOAD_USE_BYTE</th>
                    <th>service type</th>
                    <th>TAP</th>
                    <th>rate creation time</th>
                  </tr>
              </thead>
              <tfoot>
                  <tr>
                    <th>IMSI</th>
                    <th>TAP_seq_number</th>
                    <th>MSISDN</th>
                    <th>local date & time</th>
                    <th>service type</th>
                    <th>calling number</th>
                    <th>called number</th>
                    <th>TADIG</th>
                    <th>duration</th>
                    <th>byte</th>
                    <th>total duration</th>
                    <th>charge</th>
                    <th>system process time</th>
                    <th>UPLOAD_USE_BYTE</th>
                    <th>DOWNLOAD_USE_BYTE</th>
                    <th>service type</th>
                    <th>TAP</th>
                    <th>rate creation time</th>
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
        var outbound_tap_table = $('#outbound-tap-table').DataTable({
            "processing": true,
            "serverSide": true,
            "lengthMenu": [[100, 300, 600, 900], [100, 300, 600, 900]],
            "scrollY": "500px",
            "scrollX": true,
            "ajax": {
                  url: "{{ url('/outbound-tap/show')}}",
                  type: "POST"
            },
            "columns": [
                    { data: "subscription_key" },
                    { data: "cdr_seq_number" },
                    { data: "prod_no" },
                    { data: "use_strt_dttm" },
                    { data: "cdr_kd_cd" },
                    { data: "calling_no" },
                    { data: "use_trgt_no" },
                    { data: "mco_cd" },
                    { data: "use_sec" },
                    { data: "use_byte" },
                    { data: "tot_mgcv_use_qty" },
                    { data: "tot_rtng_amt" },
                    { data: "bill_mark_id" },
                    { data: "upload_use_byte" },
                    { data: "download_use_byte" },
                    { data: "mps_swtch_cd" },
                    { data: "roaming_type" },
                    { data: "rtng_creation_dttm" }
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
                                  outbound_tap_table.ajax.reload();
                              }
                            }
                          ]
        });
});
</script>
@endpush
