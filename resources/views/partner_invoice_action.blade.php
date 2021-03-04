@extends('layouts.main')
@section('content')
    <div class="container">
        <div class="row mt-5">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-header">Payment Action</div>

                    <div class="card-body">
                        <form action="/invoice/partner/action/confirm" method="get">
                            @foreach($payment as $item)
                                <input type="hidden" name="id" value="{{$item['id']}}">
                                <div class="form-group">
                                    <label for="Country">Country</label>
                                    <input type="text" class="form-control" name="country"
                                           value="{{$item['country']}}" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="Operator">Operator</label>
                                    <input type="text" class="form-control" name="operator"
                                           value="{{$item['operator']}}" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="msisdn">MSISDN</label>
                                    <input type="text" class="form-control" name="msisdn"
                                           value="{{$item['msisdn']}}" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="payment">Discount</label>
                                    <input type="text" class="form-control" name="discount"
                                           placeholder="{{$item['payment']}}">
                                    <small id="discountHelpBox" class="form-text text-muted">
                                        Дээрх үнийн дүнг өөрчилж багасгаснаар энэхүү дугаарын төлбөрийг Discount утгад оруулсан үнийн дүнгээр хөнгөлөх юм.
                                    </small>
                                </div>
                                <div class="form-group">
                                    <label for="ncmv">NCMV</label>
                                    <input type="text" class="form-control" name="ncmv"
                                           value="{{$item['limit']}}" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="bill_month">Bill Month</label>
                                    <input type="text" class="form-control" name="bill_month"
                                           value="{{$item['bill_month']}}" readonly>
                                </div>
                                <div class="form-group">
                                    <input type="submit" class="btn btn-success" value="Confirm">
                                    <a href="/invoice/partner?year_date={{$year_date}}" class="btn btn-secondary">Cancel</a>
                                </div>
                            @endforeach
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
