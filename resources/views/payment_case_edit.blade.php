@extends('layouts.main')
@section('content')
    <div class="container">
        <div class="row mt-5">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 style="text-align: center; float: left">Payment Case Edit</h3>
                    </div>

                    <div class="card-body">
                        @foreach($payment_case as $info)
                            <form action="/invoice/payment_case/edit/done" method="get">
                                <input type="hidden" class="form-control" name="id" value="{{$info['id']}}">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Country</label>
                                    <input type="text" class="form-control" name="cust_urag" value="{{$info['cust_urag']}}">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Operator</label>
                                    <input type="text" class="form-control" name="cust_name" value="{{$info['cust_name']}}">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Product Type</label>
                                    <input type="text" class="form-control" name="prod_cd" value="{{$info['prod_cd']}}">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">NCMV</label>
                                    <input type="text" class="form-control" name="ncmv" value="{{$info['ncmv']}}">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Currency</label>
                                    <input type="text" class="form-control" name="currency" value="{{$info['currency']}}">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Note</label>
                                    <input type="text" class="form-control" name="note" value="{{$info['note']}}">
                                </div>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
