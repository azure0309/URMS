<div ng-app="referenceApp" ng-controller="referenceCtrl">
<!-- Modal -->
<div class="modal fade" id="add-rp" role="dialog">
  <div class="modal-dialog modal-lg">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title"><span class="badge badge-danger">Add</span></h4>
      </div>
      <div class="modal-body">
        <form class="form-horizontal">
          <div class="form-group">
            <label class="control-label col-sm-2 text-success">Continent</label>
            <div class="col-sm-3">
              <select class="form-control form-control-sm" id="add-ref-continent">
                <option></option>
                <option>AFRICA</option>
                <option>SOUTH ASIA</option>
                <option>EUROPE: WESTERN</option>
                <option>WEST ASIA</option>
                <option>NORTH EAST ASIA</option>
                <option>EUROPE: EASTERN</option>
                <option>NORTH AMERICA</option>
                <option>AUSTRALIA</option>
                <option>SOUTH AMERICA</option>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-sm-2 text-success">Country</label>
            <div class="col-sm-3">
              <select ng-model="selectedCountry" ng-options="y.country for (x, y) in countries" class="form-control form-control-sm" id="add-ref-country">
              </select>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-sm-2 text-success">Operator</label>
            <div class="col-sm-3">
              <input type="text" class="form-control form-control-sm" id="add-ref-operator">
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-sm-2 text-success">TADIG</label>
            <div class="col-sm-3">
              <input type="text" class="form-control form-control-sm" id="add-ref-tadig">
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-sm-2 text-success">Priority</label>
            <div class="col-sm-3">
              <select class="form-control form-control-sm" id="add-ref-priority">
                <option></option>
                <option>1</option>
                <option>2</option>
                <option>3</option>
                <option>4</option>
                <option>5</option>
                <option>6</option>
                <option>7</option>
                <option>8</option>
                <option>9</option>
                <option>10</option>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-sm-2 text-success">GT Prefix</label>
            <div class="col-sm-3">
              <input type="text" class="form-control form-control-sm" id="add-ref-gtprefix" value="[[selectedCountry.code]]">
            </div>
            <div class="col-sm-8">
              <p class="text-danger">GT_PREFIX = Country code + Prefix</p>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-sm-2 text-success">IMSI GT</label>
            <div class="col-sm-3">
              <input type="text" class="form-control form-control-sm" id="add-ref-imsigt" value="[[selectedCountry.mcc]]">
            </div>
            <div class="col-sm-8">
              <p class="text-danger">IMSI_GT = MCC + MNC</p>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-sm-2 text-success">NODE_GT</label>
            <div class="col-sm-6">
              <textarea class="form-control" rows="4" id="add-ref-node-gt"></textarea>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-sm-2 text-danger">Санамж: </label>
              <div class="col-sm-8">
                <p class="text-danger">Node GT code бичихдээ таслал авна уу. Жишээ: 2600, 2350</p>
              </div>
          </div>
          <div class="form-group">
            <label class="control-label col-sm-2 text-success">Time zone</label>
            <div class="col-sm-3">
              <input type="text" class="form-control form-control-sm" id="add-ref-time-zone">
            </div>
          </div>
          <div class="form-group row">
            <label class="control-label col-sm-2 text-success">GSM</label>
            <div class="col-sm-2">
              <select class="form-control form-control-sm" id="add-ref-gsm">
                <option></option>
                <option>Inbound</option>
                <option>Outbound</option>
                <option>OK</option>
              </select>
            </div>
            <div class="col-sm-3">
              <div class="input-group">
                <input type="text" class="form-control form-control-sm" placeholder="Inbound:" id="add-ref-gsm-in-date">
                <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
              </div>
            </div>
            <div class="col-sm-3">
              <div class="input-group">
                <input type="text" class="form-control form-control-sm" placeholder="Outbound:" id="add-ref-gsm-out-date">
                <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
              </div>
            </div>
          </div>
          <div class="form-group row">
            <label class="control-label col-sm-2 text-success">GPRS</label>
            <div class="col-sm-2">
              <select class="form-control form-control-sm" id="add-ref-gprs">
                <option></option>
                <option>Inbound</option>
                <option>Outbound</option>
                <option>OK</option>
              </select>
            </div>
            <div class="col-sm-3">
              <div class="input-group">
                <input type="text" class="form-control form-control-sm" placeholder="Inbound" id="add-ref-gprs-in-date">
                <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
              </div>
            </div>
            <div class="col-sm-3">
              <div class="input-group">
                <input type="text" class="form-control form-control-sm" placeholder="Outbound" id="add-ref-gprs-out-date">
                <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
              </div>
            </div>
          </div>
          <div class="form-group row">
            <label class="control-label col-sm-2 text-success">CAMEL</label>
            <div class="col-sm-2">
              <select class="form-control form-control-sm" id="add-ref-camel">
                <option></option>
                <option>Inbound</option>
                <option>Outbound</option>
                <option>OK</option>
              </select>
            </div>
            <div class="col-sm-3">
              <div class="input-group">
                <input type="text" class="form-control form-control-sm" placeholder="Inbound" id="add-ref-camel-in-date">
                <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
              </div>
            </div>
            <div class="col-sm-3">
              <div class="input-group">
                <input type="text" class="form-control form-control-sm" placeholder="Outbound" id="add-ref-camel-out-date">
                <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
              </div>
            </div>
          </div>
          <div class="form-group row">
            <label class="control-label col-sm-2 text-success">LTE</label>
            <div class="col-sm-2">
              <select class="form-control form-control-sm" id="add-ref-lte">
                <option></option>
                <option>Inbound</option>
                <option>Outbound</option>
                <option>OK</option>
              </select>
            </div>
            <div class="col-sm-3">
              <div class="input-group">
                <input type="text" class="form-control form-control-sm" placeholder="Inbound" id="add-ref-lte-in-date">
                <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
              </div>
            </div>
            <div class="col-sm-3">
              <div class="input-group">
                <input type="text" class="form-control form-control-sm" placeholder="Outbound" id="add-ref-lte-out-date">
                <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
              </div>
            </div>
        </div>
          <div class="form-group row">
            <label class="control-label col-sm-2 text-success">NRT</label>
            <div class="col-sm-2">
              <select class="form-control form-control-sm" id="add-ref-nrt">
                <option></option>
                <option>Inbound</option>
                <option>Outbound</option>
                <option>OK</option>
              </select>
            </div>
            <div class="col-sm-3">
              <div class="input-group">
                <input type="text" class="form-control form-control-sm" placeholder="Inbound" id="add-ref-nrt-in-date">
                <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
              </div>
            </div>
            <div class="col-sm-3">
              <div class="input-group">
                <input type="text" class="form-control form-control-sm" placeholder="Outbound" id="add-ref-nrt-out-date">
                <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
              </div>
            </div>
        </div>
          <div class="form-group">
            <label class="control-label col-sm-2 text-success">Direction</label>
            <div class="col-sm-3">
              <select class="form-control form-control-sm" id="add-ref-direction">
                <option></option>
                <option>IB</option>
                <option>OB</option>
                <option>BT</option>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-sm-2 text-success">Agreement</label>
            <div class="col-sm-3">
              <input type="text" class="form-control form-control-sm" id="add-ref-agreement">
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-sm-2 text-success">Status</label>
            <div class="col-sm-3">
              <select class="form-control form-control-sm" id="add-ref-status">
                <option></option>
                <option>Active</option>
                <option>Inactive</option>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-sm-2 text-success">Memo</label>
            <div class="col-sm-6">
              <textarea class="form-control" rows="4" id="add-ref-memo"></textarea>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-sm-2 text-success">Memo date</label>
            <div class="col-sm-3">
              <div class="input-group">
                <input type="text" class="form-control form-control-sm" placeholder="memo date" id="add-memo-date">
                <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
              </div>
            </div>
          </div>
        </form>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-danger btn-sm" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-outline-danger btn-sm" data-dismiss="modal" id="add-ref-save">Save</button>
      </div>
    </div>
  </div>
