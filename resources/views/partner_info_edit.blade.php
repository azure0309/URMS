@extends('layouts.main')
@section('content')
    <div class="container">
        <div class="row mt-5">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 style="text-align: center; float: left">Partners Information Edit</h3>
                    </div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif
                        @foreach($partner as $info)
                            <form action="/invoice/partner_information/edit/done" method="get">
                                <input type="hidden" class="form-control" name="id" value="{{$info['id']}}">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Country</label>
                                    <input type="text" class="form-control" name="country" value="{{$info['country']}}">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Partner Name</label>
                                    <input type="text" class="form-control" name="partner_name" value="{{$info['partner_name']}}">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Address</label>
                                    <input type="text" class="form-control" name="address" value="{{$info['address']}}">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Phone</label>
                                    <input type="text" class="form-control" name="phone" value="{{$info['phone']}}">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Email</label>
                                    <input type="email" class="form-control" name="email" value="{{$info['email']}}">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">PMN Code</label>
                                    <input type="text" class="form-control" name="pmn_code" value="{{$info['pmn_code']}}">
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
