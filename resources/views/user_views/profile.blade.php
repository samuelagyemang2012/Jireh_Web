@extends('master')

@section('nav')

    <nav class="navbar-default" style=" background-color: #8A5241;border: none">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="#"style="color: #fff">Jireh Microfinance Ltd</a>
            </div>
            <ul class="nav navbar-nav">
                {{--<li><a href="/jireh/profile"><b class="thead">My Loans</b></a></li>--}}
                <li><a href="/jireh/loans"><b class="thead">Request A Loan</b></a></li>


                <li><a href="{{route('user_logout')}}"><b class="thead" style="padding-left: 700px">Logout</b></a></li>

            </ul>
        </div>
    </nav>
@stop


@section('header')
    <div class="container">
        <div class="row">
            <div class="col-4"></div>

            <div class="col-4">
                <br>
                @if (session('loan'))
                    <div class="alert alert-success">
                        <p>{{ session('loan') }}</p>
                    </div>
                @endif
            </div>

            <div class="col-4"></div>
        </div>
    </div>
@stop


@section('content')

    <hr class="">
    <div class="container target">
        <div class="row">
            <div class="col-sm-10">
                <br>
            </div>
        </div>
    </div>
    <br>

    <div class="row">
        <div class="col-sm-3">
            <!--left col-->
            <ul class="list-group">
                <li class="list-group-item text-muted" contenteditable="false"
                    style="background-color: #8A5241; color: #ffffff">User Details
                </li>

                <li class="list-group-item text-right"><span class="pull-left"><strong class="">Last
                            seen</strong></span> {{$last}}
                </li>
                <li class="list-group-item text-right"><span class="pull-left"><strong class="">Name</strong></span>
                    {{$fname}}
                    {{$sname}}
                </li>

            </ul>

            <ul class="list-group">
                <li class="list-group-item text-muted" style="background-color: #8A5241; color: #fff">Activity <i
                            class="fa fa-dashboard fa-1x"></i>

                </li>
                <li class="list-group-item text-right"><span class="pull-left"><strong class="">All
                            Loans</strong></span>
                    {{$numloans}}
                </li>
                <li class="list-group-item text-right"><span class="pull-left"><strong class="">Pending
                            Loans</strong></span> {{$pending}}
                </li>
                <li class="list-group-item text-right"><span class="pull-left"><strong class="">Approved Loans</strong></span>
                    {{$approved}}
                </li>
                <li class="list-group-item text-right"><span class="pull-left"><strong
                                class="">Refused Loans</strong></span> {{$refused}}
                </li>
            </ul>
        </div>
        <!--/col-3-->
        <div class="col-sm-9" contenteditable="false" style="">


            {{--Approved--}}
            <div class="panel panel-default target">
                <div class="panel-heading" contenteditable="false" style="background-color: #8A5241; color: #fff;">
                    Approved Loans
                </div>
                <div class="panel-body">
                    <div class="row">
                        @if($aloans)
                            @foreach($aloans as $aloan)
                                <div class="col-md-4">
                                    <div class="thumbnail">
                                        <div class="caption">
                                            <h3>
                                                <b style="color: #8A5241">Amount Requested</b>
                                            </h3>
                                            <hr>
                                            <p>
                                                <span>GHC </span><b>{{$aloan->amount_requested}}</b>
                                            </p>
                                            <hr>
                                            <h3>
                                                <b style="color: #8A5241">Status</b>
                                            </h3>
                                            <p>{{$aloan->name}}</p>
                                            <hr>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>

                </div>

            </div>


            {{--Pending--}}
            <div class="panel panel-default target">
                <div class="panel-heading" contenteditable="false" style="background-color: #8A5241; color: #fff;">
                    Pending Loans
                </div>
                <div class="panel-body">
                    <div class="row">
                        @foreach($ploans as $ploan)
                            <div class="col-md-4">
                                <div class="thumbnail">
                                    <div class="caption">
                                        <h3>
                                            <b style="color: #8A5241">Amount Requested</b>
                                        </h3>
                                        <hr>
                                        <p>
                                            <span>GHC </span><b>{{$ploan->amount_requested}}</b>
                                        </p>
                                        <hr>
                                        <h3>
                                            <b style="color: #8A5241">Status</b>
                                        </h3>
                                        <p>{{$ploan->name}}</p>
                                        <hr>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                </div>

            </div>

            {{--Refused--}}
            <div class="panel panel-default target">
                <div class="panel-heading" contenteditable="false" style="background-color: #8A5241; color: #fff;">
                    Refused Loans
                </div>
                <div class="panel-body">
                    <div class="row">
                        @if($rloans)
                            @foreach($rloans as $rloan)
                                <div class="col-md-4">
                                    <div class="thumbnail">
                                        <div class="caption">
                                            <h3>
                                                <b style="color: #8A5241">Amount Requested</b>
                                            </h3>
                                            <hr>
                                            <p>
                                                <span>GHC </span><b>{{$rloan->amount_requested}}</b>
                                            </p>
                                            <hr>
                                            <h3>
                                                <b style="color: #8A5241">Status</b>
                                            </h3>
                                            <p>{{$rloan->name}}</p>
                                            <hr>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>

                </div>

            </div>
        </div>


        <div id="push"></div>
    </div>

    <script src="/plugins/bootstrap-select.min.js"></script>
    <script src="/codemirror/jquery.codemirror.js"></script>
    <script src="/beautifier.js"></script>

    <script src="/plugins/bootstrap-pager.js"></script>
    </div>

@stop