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
                        <div style="margin-left: 5%; width: 20%; float: left;">
                            <form method="get" action="/invoice/partner">
                                <input style="width: 60%;" type="text" name="year_date" value="{{$current_month}}">
                                <input type="submit" name="submit" value="Search">
                            </form>
                        </div>
                        <div id="export_section" style="margin-left: 5%; width: 15%; float: right">
                            <button onclick="printDiv('lower_section')" style="width: 100%" class="btn btn-sm btn-success">Export PDF</button>
                            <button style="margin-top: 2%; width: 100%" class="btn btn-sm btn-danger">Send e-mail</button>
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
                        <p>Bill month: {{$current_month}}</p>
                        <p>Bill status: Unpaid</p>
                        <table class="table table-hover" border="1" width="100%">
                            <tr>
                                <th>Country</th>
                                <th>Operator</th>
                                <th>PROD NO</th>
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
                        <p>Bill month: {{$current_month}}</p>
                        <p>Bill status: Unpaid</p>
                        <table class="table table-hover" border="1" width="100%">
                            <tr>
                                <th style="width: 15%">Country</th>
                                <th style="width: 15%">Operator</th>
                                <th>PROD NO</th>
                                <th>Payment</th>
                                <th>Bill month</th>
                                <th>Currency</th>
                                <th style="width: 10%">Action</th>
                                <th>Action</th>
                            </tr>

                            @foreach($send_invoice as $payment)
                                <form method="get" action="invoice/service">
                                    <tr>
                                        <td><input type="hidden" name="country"
                                                   value="{{$payment['country']}}">{{$payment['country']}}</td>
                                        <td>{{$payment['operator']}}</td>
                                        <td>{{$payment['msisdn']}}</td>
                                        <td>{{floatval($payment['total'])}}</td>
                                        <td>{{$payment['bill_month']}}</td>
                                        <td>{{$payment['currency']}}</td>
                                        <td><input style="width: 92%" type="text" name="discount"
                                                   placeholder="discount"></td>
                                        <td>
                                            <input type="submit" name="submit" value="Confirm"
                                                   class="btn btn-sm btn-success">
                                            <button class="btn btn-sm btn-outline-danger">Invoice PDF</button>
                                        </td>
                                    </tr>
                                </form>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>

        function printDiv(id){
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

