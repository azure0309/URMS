@extends('layouts.main')
@section('content')
    <div class="container">
        <div class="row mt-5">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h3 style="text-align: center">Нийт төлбөрийн жагсаалт</h3>
                    </div>
                    <form method="get">
                        <div class="form-row">
                            <div class="col">
                                <label for="Month">Улс</label>
                                <select class="form-control" name="country">
                                    <option selected></option>
                                    @foreach($countries as $country)
                                        <option name="{{$country}}" value="{{$country}}">{{$country}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col">
                                <label for="Month">Оператор</label>
                                <select class="form-control" name="operator">
                                    <option selected></option>
                                    @foreach($operators as $operator)
                                        <option name="{{$operator}}">{{$operator}}</option>
                                    @endforeach
                                </select>
                            </div>
                            @foreach($usages as $item)@endforeach
                            <div class="col">
                                <label for="Month">Сараар</label>
                                <input class="form-control" name="bymonth" placeholder="202101">
                            </div>
                            <div class="col">
                                <label for="Number">Дугаараар</label>
                                <input class="form-control" name="bynumber" value='{{$item['prod_no']}}'>
                            </div>
                            <div class="col">
                                <label for="Number">Status</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="status" value="paid" id="flexRadioDefault1">
                                    <label class="form-check-label" for="flexRadioDefault1">
                                        Paid
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="status" value="unpaid" id="flexRadioDefault2">
                                    <label class="form-check-label" for="flexRadioDefault2">
                                        Unpaid
                                    </label>
                                </div>
                            </div>

                            <div class="col">
                                <label for="Search">Хайх</label>
                                <input class="form-control btn btn-sm btn-primary" type="submit" value="Search">

                            </div>
                        </div>

                    </form>
                    <button onclick="switcher()" class="form-control btn btn-sm btn-outline-info">Сүүлийн сарын хэрэглээ</button>
                    <div id="selected" class="card-body" >
                        <table id="search" class="table table-hover">
                            <thead>
                            <tr>
                                <th>Country</th>
                                <th>Operator</th>
                                <th>MSISDN</th>
                                <th>Bill Month</th>
                                <th>Total Payment</th>
                                <th>Over PYM</th>
                                <th>PYM Amount</th>
                                <th>Unpaid Amount</th>
                                <th>Status</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($usages as $info)
                                @if ($info['status'] == 'UNCALCULATED')
                                    <tr bgcolor="#d9534f">
                                        <td>{{$info['country'] }}</td>
                                        <td>{{$info['name'] }}</td>
                                        <td>{{$info['prod_no'] }}</td>
                                        <td>{{$info['bill_month'] }}</td>
                                        <td>{{$info['tot_bill_amt'] }}</td>
                                        <td>{{$info['over_pym'] }}</td>
                                        <td>{{$info['pym_amt'] }}</td>
                                        <td>{{$info['upaid_amt'] }}</td>
                                        <td>{{$info['bill_status'] }}</td>
                                    </tr>
                                @else
                                    <tr>
                                        <td>{{$info['country'] }}</td>
                                        <td>{{$info['name'] }}</td>
                                        <td>{{$info['prod_no'] }}</td>
                                        <td>{{$info['bill_month'] }}</td>
                                        <td>{{$info['tot_bill_amt'] }}</td>
                                        <td>{{$info['over_pym'] }}</td>
                                        <td>{{$info['pym_amt'] }}</td>
                                        <td>{{$info['upaid_amt'] }}</td>
                                        <td>{{$info['bill_status'] }}</td>
                                    </tr>
                                @endif
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div style="display: none" id='last_month' class="card-body">
                        <h3>Сүүлийн сарын бүх дугаарын хэрэглээ</h3>
                        <table  class="table table-hover" border="1">
                            <thead>
                            <tr>
                                <th>MSISDN</th>
                                <th>Bill Month</th>
                                <th>Total Payment</th>
                                <th>Over PYM</th>
                                <th>PYM Amount</th>
                                <th>Unpaid Amount</th>
                                <th>Status</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($last_month as $info)
                                @if ($info['status'] == 'UNCALCULATED')
                                    <tr bgcolor="#d9534f">
                                        <td>{{$info->prod_no}}</td>
                                        <td>{{$info->bill_month}}</td>
                                        <td>{{$info->tot_bill_amt}}</td>
                                        <td>{{$info->over_pym}}</td>
                                        <td>{{$info->pym_amt}}</td>
                                        <td>{{$info->upaid_amt}}</td>
                                        <td>{{$info->bill_status}}</td>
                                    </tr>
                                @else
                                    <tr>
                                        <td>{{$info->prod_no}}</td>
                                        <td>{{$info->bill_month}}</td>
                                        <td>{{$info->tot_bill_amt}}</td>
                                        <td>{{$info->over_pym}}</td>
                                        <td>{{$info->pym_amt}}</td>
                                        <td>{{$info->upaid_amt}}</td>
                                        <td>{{$info->bill_status}}</td>
                                    </tr>
                                @endif
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.bootstrap4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.colVis.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

    <script type="text/javascript">
        $(document).ready(function () {
            $('#search').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ]
            });
        });
    </script>
    <script>
        function switcher() {
            var x = document.getElementById("last_month");
            if (x.style.display === "none") {
                x.style.display = "block";
            } else {
                x.style.display = "none";
            }
        }
    </script>
@endsection
