@extends('master3')

@section('dashboard')

    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-aqua">
            <div class="inner">
                <h3>{{$all}}</h3>

                <p>All Loans</p>
            </div>
            <div class="icon">
                <i class="ion ion-bag"></i>
            </div>
            <a class="small-box-footer"> <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>

    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-green">
            <div class="inner">
                <h3>{{$approved}}</h3>

                <p>Approved Loans</p>
            </div>
            <div class="icon">
                <i class="ion ion-bag"></i>
            </div>
            <a class="small-box-footer"> <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>

    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-yellow">
            <div class="inner">
                <h3>{{$pending}}</h3>

                <p>Pending Loans</p>
            </div>
            <div class="icon">
                <i class="ion ion-person-add"></i>
            </div>
            <a class="small-box-footer"> <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>

    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-red">
            <div class="inner">
                <h3>{{$refused}}</h3>

                <p>Refused Loans</p>
            </div>
            <div class="icon">
                <i class="ion ion-pie-graph"></i>
            </div>
            <a class="small-box-footer"> <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>

@stop

@section('content')

    <div class="col-2">
        <h3>All Loans</h3>
        <table class="table" id="mytable">
            <thead>
            <th>Surname</th>
            <th>Firstname</th>
            <th>Email</th>

            <th>Telephone (Mobile)</th>
            <th>Amount Requested</th>
            <th></th>
            <th></th>
            <th></th>
            </thead>
            <tbody>

            @foreach($all_loans as $a)
                <tr>
                    <form method="get" action="{{route('details')}}">
                        {{csrf_field()}}
                        <td>{{$a->surname}}</td>
                        <td>{{$a->firstname}}</td>
                        <td>{{$a->email}}</td>

                        <td>{{$a->telephone_mobile}}</td>
                        <td><span>GHC </span>{{$a->amount_requested}}</td>
                        <td><input name="email" value="{{$a->email}}" hidden></td>

                        <td><input name="id" value="{{$a->id}}" hidden></td>
                        <td>
                            <button type="submit" class="btn btn-sm btn-primary">More Details</button>
                        </td>
                    </form>
                </tr>
            @endforeach

            </tbody>
        </table>

        <div class="container">
{{--            {{$all_loans->links()}}--}}
        </div>

        <table>
            <thead>
            <th>
                <form method="get" action="{{route('export_pdf')}}">
                    {{csrf_field()}}
                    <input value="all_loans" name="function" hidden>
                    <button type="submit" class="btn btn-primary">Print</button>
                    &nbsp;&nbsp;
                </form>

            </th>
            <th>
                <form class="form-horizontal" method="get" action="{{route('export_excel')}}">
                    {{csrf_field()}}
                    <input value="all_loans" hidden name="function">
                    <select class="" name="type">
                        <option value="xlsx">Export as xlsx</option>
                        <option value="xls">Export as xls</option>
                        <option value="csv">Export as csv</option>
                    </select>
                    <button type="submit" class="btn btn-primary">Export</button>
                </form>
            </th>
            {{--<a href="{{route('test')}}" class="btn">Mail</a>--}}

            </thead>
        </table>
    </div>
@stop

@section('footer')

@stop


