<!-- Threshold edit modal -->
  <div class="modal fade" id="threshold-edit" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title"><span class="badge badge-danger">Edit</span></h4>
        </div>
        <div class="modal-body">
          <form class="form-horizontal">
            <div class="form-group">
              <div class="row">
                <div class="col-sm-7">
                    <label class="control-label col text-success">PRIORITY</label>
                </div>
                <div class="col-sm-4">
                    <input type="text" class="form-control form-control-sm" id="edit-priority" readonly></input>
                </div>
             </div>
            </div>
          <div class="form-group">
            <div class="row">
                <div class="col-sm-7">
                <label class="control-label col text-success">Voice charge threshold [₮]</label>
                </div>
                <div class="col-sm-4">
                  <input type="text" class="form-control form-control-sm" id="edit-voice-charge">
                </div>
            </div>
          </div>
          <div class="form-group">
            <div class="row">
                <div class="col-sm-7">
                  <label class="control-label col text-success">SMS charge threshold [₮]</label>
                </div>
                <div class="col-sm-4">
                  <input type="text" class="form-control form-control-sm" id="edit-sms-charge">
                </div>
            </div>
          </div>
          <div class="form-group">
            <div class="row">
              <div class="col-sm-7">
                <label class="control-label col text-success">Data charge threshold [₮]</label>
              </div>
              <div class="col-sm-4">
                <input type="text" class="form-control form-control-sm" id="edit-data-charge">
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="row">
              <div class="col-sm-7">
                <label class="control-label col text-success">Charge  summary threshold [₮]</label>
              </div>
              <div class="col-sm-4">
                <input type="text" class="form-control form-control-sm" id="edit-charge-summery">
              </div>
           </div>
          </div>
          <div class="form-group">
            <div class="row">
              <div class="col-sm-7">
                <label class="control-label col text-success">Rate summary threshold [Score]</label>
              </div>
              <div class="col-sm-4">
                <input type="text" class="form-control form-control-sm" id="edit-rate-sum-sc">
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="row">
              <div class="col-sm-7">
                <label class="control-label col text-success">Inboind _Charge  summary threshold [₮]</label>
              </div>
              <div class="col-sm-4">
                <input type="text" class="form-control form-control-sm" id="edit-in-charge-sum">
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="row">
              <div class="col-sm-7">
                <label class="control-label col text-success">Inbound_Rate summary threshold [Score]</label>
              </div>
              <div class="col-sm-4">
                <input type="text" class="form-control form-control-sm" id="edit-in-rate-sum">
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="row">
              <div class="col-sm-7">
                <label class="control-label col text-success">Voice duratian to rate [Min]</label>
              </div>
              <div class="col-sm-4">
                <input type="text" class="form-control form-control-sm" id="edit-voice-dur-rate">
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="row">
              <div class="col-sm-7">
                <label class="control-label col text-success">SMS count to rate [Num]</label>
              </div>
              <div class="col-sm-4">
                <input type="text" class="form-control form-control-sm" id="edit-sms-count-rate">
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="row">
              <div class="col-sm-7">
                <label class="control-label col text-success">Data usage to rate [MB]</label>
              </div>
              <div class="col-sm-4">
                <input type="text" class="form-control form-control-sm" id="edit-data-usage-rate">
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="row">
              <div class="col-sm-7">
                <label class="control-label col text-success">Voice usage threshold [Min]</label>
              </div>
              <div class="col-sm-4">
                <input type="text" class="form-control form-control-sm" id="edit-voice-usage">
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="row">
              <div class="col-sm-7">
                <label class="control-label col text-success">SMS usage threshold [Num]</label>
              </div>
              <div class="col-sm-4">
                <input type="text" class="form-control form-control-sm" id="edit-sms-usage">
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="row">
              <div class="col-sm-7">
                <label class="control-label col text-success">Data usage threshold [MB]</label>
              </div>
              <div class="col-sm-4">
                <input type="text" class="form-control form-control-sm" id="edit-data-usage">
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="row">
              <div class="col-sm-7">
                <label class="control-label col text-success">MOC count [Num]</label>
              </div>
              <div class="col-sm-4">
                <input type="text" class="form-control form-control-sm" id="edit-moc-count">
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="row">
              <div class="col-sm-7">
                <label class="control-label col text-success">MTC count [Num]</label>
              </div>
              <div class="col-sm-4">
                <input type="text" class="form-control form-control-sm" id="edit-mtc-count">
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="row">
              <div class="col-sm-7">
                <label class="control-label col text-success">SMS count [Num]</label>
              </div>
              <div class="col-sm-4">
                <input type="text" class="form-control form-control-sm" id="edit-sms-count">
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="row">
              <div class="col-sm-7">
                <label class="control-label col text-success">Data count [Num]</label>
              </div>
              <div class="col-sm-4">
                <input type="text" class="form-control form-control-sm" id="edit-data-count">
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="row">
              <div class="col-sm-7">
                <label class="control-label col text-success">Voice Service check by unique IMSI_Day time_3h</label>
              </div>
              <div class="col-sm-4">
                <input type="text" class="form-control form-control-sm" id="edit-voice-check-dtime">
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="row">
              <div class="col-sm-7">
                <label class="control-label col text-success">SMS Service check by unique IMSI_Day time_3h</label>
              </div>
              <div class="col-sm-4">
                <input type="text" class="form-control form-control-sm" id="edit-sms-check-dtime">
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="row">
              <div class="col-sm-7">
                <label class="control-label col text-success">GPRS service check by unique IMSI_Day time_3h</label>
              </div>
              <div class="col-sm-4">
                <input type="text" class="form-control form-control-sm" id="edit-gprs-check-dtime">
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="row">
              <div class="col-sm-7">
                <label class="control-label col text-success">LTE service check by unique IMSI_Day time_3h</label>
              </div>
              <div class="col-sm-4">
                <input type="text" class="form-control form-control-sm" id="edit-lte-check-dtime">
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="row">
              <div class="col-sm-7">
                <label class="control-label col text-success">Voice Service check by unique IMSI_Night time_3h</label>
              </div>
              <div class="col-sm-4">
                <input type="text" class="form-control form-control-sm" id="edit-voice-check-ntime">
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="row">
              <div class="col-sm-7">
                <label class="control-label col text-success">SMS Service check by unique IMSI_Night time_3h</label>
              </div>
              <div class="col-sm-4">
                <input type="text" class="form-control form-control-sm" id="edit-sms-check-ntime">
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="row">
              <div class="col-sm-7">
                <label class="control-label col text-success">GPRS service check by unique IMSI_Night time_3h</label>
              </div>
              <div class="col-sm-4">
                <input type="text" class="form-control form-control-sm" id="edit-gprs-check-ntime">
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="row">
              <div class="col-sm-7">
                <label class="control-label col text-success">LTE service check by unique IMSI_Night time_3h</label>
              </div>
              <div class="col-sm-4">
                <input type="text" class="form-control form-control-sm" id="edit-lte-check-ntime">
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="row">
              <div class="col-sm-7">
                <label class="control-label col text-success">Voice Service check by unique IMSI_24h</label>
              </div>
              <div class="col-sm-4">
                <input type="text" class="form-control form-control-sm" id="edit-voice-check-24h">
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="row">
              <div class="col-sm-7">
                <label class="control-label col text-success">SMS Service check by unique IMSI_24h</label>
              </div>
              <div class="col-sm-4">
                <input type="text" class="form-control form-control-sm" id="edit-sms-check-24h">
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="row">
              <div class="col-sm-7">
                <label class="control-label col text-success">GPRS service check by unique IMSI_24h</label>
              </div>
              <div class="col-sm-4">
                <input type="text" class="form-control form-control-sm" id="edit-gprs-check-24h">
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="row">
              <div class="col-sm-7">
                <label class="control-label col text-success">LTE service check by unique IMSI_24h</label>
              </div>
              <div class="col-sm-4">
                <input type="text" class="form-control form-control-sm" id="edit-lte-check-24h">
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="row">
              <div class="col-sm-7">
                <label class="control-label col text-success">Service success rate by day time [%]</label>
              </div>
              <div class="col-sm-4">
                <input type="text" class="form-control form-control-sm" id="edit-success-rate-dtime">
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="row">
              <div class="col-sm-7">
                <label class="control-label col text-success">Service success rate by night time [%]</label>
              </div>
              <div class="col-sm-4">
                <input type="text" class="form-control form-control-sm" id="edit-success-rate-ntime">
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="row">
              <div class="col-sm-7">
                <label class="control-label col text-success">KPI check by unique IMSI attempt_5Min</label>
              </div>
              <div class="col-sm-4">
                <input type="text" class="form-control form-control-sm" id="edit-kpi-check-5m">
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="row">
              <div class="col-sm-7">
                <label class="control-label col text-success">KPI check by unique IMSI attempt_1H</label>
              </div>
              <div class="col-sm-4">
                <input type="text" class="form-control form-control-sm" id="edit-kpi-check-1h">
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="row">
              <div class="col-sm-7">
                <label class="control-label col text-success">KPI check by unique IMSI attempt_24H</label>
              </div>
              <div class="col-sm-4">
                <input type="text" class="form-control form-control-sm" id="edit-kpi-check24h">
              </div>
            </div>
          </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline-danger btn-sm" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-outline-danger btn-sm" data-dismiss="modal" id="edit-threshold-save">Save</button>
        </div>
    </div>
  </div>
</div>
<!-- modal end -->
