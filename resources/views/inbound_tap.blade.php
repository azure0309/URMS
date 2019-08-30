@extends('layouts.main')
@section('content')
<div class="card">
    <div class="card-header">
      <div class="row">
        <div class="col-sm-3">
        <div class="input-group">
          <input type="text" class="form-control form-control-sm" placeholder="Start Date" id="start_date">
        </div>
        </div>
        <div class="col-sm-3">
        <div class="input-group">
          <input type="text" class="form-control form-control-sm" placeholder="End Date" id="end_date">
        </div>
        </div>
        <div class="col-sm-3">
          <input type="button" class="btn btn-outline-primary btn-sm" value="Query" id="query">
        </div>
      </div>
    </div>
    <div class="card-body">
        <!-- <div class="container-fluid"> -->
          <table class="table-sm table-bordered nowrap" id="inbound-tap-table">
              <thead>
                  <tr>
                    <th>IMSI</th>
                    <th>MSISDN</th>
                    <th>VLR number</th>
                    <th>APN</th>
                    <th>IMSI_NO</th>
                    <th>TADIG</th>
                    <th>CALLING_NO</th>
                    <th>duratian</th>
                    <th>byte</th>
                    <th>total usage</th>
                    <th>total charge amount</th>
                    <th>LOCATION</th>
                    <th>date and time</th>
                    <th>RTNG_CREATION_DTTM</th>
                    <th>UPLOAD_USE_BYTE</th>
                    <th>DOWNLOAD_USE_BYTE</th>
                    <th>SGSN_ADDRESS</th>
                    <th>GGSN_ADDRESS</th>
                    <th>RECIPIENT</th>
                    <th>TAP _FILE_SEQ_NUM</th>
                    <th>RAP_FILE_SEQ_NUM</th>
                    <th>NRT_FILE_SEQ_NUM</th>
                  </tr>
              </thead>
              <tfoot>
                  <tr>
                    <th>IMSI</th>
                    <th>MSISDN</th>
                    <th>VLR number</th>
                    <th>APN</th>
                    <th>IMSI_NO</th>
                    <th>TADIG</th>
                    <th>CALLING_NO</th>
                    <th>duratian</th>
                    <th>byte</th>
                    <th>total usage</th>
                    <th>total charge amount</th>
                    <th>LOCATION</th>
                    <th>date and time</th>
                    <th>RTNG_CREATION_DTTM</th>
                    <th>UPLOAD_USE_BYTE</th>
                    <th>DOWNLOAD_USE_BYTE</th>
                    <th>SGSN_ADDRESS</th>
                    <th>GGSN_ADDRESS</th>
                    <th>RECIPIENT</th>
                    <th>TAP _FILE_SEQ_NUM</th>
                    <th>RAP_FILE_SEQ_NUM</th>
                    <th>NRT_FILE_SEQ_NUM</th>
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
        $('#start_date').datetimepicker();
        $('#end_date').datetimepicker();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var inbound_tap_table;
        var today = new Date();
        var today = new Date();
        var initst = today.getFullYear() +'0'+ (today.getMonth()+1);
        var initend = today.getFullYear() +'0'+ (today.getMonth()+1);
        fetch_data('201903','201912');
        function fetch_data(start_date, end_date){
        inbound_tap_table = $('#inbound-tap-table').DataTable({
            "processing": true,
            "serverSide": true,
            "lengthMenu": [[100, 300, 600, 900], [100, 300, 600, 900]],
            "scrollY": "500px",
            "scrollX": true,
            "ajax": {
                  url: "{{ url('/inbound-tap/show')}}",
                  type: "POST",
                  data: {start_date: start_date, end_date:end_date}
            },
            "columns": [
                            { data: "subscription_key" },
                            { data: "prod_no" },
                            { data: "ichr_no" },
                            { data: "incmg_no" },
                            { data: "imsi_no" },
                            { data: "prod_cd" },
                            { data: "calling_no" },
                            { data: "use_sec"},
                            { data: "use_byte" },
                            { data: "tot_mgcv_use_qty" },
                            { data: "tot_rtng_amt" },
                            { data: "location_info" },
                            { data: "use_strt_dttm" },
                            { data: "rtng_creation_dttm" },
                            { data: "upload_use_byte" },
                            { data: "download_use_byte" },
                            { data: "sgsn_address" },
                            { data: "ggsn_address" },
                            { data: "recipient" },
                            { data: "tap_file_seq_num" },
                            { data: "rap_file_seq_num" },
                            { data: "nrt_file_seq_num" }
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
                                  inbound_tap_table.ajax.reload();
                              }

                            }
                          ]
        });
        }
      });
</script>
@endpush
