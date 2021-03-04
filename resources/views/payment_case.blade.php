@extends('layouts.main')
@section('content')
    <div style="position:relative;" class="container">
        <div class="row mt-5">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 style="text-align: center; float: left">Payment Cases</h3>
                        <a href="/invoice/payment_case/add">
                            <button style="float: right; width: 15%" class="btn btn-primary">Add</button>
                        </a>
                    </div>
                        <table id="payment_case" class="table table-hover table-sm display no-wrap">
                            <thead>
                            <tr>
                                <th>Country</th>
                                <th>Operator</th>
                                <th>Prod_CD</th>
                                <th>NCMV</th>
                                <th>Currency</th>
                                <th>Note</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($payment_cases as $item)
                                <tr>
                                    <form method="GET" id="my_form" action="#"></form>
                                    <td>{{$item['cust_urag']}}</td>
                                    <td>{{$item['cust_name']}}</td>
                                    <td>{{$item['prod_cd']}}</td>
                                    <td>{{$item['ncmv']}}</td>
                                    <td>{{$item['currency']}}</td>
                                    <td>{{$item['note']}}</td>
                                    <td><a href="/invoice/payment_case/edit?id={{$item['id']}}">
                                            <button class="btn btn-outline-warning btn-sm">Edit</button>
                                        </a></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
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
                $('#payment_case').DataTable({
                    // dom: 'Bfrtip',
                    // buttons: [
                    //     'copy', 'csv', 'excel', 'pdf', 'print'
                    // ]
                });
            });
        </script>
@endsection
