@extends('layouts.main')
@section('content')
    <div class="container">
        <div class="row mt-5">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-header">Sim Outbound Edit</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif
                        @foreach($sim as $item)
                        <form action="/simregister/outbound/edit/done" method="get">
                            <input type="hidden" class="form-control" name="id" value="{{$item['id']}}">
                            <div class="form-group">
                                <label for="Prod_no">Prod_no</label>
                                <input type="text" class="form-control" name="prod_no" value="{{$item['prod_no']}}">
                            </div>
                            <div class="form-group">
                                <label for="Bill Acnt Num">Bill Acnt Num</label>
                                <input type="text" class="form-control" name="bill_acnt_num" value="{{$item['bill_acnt_num']}}">
                            </div>
                            <div class="form-group">
                                <label for="custrnm_num">Custrnm Num</label>
                                <input type="text" class="form-control" name="custrnm_num" value="{{$item['custrnm_num']}}">
                            </div>
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" name="name" value="{{$item['name']}}">
                            </div>
                            <div class="form-group">
                                <label for="country">Country</label>
                                <input type="text" class="form-control" name="country" value="{{$item['country']}}">
                            </div>
                            <div class="form-group">
                                <label for="prod_name">Prod Name</label>
                                <input type="text" class="form-control" name="prod_name" value="{{$item['prod_name']}}">
                            </div>
                            <div class="form-group">
                                <label for="status">Status</label>
                                <input type="text" class="form-control" name="status" value="{{$item['status']}}">
                            </div>
                            <div class="form-group">
                                <label for="acnt_blnc">Acnt Blnc</label>
                                <input type="text" class="form-control" name="acnt_blnc" value="{{$item['acnt_blnc']}}">
                            </div>
                            <div class="form-group">
                                <label for="svc_typec">Svc type</label>
                                <input type="text" class="form-control" name="svc_type" value="{{$item['svc_type']}}">
                            </div>
                            <div class="form-group">
                                <label for="type">Type</label>
                                <input type="text" class="form-control" name="type" value="{{$item['type']}}">
                            </div>

                            <div class="form-group">
                                <input class="form-control btn btn-primary" type="submit">
                            </div>
                            <div class="form-group">
                                <a href="/simregister/outbound"><button class="form-control btn btn-secondary">Cancel</button></a>
                            </div>
                        </form>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
