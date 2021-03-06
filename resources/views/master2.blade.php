<!DOCTYPE>
<html>

<head>
    <meta charset="utf-8"/>
    {{--<meta name="format-detection" content="telephone=no"/>--}}
    {{--<meta name="msapplication-tap-highlight" content="no"/>--}}
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{asset('css/mycss.css')}}">
    <link rel="stylesheet" href="{{asset('css/site.css')}}">
    <link rel="stylesheet" href="{{asset('css/bootstrap.css')}}">
    <link rel="stylesheet" href="{{asset('css/bootstrap-grid.css')}}">

    <script type="text/javascript" src="{{asset('js/jquery.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/validate.js')}}"></script>

    <script>
        $(document).ready(function () {
            $('[data-toggle="offcanvas"]').click(function () {
                $("#navigation").toggleClass("hidden-xs");
            });
        });
    </script>
</head>


<body>

<div class="container-fluid display-table">
    <div class="row display-table-row">
        <div class="col-md-2 col-sm-1 hidden-xs display-table-cell v-align box" id="navigation">

            <div class="navi" style="background-color: #8A5241">
                <ul style="background-color: #8A5241">
                    <li class="active"><a href="#"><i class="fa fa-home" aria-hidden="true"></i><span
                                    class="hidden-xs hidden-sm">Home</span></a></li>
                    <li><a href="{{route('all')}}"><i class="fa fa-tasks" aria-hidden="true"></i><span class="hidden-xs hidden-sm">All Loans</span></a>
                    </li>
                    <li><a href="{{route('pending')}}"><i class="fa fa-bar-chart" aria-hidden="true"></i><span
                                    class="hidden-xs hidden-sm">Pending Loans</span></a>
                    </li>
                    <li><a href="{{route('approved')}}"><i class="fa fa-user" aria-hidden="true"></i><span
                                    class="hidden-xs hidden-sm">Approved Loans</span></a>
                    </li>
                    {{--<li><a href="#"><i class="fa fa-calendar" aria-hidden="true"></i><span class="hidden-xs hidden-sm">Manage Clients</span></a>--}}
                    </li>
                    {{--<li><a href="#"><i class="fa fa-cog" aria-hidden="true"></i><span class="hidden-xs hidden-sm">Add New Admin</span></a>--}}
                    </li>
                </ul>
            </div>
        </div>

        <div class="col-md-10 col-sm-11 display-table-cell v-align">
            <!--<button type="button" class="slide-toggle">Slide Toggle</button> -->
            <div class="row">

                <header style="background-color: #8A5241">
                    <center><h4 class="thead">{{$title}}</h4></center>
                    @yield('title')
                    <div class="col-md-7">
                        <nav class="navbar-default pull-left">
                            <div class="navbar-header">
                                <button type="button" class="navbar-toggle collapsed" data-toggle="offcanvas"
                                        data-target="#side-menu" aria-expanded="false">
                                    <span class="sr-only">Toggle navigation</span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                </button>
                            </div>
                        </nav>
                    </div>

                    <div class="col-md-5">
                        <div class="header-rightside">
                            <ul class="list-inline header-top pull-right">

                                <li><a href="#"><i class="fa fa-envelope" aria-hidden="true"></i></a></li>

                            </ul>
                        </div>
                    </div>
                </header>

            </div>

            <div class="user-dashboard">
                <br>
                {{--actual data--}}
                <div class="row">

                    @yield('content')
                    {{--<div class="col-md-12 col-sm-12 col-xs-12 gutter">--}}
                    {{--<table class="table table-responsive">--}}
                    {{--<thead>--}}
                    {{--<th>Surname</th>--}}
                    {{--<th>First Name</th>--}}
                    {{--<th>Amount Requested</th>--}}
                    {{--<th>Telephone (Mobile)</th>--}}
                    {{--<th>Date Issued</th>--}}
                    {{--<th></th>--}}
                    {{--</thead>--}}

                    {{--<tbody>--}}
                    {{--<tr>--}}
                    {{--<td class="">aba</td>--}}
                    {{--<td>aba</td>--}}
                    {{--<td>aba</td>--}}
                    {{--<td>aba</td>--}}
                    {{--<td>aba</td>--}}
                    {{--<td>--}}
                    {{--<button st>More Details</button>--}}
                    {{--</td>--}}
                    {{--</tr>--}}
                    {{--</tbody>--}}
                    {{--</table>--}}
                    {{--</div>--}}

                </div>
            </div>

        </div>

    </div>

</div>