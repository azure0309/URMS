@extends('layouts.main')
@section('content')
    <div class="container">
        <div class="row mt-5">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h3 style="text-align: center">Нийт төлбөрийн жагсаалт</h3>
                    </div>
                    <form method="get">
                        <div class="form-row">
                            <div class="col">
                                <label for="Month">Улс</label>
                                <select class="form-control" name="country">
                                    <option selected></option>
                                    @foreach($countries as $country)
                                        <option name="{{$country}}" value="{{$country}}">{{$country}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col">
                                <label for="Month">Оператор</label>
                                <select class="form-control" name="operator">
                                    <option selected></option>
                                    @foreach($operators as $operator)
                                        <option name="{{$operator}}">{{$operator}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col">
                                <label for="Month">Сараар</label>
                                <input class="form-control" name="bymonth" placeholder="202101">
                            </div>
                            <div class="col">
                                <label for="Number">Дугаараар</label>
                                <input class="form-control" name="bynumber" placeholder="88112233">
                            </div>
                            <div class="col">
                                <label for="Search">Хайх</label>
                                <input class="form-control btn btn-sm btn-primary" type="submit" value="Search">

                            </div>
                        </div>

                    </form>
                    <button onclick="switcher()" class="form-control btn btn-sm btn-outline-info">Сүүлийн сарын хэрэглээ</button>
                    <div id="selected" class="card-body" >
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
                            @foreach($usages as $info)
                                @if ($info['status'] == 'UNCALCULATED')
                                    <tr bgcolor="#d9534f">
                                        <td>{{$info['prod_no']}}</td>
                                        <td>{{$info['bill_month']}}</td>
                                        <td>{{$info['tot_bill_amt']}}</td>
                                        <td>{{$info['over_pym']}}</td>
                                        <td>{{$info['pym_amt']}}</td>
                                        <td>{{$info['upaid_amt']}}</td>
                                        <td>{{$info['bill_status']}}</td>
                                    </tr>
                                @else
                                    <tr>
                                        <td>{{$info['prod_no']}}</td>
                                        <td>{{$info['bill_month']}}</td>
                                        <td>{{$info['tot_bill_amt']}}</td>
                                        <td>{{$info['over_pym']}}</td>
                                        <td>{{$info['pym_amt']}}</td>
                                        <td>{{$info['upaid_amt']}}</td>
                                        <td>{{$info['bill_status']}}</td>
                                    </tr>
                                @endif
                            @endforeach
                        </table>
                    </div>
                    <div style="display: none" id='last_month' class="card-body">
                        <h3>Сүүлийн сарын бүх дугаарын хэрэглээ</h3>
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
                                @if ($info['status'] == 'UNCALCULATED')
                                    <tr bgcolor="#d9534f">
                                        <td>{{$info['prod_no']}}</td>
                                        <td>{{$info['bill_month']}}</td>
                                        <td>{{$info['tot_bill_amt']}}</td>
                                        <td>{{$info['over_pym']}}</td>
                                        <td>{{$info['pym_amt']}}</td>
                                        <td>{{$info['upaid_amt']}}</td>
                                        <td>{{$info['bill_status']}}</td>
                                    </tr>
                                @else
                                    <tr>
                                        <td>{{$info['prod_no']}}</td>
                                        <td>{{$info['bill_month']}}</td>
                                        <td>{{$info['tot_bill_amt']}}</td>
                                        <td>{{$info['over_pym']}}</td>
                                        <td>{{$info['pym_amt']}}</td>
                                        <td>{{$info['upaid_amt']}}</td>
                                        <td>{{$info['bill_status']}}</td>
                                    </tr>
                                @endif
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function switcher() {
            var x = document.getElementById("last_month");
            if (x.style.display === "none") {
                x.style.display = "block";
            } else {
                x.style.display = "none";
            }
        }
    </script>
@endsection