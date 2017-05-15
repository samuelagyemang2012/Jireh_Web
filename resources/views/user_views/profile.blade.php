@extends('master')

@section('nav')
    <body>
    <nav class="navbar-default" style=" background-color: #8A5241;border: none">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="#">Jireh Microfinance Ltd</a>
            </div>
            <ul class="nav navbar-nav">
                <li><a href="\profile"><b class="myfont">My Loans</b></a></li>
                <li><a href="\loan"><b class="myfont">Request A Loan</b></a></li>
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
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h3>My Loans</h3>
                    <hr>
                    {{--                @if()--}}

                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>Purpose</th>
                            <th>Date</th>
                            <th>Amount Requested (GHS)</th>
                            <th>Status</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($loans as $loan)
                            <tr>
                                <td>{{$loan->purpose_of_loan}}</td>
                                <td>{{$loan->date_applied}}</td>
                                <td>{{$loan->amount_requested}}</td>
                                <td>{{$loan->name}}</td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
@stop