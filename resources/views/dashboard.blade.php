@extends('layouts.main')
@section('content')
<!-- Modal -->
          <!-- User add modal-->
          <div class="modal fade" id="user-add" role="dialog">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-body">
                  <div class="card">
                      <div class="card-header">Register</div>
                      <div class="card-body">
                          <form role="form" method="POST" action="{{ url('/register') }}">
                              {!! csrf_field() !!}
                              <div class="form-group row">
                                  <label class="col-lg-4 col-form-label text-lg-right">Name</label>
                                  <div class="col-lg-6">
                                      <input
                                              type="text"
                                              class="form-control-sm form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                              name="name"
                                              value="{{ old('name') }}"
                                              required
                                      >
                                      @if ($errors->has('name'))
                                          <div class="invalid-feedback">
                                              <strong>{{ $errors->first('name') }}</strong>
                                          </div>
                                      @endif
                                  </div>
                              </div>
                              <div class="form-group row">
                                  <label class="col-lg-4 col-form-label text-lg-right">Permission</label>

                                  <div class="col-lg-6">
                                    <input type="text" class="form-control-sm form-control{{ $errors->has('permission') ? ' is-invalid' : '' }}"
                                    name="permission"
                                    value="{{ old('permission') }}"
                                    required>
                                    @if ($errors->has('permission'))
                                      <div class="invalid-feedback">
                                          <strong>{{ $errors->first('permission') }}</strong>
                                      </div>
                                    @endif
                                  </div>
                              </div>
                              <div class="form-group row">
                                  <label class="col-lg-4 col-form-label text-lg-right">E-Mail Address</label>

                                  <div class="col-lg-6">
                                      <input
                                              type="email"
                                              class="form-control-sm form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                              name="email"
                                              value="{{ old('email') }}"
                                              required
                                      >

                                      @if ($errors->has('email'))
                                          <div class="invalid-feedback">
                                              <strong>{{ $errors->first('email') }}</strong>
                                          </div>
                                      @endif
                                  </div>
                              </div>

                              <div class="form-group row">
                                  <label class="col-lg-4 col-form-label text-lg-right">Password</label>

                                  <div class="col-lg-6">
                                      <input
                                              type="password"
                                              class="form-control-sm form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                              name="password"
                                              required
                                      >
                                      @if ($errors->has('password'))
                                          <div class="invalid-feedback">
                                              <strong>{{ $errors->first('password') }}</strong>
                                          </div>
                                      @endif
                                  </div>
                              </div>

                              <div class="form-group row">
                                  <label class="col-lg-4 col-form-label text-lg-right">Confirm Password</label>

                                  <div class="col-lg-6">
                                      <input
                                              type="password"
                                              class="form-control-sm form-control{{ $errors->has('password_confirmation') ? ' is-invalid' : '' }}"
                                              name="password_confirmation"
                                              required
                                      >
                                      @if ($errors->has('password_confirmation'))
                                          <div class="invalid-feedback">
                                              <strong>{{ $errors->first('password_confirmation') }}</strong>
                                          </div>
                                      @endif
                                  </div>
                              </div>
                              <div class="form-group row">
                                  <div class="col-4">
                                      <button type="button" class="btn btn-primary btn-sm float-right" data-dismiss="modal">
                                        Close
                                      </button>
                                  </div>
                                  <div class="col-4">
                                      <button type="submit" class="btn btn-primary btn-sm">
                                          Register
                                      </button>
                                  </div>
                              </div>
                          </form>
                      </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- modal end -->
          <!-- Modal -->
          <div class="modal fade" id="user-edit" role="dialog">
            <div class="modal-dialog">
              <!-- User edit modal-->
              <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title"><span class="badge badge-danger">Edit</span></h4>
                </div>
                <div class="modal-body">
                  <form class="form-horizontal">
                    <div class="form-group">
                      <div class="col">
                        <input type="text" class="form-control form-control-sm" id="id" hidden></input>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="control-label col-sm-6 text-success">Name</label>
                      <div class="col">
                        <input type="text" class="form-control form-control-sm" id="name"></input>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="control-label col-sm-6 text-success">E-mail</label>
                      <div class="col">
                        <input type="text" class="form-control form-control-sm" id="email"></input>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="control-label col-sm-6 text-success">Permission</label>
                      <div class="col">
                        <input type="text" class="form-control form-control-sm" id="permission"></input>
                      </div>
                    </div>
                  </form>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-success btn-xs" data-dismiss="modal">Close</button>
                  <button type="button" class="btn btn-success btn-xs" data-dismiss="modal" id="user-edit-save">Save</button>
                </div>
              </div>

            </div>
          </div>
        <!-- modal end -->
        <!-- Modal -->
        <div class="modal fade" id="user-delete" role="dialog">
          <div class="modal-dialog">
            <!-- User delete modal-->
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title"><span class="badge badge-danger">Delete</span></h4>
              </div>
              <div class="modal-body">
                <form class="form-horizontal">
                  <div class="form-group">
                    <div class="col">
                      <input type="hidden" class="form-control form-control-sm" id="delete-id" readonly></input>
                    </div>
                    <label class="control-label text-success">Are you sure ?</label>
                  </div>
                </form>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-outline-danger btn-xs" data-dismiss="modal">No</button>
                <button type="button" class="btn btn-outline-danger btn-xs" data-dismiss="modal" id="user-delete-save">Yes</button>
              </div>
            </div>
          </div>
        </div>
        <!-- modal end -->
        