</div>
</div>
<!-- Modal -->
<!-- Edit modal -->
<div class="modal fade" id="reference-edit" role="dialog">
  <div class="modal-dialog modal-lg">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title"><span class="badge badge-danger">Edit</span></h4>
      </div>
      <div class="modal-body">
        <form class="form-horizontal">
          <div class="form-group">
            <label class="control-label col-sm-2 text-success">Continent</label>
            <div class="col-sm-3">
              <select class="form-control form-control-sm" id="edit-ref-continent">
                <option></option>
                <option>AFRICA</option>
                <option>SOUTH ASIA</option>
                <option>WESTERN EUROPE</option>
                <option>WEST ASIA</option>
                <option>NORTH EAST ASIA</option>
                <option>EASTERN EUROPE</option>
                <option>NORTH AMERICA</option>
                <option>AUSTRALIA</option>
                <option>SOUTH AMERICA</option>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-sm-2 text-success">Country</label>
            <div class="col-sm-3">
              <select class="form-control form-control-sm" id="edit-ref-country">
                  <option>ABKHAZIA</option>
                  <option>AFGHANISTAN</option>
                  <option>ALBANIA</option>
                  <option>ALGERIA</option>
                  <option>AMERICAN SAMOA</option>
                  <option>ANDORRA</option>
                  <option>ANGOLA</option>
                  <option>ANGUILLA</option>
                  <option>Antigua</option>
                  <option>ARGENTINA</option>
                  <option>ARMENIA</option>
                  <option>ARUBA</option>
                  <option>AUSTRALIA</option>
                  <option>AUSTRIA</option>
                  <option>AZERBAJIAN</option>
                  <option>BAHAMAS</option>
                  <option>BAHRAIN</option>
                  <option>BANGLADESH</option>
                  <option>Barbados</option>
                  <option>BELARUS</option>
                  <option>BELGIUM</option>
                  <option>BELIZE</option>
                  <option>BENIN</option>
                  <option>BERMUDA</option>
                  <option>BHUTAN</option>
                  <option>BOLIVIA</option>
                  <option>Bosnia&Herzegovina</option>
                  <option>BOTSWANA</option>
                  <option>BRAZIL</option>
                  <option>BRITISH VIRGIN ISLANDS</option>
                  <option>BRUNEI</option>
                  <option>BULGARIA</option>
                  <option>BURKINA FASO</option>
                  <option>BURUNDI</option>
                  <option>CAMBODIA</option>
                  <option>CAMEROON</option>
                  <option>CANADA</option>
                  <option>CAPE VERDE</option>
                  <option>CAYMAN ISLANDS</option>
                  <option>CENTRAL AFRICAN Republic</option>
                  <option>CHAD</option>
                  <option>CHILI</option>
                  <option>CHINA</option>
                  <option>COLOMBIA</option>
                  <option>COMOROS</option>
                  <option>CONGO Democratic RP</option>
                  <option>CONGO, REPUBLIC</option>
                  <option>COOK IRELANDS</option>
                  <option>COSTA RICA</option>
                  <option>CROATIA</option>
                  <option>CUBA</option>
                  <option>Bonaire & Curacao</option>
                  <option>CYPRUS</option>
                  <option>CZECH</option>
                  <option>DENMARK</option>
                  <option>DJIBOUTI</option>
                  <option>DOMINICA</option>
                  <option>DOMINICAN RP</option>
                  <option>ECUADOR</option>
                  <option>EGYPT</option>
                  <option>EL SALVADOR</option>
                  <option>EQUATORIAL GUINEA</option>
                  <option>ERITREA</option>
                  <option>ESTONIA</option>
                  <option>ETHIOPIA</option>
                  <option>FALKLAND ISLANDS (MALVINAS)</option>
                  <option>FAROE ISLANDS</option>
                  <option>FIJI</option>
                  <option>FINLAND</option>
                  <option>FRANCE</option>
                  <option>FRENCH GUIANA</option>
                  <option>FRENCH POLYNESIA</option>
                  <option>GABON</option>
                  <option>GAMBIA</option>
                  <option>GEORGIA</option>
                  <option>GERMANY</option>
                  <option>GHANA</option>
                  <option>GIBRALTAR</option>
                  <option>GREECE</option>
                  <option>GREENLAND</option>
                  <option>GRENADA</option>
                  <option>GUAM_310</option>
                  <option>GUAM_311</option>
                  <option>GUATEMALA</option>
                  <option>GUINEA</option>
                  <option>GUNIEA Bissau</option>
                  <option>GUYANA</option>
                  <option>HAITI</option>
                  <option>HONDURAS</option>
                  <option>HONGKONG</option>
                  <option>HUNGARY</option>
                  <option>ICELAND</option>
                  <option>INDIA</option>
                  <option>INDIA</option>
                  <option>INDONESIA</option>
                  <option>INTERNATIONAL NETWORKS</option>
                  <option>IRAN</option>
                  <option>IRAQ</option>
                  <option>IRELAND</option>
                  <option>ISRAEL</option>
                  <option>ITALY</option>
                  <option>IVORY COAST</option>
                  <option>JAMAICA</option>
                  <option>JAPAN_440</option>
                  <option>JAPAN_441</option>
                  <option>JORDAN</option>
                  <option>KAZAKHSTAN</option>
                  <option>KENYA</option>
                  <option>KIRIBATI</option>
                  <option>KOREA N., DEM. PEOPLE'S REP.</option>
                  <option>SOUTH KOREA</option>
                  <option>KUWAIT</option>
                  <option>KYRGYZSTAN</option>
                  <option>LAOS</option>
                  <option>LATVIA</option>
                  <option>LEBANON</option>
                  <option>LESOTHO</option>
                  <option>LIBERIA</option>
                  <option>LIBYA</option>
                  <option>LIECHTENSTEIN</option>
                  <option>LITHUANIA</option>
                  <option>LUXEMBOURG</option>
                  <option>MACAU</option>
                  <option>MACEDONIA</option>
                  <option>MADAGASCAR</option>
                  <option>MALAWI</option>
                  <option>MALAYSIA</option>
                  <option>MALDIVES</option>
                  <option>MALI</option>
                  <option>MALTA</option>
                  <option>MAURITANIA</option>
                  <option>MAURITIUS</option>
                  <option>MEXICO</option>
                  <option>MICRONESIA</option>
                  <option>MOLDOVA</option>
                  <option>MONACO</option>
                  <option>MONGOLIA</option>
                  <option>MONTENEGRO</option>
                  <option>MONTSERRAT</option>
                  <option>MOROCCO</option>
                  <option>MOZAMBIQUE</option>
                  <option>MYANMAR</option>
                  <option>NAMIBIA</option>
                  <option>NEPAL</option>
                  <option>NETHERLANDS</option>
                  <option>NEW CALEDONIA</option>
                  <option>NEW ZEALAND</option>
                  <option>NICARAGUA</option>
                  <option>NIGER</option>
                  <option>NIGERIA</option>
                  <option>NIUE</option>
                  <option>NORWAY</option>
                  <option>OMAN</option>
                  <option>PAKISTAN</option>
                  <option>PALAU (REPUBLIC OF)</option>
                  <option>PANAMA</option>
                  <option>PAPUA NEW GUINEA</option>
                  <option>PARAGUAY</option>
                  <option>PERU</option>
                  <option>PHILIPPINES</option>
                  <option>POLAND</option>
                  <option>PORTUGAL</option>
                  <option>PUERTO RICO</option>
                  <option>QATAR</option>
                  <option>Reunion Island</option>
                  <option>ROMANIA</option>
                  <option>RUSSIA</option>
                  <option>RWANDA</option>
                  <option>St. Kitts</option>
                  <option>St. Lucia</option>
                  <option>SOMOA</option>
                  <option>SAN MARINO</option>
                  <option>SAO TOME & PRINCIPE</option>
                  <option>SAUDI ARABIA</option>
                  <option>SENEGAL</option>
                  <option>SERBIA</option>
                  <option>SEYCHELLES</option>
                  <option>SIERRA LEONE</option>
                  <option>SINGAPORE</option>
                  <option>SLOVAKIA</option>
                  <option>SLOVENIA</option>
                  <option>SOLOMON ISLANDS</option>
                  <option>SOMALIA</option>
                  <option>SOUTH AFRICA</option>
                  <option>SOUTH SUDAN</option>
                  <option>SPAIN</option>
                  <option>SRI LANKA</option>
                  <option>ST. PIERRE & MIQUELON</option>
                  <option>St. Vincent</option>
                  <option>SUDAN</option>
                  <option>SURINAME</option>
                  <option>SWAZILAND</option>
                  <option>SWEDEN</option>
                  <option>SWITZERLAND</option>
                  <option>SYRIAN ARAB REPUBLIC</option>
                  <option>TAIWAN</option>
                  <option>TAJIKISTAN</option>
                  <option>TANZANIA</option>
                  <option>THAILAND</option>
                  <option>TIMORE-LESTE</option>
                  <option>TOGO</option>
                  <option>TONGA</option>
                  <option>Trinidad & Tobago</option>
                  <option>TUNISIA</option>
                  <option>TURKEY</option>
                  <option>TURKMENISTAN</option>
                  <option>Turks & Caicos</option>
                  <option>TUVALU</option>
                  <option>UGANDA</option>
                  <option>UKRAINE</option>
                  <option>UAE_424</option>
                  <option>UAE_431</option>
                  <option>UAE_430</option>
                  <option>UK_234</option>
                  <option>UK_235</option>
                  <option>USA_312</option>
                  <option>USA_316</option>
                  <option>URUGUAY</option>
                  <option>UZBEKISTAN</option>
                  <option>VANUATU</option>
                  <option>VENEZUELA</option>
                  <option>VIETNAM</option>
                  <option>YEMEN</option>
                  <option>ZAMBIA</option>
                  <option>ZIMBABWE</option>
                  <option>PALESTINE</option>
                  <option>JERSEY</option>
                  <option>KOSOVO</option>
                  <option>TATARSTAN</option>
                  <option>NETHERLANDS ANTILLES</option>
                  <option>USA_310</option>
                  <option>USA_311</option>
                  <option>USA_313</option>
                  <option>USA</option>
                  <option>UK</option>
                  <option>JAPAN</option>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-sm-2 text-success">Operator</label>
            <div class="col-sm-3">
              <input type="text" class="form-control form-control-sm" id="edit-ref-operator">
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-sm-2 text-success">TADIG</label>
            <div class="col-sm-3">
              <input type="text" class="form-control form-control-sm" id="edit-ref-tadig" readonly>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-sm-2 text-success">Priority</label>
            <div class="col-sm-3">
              <select class="form-control form-control-sm" id="edit-ref-priority">
                <option></option>
                <option>1</option>
                <option>2</option>
                <option>3</option>
                <option>4</option>
                <option>5</option>
                <option>6</option>
                <option>7</option>
                <option>8</option>
                <option>9</option>
                <option>10</option>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-sm-2 text-success">GT_PREFIX</label>
            <div class="col-sm-3">
              <input type="text" class="form-control form-control-sm" id="edit-ref-gtprefix">
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-sm-2 text-success">IMSI_GT</label>
            <div class="col-sm-3">
              <input type="text" class="form-control form-control-sm" id="edit-ref-imsigt">
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-sm-2 text-success">NODE_GT</label>
            <div class="col-sm-6">
              <textarea class="form-control" rows="4" id="edit-ref-node-gt"></textarea>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-sm-2 text-success">Time zone</label>
            <div class="col-sm-3">
              <input type="text" class="form-control form-control-sm" id="edit-ref-time-zone">
            </div>
          </div>
          <div class="form-group row">
            <label class="control-label col-sm-2 text-success">GSM</label>
            <div class="col-sm-2">
              <select class="form-control form-control-sm" id="edit-ref-gsm">
                <option></option>
                <option>Inbound</option>
                <option>Outbound</option>
                <option>OK</option>
              </select>
            </div>
            <div class="col-sm-3">
              <div class="input-group">
                <input type="text" class="form-control form-control-sm" placeholder="Inbound:" id="edit-ref-gsm-in-date">
                <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
              </div>
            </div>
            <div class="col-sm-3">
              <div class="input-group">
                <input type="text" class="form-control form-control-sm" placeholder="Outbound:" id="edit-ref-gsm-out-date">
                <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
              </div>
            </div>
          </div>
          <div class="form-group row">
            <label class="control-label col-sm-2 text-success">GPRS</label>
            <div class="col-sm-2">
              <select class="form-control form-control-sm" id="edit-ref-gprs">
                <option></option>
                <option>Inbound</option>
                <option>Outbound</option>
                <option>OK</option>
              </select>
            </div>
            <div class="col-sm-3">
              <div class="input-group">
                <input type="text" class="form-control form-control-sm" placeholder="Inbound" id="edit-ref-gprs-in-date">
                <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
              </div>
            </div>
            <div class="col-sm-3">
              <div class="input-group">
                <input type="text" class="form-control form-control-sm" placeholder="Outbound" id="edit-ref-gprs-out-date">
                <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
              </div>
            </div>
          </div>
          <div class="form-group row">
            <label class="control-label col-sm-2 text-success">CAMEL</label>
            <div class="col-sm-2">
              <select class="form-control form-control-sm" id="edit-ref-camel">
                <option></option>
                <option>Inbound</option>
                <option>Outbound</option>
                <option>OK</option>
              </select>
            </div>
            <div class="col-sm-3">
              <div class="input-group">
                <input type="text" class="form-control form-control-sm" placeholder="Inbound" id="edit-ref-camel-in-date">
                <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
              </div>
            </div>
            <div class="col-sm-3">
              <div class="input-group">
                <input type="text" class="form-control form-control-sm" placeholder="Outbound" id="edit-ref-camel-out-date">
                <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
              </div>
            </div>
          </div>
          <div class="form-group row">
            <label class="control-label col-sm-2 text-success">LTE</label>
            <div class="col-sm-2">
              <select class="form-control form-control-sm" id="edit-ref-lte">
                <option></option>
                <option>Inbound</option>
                <option>Outbound</option>
                <option>OK</option>
              </select>
            </div>
            <div class="col-sm-3">
              <div class="input-group">
                <input type="text" class="form-control form-control-sm" placeholder="Inbound" id="edit-ref-lte-in-date">
                <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
              </div>
            </div>
            <div class="col-sm-3">
              <div class="input-group">
                <input type="text" class="form-control form-control-sm" placeholder="Outbound" id="edit-ref-lte-out-date">
                <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
              </div>
            </div>
        </div>
          <div class="form-group row">
            <label class="control-label col-sm-2 text-success">NRT</label>
            <div class="col-sm-2">
              <select class="form-control form-control-sm" id="edit-ref-nrt">
                <option></option>
                <option>Inbound</option>
                <option>Outbound</option>
                <option>OK</option>
              </select>
            </div>
            <div class="col-sm-3">
              <div class="input-group">
                <input type="text" class="form-control form-control-sm" placeholder="Inbound" id="edit-ref-nrt-in-date">
                <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
              </div>
            </div>
            <div class="col-sm-3">
              <div class="input-group">
                <input type="text" class="form-control form-control-sm" placeholder="Outbound" id="edit-ref-nrt-out-date">
                <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
              </div>
            </div>
        </div>
          <div class="form-group">
            <label class="control-label col-sm-2 text-success">Direction</label>
            <div class="col-sm-2">
              <select class="form-control form-control-sm" id="edit-ref-direction">
                <option></option>
                <option>IB</option>
                <option>OB</option>
                <option>BT</option>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-sm-2 text-success">Agreement</label>
            <div class="col-sm-3">
              <input type="text" class="form-control form-control-sm" id="edit-ref-agreement">
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-sm-2 text-success">Status</label>
            <div class="col-sm-3">
              <select class="form-control form-control-sm" id="edit-ref-status">
                <option></option>
                <option>Active</option>
                <option>Inactive</option>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-sm-2 text-success">Memo</label>
            <div class="col-sm-6">
              <textarea class="form-control" rows="4" id="edit-ref-memo"></textarea>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-sm-2 text-success">Memo date</label>
            <div class="col-sm-3">
              <div class="input-group">
                <input type="text" class="form-control form-control-sm" placeholder="" id="edit-memo-date">
                <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
              </div>
            </div>
          </div>
        </form>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-danger btn-sm" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-outline-danger btn-sm" data-dismiss="modal" id="edit-ref-save">Save</button>
      </div>
    </div>
  </div>
</div>
</div>
<!-- modal end -->
</div>
<!-- Modal -->
<div class="modal fade" id="reference-delete" role="dialog">
  <div class="modal-dialog">
    <!-- Reference delete modal-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title"><span class="badge badge-danger">Delete</span></h4>
      </div>
      <div class="modal-body">
        <form class="form-horizontal">
          <div class="form-group">
            <div class="col">
              <input type="hidden" class="form-control form-control-sm" id="delete-ref-tadig" readonly></input>
            </div>
            <label class="control-label text-success">Are you sure ?</label>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-danger btn-xs" data-dismiss="modal">No</button>
        <button type="button" class="btn btn-outline-danger btn-xs" data-dismiss="modal" id="reference-delete-save">Yes</button>
      </div>
    </div>
  </div>
</div>
<!-- modal end -->
