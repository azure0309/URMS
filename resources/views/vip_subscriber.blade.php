@extends('layouts.main')
@section('content')

<div class="card">
    <div class="card-header">
      <!-- Modal -->
      <div class="modal fade" id="vip-sub-add" role="dialog">
        <div class="modal-dialog">
          <!-- VIP add modal-->
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title"><span class="badge badge-danger">Add</span></h4>
            </div>
            <div class="modal-body">
              <form class="form-horizontal">
                <div class="form-group">
                  <label class="control-label text-success">MSISDN</label>
                  <div class="col">
                    <input type="text" class="form-control form-control-sm" id="add-msisdn"></input>
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label text-success">Status</label>
                  <div class="col">
                    <input type="text" class="form-control form-control-sm" id="add-imsi"></input>
                  </div>
                </div>
              </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-outline-danger btn-xs" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-outline-danger btn-xs" data-dismiss="modal" id="vip-add-save">Save</button>
            </div>
          </div>
        </div>
      </div>
      <!-- modal end -->
      <!-- Modal -->
      <div class="modal fade" id="vip-sub-edit" role="dialog">
        <div class="modal-dialog">
          <!-- VIP edit modal-->
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title"><span class="badge badge-danger">Edit</span></h4>
            </div>
            <div class="modal-body">
              <form class="form-horizontal">
                <div class="form-group">
                  <label class="control-label text-success">MSISDN</label>
                  <div class="col">
                    <input type="text" class="form-control form-control-sm" id="edit-msisdn" readonly></input>
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label text-success">Status</label>
                  <div class="col">
                    <input type="text" class="form-control form-control-sm" id="edit-imsi"></input>
                  </div>
                </div>
              </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-outline-danger btn-xs" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-outline-danger btn-xs" data-dismiss="modal" id="vip-edit-save">Save</button>
            </div>
          </div>
        </div>
      </div>
      <!-- modal end -->
      <!-- Modal -->
      <div class="modal fade" id="vip-sub-delete" role="dialog">
        <div class="modal-dialog">
          <!-- VIP delete modal-->
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title"><span class="badge badge-danger">Delete</span></h4>
            </div>
            <div class="modal-body">
              <form class="form-horizontal">
                <div class="form-group">
                  <div class="col">
                    <input type="hidden" class="form-control form-control-sm" id="delete-msisdn" readonly></input>
                  </div>
                  <label class="control-label text-success">Are you sure ?</label>
                </div>
              </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-outline-danger btn-xs" data-dismiss="modal">No</button>
              <button type="button" class="btn btn-outline-danger btn-xs" data-dismiss="modal" id="vip-delete-save">Yes</button>
            </div>
          </div>
        </div>
      </div>
      <!-- modal end -->
    </div>
    <div class="card-body">
        <!-- <div class="container-fluid"> -->
          <table class="table-sm table-bordered responsive" id="vip-sub-table">
              <thead>
                  <tr>
                    <th>MSISDN</th>
                    <th>IMSI</th>
                    <th>Action</th>
                  </tr>
              </thead>
              <tfoot>
                  <tr>
                    <th>MSISDN</th>
                    <th>IMSI</th>
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
        var vip_sub_table = $('#vip-sub-table').DataTable({
            "processing": true,
            "serverSide": true,
            "lengthMenu": [[100, 300, 600, 900], [100, 300, 600, 900]],
            "scrollY": "450px",
            "ajax": {
                  url: "{{ url('/vip-subscriber/show')}}",
                  type: "POST"
            },
            "columns": [
                { data: "prod_no" },
                { data: "imsi_no" },
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
                  buttons: [
                            {
                              text: 'Add',
                              "className": 'vip-sub-add btn-sm'
                            },
                            {
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
                              "className": 'btn-sm fa fa-refresh',
                              action: function ( e, dt, node, config ) {
                                  vip_sub_table.ajax.reload();
                              }
                            }
                          ]
        });
        $('#vip-sub-table').on('init.dt', function() {
           $('.vip-sub-add')
             .attr('data-toggle', 'modal')
             .attr('data-target', '#vip-sub-add');
        });
        $(document).on('click', '#vip-add-save', function() {
          var msisdn = $('#add-msisdn').val();
          var imsi = $('#add-imsi').val();
              $.ajax({
               type: "POST",
               url: "{{ url('/vip-subscriber/store')}}",
               data: {msisdn:msisdn,imsi:imsi},
               success: function(data){
                 alert("Data saved");
               }
             });
          });
        $(document).on('click', '.vip-edit', function() {
            var msisdn = $(this).attr("id");
               $.ajax({
               type: "POST",
               url: "{{ url('/vip-subscriber/edit')}}",
               data: {msisdn:msisdn},
               success: function(data){
                 var response = JSON.parse(data);
                  $('#edit-msisdn').val(msisdn);
                  $('#edit-imsi').val(response.imsi);
               }
               });
            });
        $(document).on('click', '#vip-edit-save', function() {
          var msisdn = $('#edit-msisdn').val();
          var imsi = $('#edit-imsi').val();
              $.ajax({
               type: "POST",
               url: "{{ url('/vip-subscriber/update')}}",
               data: {msisdn:msisdn,imsi:imsi},
               success: function(data){
                 alert("Data saved");
               }
             });
          });
          $(document).on('click', '.vip-delete', function() {
              var msisdn = $(this).attr("id");
              $('#delete-msisdn').val(msisdn);
              });
          $(document).on('click', '#vip-delete-save', function() {
            var msisdn = $('#delete-msisdn').val();
                $.ajax({
                 type: "POST",
                 url: "{{ url('/vip-subscriber/delete')}}",
                 data: {msisdn:msisdn},
                 success: function(data){
                   alert("Data saved");
                 }
               });
            });
});
</script>
@endpush
