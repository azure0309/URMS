@extends('layouts.main')
@section('content')
    <div class="container">
        <div class="row mt-5">
            <div class="col-md-12">
                <div style="width: 120%" class="card">
                    <div style="height: 80%" class="card-header">
                        <div style="width: 50%; float: left">
                            <button onclick="lower()"
                                    style="width: 30%; float: left; border-bottom-right-radius: 0; border-top-right-radius: 0;"
                                    class="btn btn-lg btn-primary">Нэхэмжлэх илгээх
                            </button>
                            <button id="close_payment"
                                    onclick="higher()"
                                    style="width: 30%; float: left; border-bottom-left-radius: 0; border-top-left-radius: 0"
                                    class="btn btn-lg btn-success">Төлбөр хаах
                            </button>
                        </div>

                        <form method="get" action="/invoice/partner">
                            <div class="form-group-sm" style="margin-left: 5%; width: 25%; float: left;">
                                <input class="form-control" style="width: 60%; float: left" type="text" name="year_date"
                                       value="{{$year_date}}">
                                <input style="float: left" type="submit" class="btn btn-outline-info"
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
                    <div id="list_section">
                        <div id="lower_section" class="card-body" style="display: none">
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
                                </tr>
                                @foreach($close_payment as $payment)
                                    <tr>
                                        <td>{{$payment['country']}}</td>
                                        <td>{{$payment['operator']}}</td>
                                        <td>{{$payment['msisdn']}}</td>
                                        <td>{{floatval($payment['total'])}}</td>
                                        <td>{{$payment['bill_month']}}</td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                        <div id="higher_section" class="card-body" style="display: block">
                            @if (session('status'))
                                <div class="alert alert-success">
                                    {{ session('status') }}
                                </div>
                            @endif

                            <h3 style="text-align: center">Нэхэмжлэх илгээх дугаарын жагсаалт</h3>

                            <br>
                            <p>Bill month: {{$year_date}}</p>
                            <p>Bill status: Unpaid</p>
                            <table id="my_table" class="table table-hover" border="1" width="100%">
                                <tr>
                                    <th>Country</th>
                                    <th>Operator</th>
                                    <th>MSISDN</th>
                                    <th>Payment</th>
                                    <th>NCMV</th>
                                    <th>Bill month</th>
                                    <th style="width: 15%">Discount</th>
                                    <th colspan="2" style="width: 25%">Action</th>
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
                                                   value="{{$payment['payment']}}">{{$payment['payment']}}</td>
                                        <td><input type="hidden" name="limit" form="my_form"
                                                   value="{{$payment['limit']}}">{{$payment['limit']}}</td>
                                        <td><input type="hidden" name="bill_month" form="my_form"
                                                   value="{{$payment['bill_month']}}">{{$payment['bill_month']}}</td>
                                        <td><input type="text" style="width: 92%" name="discount" form="my_form"
                                                   placeholder="discount"></td>
                                        <td>

                                            <input type="submit" class="btn btn-sm btn-success" value="Confirm"
                                                   name="action"
                                                   form="my_form">
                                        </td>
                                        <td>
{{--                                            <input formaction="/invoice/partner/print" type="submit"--}}
{{--                                                   class="btn btn-sm btn-outline-danger" value="InvoicePDF"--}}
{{--                                                   name="action"--}}
{{--                                                   form="my_form">--}}
                                            <a href="/invoice/partner/print?country={{$payment['country']}}
                                                    &operator={{$payment['operator']}}
                                                    &bill_month={{$payment['bill_month']}}
                                                    &limit={{$payment['limit']}}
                                                    &action=InvoicePDF
&year_date={{$year_date}}"><button class="btn btn-sm btn-outline-danger">InvoicePDF</button></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
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

