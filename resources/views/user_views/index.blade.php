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
                <h5>JIREH MICROFINANCE LIMITED</h5>
                <br>
                {{--<br>--}}

                @if (session('status'))
                    <div class="alert alert-success">
                        <p>{{ session('status') }}</p>
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
                <form class="form-horizontal" method="post" action="/login">
                    {{csrf_field()}}
                    <label>Username</label>
                    <div>
                        <input type="text" class="form-control" name="username" id="lusername" required>
                    </div>
                    <br>

                    <label>Password</label>
                    <div>
                        <input type="password" class="form-control" name="lpassword" id="lpassword" required>
                    </div>
                    <br>

                    <button class="btn btn-primary" type="submit">Login</button>

                </form>
                <br>
                <a href="/client/create">Click here to create an account!</a>
            </div>

            <div class="col-4"></div>
        </div>
    </div>
@stop