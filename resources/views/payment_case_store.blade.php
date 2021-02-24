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
                                    <input type="text" class="form-control" name="country" placeholder="Mongolia">
                                </div>
                                <div class="form-group">
                                    <label for="Country">Operator</label>
                                    <input type="text" class="form-control" name="operator" placeholder="Unitel">
                                </div>
                                <div class="form-group">
                                    <label for="Product Type">Product Type</label>
                                    <select class="form-control" name="prod_cd">
                                        <option>Roaming Partner Test</option>
                                        <option>Roaming Service Test</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="NCMV">NCMV</label>
                                    <input type="text" class="form-control" name="ncmv" placeholder="80">
                                </div>
                                <div class="form-group">
                                    <label for="Currency">Currency</label>
                                    <input type="text" class="form-control" name="currency" placeholder="USD">
                                </div>
                                <div class="form-group">
                                    <label for="Note">Note</label>
                                    <select class="form-control" name="note">
                                        <option>total SIM</option>
                                        <option>per SIM</option>
                                        <option>per PLSM</option>
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
