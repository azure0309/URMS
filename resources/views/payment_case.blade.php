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
                                    <td><input type="hidden" name="cust_urag" form="my_form"
                                        value="{{$item['cust_urag']}}">{{$item['cust_urag']}}</td>
                                    <td><input type="hidden" name="cust_name" form="my_form"
                                               value="{{$item['cust_name']}}">{{$item['cust_name']}}</td>
                                    <td><input type="hidden" name="prod_cd" form="my_form"
                                               value="{{$item['prod_cd']}}">{{$item['prod_cd']}}</td>
                                    <td><input type="hidden" name="ncmv" form="my_form"
                                               value="{{$item['ncmv']}}">{{$item['ncmv']}}</td>
                                    <td><input type="hidden" name="currency" form="my_form"
                                               value="{{$item['currency']}}">{{$item['currency']}}</td>
                                    <td><input type="hidden" name="note" form="my_form"
                                               value="{{$item['note']}}">{{$item['note']}}</td>
                                    <td><input class="btn btn-outline-warning btn-sm" type="submit" form="my_form" value="Edit"></td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
