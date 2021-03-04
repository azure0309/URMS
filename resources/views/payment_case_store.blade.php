@extends('layouts.main')
@section('content')
    <div class="container">
        <div class="row mt-5">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-header">Add Payment Case</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif

                            <form action="/invoice/payment_case" method="get" >
                                <div class="form-group">
                                    <label for="Country">Country</label>
                                    <select class="form-control" name="note">
                                        <option></option>
                                        @foreach($country as $item)
                                            <option>{{$item}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="Country">Operator</label>
                                    <select class="form-control" name="note">
                                        <option></option>
                                        @foreach($operator as $item)
                                            <option>{{$item}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="Product Type">Product Type</label>
                                    <select class="form-control" name="note">
                                        <option></option>
                                        @foreach($prod_cd as $item)
                                            <option>{{$item}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="NCMV">NCMV</label>
                                    <input type="text" class="form-control" name="ncmv" placeholder="80">
                                </div>
                                <div class="form-group">
                                    <label for="Currency">Currency</label>
                                    <select class="form-control" name="currency">
                                        <option></option>
                                        @foreach($currency as $item)
                                        <option>{{$item['currency']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="Note">Note</label>
                                    <select class="form-control" name="note">
                                        <option></option>
                                        @foreach($threshold_type as $item)
                                        <option>{{$item}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <input class="form-control btn btn-primary" type="submit" >
                                </div>
                            </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
