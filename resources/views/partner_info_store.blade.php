@extends('layouts.main')
@section('content')
    <div class="container">
        <div class="row mt-5">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-header">Add Partner Info</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form action="/invoice/partner_information" method="get">
                            <div class="form-group">
                                <label for="Country">Country</label>
                                <input type="text" class="form-control" name="country" placeholder="Mongolia">
                            </div>
                            <div class="form-group">
                                <label for="Partner_name">Partner Name</label>
                                <input type="text" class="form-control" name="partner_name" placeholder="Unitel">
                            </div>
                            <div class="form-group">
                                <label for="Address">Address</label>
                                <textarea type="text" class="form-control" name="address"
                                          placeholder="CENTRAL TOWER, 8TH FLOOR, SUKHBAATAR SQUARE-2 UB14200, MONGOLIA">
                                </textarea>
                            </div>
                            <div class="form-group">
                                <label for="Phone">Phone</label>
                                <input type="text" class="form-control" name="phone" placeholder="97677778080">
                            </div>
                            <div class="form-group">
                                <label for="Email">Email</label>
                                <input type="text" class="form-control" name="email" placeholder="INVOICE@UNITEL.MN">
                            </div>
                            <div class="form-group">
                                <label for="PMN_code">PMN Code</label>
                                <input type="text" class="form-control" name="pmn_code" placeholder="*****">
                            </div>
                            <div class="form-group">
                                <input class="form-control btn btn-primary" type="submit">
                            </div>
                            <div class="form-group">
                                <a href="/invoice/partner"><button class="form-control btn btn-secondary">Cancel</button></a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
