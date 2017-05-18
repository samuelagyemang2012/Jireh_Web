@extends('master')


@section('content')
    <body class="login">

    <div class="container">
        <div class="row">
            <div class="col-4"></div>

            <div class="col-4">
                <div class="form-signin">
                    <div class="text-center">
                        <img src="{{asset('img/jireh.png')}}" alt="Metis Logo" height="100px" width="100px">
                    </div>
                    <hr>
                    <div class="tab-content">
                        <div id="login" class="tab-pane active">

                            <form action="\admin" method="post">
                                {{csrf_field()}}
                                <p class="text-muted text-center">
                                    Enter your email and password
                                </p>
                                <input type="text" placeholder="Email" class="form-control top" name="email" required>

                                <input type="password" placeholder="Password" class="form-control bottom" name="password" required>

                                {{--<div class="checkbox">--}}
                                {{--<label>--}}
                                {{--<input type="checkbox"> Remember Me--}}
                                {{--</label>--}}
                                {{--</div>--}}
                                <button class="btn btn-lg btn-primary btn-block" type="submit"
                                        style="background-color: #8A5241; border: none">Sign in
                                </button>
                            </form>
                        </div>
                    </div>
                    <hr>
                </div>
            </div>

            <div class="col-4"></div>
        </div>
    </div>

    </body>
@stop