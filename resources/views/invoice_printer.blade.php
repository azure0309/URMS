@extends('layouts.main')
@section('content')
    <div class="container">
        <div class="row mt-5">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif

                        <div id="invoice_div" style="display: block;">
                            <div style="width: 100%; float: right;">
                                <div style="float: right">
                                    <button onclick="printInvoice('invoice_section_1')" class="btn btn-outline-danger">
                                        Print Invoice
                                    </button>
                                    <a href="/invoice/partner?year_date={{$year_date}}">
                                        <button class="btn btn-primary">Cancel</button>
                                    </a>
                                </div>
                            </div>
                            <div id="invoice_section_1"
                                 style="; border: #0a0a0a; height: 150rem; width: 100%; margin-left: auto; margin-right: auto; padding: 5%">
                                <div style="width: 100%; height: 5%; ">
                                    <img src="{{ asset('images/logo.png') }}" width="20%">
                                </div>
                                <div style="width: 100%; height:25%;">
                                    @foreach($partner_info as $info)
                                        <table style="margin-right: 5%; margin-left: 5%" width="90%">
                                            <tr>
                                                <th width="50%"></th>
                                                <th width="50%"><p style="text-align: right; font-variant: small-caps">
                                                        INVOICE</p></th>
                                            </tr>
                                            <tr>
                                                <th width="50%"></th>
                                                <th width="50%"><p style="text-align: right; font-variant: small-caps">
                                                        Date: 02/24/2021</p></th>
                                            </tr>
                                            <tr>
                                                <th width="50%"></th>
                                                <th width="50%"><p style="text-align: right; font-variant: small-caps">
                                                        Invoice for: February 2021</p>
                                                </th>
                                            </tr>
                                            <tr>
                                                <th width="50%"></th>
                                                <th width="50%"><p style="text-align: right; font-variant: small-caps">
                                                        Due date: 03/24/2021</p>
                                                </th>
                                            </tr>
                                            <tr>
                                                <td width="50%"></td>
                                                <th width="50%"><p style="text-align: right; font-variant: small-caps">
                                                        Invoice
                                                        # {{$current_month}} </p>
                                                </th>
                                            </tr>
                                            <tr>
                                                <th width="50%"><p
                                                            style="text-align: left; font-variant: small-caps; text-decoration: underline">
                                                        UNITEL LLC</p></th>
                                                <th width="50%"><p
                                                            style="text-align: right; font-variant: small-caps; text-decoration: underline">{{$info['partner_name']}}</p>
                                                </th>
                                            </tr>
                                            <tr>
                                                <th width="50%"><p style="text-align: left; font-variant: small-caps">
                                                        Central tower, 8TH
                                                        FLOOR, <br> Sukhbaatar square-2
                                                        UB14200, <br> Mongolia</p></th>
                                                <th style="vertical-align: top" width="50%"><p
                                                            style="text-align: right; font-variant: small-caps;">
                                                        Address:
                                                        <br>{{$info['address']}}</p>
                                                </th>
                                            </tr>
                                            <tr>
                                                <th><p style="text-align: left; font-variant: small-caps">Phone: (976)
                                                        7777-8080</p>
                                                </th>
                                                <th width="50%"><p style="text-align: right; font-variant: small-caps">
                                                        Phone: {{$info['phone']}}</p>
                                                </th>
                                            </tr>
                                            <tr>
                                                <th><p style="text-align: left; font-variant: small-caps">Fax:(976)
                                                        7777-8989</p></th>
                                                <th width="50%"><p style="text-align: right; font-variant: small-caps">
                                                        E-mail: {{$info['email']}}</p>
                                                </th>
                                            </tr>
                                            <tr>
                                                <th width="50%"><p style="text-align: left; font-variant: small-caps">
                                                        Email:
                                                        Invoice@unitel.mn</p></th>
                                                <th width="50%"><p style="text-align: right; font-variant: small-caps">
                                                        Receiving
                                                        operator
                                                        PMN
                                                        code: </p>
                                                </th>
                                            </tr>
                                            <tr>
                                                <th><p style="text-align: left; font-variant: small-caps">Sending
                                                        operator PMN code:
                                                        MNGMN</p></th>
                                                <th width="50%"><p
                                                            style="text-align: right; font-variant: small-caps">{{$info['pmn_code']}}</p>
                                                </th>
                                            </tr>
                                        </table>
                                    @endforeach
                                </div>
                                <div style="width: 100%;">
                                    <h3 style="margin-left: 5%; margin-right: 5%; margin-top: 5%">Invoice for Roaming
                                        Test SIM: </h3>
                                    <table class="table table-sm table-hover"
                                           style="margin-right: auto; margin-left: auto; margin-top: 5%"
                                           border="1">
                                        <tr>
                                            <th>Bill month</th>
                                            <th>Total charged amount</th>
                                            <th>NCMV limit amount</th>
                                            <th>Total payable amount</th>
                                        </tr>
                                        @foreach($send_invoice as $invoice)
                                        @endforeach
                                            <tr>
                                                <td>{{$invoice['bill_month']}}</td>
                                                <td>{{number_format($sum_amount / $invoice['currency_amt'],2) . '$'}}</td>
                                                <td>{{$limit / $invoice['currency_amt'] . '$'}}</td>
                                                <td>{{number_format($payable_amt / $invoice['currency_amt'],2) . '$'}}</td>

                                            </tr>

                                    </table>
                                </div>
                                <div style="width: 100%; height: 30%; margin-top: 15%">
                                    <table style="margin-right: auto; margin-left: auto; width: 75%" border="1">
                                        <tr>
                                            <th colspan="2">Bank Info</th>
                                        </tr>
                                        <tr>
                                            <td>Beneficiary operator</td>
                                            <td>Unitel LLC</td>
                                        </tr>
                                        <tr>
                                            <td>Account Number</td>
                                            <td>499-086-875 (USD)</td>
                                        </tr>
                                        <tr>
                                            <td>Bank name</td>
                                            <td>Trade and Development Bank</td>
                                        </tr>
                                        <tr>
                                            <td>SWIFT</td>
                                            <td>TDBM MN UB</td>
                                        </tr>
                                        <tr>
                                            <td>City, Country</td>
                                            <td>Ulaanbaatar, Mongolia</td>
                                        </tr>
                                        <tr>
                                            <th colspan="2">CORRESPONDENT BANK</th>
                                        </tr>
                                        <tr>
                                            <td>Bank name</td>
                                            <td>Standard Chartered Bank<br>NEW YORK,USA</td>
                                        </tr>
                                        <tr>
                                            <td>SWIFT</td>
                                            <td>SCBLUS33</td>
                                        </tr>
                                    </table>
                                </div>
                                <div style="width: 100%; height: 50%; margin-top: 10%; page-break-before:always">
                                    <h3>Invoice For Roaming Test SIM detail:</h3>

                                    <table width="100%" border="1" class="table table-sm table-hover"
                                           style="margin-left: 5%; margin-right: 5%;">
                                        <tr>
                                            <th>MSISDN</th>
                                            <th>Bill month</th>
                                            <th>Charged amount</th>
                                        </tr>
                                        @foreach($send_invoice as $invoice)
                                            <tr>
                                                <td>{{$invoice['msisdn']}}</td>
                                                <td>{{$invoice['bill_month']}}</td>
                                                <td>{{number_format($invoice['payment'] / $invoice['currency_amt'],2) . '$'}}</td>
                                            </tr>
                                        @endforeach
                                            <tr>
                                                <td colspan="2"><span
                                                            style="font-weight: bold;">Total Charged Amount: </span>
                                                </td>
                                                <td>{{number_format($sum_amount / $invoice['currency_amt'],2) . '$'}}</td>
                                            </tr>
                                            <tr>
                                                <td colspan="2"><span
                                                            style="font-weight: bold">NCMV limit amount: </span></td>
                                                <td>{{$limit / $invoice['currency_amt'] . '$'}}</td>
                                            </tr>
                                            <tr>
                                                <td colspan="2"><span
                                                            style="font-weight: bold">Total payable amount: </span></td>
                                                <td>{{number_format($payable_amt / $invoice['currency_amt'], 2) . '$'}}</td>
                                            </tr>

                                    </table>

                                </div>
                                <div style="width: 75%; height: 2%; margin-top: 2%; margin-left: auto; margin-right: auto;">
                                    <p style="text-align: center">If you have any questions concerning this invoice,
                                        please contact
                                        invoice@unitel.mn</p>
                                    <p style="text-align: center; font-weight: bold">Thank you for your cooperation!</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function printInvoice(id) {
            var printContents = document.getElementById(id).innerHTML;
            var originalContents = document.body.innerHTML;
            document.body.innerHTML = printContents;
            window.print();
            document.body.innerHTML = originalContents;
        }
    </script>
@endsection
