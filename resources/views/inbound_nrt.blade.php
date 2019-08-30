@extends('layouts.main')
@section('content')
<div class="card">
    <div class="card-header">

    </div>
    <div class="card-body">
        <!-- <div class="container-fluid"> -->
          <table class="table-sm table-bordered nowrap" id="inbound-nrt-table">
              <thead>
                  <tr>
                    <th>MSISDN</th>
                    <th>USE_STRT_DTTM</th>
                    <th>VLR number</th>
                    <th>URL</th>
                    <th>IMSI_NO</th>
                    <th>direction</th>
                    <th>CALLING_NO</th>
                    <th>IMEI</th>
                    <th>duration</th>
                    <th>total byte</th>
                    <th>total</th>
                    <th>charge</th>
                    <th>SYS_CREATION_DATE</th>
                    <th>LOCATION_INFO</th>
                    <th>RTNG_CREATION_DTTM</th>
                    <th>UPLOAD_USE_BYTE</th>
                    <th>DOWNLOAD_USE_BYTE</th>
                    <th>SGSN_ADDRESS</th>
                    <th>TADIG</th>
                    <th>NRT_FILE_SEQ_NU</th>
                    <th>service type</th>
                    <th>CDR_SEQ_NUMBER in HLR</th>
                  </tr>
              </thead>
              <tfoot>
                  <tr>
                    <th>MSISDN</th>
                    <th>USE_STRT_DTTM</th>
                    <th>VLR number</th>
                    <th>URL</th>
                    <th>IMSI_NO</th>
                    <th>direction</th>
                    <th>CALLING_NO</th>
                    <th>IMEI</th>
                    <th>duration</th>
                    <th>total byte</th>
                    <th>total</th>
                    <th>charge</th>
                    <th>SYS_CREATION_DATE</th>
                    <th>LOCATION_INFO</th>
                    <th>RTNG_CREATION_DTTM</th>
                    <th>UPLOAD_USE_BYTE</th>
                    <th>DOWNLOAD_USE_BYTE</th>
                    <th>SGSN_ADDRESS</th>
                    <th>TADIG</th>
                    <th>NRT_FILE_SEQ_NU</th>
                    <th>service type</th>
                    <th>CDR_SEQ_NUMBER in HLR</th>
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
        var inbound_nrt_table = $('#inbound-nrt-table').DataTable({
            "processing": true,
            "serverSide": true,
            "lengthMenu": [[100, 300, 600, 900], [100, 300, 600, 900]],
            "scrollY": "500px",
            "scrollX": true,
            "ajax": {
                  url: "{{ url('/inbound-nrt/show')}}",
                  type: "POST"
            },
            "columns": [
                          { data: "prod_no" },
                          { data: "use_strt_dttm" },
                          { data: "ichr_no" },
                          { data: "incmg_no" },
                          { data: "imsi_no" },
                          { data: "prod_cd" },
                          { data: "calling_no" },
                          { data: "mcn_no" },
                          { data: "use_sec" },
                          { data: "use_byte" },
                          { data: "tot_mgcv_use_qty" },
                          { data: "tot_rtng_amt" },
                          { data: "sys_creation_date" },
                          { data: "location_info" },
                          { data: "rtng_creation_dttm" },
                          { data: "upload_use_byte" },
                          { data: "download_use_byte" },
                          { data: "sgsn_address" },
                          { data: "recipient" },
                          { data: "nrt_file_seq_num" },
                          { data: "service_type" },
                          { data: "cdr_seq_number" }
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
                              "className": 'inbound-nrt-refresh btn-sm',
                              action: function ( e, dt, node, config ) {
                                  inbound_nrt_table.ajax.reload();
                              }
                            }
                          ]
        });
});
</script>
@endpush
