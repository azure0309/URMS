@extends('layouts.main')
@section('content')
    <div style="position:relative;" class="container">
        <div class="row mt-5">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 style="text-align: center; float: left">Payment Cases</h3>
                        <a href="/invoice/payment_case/add" ><button style="float: right; width: 15%" class="btn btn-primary">Add</button></a>
                    </div>
                    <div style="height: 50em; overflow: scroll">
                        <table class="table table-hover" border="1">
                            <tr>
                                <th>Country</th>
                                <th>Operator</th>
                                <th>Prod_CD</th>
                                <th>NCMV</th>
                                <th>Currency</th>
                                <th>Note</th>
                                <th>Action</th>
                            </tr>
                            @foreach($payment_cases as $item)
                                <tr>
                                    <form method="GET" id="my_form" action="#"></form>
                                    <td>{{$item['cust_urag']}}</td>
                                    <td>{{$item['cust_name']}}</td>
                                    <td>{{$item['prod_cd']}}</td>
                                    <td>{{$item['ncmv']}}</td>
                                    <td>{{$item['currency']}}</td>
                                    <td>{{$item['note']}}</td>
                                    <td><a href="/invoice/payment_case/edit?id={{$item['id']}}"><button class="btn btn-outline-warning btn-sm">Edit</button></a></td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
