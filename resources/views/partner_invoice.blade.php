@extends('layouts.main')
@section('content')
    <div class="container">
        <div class="row mt-5">
            <div class="col-md-8 offset-md-2">
                <div style="width: 120%" class="card">
                    <div style="height: 80%" class="card-header">
                        <div style="width: 50%; float: left">
                            <button onclick="lower()"
                                    style="width: 50%; border-bottom-right-radius: 0; border-top-right-radius: 0;"
                                    class="btn btn-lg btn-primary">Invoice List
                            </button>
                            <button id="close_payment"
                                    onclick="higher()"
                                    style="width: 50%; float: right; border-bottom-left-radius: 0; border-top-left-radius: 0"
                                    class="btn btn-lg btn-success">Close Payment List
                            </button>
                        </div>

                        <form method="get" action="/invoice/partner">
                            <div class="form-group-sm" style="margin-left: 5%; width: 25%; float: left;">
                                <input class="form-control" style="width: 60%; float: left" type="text" name="year_date"
                                       value="{{$current_month}}">
                                <input style="float: right" type="submit" class="btn btn-outline-info"
                                       value="Search">
                            </div>
                        </form>

                        <div id="export_section" style="margin-left: 5%; width: 15%; float: right">
                            <button onclick="printDiv('lower_section')" style="width: 100%"
                                    class="btn btn-sm btn-success">Export PDF
                            </button>
                            <button style="margin-top: 2%; width: 100%" class="btn btn-sm btn-danger">Send e-mail
                            </button>
                        </div>
                    </div>
                    <div id="lower_section" class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif

                        <h3 style="text-align: center">Төлбөр хаах дугаарын жагсаалт
                        </h3>

                        <br>
                        <p>Bill month: {{$year_date}}</p>
                        <p>Bill status: Unpaid</p>
                        <table class="table table-hover" border="1" width="100%">
                            <tr>
                                <th>Country</th>
                                <th>Operator</th>
                                <th>MSISDN</th>
                                <th>Payment</th>
                                <th>Bill month</th>
                                <th>Currency</th>
                            </tr>
                            @foreach($close_payment as $payment)
                                <tr>
                                    <td>{{$payment['country']}}</td>
                                    <td>{{$payment['operator']}}</td>
                                    <td>{{$payment['msisdn']}}</td>
                                    <td>{{floatval($payment['total'])}}</td>
                                    <td>{{$payment['bill_month']}}</td>
                                    <td>{{$payment['currency']}}</td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                    <div id="higher_section" class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif

                        <h3 style="text-align: center">Нэхэмжлэх илгээх дугаарын жагсаалт</h3>

                        <br>
                        <p>Bill month: {{$year_date}}</p>
                        <p>Bill status: Unpaid</p>
                        <table class="table table-hover" border="1" width="100%">
                            <tr>
                                <th style="width: 15%">Country</th>
                                <th style="width: 15%">Operator</th>
                                <th>MSISDN</th>
                                <th>Payment</th>
                                <th>Bill month</th>
                                <th>Currency</th>
                                <th style="width: 10%">Discount</th>
                                <th>Action</th>
                            </tr>

                            @foreach($send_invoice as $payment)
                                <tr>
                                    <form method="GET" id="my_form"></form>
                                    <td><input type="hidden" name="country" form="my_form"
                                               value="{{$payment['country']}}">{{$payment['country']}}</td>
                                    <td><input type="hidden" name="operator" form="my_form"
                                               value="{{$payment['operator']}}">{{$payment['operator']}}</td>
                                    <td><input type="hidden" name="msisdn" form="my_form"
                                               value="{{$payment['msisdn']}}">{{$payment['msisdn']}}</td>
                                    <td><input type="hidden" name="total" form="my_form"
                                               value="{{$payment['total']}}">{{$payment['total']}}</td>
                                    <td><input type="hidden" name="bill_month" form="my_form"
                                               value="{{$payment['bill_month']}}">{{$payment['bill_month']}}</td>
                                    <td><input type="hidden" name="currency" form="my_form"
                                               value="{{$payment['currency']}}">{{$payment['currency']}}</td>
                                    <td><input type="text" style="width: 92%" name="discount" form="my_form"
                                               placeholder="discount"></td>
                                    <td>
                                        <input type="submit" value="Confirm" form="my_form"
                                               class="btn btn-sm btn-success">
                                        <button class="btn btn-sm btn-outline-danger">Invoice PDF</button>
                                    </td>
                                </tr>
                            @endforeach

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>

        function printDiv(id) {
            var printContents = document.getElementById(id).innerHTML;
            var originalContents = document.body.innerHTML;
            document.body.innerHTML = printContents;
            window.print();
            document.body.innerHTML = originalContents;
        }

        document.getElementById("close_payment").click();

        function higher() {
            document.getElementById('lower_section').style.display = 'block';
            document.getElementById('higher_section').style.display = 'none';
            document.getElementById('export_section').style.display = 'block';
        }

        function lower() {
            document.getElementById('lower_section').style.display = 'none';
            document.getElementById('higher_section').style.display = 'block';
            document.getElementById('export_section').style.display = 'none';
        }
    </script>
@endsection

