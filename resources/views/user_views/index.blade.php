@extends('master')

@section('header')
    <br>
    <br>
    <br>
    <br>

    <div class="container">

        <div class="row">
            <div class="col-4"></div>

            <div class="col-4">
                <h4 style="color: #8A5241">JIREH MICROFINANCE LIMITED</h4>
                <br>
                {{--<br>--}}

                @if (session('status'))
                    <div class="alert alert-success">
                        <p>{{ session('status') }}</p>
                    </div>
                @endif

                @if (session('log'))
                    <div class="alert alert-danger">
                        <p>{{ session('log') }}</p>
                    </div>
                @endif
                <br>

            </div>
            <br>
            <br>
            <div class="col-4"></div>
        </div>
    </div>

@stop


@section('content')
    <div class="container">
        <div class="row">
            <div class="col-4"></div>

            <div class="col-4">
                <form class="form-horizontal" method="post" action="/jireh/login">
                    {{csrf_field()}}
                    <label>Email</label>
                    <div>
                        <input type="text" class="form-control" name="email" id="lemail" required>
                    </div>
                    <br>

                    <label>Password</label>
                    <div>
                        <input type="password" class="form-control" name="password" id="lpassword" required>
                    </div>
                    <br>

                    <button class="btn btn-primary btn-block" style="background-color: #8A5241; border: none" type="submit">Login</button>

                </form>
                <br>
                <a href="/client/create">Click here to create an account!</a>
            </div>

            <div class="col-4"></div>
        </div>
    </div>
@stop