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
            <a href="#" class="small-box-footer"> <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>

    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-green">
            <div class="inner">
                <h3>{{$approved}}<sup style="font-size: 20px"></sup></h3>

                <p>Approved Loans</p>
            </div>
            <div class="icon">
                <i class="ion ion-stats-bars"></i>
            </div>
            <a href="#" class="small-box-footer"> <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>

    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-yellow">
            <div class="inner">
                <h3>{{$pending1}}</h3>

                <p>Pending Loans</p>
            </div>
            <div class="icon">
                <i class="ion ion-person-add"></i>
            </div>
            <a href="#" class="small-box-footer"> <i class="fa fa-arrow-circle-right"></i></a>
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
            <a href="#" class="small-box-footer"> <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
@stop

@section('content')
    <div class="container">
        @if (session('status'))
            <div class="alert alert-success" style="width: 400px">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <p>{{ session('status') }}</p>
            </div>
    </div>
    @endif



    <div class="box-footer clearfix">
        <h3>Pending Loans</h3>
        <table class="table" id="mytable">
            <thead>
            <tr>
                <th>Surname</th>
                <th>Firstname</th>
                <th>Email</th>

                <th>Telephone (Mobile)</th>
                <th>Amount Requested</th>
                <th>Date</th>
{{----}}
                <th></th>
                <th></th>
                <th></th>
            </tr>
            </thead>
            <tbody>

            @foreach($all_pend as $pend)
                <tr>
                    <form method="get" action="{{route('pending_details')}}">
                        {{csrf_field()}}
                        <td>{{$pend->surname}}</td>
                        <td>{{$pend->firstname}}</td>
                        <td>{{$pend->email}}</td>

                        <td>{{$pend->telephone_mobile}}</td>
                        <td><span>GHC </span>{{$pend->amount_requested}}</td>
                        <td>{{$pend->date_applied}}</td>

                        <td><input name="email" value="{{$pend->email}}" hidden></td>
                        <td><input name="id" value="{{$pend->id}}" hidden></td>
                        <td>
                            <button type="submit" class="btn btn-sm btn-primary">More Details</button>
                        </td>
                    </form>
                </tr>
            @endforeach

            </tbody>
        </table>

        <div class="container">
{{--            {{$all_pend->links()}}--}}
        </div>

        <table>
            <thead>
            <th>
                <form method="get" action="{{route('export_pdf')}}">
                    {{csrf_field()}}
                    <input value="pending" name="function" hidden>
                    <button type="submit" class="btn btn-primary">Print</button>
                    &nbsp;&nbsp;
                </form>
            </th>
            <th>
                <form class="form-horizontal" method="get" action="{{route('export_excel')}}">
                    {{csrf_field()}}
                    <input value="pending" hidden name="function">
                    <select class="" name="type">
                        <option value="xlsx">Export as xlsx</option>
                        <option value="xls">Export as xls</option>
                        <option value="csv">Export as csv</option>
                    </select>
                    <button type="submit" class="btn btn-primary">Export</button>
                </form>
            </th>

            </thead>
        </table>
    </div>
@stop
