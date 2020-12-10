@extends('layouts.main')
@section('content')
    <div class="container">
        <div class="row mt-5">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-header">Nav bar</div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif

                        <h3>Төлбөр хаах дугаарын жагсаалт
                            <button onclick="window.print()" class="btn btn-sm btn-success">Export PDF</button>
                            <button class="btn btn-sm btn-danger">Send e-mail</button>
                        </h3>

                        <br>
                        <p>Bill month: {{$current_month}}</p>
                        <p>Bill status: Unpaid</p>
                        <table border="1" width="100%">
                            <tr>
                                <th>Country</th>
                                <th>Operator</th>
                                <th>PROD NO</th>
                                <th>Payment</th>
                                <th>Bill month</th>
                                <th>Action</th>
                            </tr>
                            @foreach($total_sim_payment as $payment)
                                <tr>
                                    <td>{{$payment['country']}}</td>
                                    <td>{{$payment['operator']}}</td>
                                    <td>{{$payment['prod_no']}}</td>
                                    <td>{{$payment['payment']}}</td>
                                    <td>{{$payment['bill_month']}}</td>
                                    <td>
                                        <button class="btn btn-sm btn-outline-secondary">Close</button>
                                        <button class="btn btn-sm btn-outline-danger">Invoice</button>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
