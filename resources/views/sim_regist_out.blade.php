@extends('layouts.main')
@section('content')
    <div class="container">
        <div class="row mt-5">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 style="text-align: center; float: left">Sim Registration Outbound</h3>
                        <a href="/simregister/outbound/add">
                            <button style="float: right; width: 15%" class="btn btn-primary">Add</button>
                        </a>
                    </div>

                    <div class="card-body">

                        <table id="example" class="table table-hover table-sm display no-wrap">
                            <thead>
                            <tr>
                                <th>Prod NO</th>
                                <th>Bill Accnt Number</th>
                                <th>Customer Number</th>
                                <th>Name</th>
                                <th>Country</th>
                                <th>Prod Name</th>
                                <th>Status</th>
                                <th>Accnt BLNC</th>
                                <th>SVC Type</th>
                                <th>Type</th>
                                <th width="10%">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($info as $item)
                                <tr>
                                    <td>{{$item['prod_no']}}</td>
                                    <td>{{$item['bill_acnt_num']}}</td>
                                    <td>{{$item['custrnm_num']}}</td>
                                    <td>{{$item['name']}}</td>
                                    <td>{{$item['country']}}</td>
                                    <td>{{$item['prod_name']}}</td>
                                    <td>{{$item['status']}}</td>
                                    <td>{{$item['acnt_blnc']}}</td>
                                    <td>{{$item['svc_type']}}</td>
                                    <td>{{$item['type']}}</td>
                                    <td><a href="/simregister/outbound/edit?id={{$item['id']}}">
                                            <button class="btn btn-outline-warning btn-sm">Edit</button>
                                        </a>
                                        <a href="/simregister/outbound/delete?id={{$item['id']}}">
                                            <button class="btn btn-outline-danger btn-sm">Delete</button>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.bootstrap4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.colVis.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

    <script type="text/javascript">
        $(document).ready(function () {
            $('#example').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ]
            });
        });
    </script>
@endsection
