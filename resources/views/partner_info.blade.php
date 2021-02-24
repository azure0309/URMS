@extends('layouts.main')
@section('content')
    <div class="container">
        <div class="row mt-5">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 style="text-align: center; float: left">Partners Information</h3>
                        <a href="/invoice/partner_information/add" ><button style="float: right; width: 15%" class="btn btn-primary">Add</button></a>
                    </div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif

                        <table class="table table-hover" border="1">
                            <tr>
                                <th>Country</th>
                                <th>Partner Name</th>
                                <th>Address</th>
                                <th>Phone</th>
                                <th>Email</th>
                                <th>PMN Code</th>
                                <th colspan="2">Action</th>
                            </tr>
                            @foreach($all_partner_info as $info)
                            <tr>
                                <td>{{$info['country']}}</td>
                                <td>{{$info['partner_name']}}</td>
                                <td>{{$info['address']}}</td>
                                <td>{{$info['phone']}}</td>
                                <td>{{$info['email']}}</td>
                                <td>{{$info['pmn_code']}}</td>
                                <td><a href="/invoice/partner_information/edit?id={{$info['id']}}"><button class="btn btn-sm btn-outline-warning">Edit</button></a></td>
                                <td><a href="/invoice/partner_information/delete?id={{$info['id']}}"><button class="btn btn-sm btn-danger">Delete</button></a></td>
                            </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
