@extends('layouts.main')
@section('content')
    <div class="container">
        <div class="row mt-5">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 style="text-align: center">Нийт төлбөрийн жагсаалт</h3>
                    </div>
                    <form method="get" action="#">
                        <div class="form-row">
                            <div class="col">
                                <select class="form-control" name="country">
                                    @foreach($countries as $country)
                                        <option name="{{$country}}">{{$country}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col">
                                <select class="form-control" name="operator">
                                    @foreach($operators as $operator)
                                        <option name="{{$operator}}">{{$operator}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-3">
                                <input class="form-control btn btn-primary" type="submit" value="Search">
                            </div>
                        </div>

                    </form>
                    <div class="card-body">
                        <table class="table table-hover" border="1">
                            <tr>
                                <th>MSISDN</th>
                                <th>Bill Month</th>
                                <th>Total Payment</th>
                                <th>Over PYM</th>
                                <th>PYM Amount</th>
                                <th>Unpaid Amount</th>
                                <th>Status</th>
                            </tr>
                            @foreach($last_month as $info)
                                <tr>
                                    <td>{{$info['prod_no']}}</td>
                                    <td>{{$info['bill_month']}}</td>
                                    <td>{{$info['tot_bill_amt']}}</td>
                                    <td>{{$info['over_pym']}}</td>
                                    <td>{{$info['pym_amt']}}</td>
                                    <td>{{$info['upaid_amt']}}</td>
                                    <td>{{$info['bill_status']}}</td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
