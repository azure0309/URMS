@extends('layouts.main')
@section('content')
<div class="container-fluid">
  <div class="card">
      <div class="card-header">
        <div class="row">
          <div class="col-sm-3">
            <form>
              <div class="input-group mb-3 input-group-sm">
                <div class="input-group-prepend">
                  <span class="input-group-text">IMSI/MSISDN</span>
                </div>
                <input type="text" class="form-control" id="imsi-in">
                <div class="input-group-append">
                  <input type="button" class="btn btn-success" id="imsi-search" value="Search">
                </div>
              </div>
            </form>
          </div>
          <div class="col-sm-3">
            <form>
              <div class="input-group mb-3 input-group-sm">
                <div class="input-group-prepend">
                  <span class="input-group-text">Time Range</span>
                </div>
                <select class="form-control">
                  <option>Weekly</option>
                  <option>Monthly</option>
                  <option>Quarterly</option>
                </select>
              </div>
            </form>
          </div>
          <div class="col-sm-3">
            <form>
              <div class="form-check">
                <label class="form-check-label" for="check1">
                  <input type="checkbox" class="form-check-input" checked>Voice
                </label>
              </div>
              <div class="form-check">
                <label class="form-check-label" for="check2">
                  <input type="checkbox" class="form-check-input">SMS
                </label>
              </div>
              <div class="form-check">
                <label class="form-check-label">
                  <input type="checkbox" class="form-check-input">Data
                </label>
              </div>
              <!-- <button type="submit" class="btn btn-sm btn-primary">Submit</button> -->
            </form>
          </div>
        </div>
      </div>
      <div id="imsi-show-hotline" style="display:none">
      <div class="card-body">
      <div class="card">
      <h6 class="card-title">VOICE</h6>
      <div class="card-body">
        <div class="container">
          <table class="table-sm table-bordered cell-border text-center" id="hotline-voice-table" style="width:100%">
              <thead class="bg-success">
                  <tr>
                    <th rowspan="2">Date</th>
                    <th rowspan="2">IMSI</th>
                    <th rowspan="2">Location</th>
                    <th rowspan="2">Network</th>
                    <th colspan="2">Network Status</th>
                    <th colspan="4">User attempt</th>
                    <th colspan="4">Usage</th>
                  </tr>
                  <tr>
                    <th>GSM</th>
                    <th>CAMEL</th>
                    <th>LU Suc</th>
                    <th>LU Fail</th>
                    <th>PRN Suc</th>
                    <th>PRN Fail</th>
                    <th>MOC_local</th>
                    <th>MOC_home</th>
                    <th>MOC_int</th>
                    <th>MTC</th>
                  </tr>
              </thead>
          </table>
        </div>
      </div>
    </div>
  </div>
  <div class="card">
      <!-- <div class="card-header">
      </div> -->
      <div class="card-body">
            <div class="card">
              <h6 class="card-title">SMS</6>
              <div class="card-body">
                <div class="container">
                  <table class="table-sm table-bordered cell-border text-center" id="hotline-sms-table" style="width:100%">
                      <thead class="bg-success">
                          <tr>
                            <th rowspan="2">Date</th>
                            <th rowspan="2">IMSI</th>
                            <th rowspan="2">Location</th>
                            <th rowspan="2">Network</th>
                            <th colspan="1">Network Status</th>
                            <th colspan="6">User attempt</th>
                          </tr>
                          <tr>
                            <th>GSM</th>
                            <th>LU Suc</th>
                            <th>LU Fail</th>
                            <th>SMSMO Suc</th>
                            <th>SMSMO Fail</th>
                            <th>SMSMT Suc</th>
                            <th>SMSMT Fail</th>
                          </tr>
                      </thead>
                  </table>
                </div>
              </div>
            </div>
      </div>
  </div>
  <div class="card">
      <!-- <div class="card-header">
      </div> -->
      <div class="card-body">
            <div class="card">
              <h6 class="card-title">DATA</h6>
              <div class="card-body">
                <div class="container">
                  <table class="table-sm table-bordered cell-border text-center" id="hotline-data-table" style="width:100%">
                      <thead class="bg-success">
                          <tr>
                            <th rowspan="2">Date</th>
                            <th rowspan="2">IMSI</th>
                            <th rowspan="2">Location</th>
                            <th rowspan="2">Network</th>
                            <th colspan="2">Network Status</th>
                            <th colspan="4">User attempt</th>
                            <th colspan="1">Usage</th>
                          </tr>
                          <tr>
                            <th>GPRS</th>
                            <th>LTE</th>
                            <th>PS LU Suc</th>
                            <th>PS LU Fail</th>
                            <th>S1 Mode</th>
                            <th>S1 Mode</th>
                            <th>GPRS</th>
                          </tr>
                      </thead>
                </table>
                </div>
            </div>
          </div>
        </div>
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
        function search_imsi(imsi) {
        $('#hotline-voice-table').DataTable({
            "processing": true,
            "serverSide": true,
            "scrollY": "250px",
            "scrollX": true,
            "scrollCollapse": true,
            "searching": false,
            "lengthChange": false,
            "ajax": {
                  url: "{{ url('/sub-analysis/hotline/voice')}}",
                  type: "POST",
                  data: {imsi:imsi}
            },
            "columns": [
                            { data: "cdate" },
                            { data: "imsi" },
                            { data: "location" },
                            { data: "network" },
                            { data: "gsm" },
                            { data: "camel" },
                            { data: "lu_suc" },
                            { data: "lu_fail" },
                            { data: "prn_suc" },
                            { data: "prn_fail" },
                            { data: "moc_local" },
                            { data: "moc_home" },
                            { data: "moc_int"},
                            { data: "mtc"}
            ]
        });
        $('#hotline-sms-table').DataTable({
            "processing": true,
            "serverSide": true,
            "scrollY": "250px",
            "scrollX": true,
            "searching": false,
            "lengthChange": false,
            "ajax": {
                  url: "{{ url('/sub-analysis/hotline/sms')}}",
                  type: "POST",
                  data: {imsi:imsi}
            },
            "columns": [
                            { data: "cdate" },
                            { data: "imsi" },
                            { data: "location" },
                            { data: "network" },
                            { data: "gsm" },
                            { data: "lu_suc" },
                            { data: "lu_fail" },
                            { data: "smsmo_suc" },
                            { data: "smsmo_fail" },
                            { data: "smsmt_suc" },
                            { data: "smsmt_fail" }
            ]
        });
        $('#hotline-data-table').DataTable({
            "processing": true,
            "serverSide": true,
            "scrollY": "250px",
            "scrollX": true,
            "searching": false,
            "lengthChange": false,
            "ajax": {
                  url: "{{ url('/sub-analysis/hotline/data')}}",
                  type: "POST",
                  data: {imsi:imsi}
            },
            "columns": [
                            { data: "cdate" },
                            { data: "imsi" },
                            { data: "location" },
                            { data: "network" },
                            { data: "gprs" },
                            { data: "lte" },
                            { data: "ps_lu_suc" },
                            { data: "ps_lu_fail" },
                            { data: "s1mode_lu_suc" },
                            { data: "s1mode_lu_fail" },
                            { data: "us_gprs" }
            ]
        });
      }
        $(document).on('click', '#imsi-search', function() {
              var imsi = $('#imsi-in').val();
              if(imsi != '')
              {
                $('#hotline-voice-table').DataTable().destroy();
                $('#hotline-sms-table').DataTable().destroy();
                $('#hotline-data-table').DataTable().destroy();
                search_imsi(imsi);
                $('#imsi-show-hotline').show();
              }
              else
              {
               alert("IMSI is Required");
              }

          });
});
</script>
@endpush
