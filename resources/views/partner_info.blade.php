@extends('layouts.main')
@section('content')
    <div class="container">
        <div class="row mt-5">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 style="text-align: center; float: left">Partners Information</h3>
                        <a href="/invoice/partner_information/add">
                            <button style="float: right; width: 15%" class="btn btn-primary">Add</button>
                        </a>
                    </div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif

                        <table id="partner" class="table table-hover table-sm display no-wrap">
                            <thead>
                            <tr>
                                <th>Country</th>
                                <th>Partner Name</th>
                                <th>Address</th>
                                <th>Phone</th>
                                <th>Email</th>
                                <th>PMN Code</th>
                                <th colspan="2">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($all_partner_info as $info)
                                <tr>
                                    <td>{{$info['country']}}</td>
                                    <td>{{$info['partner_name']}}</td>
                                    <td>{{$info['address']}}</td>
                                    <td>{{$info['phone']}}</td>
                                    <td>{{$info['email']}}</td>
                                    <td>{{$info['pmn_code']}}</td>
                                    <td><a href="/invoice/partner_information/edit?id={{$info['id']}}">
                                            <button class="btn btn-sm btn-outline-warning">Edit</button>
                                        </a></td>
                                    <td><a href="/invoice/partner_information/delete?id={{$info['id']}}">
                                            <button class="btn btn-sm btn-danger">Delete</button>
                                        </a></td>
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
            $('#partner').DataTable({
                // dom: 'Bfrtip',
                // buttons: [
                //     'copy', 'csv', 'excel', 'pdf', 'print'
                // ]
            });
        });
    </script>
@endsection
