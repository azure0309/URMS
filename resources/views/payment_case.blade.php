@extends('layouts.main')
@section('content')
    <div class="container">
        <div class="row mt-5">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 style="text-align: center">Payment Cases</h3>
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
                            </tr>
                            @foreach($payment_cases as $item)
                                <tr>
                                    <td>{{$item['cust_urag']}}</td>
                                    <td>{{$item['cust_name']}}</td>
                                    <td>{{$item['prod_cd']}}</td>
                                    <td>{{$item['ncmv']}}</td>
                                    <td>{{$item['currency']}}</td>
                                    <td>{{$item['note']}}</td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
