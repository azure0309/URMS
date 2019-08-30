@extends('dashboard')
@section('dashboard')
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
                        <input type="text" class="form-control form-control-sm" id="id" readonly hidden></input>
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
          <div class="card">
            <div class="card-body">
              <h5 class="card-title text-success"><b>Dashboard</b></h5>
              <div class="row">
                  <div class="col-2">
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
                  <div class="col-8">
                    <div class="card">
                      <div class="card-body">
                        <h5 class="card-title text-danger"><b>USERS</b></h5>
                        <table class="table-sm table-bordered nowrap" id="users-table">
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
                  <!-- <div class="col-sm">

                  </div> -->
                </div>
            </div>
    </div>
@endsection
