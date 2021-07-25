@extends('layouts.main')
@section('content')
    <div class="container">
        <div class="row mt-5">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-header">Add Sim Inbound</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form action="/simregister/inbound/add/store" method="get">
                            <div class="form-group">
                                <label for="Prod_no">Tadig</label>
                                <input type="text" class="form-control" name="tadig">
                            </div>
                            <div class="form-group">
                                <label for="Bill Acnt Num">Operator</label>
                                <input type="text" class="form-control" name="operator">
                            </div>
                            <div class="form-group">
                                <label for="custrnm_num">Country</label>
                                <input type="text" class="form-control" name="country">
                            </div>
                            <div class="form-group">
                                <label for="name">Agreement</label>
                                <input type="text" class="form-control" name="agreement">
                            </div>
                            <div class="form-group">
                                <label for="country">MSISDN</label>
                                <input type="text" class="form-control" name="msisdn">
                            </div>
                            <div class="form-group">
                                <label for="prod_name">IMSI</label>
                                <input type="text" class="form-control" name="imsi">
                            </div>
                            <div class="form-group">
                                <label for="status">ICC ID</label>
                                <input type="text" class="form-control" name="icc_id">
                            </div>
                            <div class="form-group">
                                <label for="acnt_blnc">Pin 1</label>
                                <input type="text" class="form-control" name="pin_1">
                            </div>
                            <div class="form-group">
                                <label for="svc_typec">Puk 1</label>
                                <input type="text" class="form-control" name="puk_1">
                            </div>
                            <div class="form-group">
                                <label for="type">Type</label>
                                <input type="text" class="form-control" name="type">
                            </div>
                            <div class="form-group">
                                <label for="type">Post_pps</label>
                                <input type="text" class="form-control" name="post_pps">
                            </div>
                            <div class="form-group">
                                <label for="type">Card Status</label>
                                <input type="text" class="form-control" name="card_status">
                            </div>
                            <div class="form-group">
                                <label for="type">Card Location</label>
                                <input type="text" class="form-control" name="card_location">
                            </div>
                            <div class="form-group">
                                <label for="type">Date</label>
                                <input type="text" class="form-control" name="dt">
                            </div>

                            <div class="form-group">
                                <input class="form-control btn btn-primary" type="submit">
                            </div>
                            <div class="form-group">
                                <a href="/simregister/outbound">
                                    <button class="form-control btn btn-secondary">Cancel</button>
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
