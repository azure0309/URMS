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


                        <div id="export_section" style="margin-left: 5%; width: 15%; float: right; display: none">
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
                                    @if($payment['iscalculated'] == 'UNCALCULATED')
                                        <tr bgcolor="#d9534f">
                                            <td>{{$payment['country']}}</td>
                                            <td>{{$payment['operator']}}</td>
                                            <td>{{$payment['msisdn']}}</td>
                                            <td>{{number_format(floatval($payment['total'])) . '₮'}}</td>
                                            <td>{{$payment['bill_month']}}</td>
                                        </tr>
                                    @else
                                        <tr>
                                            <td>{{$payment['country']}}</td>
                                            <td>{{$payment['operator']}}</td>
                                            <td>{{$payment['msisdn']}}</td>
                                            <td>{{number_format(floatval($payment['total'])) . '₮'}}</td>
                                            <td>{{$payment['bill_month']}}</td>
                                        </tr>
                                    @endif
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
                                    <th>Payment /MNT/</th>
                                    <th>NCMV /MNT/</th>
                                    <th>Note</th>
                                    <th>Bill month</th>
                                    <th colspan="2" style="width: 25%">Action</th>
                                </tr>

                                @php ($renderedElections = []) @endphp
                                @php ($renderedAreas = []) @endphp
                                @foreach($send_invoice as $payment)
                                    @if(@$payment['iscalculated'] == 'UNCALCULATED')
                                    <tr bgcolor="#d9534f">

                                        <form action="partner" method="GET" id="my_form">
                                            <input type="hidden" name="id" form="my_form"
                                                   value="{{$payment['id']}}">
                                            <input type="hidden" name="year_date" form="my_form"
                                                   value="{{$year_date}}">
                                            <td>{{$payment['country']}}</td>
                                            <td>{{$payment['operator']}}</td>
                                            <td>{{$payment['msisdn']}}</td>
                                            <td>{{number_format($payment['payment']) . '₮' }}</td>
                                            <td>{{number_format($payment['limit']) . '₮' . '  --  ' . $payment['ncmv'] . '$'}}</td>
                                            <td>{{$payment['note']}}</td>
                                            <td>{{$payment['bill_month']}}</td>
                                            <td>
                                                <a href="/invoice/partner/action?id={{$payment['id']}}&year_date={{$year_date}}">
                                                    <button class="btn btn-sm btn-success">Confirm</button>
                                                </a>
                                            </td>

                                            @if(!in_array($payment['country'] . '_' . $payment['operator'], $renderedAreas))
                                                <td rowspan="{{count($send_invoice->where('country', $payment['country']))}}">
                                                    <a href="/invoice/partner/print?country={{$payment['country']}}&operator={{$payment['operator']}}&bill_month={{$payment['bill_month']}}&limit={{$payment['limit']}}&action=InvoicePDF&year_date={{$year_date}}">
                                                        <button class="btn btn-sm btn-primary">InvoicePDF
                                                        </button>
                                                    </a>
                                                </td>
                                                <?php array_push($renderedAreas, $payment['country'] . '_' . $payment['operator']) ?>

{{--                                            @elseif(in_array($payment['country'] . '_' . $payment['operator'], $renderedAreas))--}}
{{--                                                <td>--}}
{{--                                                    <a href="/invoice/partner/print?country={{$payment['country']}}&operator={{$payment['operator']}}&bill_month={{$payment['bill_month']}}&limit={{$payment['limit']}}&action=InvoicePDF&year_date={{$year_date}}">--}}
{{--                                                        <button class="btn btn-sm btn-outline-danger">InvoicePDF--}}
{{--                                                        </button>--}}
{{--                                                    </a>--}}
{{--                                                </td>--}}
                                            @endif

                                        </form>
                                    </tr>
                                    @else
                                        <tr>

                                            <form action="partner" method="GET" id="my_form">
                                                <input type="hidden" name="id" form="my_form"
                                                       value="{{$payment['id']}}">
                                                <input type="hidden" name="year_date" form="my_form"
                                                       value="{{$year_date}}">
                                                <td>{{$payment['country']}}</td>
                                                <td>{{$payment['operator']}}</td>
                                                <td>{{$payment['msisdn']}}</td>
                                                <td>{{number_format($payment['payment']) . '₮' }}</td>
                                                <td>{{number_format($payment['limit']) . '₮' . '  --  ' . $payment['ncmv'] . '$'}}</td>
                                                <td>{{$payment['note']}}</td>
                                                <td>{{$payment['bill_month']}}</td>
                                                <td>
                                                    <a href="/invoice/partner/action?id={{$payment['id']}}&year_date={{$year_date}}">
                                                        <button class="btn btn-sm btn-success">Confirm</button>
                                                    </a>
                                                </td>

                                                @if(!in_array($payment['country'] . '_' . $payment['operator'], $renderedAreas))
                                                    <td rowspan="{{count($send_invoice->where('country', $payment['country']))}}">
                                                        <a href="/invoice/partner/print?country={{$payment['country']}}&operator={{$payment['operator']}}&bill_month={{$payment['bill_month']}}&limit={{$payment['limit']}}&action=InvoicePDF&year_date={{$year_date}}">
                                                            <button class="btn btn-sm btn-outline-danger">InvoicePDF
                                                            </button>
                                                        </a>
                                                    </td>
                                                    <?php array_push($renderedAreas, $payment['country'] . '_' . $payment['operator']) ?>

                                                    {{--                                            @elseif(in_array($payment['country'] . '_' . $payment['operator'], $renderedAreas))--}}
                                                    {{--                                                <td>--}}
                                                    {{--                                                    <a href="/invoice/partner/print?country={{$payment['country']}}&operator={{$payment['operator']}}&bill_month={{$payment['bill_month']}}&limit={{$payment['limit']}}&action=InvoicePDF&year_date={{$year_date}}">--}}
                                                    {{--                                                        <button class="btn btn-sm btn-outline-danger">InvoicePDF--}}
                                                    {{--                                                        </button>--}}
                                                    {{--                                                    </a>--}}
                                                    {{--                                                </td>--}}
                                                @endif

                                            </form>
                                        </tr>
                                    @endif
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

