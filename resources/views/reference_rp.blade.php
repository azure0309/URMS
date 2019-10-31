@extends('layouts.main')
@section('content')
    <div class="card">
        <div class="card-header">
            @include('inc.reference')
        </div>
        <div class="card-body">
            <!-- <div class="container-fluid"> -->
            <table class="table-sm table-bordered nowrap" id="reference-table" width="100%">
                <thead>
                <tr>
                    <th></th>
                    <th>CONTINENT</th>
                    <th>COUNTRY</th>
                    <th>OPERATOR</th>
                    <th>TADIG</th>
                    <th>IMSI_GT</th>
                    <th>GT_PREFIX</th>
                    <th>TIME_ZONE</th>
                    <th>PRIORITY</th>
                    <th>GSM</th>
                    <th>GSM_LAUNCH_DATE_IN</th>
                    <th>GSM_LAUNCH_DATE_OUT</th>
                    <th>GPRS</th>
                    <th>GPRS_LAUNCH_DATE_IN</th>
                    <th>GPRS_LAUNCH_DATE_OUT</th>
                    <th>CAMEL</th>
                    <th>CAMEL_LAUNCH_DATE_IN</th>
                    <th>CAMEL_LAUNCH_DATE_OUT</th>
                    <th>LTE</th>
                    <th>LTE_LAUNCH_DATE_IN</th>
                    <th>LTE_LAUNCH_DATE_OUT</th>
                    <th>NRT</th>
                    <th>NRT_LAUNCH_DATE_IN</th>
                    <th>NRT_LAUNCH_DATE_OUT</th>
                    <th>DIRECTION</th>
                    <th>AGREEMENT</th>
                    <th>MEMO</th>
                    <th>MEMO_DATE</th>
                    <th>STATUS</th>
                    <th>STATUS_DATE</th>
                    <th>TAP_SEQ</th>
                    <th>TAP_SEQ_IN</th>
                    <th>NODE_GT</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tfoot>
                <tr>
                    <th class="non_searchable"></th>
                    <th>CONTINENT</th>
                    <th>COUNTRY</th>
                    <th>OPERATOR</th>
                    <th>TADIG</th>
                    <th>IMSI_GT</th>
                    <th>GT_PREFIX</th>
                    <th>TIME_ZONE</th>
                    <th>PRIORITY</th>
                    <th>GSM</th>
                    <th>GSM_LAUNCH_DATE_IN</th>
                    <th>GSM_LAUNCH_DATE_OUT</th>
                    <th>GPRS</th>
                    <th>GPRS_LAUNCH_DATE_IN</th>
                    <th>GPRS_LAUNCH_DATE_OUT</th>
                    <th>CAMEL</th>
                    <th>CAMEL_LAUNCH_DATE_IN</th>
                    <th>CAMEL_LAUNCH_DATE_OUT</th>
                    <th>LTE</th>
                    <th>LTE_LAUNCH_DATE_IN</th>
                    <th>LTE_LAUNCH_DATE_OUT</th>
                    <th>NRT</th>
                    <th>NRT_LAUNCH_DATE_IN</th>
                    <th>NRT_LAUNCH_DATE_OUT</th>
                    <th>DIRECTION</th>
                    <th>AGREEMENT</th>
                    <th>MEMO</th>
                    <th>MEMO_DATE</th>
                    <th>STATUS</th>
                    <th>STATUS_DATE</th>
                    <th>TAP_SEQ</th>
                    <th>TAP_SEQ_IN</th>
                    <th>NODE_GT</th>
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
        function format(d) {
            return '<table class="table-sm table-bordered nowrap table-striped" style="width: 25%">' +
                '<tr>' +
                '<th>Service</th>' +
                '<th>Status</th>' +
                '<th>Launch Date IB</th>' +
                '<th>Launch Date OUT</th>' +
                '</tr>' +
                '<tr>' +
                '<td>GSM</td>' +
                '<td>' + d.gsm + '</td>' +
                '<td>' + d.gsm_launch_date_in + '</td>' +
                '<td>' + d.gsm_launch_date_out + '</td>' +
                '</tr>' +
                '<tr>' +
                '<td>GPRS</td>' +
                '<td>' + d.gprs + '</td>' +
                '<td>' + d.gprs_launch_date_in + '</td>' +
                '<td>' + d.gprs_launch_date_out + '</td>' +
                '</tr>' +
                '<tr>' +
                '<td>CAMEL</td>' +
                '<td>' + d.camel + '</td>' +
                '<td>' + d.camel_launch_date_in + '</td>' +
                '<td>' + d.camel_launch_date_out + '</td>' +
                '</tr>' +
                '<tr>' +
                '<td>LTE</td>' +
                '<td>' + d.lte + '</td>' +
                '<td>' + d.lte_launch_date_in + '</td>' +
                '<td>' + d.lte_launch_date_out + '</td>' +
                '</tr>' +
                '<tr>' +
                '<td>NRT</td>' +
                '<td>' + d.nrt + '</td>' +
                '<td>' + d.nrt_launch_date_in + '</td>' +
                '<td>' + d.nrt_launch_date_out + '</td>' +
                '</tr>' +
                '</table>';
        }

        $(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var reference_table = $('#reference-table').DataTable({
                "processing": true,
                "serverSide": true,
                "lengthMenu": [[100, 300, 600, 900], [100, 300, 600, 900]],
                "scrollY": "450px",
                "scrollX": true,
                "ajax": {
                    url: "{{ url('/reference-rp/show')}}",
                    type: "post"
                },
                "columns": [
                    {
                        className: 'details-control',
                        orderable: false,
                        searchable: false,
                        data: null,
                        defaultContent: ''
                    },
                    {data: "continent"},
                    {data: "country"},
                    {data: "operator"},
                    {data: "tadig"},
                    {data: "imsi_gt"},
                    {data: "gt_prefix"},
                    {data: "time_zone"},
                    {data: "priority"},
                    {data: "gsm"},
                    {data: "gsm_launch_date_in"},
                    {data: "gsm_launch_date_out"},
                    {data: "gprs"},
                    {data: "gprs_launch_date_in"},
                    {data: "gprs_launch_date_out"},
                    {data: "camel"},
                    {data: "camel_launch_date_in"},
                    {data: "camel_launch_date_out"},
                    {data: "lte"},
                    {data: "lte_launch_date_in"},
                    {data: "lte_launch_date_out"},
                    {data: "nrt"},
                    {data: "nrt_launch_date_in"},
                    {data: "nrt_launch_date_out"},
                    {data: "direction"},
                    {data: "agreement"},
                    {data: "memo"},
                    {data: "memo_date"},
                    {data: "status"},
                    {data: "status_date"},
                    {data: "tap_seq"},
                    {data: "tap_seq_in"},
                    {data: "node_gt"},
                    {data: 'action', name: 'action', orderable: false, searchable: false}
                ],
                "initComplete": function () {
                    var r = $('#reference-table tfoot tr');
                    $('#reference-table thead').append(r);
                    this.api().columns().every(function (i) {
                        var column = this;
                        var columnClass = column.footer().className;
                        if (columnClass != 'non_searchable' && i != 0) {
                            var input = document.createElement("input");
                            input.style.cssText = 'width:100%; height:20px;';
                            $(input).appendTo($(column.footer()).empty())
                                .on('change', function () {
                                    column.search($(this).val(), false, false, true).draw();
                                });
                        }
                    });
                },
                dom:
                // 'Bfrtip',
                    "<'row'<'col-sm-2'l><'col-sm-3'B><'col-sm-7'f>>" +
                    "<'row'<'col-sm-12'tr>>" + "<'row'<'col-sm-5'i><'col-sm-7'p>>",
                buttons: [
                    {
                        text: ' Add',
                        "className": 'reference-rp-add btn-sm fa fa-plus-circle'
                    },
                    {
                        text: ' Refresh',
                        "className": 'btn-sm fa fa-refresh',
                        action: function (e, dt, node, config) {
                            reference_table.ajax.reload();
                        }
                    },
                    {
                        extend: 'colvis',
                        "className": 'btn-sm'
                    },
                    {
                        extend: 'collection',
                        "className": 'btn-sm fa fa-file-o',
                        text: ' export',
                        buttons: ['csv', 'excel', 'pdf']
                    }
                ],
                "columnDefs": [
                    {
                        "targets": [1], "visible": false
                    },
                    // {
                    //     "targets": [ 2 ], "visible": false
                    // },
                    // {
                    //     "targets": [ 3 ], "visible": false
                    // },
                    // {
                    //     "targets": [ 4 ], "visible": false
                    // },
                    {
                        "targets": [5], "visible": false
                    },
                    {
                        "targets": [6], "visible": false
                    },
                    {
                        "targets": [7], "visible": false
                    },
                    // {
                    //     "targets": [ 8 ], "visible": false
                    // },
                    // {
                    //     "targets": [ 9 ], "visible": false
                    // },
                    {
                        "targets": [10], "visible": false
                    },
                    {
                        "targets": [11], "visible": false
                    },
                    // {
                    //     "targets": [ 12 ], "visible": false
                    // },
                    {
                        "targets": [13], "visible": false
                    },
                    {
                        "targets": [14], "visible": false
                    },
                    // {
                    //     "targets": [ 15 ], "visible": false
                    // },
                    {
                        "targets": [16], "visible": false
                    },
                    {
                        "targets": [17], "visible": false
                    },
                    // {
                    //     "targets": [ 18 ], "visible": false
                    // },
                    {
                        "targets": [19], "visible": false
                    },
                    {
                        "targets": [20], "visible": false
                    },
                    // {
                    //     "targets": [ 21 ], "visible": false
                    // },
                    {
                        "targets": [22], "visible": false
                    },
                    {
                        "targets": [23], "visible": false
                    },
                    // {
                    //     "targets": [ 24 ], "visible": false
                    // },
                    // {
                    //     "targets": [ 25 ], "visible": false
                    // },
                    {
                        "targets": [26], "visible": false
                    },
                    {
                        "targets": [27], "visible": false
                    },
                    // {
                    //     "targets": [ 28 ], "visible": false
                    // },
                    {
                        "targets": [29], "visible": false
                    },
                    {
                        "targets": [30], "visible": false
                    },
                    {
                        "targets": [31], "visible": false
                    },
                    {
                        "targets": [32], "visible": false
                    }
                    // {
                    //     "targets": [ 33 ], "visible": false
                    // }
                ]
            });
            $('#reference-table').on('init.dt', function () {
                $('.reference-rp-add')
                    .attr('data-toggle', 'modal')
                    .attr('data-target', '#add-rp');
            });
            $('#reference-table tbody').on('click', 'td.details-control', function () {
                var tr = $(this).closest('tr');
                var row = reference_table.row(tr);
                if (row.child.isShown()) {
                    row.child.hide();
                    tr.removeClass('shown');
                } else {
                    row.child(format(row.data())).show();
                    tr.addClass('shown');
                }
            });
            $(document).on('click', '#add-ref-save', function () {
                var continent = $('#add-ref-continent').val();
                var country = $('#add-ref-country').find(":selected").text();
                var operator = $('#add-ref-operator').val();
                var tadig = $('#add-ref-tadig').val();
                var priority = $('#add-ref-priority').val();
                var gt_prefix = $('#add-ref-gtprefix').val();
                var imsi_gt = $('#add-ref-imsigt').val();
                var timezone = $('#add-ref-time-zone').val();
                var gsm = $('#add-ref-gsm').val();
                var gsm_launch_date_in = $('#add-ref-gsm-in-date').val();
                var gsm_launch_date_out = $('#add-ref-gsm-out-date').val();
                var gprs = $('#add-ref-gprs').val();
                var gprs_launch_date_in = $('#add-ref-gprs-in-date').val();
                var gprs_launch_date_out = $('#add-ref-gprs-out-date').val();
                var camel = $('#add-ref-camel').val();
                var camel_launch_date_in = $('#add-ref-camel-in-date').val();
                var camel_launch_date_out = $('#add-ref-camel-out-date').val();
                var lte = $('#add-ref-lte').val();
                var lte_launch_date_in = $('#add-ref-lte-in-date').val();
                var lte_launch_date_out = $('#add-ref-lte-out-date').val();
                var nrt = $('#add-ref-nrt').val();
                var nrt_launch_date_in = $('#add-ref-nrt-in-date').val();
                var nrt_launch_date_out = $('#add-ref-nrt-out-date').val();
                var direction = $('#add-ref-direction').val();
                var agreement = $('#add-ref-agreement').val();
                var status = $('#add-ref-status').val();
                var memo = $('#add-ref-memo').val();
                var memo_date = $('#add-memo-date').val();
                var node_gt = $('#add-ref-node-gt').val();
                var status = $('#add-ref-status').val();
                $.ajax({
                    type: "POST",
                    url: "{{ url('/reference-rp/store')}}",
                    data: {
                        continent: continent,
                        country: country,
                        operator: operator,
                        tadig: tadig,
                        priority: priority,
                        gt_prefix: gt_prefix,
                        imsi_gt: imsi_gt,
                        timezone: timezone,
                        gsm: gsm,
                        gsm_launch_date_in: gsm_launch_date_in,
                        gsm_launch_date_out: gsm_launch_date_out,
                        gprs: gprs,
                        gprs_launch_date_in: gprs_launch_date_in,
                        gprs_launch_date_out: gprs_launch_date_out,
                        camel: camel,
                        camel_launch_date_in: camel_launch_date_in,
                        camel_launch_date_out: camel_launch_date_out,
                        lte: lte,
                        lte_launch_date_in: lte_launch_date_in,
                        lte_launch_date_out: lte_launch_date_out,
                        nrt: nrt,
                        nrt_launch_date_in: nrt_launch_date_in,
                        nrt_launch_date_out: nrt_launch_date_out,
                        direction: direction,
                        agreement: agreement,
                        status: status,
                        memo: memo,
                        memo_date: memo_date,
                        node_gt: node_gt
                    },
                    success: function (data) {
                        alert("Data saved");
                    }
                });
            });
            $(document).on('click', '.reference-edit', function () {
                var tadig = $(this).attr("id");
                $.ajax({
                    type: "POST",
                    url: "{{ url('/reference-rp/edit')}}",
                    data: {tadig: tadig},
                    success: function (data) {
                        var response = JSON.parse(data);
                        $('#edit-ref-continent').val(response.continent);
                        $('#edit-ref-country').val(response.country);
                        $('#edit-ref-operator').val(response.operator);
                        $('#edit-ref-tadig').val(tadig);
                        $('#edit-ref-imsigt').val(response.imsi_gt);
                        $('#edit-ref-gtprefix').val(response.gt_prefix);
                        $('#edit-ref-time-zone').val(response.time_zone);
                        $('#edit-ref-priority').val(response.priority);
                        $('#edit-ref-gsm').val(response.gsm);
                        $('#edit-ref-gsm-in-date').val(response.gsm_launch_date_in);
                        $('#edit-ref-gsm-out-date').val(response.gsm_launch_date_out);
                        $('#edit-ref-gprs').val(response.gprs);
                        $('#edit-ref-gprs-in-date').val(response.gprs_launch_date_in);
                        $('#edit-ref-gprs-out-date').val(response.gprs_launch_date_out);
                        $('#edit-ref-camel').val(response.camel);
                        $('#edit-ref-camel-in-date').val(response.camel_launch_date_in);
                        $('#edit-ref-camel-out-date').val(response.camel_launch_date_out);
                        $('#edit-ref-lte').val(response.lte);
                        $('#edit-ref-lte-in-date').val(response.lte_launch_date_in);
                        $('#edit-ref-lte-out-date').val(response.lte_launch_date_out);
                        $('#edit-ref-nrt').val(response.nrt);
                        $('#edit-ref-nrt-in-date').val(response.nrt_launch_date_in);
                        $('#edit-ref-nrt-out-date').val(response.nrt_launch_date_out);
                        $('#edit-ref-direction').val(response.direction);
                        $('#edit-ref-agreement').val(response.agreement);
                        $('#edit-ref-status').val(response.status);
                        $('#edit-ref-memo').val(response.memo);
                        $('#edit-memo-date').val(response.memo_date);
                        $('#edit-ref-node-gt').val(response.node_gt);
                    }
                });
            });
            $(document).on('click', '#edit-ref-save', function () {
                var continent = $('#edit-ref-continent').val();
                var country = $('#edit-ref-country').val();
                var operator = $('#edit-ref-operator').val();
                var tadig = $('#edit-ref-tadig').val();
                var priority = $('#edit-ref-priority').val();
                var gt_prefix = $('#edit-ref-gtprefix').val();
                var imsi_gt = $('#edit-ref-imsigt').val();
                var time_zone = $('#edit-ref-time-zone').val();
                var gsm = $('#edit-ref-gsm').val();
                var gsm_launch_date_in = $('#edit-ref-gsm-in-date').val();
                var gsm_launch_date_out = $('#edit-ref-gsm-out-date').val();
                var gprs = $('#edit-ref-gprs').val();
                var gprs_launch_date_in = $('#edit-ref-gprs-in-date').val();
                var gprs_launch_date_out = $('#edit-ref-gprs-out-date').val();
                var camel = $('#edit-ref-camel').val();
                var camel_launch_date_in = $('#edit-ref-camel-in-date').val();
                var camel_launch_date_out = $('#edit-ref-camel-out-date').val();
                var lte = $('#edit-ref-lte').val();
                var lte_launch_date_in = $('#edit-ref-lte-in-date').val();
                var lte_launch_date_out = $('#edit-ref-lte-out-date').val();
                var nrt = $('#edit-ref-nrt').val();
                var nrt_launch_date_in = $('#edit-ref-nrt-in-date').val();
                var nrt_launch_date_out = $('#edit-ref-nrt-out-date').val();
                var direction = $('#edit-ref-direction').val();
                var agreement = $('#edit-ref-agreement').val();
                var status = $('#edit-ref-status').val();
                var memo = $('#edit-ref-memo').val();
                var memo_date = $('#edit-memo-date').val();
                var node_gt = $('#edit-ref-node-gt').val();
                var status = $('#edit-ref-status').val();
                $.ajax({
                    type: "POST",
                    url: "{{ url('/reference-rp/update')}}",
                    data: {
                        continent: continent,
                        country: country,
                        operator: operator,
                        tadig: tadig,
                        priority: priority,
                        gt_prefix: gt_prefix,
                        imsi_gt: imsi_gt,
                        time_zone: time_zone,
                        gsm: gsm,
                        gsm_launch_date_in: gsm_launch_date_in,
                        gsm_launch_date_out: gsm_launch_date_out,
                        gprs: gprs,
                        gprs_launch_date_in: gprs_launch_date_in,
                        gprs_launch_date_out: gprs_launch_date_out,
                        camel: camel,
                        camel_launch_date_in: camel_launch_date_in,
                        camel_launch_date_out: camel_launch_date_out,
                        lte: lte,
                        lte_launch_date_in: lte_launch_date_in,
                        lte_launch_date_out: lte_launch_date_out,
                        nrt: nrt,
                        nrt_launch_date_in: nrt_launch_date_in,
                        nrt_launch_date_out: nrt_launch_date_out,
                        direction: direction,
                        agreement: agreement,
                        status: status,
                        memo: memo,
                        memo_date: memo_date,
                        node_gt: node_gt
                    },
                    success: function (data) {
                        alert("Data saved");
                    }
                });
            });
            $(document).on('click', '.reference-delete', function () {
                var tadig = $(this).attr("id");
                $('#delete-ref-tadig').val(tadig);
            });
            $(document).on('click', '#reference-delete-save', function () {
                var tadig = $('#delete-ref-tadig').val();
                $.ajax({
                    type: "POST",
                    url: "{{ url('/reference-rp/delete')}}",
                    data: {tadig: tadig},
                    success: function (data) {
                        alert("Data saved");
                    }
                });
            });

        });
        var app = angular.module('referenceApp', []);
        app.config(function ($interpolateProvider) {
            $interpolateProvider.startSymbol('[[');
            $interpolateProvider.endSymbol(']]');
        });
        app.controller('referenceCtrl', function ($scope) {
            $scope.countries = {
                1: {country: "ABKHAZIA", code: "7", mcc: "289"},
                2: {country: "AFGHANISTAN", code: "93", mcc: "412"},
                3: {country: "ALBANIA", code: "355", mcc: "276"},
                4: {country: "ALGERIA", code: "213", mcc: "603"},
                5: {country: "AMERICAN SAMOA", code: "684", mcc: "544"},
                6: {country: "ANDORRA", code: "376", mcc: "213"},
                7: {country: "ANGOLA", code: "244", mcc: "631"},
                8: {country: "ANGUILLA", code: "1264", mcc: "365"},
                9: {country: "Antigua", code: "1268", mcc: "344"},
                10: {country: "ARGENTINA", code: "54", mcc: "722"},
                11: {country: "ARMENIA", code: "374", mcc: "283"},
                12: {country: "ARUBA", code: "297", mcc: "363"},
                13: {country: "AUSTRALIA", code: "61", mcc: "505"},
                14: {country: "AUSTRIA", code: "43", mcc: "232"},
                15: {country: "AZERBAJIAN", code: "994", mcc: "400"},
                16: {country: "BAHAMAS", code: "1242", mcc: "364"},
                17: {country: "BAHRAIN", code: "973", mcc: "426"},
                18: {country: "BANGLADESH", code: "880", mcc: "470"},
                19: {country: "Barbados", code: "1246", mcc: "342"},
                20: {country: "BELARUS", code: "375", mcc: "257"},
                21: {country: "BELGIUM", code: "32", mcc: "206"},
                22: {country: "BELIZE", code: "501", mcc: "702"},
                23: {country: "BENIN", code: "229", mcc: "616"},
                24: {country: "BERMUDA", code: "1441", mcc: "350"},
                25: {country: "BHUTAN", code: "975", mcc: "402"},
                26: {country: "BOLIVIA", code: "591", mcc: "736"},
                27: {country: "Bosnia&Herzegovina", code: "387", mcc: "218"},
                28: {country: "BOTSWANA", code: "267", mcc: "652"},
                29: {country: "BRAZIL", code: "55", mcc: "724"},
                30: {country: "BRITISH VIRGIN ISLANDS", code: "284", mcc: "348"},
                31: {country: "BRUNEI", code: "673", mcc: "528"},
                32: {country: "BULGARIA", code: "359", mcc: "284"},
                33: {country: "BURKINA FASO", code: "226", mcc: "613"},
                34: {country: "BURUNDI", code: "257", mcc: "642"},
                35: {country: "CAMBODIA", code: "855", mcc: "456"},
                36: {country: "CAMEROON", code: "237", mcc: "624"},
                37: {country: "CANADA", code: "1", mcc: "302"},
                38: {country: "CAPE VERDE", code: "238", mcc: "625"},
                39: {country: "CAYMAN ISLANDS", code: "1345", mcc: "346"},
                40: {country: "CENTRAL AFRICAN Republic", code: "236", mcc: "623"},
                41: {country: "CHAD", code: "235", mcc: "622"},
                42: {country: "CHILI", code: "56", mcc: "730"},
                43: {country: "CHINA", code: "86", mcc: "460"},
                44: {country: "COLOMBIA", code: "57", mcc: "732"},
                45: {country: "COMOROS", code: "269", mcc: "654"},
                46: {country: "CONGO Democratic RP", code: "243", mcc: "630"},
                47: {country: "CONGO, REPUBLIC", code: "242", mcc: "629"},
                48: {country: "COOK IRELANDS", code: "682", mcc: "548"},
                49: {country: "COSTA RICA", code: "506", mcc: "712"},
                50: {country: "CROATIA", code: "385", mcc: "219"},
                51: {country: "CUBA", code: "53", mcc: "368"},
                52: {country: "Bonaire & Curacao", code: "599", mcc: "362"},
                53: {country: "CYPRUS", code: "357", mcc: "280"},
                54: {country: "CZECH", code: "420", mcc: "230"},
                55: {country: "DENMARK", code: "45", mcc: "238"},
                56: {country: "DJIBOUTI", code: "253", mcc: "638"},
                57: {country: "DOMINICA", code: "1767", mcc: "366"},
                58: {country: "DOMINICAN RP", code: "1809", mcc: "370"},
                59: {country: "ECUADOR", code: "593", mcc: "740"},
                60: {country: "EGYPT", code: "20", mcc: "602"},
                61: {country: "EL SALVADOR", code: "503", mcc: "706"},
                62: {country: "EQUATORIAL GUINEA", code: "240", mcc: "627"},
                63: {country: "ERITREA", code: "291", mcc: "657"},
                64: {country: "ESTONIA", code: "372", mcc: "248"},
                65: {country: "ETHIOPIA", code: "251", mcc: "636"},
                66: {country: "FALKLAND ISLANDS (MALVINAS)", code: "500", mcc: "750"},
                67: {country: "FAROE ISLANDS", code: "298", mcc: "288"},
                68: {country: "FIJI", code: "679", mcc: "542"},
                69: {country: "FINLAND", code: "358", mcc: "244"},
                70: {country: "FRANCE", code: "33", mcc: "208"},
                71: {country: "FRENCH GUIANA", code: "594", mcc: "340"},
                72: {country: "FRENCH POLYNESIA", code: "689", mcc: "547"},
                73: {country: "GABON", code: "241", mcc: "628"},
                74: {country: "GAMBIA", code: "220", mcc: "607"},
                75: {country: "GEORGIA", code: "995", mcc: "282"},
                76: {country: "GERMANY", code: "49", mcc: "262"},
                77: {country: "GHANA", code: "233", mcc: "620"},
                78: {country: "GIBRALTAR", code: "350", mcc: "266"},
                79: {country: "GREECE", code: "30", mcc: "202"},
                80: {country: "GREENLAND", code: "299", mcc: "290"},
                81: {country: "GRENADA", code: "1473", mcc: "352"},
                82: {country: "GUAM_310", code: "1671", mcc: "310"},
                83: {country: "GUAM_311", code: "1671", mcc: "311"},
                84: {country: "GUATEMALA", code: "502", mcc: "704"},
                85: {country: "GUINEA", code: "224", mcc: "611"},
                86: {country: "GUNIEA Bissau", code: "245", mcc: "632"},
                87: {country: "GUYANA", code: "592", mcc: "738"},
                88: {country: "HAITI", code: "509", mcc: "372"},
                89: {country: "HONDURAS", code: "504", mcc: "708"},
                90: {country: "HONGKONG", code: "852", mcc: "454"},
                91: {country: "HUNGARY", code: "36", mcc: "216"},
                92: {country: "ICELAND", code: "354", mcc: "274"},
                93: {country: "INDIA", code: "91", mcc: "404"},
                94: {country: "INDIA", code: "91", mcc: "405"},
                95: {country: "INDONESIA", code: "62", mcc: "510"},
                96: {country: "INTERNATIONAL NETWORKS", code: "882", mcc: "901"},
                97: {country: "IRAN", code: "98", mcc: "432"},
                98: {country: "IRAQ", code: "964", mcc: "418"},
                99: {country: "IRELAND", code: "353", mcc: "272"},
                100: {country: "ISRAEL", code: "972", mcc: "425"},
                101: {country: "ITALY", code: "39", mcc: "222"},
                102: {country: "IVORY COAST", code: "225", mcc: "612"},
                103: {country: "JAMAICA", code: "1876", mcc: "338"},
                104: {country: "JAPAN_440", code: "81", mcc: "440"},
                105: {country: "JAPAN_441", code: "81", mcc: "441"},
                106: {country: "JORDAN", code: "962", mcc: "416"},
                107: {country: "KAZAKHSTAN", code: "7", mcc: "401"},
                108: {country: "KENYA", code: "254", mcc: "639"},
                109: {country: "KIRIBATI", code: "686", mcc: "545"},
                110: {country: "KOREA N., DEM. PEOPLE'S REP.", code: "850", mcc: "467"},
                111: {country: "SOUTH KOREA", code: "82", mcc: "450"},
                112: {country: "KUWAIT", code: "965", mcc: "419"},
                113: {country: "KYRGYZSTAN", code: "996", mcc: "437"},
                114: {country: "LAOS", code: "856", mcc: "457"},
                115: {country: "LATVIA", code: "371", mcc: "247"},
                116: {country: "LEBANON", code: "961", mcc: "415"},
                117: {country: "LESOTHO", code: "266", mcc: "651"},
                118: {country: "LIBERIA", code: "231", mcc: "618"},
                119: {country: "LIBYA", code: "218", mcc: "606"},
                120: {country: "LIECHTENSTEIN", code: "423", mcc: "295"},
                121: {country: "LITHUANIA", code: "370", mcc: "246"},
                122: {country: "LUXEMBOURG", code: "352", mcc: "270"},
                123: {country: "MACAU", code: "853", mcc: "455"},
                124: {country: "MACEDONIA", code: "389", mcc: "294"},
                125: {country: "MADAGASCAR", code: "261", mcc: "646"},
                126: {country: "MALAWI", code: "265", mcc: "650"},
                127: {country: "MALAYSIA", code: "60", mcc: "502"},
                128: {country: "MALDIVES", code: "960", mcc: "472"},
                129: {country: "MALI", code: "223", mcc: "610"},
                130: {country: "MALTA", code: "356", mcc: "278"},
                131: {country: "MAURITANIA", code: "222", mcc: "609"},
                132: {country: "MAURITIUS", code: "230", mcc: "617"},
                133: {country: "MEXICO", code: "52", mcc: "334"},
                134: {country: "MICRONESIA", code: "691", mcc: "550"},
                135: {country: "MOLDOVA", code: "373", mcc: "259"},
                136: {country: "MONACO", code: "377", mcc: "212"},
                137: {country: "MONGOLIA", code: "976", mcc: "428"},
                138: {country: "MONTENEGRO", code: "382", mcc: "297"},
                139: {country: "MONTSERRAT", code: "1664", mcc: "354"},
                140: {country: "MOROCCO", code: "212", mcc: "604"},
                141: {country: "MOZAMBIQUE", code: "258", mcc: "643"},
                142: {country: "MYANMAR", code: "95", mcc: "414"},
                143: {country: "NAMIBIA", code: "264", mcc: "649"},
                144: {country: "NEPAL", code: "977", mcc: "429"},
                145: {country: "NETHERLANDS", code: "31", mcc: "204"},
                146: {country: "NEW CALEDONIA", code: "687", mcc: "546"},
                147: {country: "NEW ZEALAND", code: "64", mcc: "530"},
                148: {country: "NICARAGUA", code: "505", mcc: "710"},
                149: {country: "NIGER", code: "227", mcc: "614"},
                150: {country: "NIGERIA", code: "234", mcc: "621"},
                151: {country: "NIUE", code: "683", mcc: "555"},
                152: {country: "NORWAY", code: "47", mcc: "242"},
                153: {country: "OMAN", code: "968", mcc: "422"},
                154: {country: "PAKISTAN", code: "92", mcc: "410"},
                155: {country: "PALAU (REPUBLIC OF)", code: "680", mcc: "552"},
                156: {country: "PANAMA", code: "507", mcc: "714"},
                157: {country: "PAPUA NEW GUINEA", code: "675", mcc: "537"},
                158: {country: "PARAGUAY", code: "595", mcc: "744"},
                159: {country: "PERU", code: "51", mcc: "716"},
                160: {country: "PHILIPPINES", code: "63", mcc: "515"},
                161: {country: "POLAND", code: "48", mcc: "260"},
                162: {country: "PORTUGAL", code: "351", mcc: "268"},
                163: {country: "PUERTO RICO", code: "1", mcc: "330"},
                164: {country: "QATAR", code: "974", mcc: "427"},
                165: {country: "Reunion Island", code: "262", mcc: "647"},
                166: {country: "ROMANIA", code: "40", mcc: "226"},
                167: {country: "RUSSIA", code: "79", mcc: "250"},
                168: {country: "RWANDA", code: "250", mcc: "635"},
                169: {country: "St. Kitts", code: "1869", mcc: "356"},
                170: {country: "St. Lucia", code: "1758", mcc: "358"},
                171: {country: "SOMOA", code: "685", mcc: "549"},
                172: {country: "SAN MARINO", code: "378", mcc: "292"},
                173: {country: "SAO TOME & PRINCIPE", code: "239", mcc: "626"},
                174: {country: "SAUDI ARABIA", code: "966", mcc: "420"},
                175: {country: "SENEGAL", code: "221", mcc: "608"},
                176: {country: "SERBIA", code: "381", mcc: "220"},
                177: {country: "SEYCHELLES", code: "248", mcc: "633"},
                178: {country: "SIERRA LEONE", code: "232", mcc: "619"},
                179: {country: "SINGAPORE", code: "65", mcc: "525"},
                180: {country: "SLOVAKIA", code: "421", mcc: "231"},
                181: {country: "SLOVENIA", code: "386", mcc: "293"},
                182: {country: "SOLOMON ISLANDS", code: "677", mcc: "540"},
                183: {country: "SOMALIA", code: "252", mcc: "637"},
                184: {country: "SOUTH AFRICA", code: "27", mcc: "655"},
                185: {country: "SOUTH SUDAN", code: "211", mcc: "659"},
                186: {country: "SPAIN", code: "34", mcc: "214"},
                187: {country: "SRI LANKA", code: "94", mcc: "413"},
                188: {country: "ST. PIERRE & MIQUELON", code: "508", mcc: "308"},
                189: {country: "St. Vincent", code: "1784", mcc: "360"},
                190: {country: "SUDAN", code: "249", mcc: "634"},
                191: {country: "SURINAME", code: "597", mcc: "746"},
                192: {country: "SWAZILAND", code: "268", mcc: "653"},
                193: {country: "SWEDEN", code: "46", mcc: "240"},
                194: {country: "SWITZERLAND", code: "41", mcc: "228"},
                195: {country: "SYRIAN ARAB REPUBLIC", code: "963", mcc: "417"},
                196: {country: "TAIWAN", code: "886", mcc: "466"},
                197: {country: "TAJIKISTAN", code: "992", mcc: "436"},
                198: {country: "TANZANIA", code: "255", mcc: "640"},
                199: {country: "THAILAND", code: "66", mcc: "520"},
                200: {country: "TIMORE-LESTE", code: "670", mcc: "514"},
                201: {country: "TOGO", code: "228", mcc: "615"},
                202: {country: "TONGA", code: "676", mcc: "539"},
                203: {country: "Trinidad & Tobago", code: "1868", mcc: "374"},
                204: {country: "TUNISIA", code: "216", mcc: "605"},
                205: {country: "TURKEY", code: "90", mcc: "286"},
                206: {country: "TURKMENISTAN", code: "993", mcc: "438"},
                207: {country: "Turks & Caicos", code: "1", mcc: "376"},
                208: {country: "TUVALU", code: "688", mcc: "553"},
                209: {country: "UGANDA", code: "256", mcc: "641"},
                210: {country: "UKRAINE", code: "380", mcc: "255"},
                211: {country: "UAE_424", code: "971", mcc: "424"},
                212: {country: "UAE_431", code: "971", mcc: "431"},
                213: {country: "UAE_430", code: "971", mcc: "430"},
                214: {country: "UK_234", code: "44", mcc: "234"},
                215: {country: "UK_235", code: "44", mcc: "235"},
                216: {country: "USA_312", code: "1", mcc: "312"},
                217: {country: "USA_316", code: "1", mcc: "316"},
                218: {country: "URUGUAY", code: "598", mcc: "748"},
                219: {country: "UZBEKISTAN", code: "998", mcc: "434"},
                220: {country: "VANUATU", code: "678", mcc: "541"},
                221: {country: "VENEZUELA", code: "58", mcc: "734"},
                222: {country: "VIETNAM", code: "84", mcc: "452"},
                223: {country: "YEMEN", code: "967", mcc: "421"},
                224: {country: "ZAMBIA", code: "260", mcc: "645"},
                225: {country: "ZIMBABWE", code: "263", mcc: "648"},
                226: {country: "PALESTINE", code: "970", mcc: "425"},
                227: {country: "JERSEY", code: "44", mcc: "234"},
                228: {country: "KOSOVO", code: "383", mcc: "212"},
                229: {country: "TATARSTAN", code: "7", mcc: "250"},
                230: {country: "NETHERLANDS ANTILLES", code: "599", mcc: "362"},
                231: {country: "USA_310", code: "1", mcc: "310"},
                232: {country: "USA_311", code: "1", mcc: "311"},
                233: {country: "USA_313", code: "1", mcc: "313"},
                234: {country: "USA", code: "1", mcc: ""},
                235: {country: "UK", code: "44", mcc: ""},
                236: {country: "JAPAN", code: "81", mcc: ""}
            }
        });
    </script>
@endpush
