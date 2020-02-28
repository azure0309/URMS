@extends('layouts.main')
@section('content')
    <!-- Modal -->
    <div class="modal fade" id="alarm-action" role="dialog">
        <div class="modal-dialog">
            <!-- Action modal-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><span class="badge badge-danger">Alarm Status</span></h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal">
                        <div class="form-group">
                            <div class="col">
                                <input type="text" class="form-control form-control-sm" id="id" readonly hidden></input>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label text-success">Status</label>
                            <div class="col">
                                <select class="form-control form-control-sm" id="alarm-status">
                                    <option></option>
                                    <option>Clear</option>
                                    <option>Unclear</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label text-success">Description</label>
                            <div class="col">
                                <textarea class="form-control" id="alarm-description"></textarea>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-danger btn-xs" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-outline-danger btn-xs" data-dismiss="modal"
                            id="alarm-status-save">Save
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!-- modal end -->
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col">
                    <div class="input-group">
                        <input type="text" class="form-control form-control-sm" placeholder="Start Date"
                               id="start_date">
                    </div>
                </div>
                <div class="col">
                    <div class="input-group">
                        <input type="text" class="form-control form-control-sm" placeholder="End Date" id="end_date">
                    </div>
                </div>
                <div class="col">
                    <input type="button" class="btn btn-outline-primary btn-sm" value="Query" id="query">
                </div>
                <div class="col">
                    <a href="https://ufms.uni/" target="_blank" class="btn btn-outline-primary btn-sm" role="button">UFMS</a>
                </div>
                <div class="col">
                    <a href="http://ucbs.uni/" target="_blank" class="btn btn-outline-primary btn-sm" role="button">A
                        Cube</a>
                </div>
                <div class="col">
                    <a href="https://globalroamer.com/webui/faces/login.xhtml?redirect=%2Fwebui%2Ffaces%2Fpages_site%2Ftestcases.xhtml%3Fid%3D7784409"
                       target="_blank" class="btn btn-outline-primary btn-sm" role="button">SIGOS</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <audio id="audio" src="{{ asset('audio/alarm.mp3')}}"></audio>
            <!-- <div class="container-fluid"> -->
            <table class="table-sm table-bordered nowrap" id="alarm-table" width="100%">
                <thead>
                <tr>
                    <th>Severity</th>
                    <th>IMSI</th>
                    <th>Direction</th>
                    <th>TADIG</th>
                    <th>Service Time</th>
                    <th>Alarm name</th>
                    <th>Detail</th>
                    <th>Alarm time</th>
                    <th></th>
                </tr>
                </thead>
                <tfoot>
                <tr>
                    <th>Severity</th>
                    <th>IMSI</th>
                    <th>Direction</th>
                    <th>TADIG</th>
                    <th>Service Time</th>
                    <th>Alarm name</th>
                    <th>Detail</th>
                    <th>Alarm time</th>
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
        $(function () {
            var alarm_table;
            // var dt = new Date();
            $('#start_date').datetimepicker();
            $('#end_date').datetimepicker();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            function play() {
                var audio = $('#audio')[0];
                audio.play();
            }

            var today = new Date();
            const months = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12];
            const days = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30];
            var translateDays = d => days[d];
            var translateMonth = m => months[m];
            // var initst = today.getFullYear() -1  + '/' + translateMonth(today.getMonth()) + '/' + today.getDate();
            // var initend = today.getFullYear() + '/' + (today.getMonth() +1) + '/' + (today.getDate()+1);
            // var initend = today.getFullYear() +'/'+ translateMonth(new Date().getMonth()) +'/' + today.getDate()+10;
            // var test = today.getDate()+10;
            // document.write(test);
            var initst = today.getFullYear() +'/'+ translateMonth(new Date().getMonth()) +'/'+28;
            var initend = today.getFullYear() +'/'+ (today.getMonth() +2)+'/'+(today.getDate()+1);
            // console.log(initst);
            // console.log(initend);
            fetch_data(initst, initend);

            // document.write(translateMonth(new Date().getMonth()));
            function fetch_data(start_date, end_date) {
                alarm_table = $('#alarm-table').DataTable({
                    "processing": true,
                    "serverSide": true,
                    "lengthMenu": [[50, 100, 300, 600, 900], [50, 100, 300, 600, 900]],
                    "order": [7, 'desc'],
                    "scrollY": "500px",
                    "scrollX": true,
                    "ajax": {
                        url: "{{ url('/real-time-monitor/show')}}",
                        type: "post",
                        data: {start_date: start_date, end_date: end_date}
                    },
                    "columns": [
                        {data: 'severity', name: 'severity'},
                        {data: 'imsi', name: 'imsi'},
                        {data: 'dir', name: 'dir'},
                        {data: 'tadig', name: 'tadig'},
                        {data: 'dt', name: 'dt'},
                        {data: 'c_type', name: 'c_type'},
                        {data: 'detail', name: 'detail'},
                        {data: 'reg_date', name: 'reg_date'},
                        {data: 'action', name: 'action', orderable: false, searchable: false}
                    ],
                    "initComplete": function () {
                        var r = $('#alarm-table tfoot tr');
                        $('#alarm-table thead').append(r);
                        this.api().columns().every(function () {
                            var column = this;
                            var columnClass = column.footer().className;
                            if (columnClass != 'non_searchable') {
                                var input = document.createElement("input");
                                input.style.cssText = 'width:100%; height:20px;';
                                $(input).appendTo($(column.footer()).empty())
                                    .on('change', function () {
                                        column.search($(this).val(), false, false, true).draw();
                                    });
                            }
                        });
                    }
                });
            }

            setInterval(function () {
                alarm_table.ajax.reload();
                $.ajax({
                    type: "POST",
                    url: "{{ url('/real-time-monitor/check')}}",
                    success: function (data) {
                        if (data == 1) {
                            play();
                        }
                    }
                });
            }, 300000);
            $('#query').on('click', function () {
                // var st = $('#start_date').val();
                //   console.log(st);
                // alarm_table.draw();
                // e.preventDefault();
                var start_date = $('#start_date').val();
                var end_date = $('#end_date').val();

                if (start_date != '' && end_date != '') {
                    $('#alarm-table').DataTable().destroy();
                    fetch_data(start_date, end_date);
                } else {
                    alert("Both Date is Required");
                }
            });
            $(document).on('click', '.edit', function () {
                var id = $(this).attr("id");
                $.ajax({
                    type: "POST",
                    url: "{{ url('/real-time-monitor/edit')}}",
                    data: {id: id},
                    success: function (data) {
                        var response = JSON.parse(data);
                        $('#id').val(id);
                        $('#alarm-status').val(response.status);
                        $('#alarm-description').val(response.description);
                    }
                });
            });
            $(document).on('click', '#alarm-status-save', function () {
                var id = $('#id').val();
                var status = $('#alarm-status').val();
                var description = $('#alarm-description').val();
                $.ajax({
                    type: "POST",
                    url: "{{ url('/real-time-monitor/update')}}",
                    data: {id: id, status: status, description: description},
                    success: function (data) {
                        alert("Data saved");
                    }
                });
            });
        });
    </script>
@endpush
