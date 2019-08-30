@extends('layouts.main')
@section('content')
<div class="card">
    <div class="card-header">
      <div class="container">
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
          <div class="col-sm-4">
            <input type="button" class="btn btn-outline-primary btn-sm" value="Query" id="query">
          </div>
        </div>
      </div>
    </div>
    </div>
    <div class="card-body">
        <!-- <div class="container-fluid"> -->
          <table class="table-sm table-bordered nowrap" id="stp-transaction-table">
              <thead>
                  <tr>
                        <!-- <th>COUNTRY</th>
                        <th>OPERATOR</th> -->
                        <th>TADIG</th>
                        <!-- <th>IMSI_GT</th>
                        <th>GT_PREFIX</th>
                        <th>TIME_ZONE</th>
                        <th>PRIORITY</th> -->
                        <th>REGDATE</th>
                        <th>RECVTIME</th>
                        <th>OTID</th>
                        <th>DTID</th>
                        <th>OPC</th>
                        <th>DPC</th>
                        <th>CALLINGSSN</th>
                        <th>CALLINGGT</th>
                        <th>CALLEDSSN</th>
                        <th>CALLEDGT</th>
                        <th>OPNAME</th>
                        <th>OPRESULT</th>
                        <th>OPERROR</th>
                        <th>IMSI</th>
                        <th>MSISDN</th>
                        <th>VLR</th>
                        <th>HLR</th>
                        <th>MSC</th>
                        <th>SGSN</th>
                        <th>OPCODE</th>
                        <th>OPERROR1</th>
                        <th>TSVC</th>
                        <th>SCADDR</th>
                        <th>DESTADDR</th>
                        <th>ORIGADDR</th>
                        <th>DIRECTION</th>
                        <th>OCS</th>
                  </tr>
              </thead>
              <tfoot>
                  <tr>
                    <!-- <th>COUNTRY</th>
                    <th>OPERATOR</th> -->
                    <th>TADIG</th>
                    <!-- <th>IMSI_GT</th>
                    <th>GT_PREFIX</th>
                    <th>TIME_ZONE</th>
                    <th>PRIORITY</th> -->
                    <th>REGDATE</th>
                    <th>RECVTIME</th>
                    <th>OTID</th>
                    <th>DTID</th>
                    <th>OPC</th>
                    <th>DPC</th>
                    <th>CALLINGSSN</th>
                    <th>CALLINGGT</th>
                    <th>CALLEDSSN</th>
                    <th>CALLEDGT</th>
                    <th>OPNAME</th>
                    <th>OPRESULT</th>
                    <th>OPERROR</th>
                    <th>IMSI</th>
                    <th>MSISDN</th>
                    <th>VLR</th>
                    <th>HLR</th>
                    <th>MSC</th>
                    <th>SGSN</th>
                    <th>OPCODE</th>
                    <th>OPERROR1</th>
                    <th>TSVC</th>
                    <th>SCADDR</th>
                    <th>DESTADDR</th>
                    <th>ORIGADDR</th>
                    <th>DIRECTION</th>
                    <th>OCS</th>
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
        var stp_transaction_table;
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var today = new Date();
        var initst = today.getFullYear() +'0'+ (today.getMonth()+1)+''+(today.getDate()-20);
        var initend = today.getFullYear()+'0'+(today.getMonth()+1)+''+(today.getDate()+1);
        console.log(initst);
        console.log(initend);
        fetch_data(initst,initend);
        function fetch_data(start_date, end_date){
        stp_transaction_table = $('#stp-transaction-table').DataTable({
            "processing": true,
            "serverSide": true,
            "lengthMenu": [[100, 300, 600, 900], [100, 300, 600, 900]],
            "order": [ 1, 'desc' ],
            "scrollY": "500px",
            "scrollX": true,
            "ajax": {
                  url: "{{ url('/stp-transaction/show')}}",
                  type: "POST",
                  data: {start_date: start_date, end_date:end_date}
            },
            "columns": [
                          // { data: "country" },
                          // { data: "operator" },
                          { data: "tadig" },
                          // { data: "imsi_gt" },
                          // { data: "gt_prefix" },
                          // { data: "time_zone" },
                          // { data: "priority" },
                          { data: "regdate" },
                          { data: "recvtime" },
                          { data: "otid" },
                          { data: "dtid" },
                          { data: "opc" },
                          { data: "dpc" },
                          { data: "callingssn" },
                          { data: "callinggt" },
                          { data: "calledssn" },
                          { data: "calledgt" },
                          { data: "opname" },
                          { data: "opresult" },
                          { data: "operror" },
                          { data: "imsi" },
                          { data: "msisdn" },
                          { data: "vlr" },
                          { data: "hlr" },
                          { data: "msc" },
                          { data: "sgsn" },
                          { data: "opcode" },
                          { data: "operror1" },
                          { data: "barring" },
                          { data: "scaddr" },
                          { data: "destaddr" },
                          { data: "origaddr" },
                          { data: "inbound" },
                          { data: "ocs" }
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
                                  stp_transaction_table.ajax.reload();
                              }
                            }
                          ]
        });
      }
      $('#query').on('click', function() {
          var start_date = $('#start_date').val();
          var end_date = $('#end_date').val();
          var st_date = start_date.split(/[/: ]/);
          var en_date = end_date.split(/[/: ]/);
          var db_start_date = st_date[0] + st_date[1] + st_date[2] + st_date[3] + st_date[4];
          var db_end_date = en_date[0] + en_date[1] + en_date[2] + en_date[3] + en_date[4];
          //console.log(db_start_date);
          if(start_date != '' && end_date !='')
          {
           $('#stp-transaction-table').DataTable().destroy();
           fetch_data(db_start_date, db_end_date);
          }
          else
          {
           alert("Both Date is Required");
          }
      });
});
</script>
@endpush