<div class="container-fluid">
  <div class="row">
    <div class="col-2">
      <div class="nav flex-column nav-pills p-2" id="v-pills-tab" role="tablist" aria-orientation="vertical">
      <a class="nav-link active" id="v-pills-users-tab" data-toggle="pill" href="#v-pills-users" role="tab" aria-controls="v-pills-users" aria-selected="true">users</a>
      <a class="nav-link" id="v-pills-log-tab" data-toggle="pill" href="#v-pills-log" role="tab" aria-controls="v-pills-log" aria-selected="false">log</a>
      <a class="nav-link" id="v-pills-messages-tab" data-toggle="pill" href="#v-pills-messages" role="tab" aria-controls="v-pills-messages" aria-selected="false">Messages</a>
      <a class="nav-link" id="v-pills-settings-tab" data-toggle="pill" href="#v-pills-settings" role="tab" aria-controls="v-pills-settings" aria-selected="false">Settings</a>
    </div>
    </div>
    <div class="col-10">
      <div class="tab-content" id="v-pills-tabContent">
      <div class="tab-pane fade show active" id="v-pills-users" role="tabpanel" aria-labelledby="v-pills-users-tab">
        <div class="container-fluid">
          <div class="card">
            <div class="card-body">
              <div class="row">
                  <div class="col-sm-4">
                    <div class="card">
                      <div class="card-body">
                        <h5 class="card-title text-danger"><b>INFORMATION</b></h5>
                        <h6 class="card-subtitle mb-2 text-success"><b>Host: </b></h6>
                        <h6>@php
                        $ip = gethostbyaddr($_SERVER['REMOTE_ADDR']);
                        echo $ip;
                        @endphp</h6>
                        <h6 class="card-subtitle mb-2 text-success">
                          <b>Domain: </b>
                        </h6>
                        <h6>
                          @php
                          $domain = gethostbyname($_SERVER['REMOTE_ADDR']);
                          echo $domain;
                          @endphp
                        </h6>
                        <h6 class="card-subtitle mb-2 text-success">
                          <b>Location: </b>
                        </h6>
                        <h6>
                          MONGOLIA
                        </h6>
                      </div>
                    </div>
                  </div>
                  <div class="col-sm-4">
                    <div class="card">
                      <div class="card-body">

                      </div>
                    </div>
                  </div>
                  <div class="col-sm-4">
                    <div class="card">
                      <div class="card-body">

                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                    <div class="col">
                      <div class="container">
                        <div class="card">
                          <div class="card-body">
                            <h5 class="card-title text-danger"><b>USERS</b></h5>
                            <table class="table-sm table-bordered nowrap" id="users-table" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Permission</th>
                                        <th>Created At</th>
                                        <th>Updated At</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Id</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Permission</th>
                                        <th>Created At</th>
                                        <th>Updated At</th>
                                        <th class="non_searchable"></th>
                                    </tr>
                                </tfoot>
                            </table>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
            </div>
          </div>
        </div>
      </div>
      <div class="tab-pane fade" id="v-pills-log" role="tabpanel" aria-labelledby="v-pills-log-tab">
        <!-- USER LOG CARD -->
        <div class="card">
         <div class="card-body">
          <h5 class="card-title text-danger"><b>USER LOG</b></h5>
           <div class="container-fluid">
              <div class="log-container">
                <pre>
                  @php
                  $myfile = fopen("./log/log.txt", "r") or die("Unable to open file!");
                    echo fread($myfile,filesize("./log/log.txt"));
                  fclose($myfile);
                  @endphp
                </pre>
              </div>
            </div>
        </div>
      </div>
      </div>
      <div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">...cc</div>
      <div class="tab-pane fade" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab">...dd</div>
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
          var users_table = $('#users-table').DataTable({
              "processing": true,
              "serverSide": true,
              // "scrollY":   "300px",
              // "scrollX": false,
              "ajax": {
                    url: "{{ url('/dashboard/show')}}",
                    type: "POST"
              },
              "columns": [
                  { data: 'id', name: 'id'},
                  { data: 'name', name: 'name'},
                  { data: 'email', name: 'email'},
                  { data: 'permission', name: 'permission'},
                  // { data: 'remember_token'},
                  { data: 'created_at', name: 'created_at'},
                  { data: 'updated_at', name: 'updated_at'},
                  {data: 'action', name: 'action', orderable: false, searchable: false}
              ],
              "initComplete": function () {
                var r = $('#users-table tfoot tr');
                $('#users-table thead').append(r);
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
              dom: "<'row'<'col-sm-3'l><'col-sm-3'B><'col-sm-5'f>>" +
                    "<'row'<'col-sm-8'tr>>" + "<'row'<'col-sm-5'i><'col-sm-6'p>>",
                    buttons: [
                              {
                                text: 'Add',
                                "className": 'user-add btn-sm'
                              },
                              {
                                text: 'Refresh',
                                "className": 'btn-sm',
                                action: function ( e, dt, node, config ) {
                                    users_table.ajax.reload();
                                }
                              }
                            ],
          });
          $('#users-table').on('init.dt', function() {
               $('.user-add')
                 .attr('data-toggle', 'modal')
                 .attr('data-target', '#user-add');
          });
          $(document).on('click', '.user-edit', function() {
              var id = $(this).attr("id");
                $.ajax({
                 url: "{{ url('/dashboard/edit')}}",
                 type: "POST",
                 data: {id:id},
                 success: function(data){
                   var response = JSON.parse(data);
                   $('#id').val(id);
                    $('#name').val(response.name);
                    $('#permission').val(response.permission);
                    $('#email').val(response.email);
                 }
               });
            });
            $(document).on('click', '#user-edit-save', function() {
              var id = $('#id').val();
              var name = $('#name').val();
              var permission = $('#permission').val();
              var email = $('#email').val();
                  $.ajax({
                   url: "{{ url('/dashboard/update')}}",
                   type: "POST",
                   data: {id:id,name:name,permission:permission,email:email},
                   success: function(data){
                     alert("Data saved");
                   }
                 });
              });
            $(document).on('click', '.user-delete', function() {
                var id = $(this).attr("id");
                  $('#delete-id').val(id);
                });
            $(document).on('click', '#user-delete-save', function() {
                var id = $('#delete-id').val();
                  $.ajax({
                   type: "POST",
                   url: "{{ url('/dashboard/delete')}}",
                   data: {id:id},
                   success: function(data){
                     alert("Data saved");
                   }
                 });
              });
      });
</script>
@endpush
