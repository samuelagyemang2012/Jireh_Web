@extends('master2')

@section('content')
    {{--<body>--}}
    <div class="bg-dark dk" id="wrap">
        <div id="top">
            <!-- .navbar -->
            <nav class="navbar navbar-inverse navbar-static-top">
                <div class="container-fluid">

                    <!-- Brand and toggle get grouped for better mobile display -->
                    <header class="navbar-header">

                        <button type="button" class="navbar-toggle" data-toggle="collapse"
                                data-target=".navbar-ex1-collapse">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a href="index.html" class="navbar-brand">
                            {{--<img src="assets/img/logo.png" alt="">--}}
                        </a>

                    </header>


                    <div class="topnav">
                        <div class="btn-group">
                            <a data-placement="bottom" data-original-title="Fullscreen" data-toggle="tooltip"
                               class="btn btn-default btn-sm" id="toggleFullScreen">
                                <i class="fa fa-arrows-alt"></i>
                            </a>
                        </div>
                        <div class="btn-group">
                            {{--<a data-placement="bottom" data-original-title="E-mail" data-toggle="tooltip"--}}
                            {{--class="btn btn-default btn-sm">--}}
                            {{--<i class="fa fa-envelope"></i>--}}
                            {{--<span class="label label-warning">5</span>--}}
                            {{--</a>--}}
                            {{--<a data-placement="bottom" data-original-title="Messages" href="#" data-toggle="tooltip"--}}
                            {{--class="btn btn-default btn-sm">--}}
                            {{--<i class="fa fa-comments"></i>--}}
                            {{--<span class="label label-danger">4</span>--}}
                            {{--</a>--}}
                            {{--<a data-toggle="modal" data-original-title="Help" data-placement="bottom"--}}
                            {{--class="btn btn-default btn-sm"--}}
                            {{--href="#helpModal">--}}
                            {{--<i class="fa fa-question"></i>--}}
                            {{--</a>--}}
                        </div>
                        <div class="btn-group">
                            <a href="login.html" data-toggle="tooltip" data-original-title="Logout"
                               data-placement="bottom"
                               class="btn btn-metis-1 btn-sm">
                                <i class="fa fa-power-off"></i>
                            </a>
                        </div>
                        <div class="btn-group">
                            {{--<a data-placement="bottom" data-original-title="Show / Hide Left" data-toggle="tooltip"--}}
                            {{--class="btn btn-primary btn-sm toggle-left" id="menu-toggle">--}}
                            {{--<i class="fa fa-bars"></i>--}}
                            {{--</a>--}}
                            {{--<a href="#right" data-toggle="onoffcanvas" class="btn btn-default btn-sm"--}}
                            {{--aria-expanded="false">--}}
                            {{--<span class="fa fa-fw fa-comment"></span>--}}
                            {{--</a>--}}
                        </div>

                    </div>


                    <div class="collapse navbar-collapse navbar-ex1-collapse">

                        <!-- .nav -->
                        <ul class="nav navbar-nav">
                            <li class="active"><a href="dashboard.html">Dashboard</a></li>
                            <!--<li><a href="table.html">Tables</a></li>-->
                            <!--<li class='dropdown '>-->
                            <!--<a href="#" class="dropdown-toggle" data-toggle="dropdown">-->
                            <!--Form Elements <b class="caret"></b>-->
                            <!--</a>-->
                            <!--<ul class="dropdown-menu">-->
                            <!--<li><a href="form-general.html">General</a></li>-->
                            <!--<li><a href="form-validation.html">Validation</a></li>-->
                            <!--<li><a href="form-wysiwyg.html">WYSIWYG</a></li>-->
                            <!--<li><a href="form-wizard.html">Wizard &amp; File Upload</a></li>-->
                            <!--</ul>-->
                            <!--</li>-->
                        </ul>
                        <!-- /.nav -->
                    </div>
                </div>
                <!-- /.container-fluid -->
            </nav>
            <!-- /.navbar -->
            <header class="head">
                <div class="search-bar">
                    <form class="main-search" action="">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Live Search ...">
                                            <span class="input-group-btn">
                                                <button class="btn btn-primary btn-sm text-muted" type="button">
                                                    <i class="fa fa-search"></i>
                                                </button>
                                            </span>
                        </div>
                    </form>
                    <!-- /.main-search -->                                </div>
                <!-- /.search-bar -->
                <div class="main-bar">
                    <h3>
                        <i class="fa fa-dashboard"></i>&nbsp;
                        Dashboard
                    </h3>
                </div>
                <!-- /.main-bar -->
            </header>
            <!-- /.head -->
        </div>
        <!-- /#top -->
        <div id="left">
            <div class="media user-media bg-dark dker">
                <div class="user-media-toggleHover">
                    <span class="fa fa-user"></span>
                </div>
                <div class="user-wrapper bg-dark">
                    <a class="user-link" href="">
                        {{--<img class="media-object img-thumbnail user-img" alt="User Picture" src="assets/img/user.gif">--}}
                        <span class="label label-danger user-label">16</span>
                    </a>

                    <div class="media-body">
                        <h5 class="media-heading">Archie</h5>
                        <ul class="list-unstyled user-info">
                            <li><a href="">Administrator</a></li>
                            <li>Last Access : <br>
                                <small><i class="fa fa-calendar"></i>&nbsp</small>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- #menu -->
            <ul id="menu" class="bg-blue dker">
                <li class="nav-header">Menu</li>
                <li class="nav-divider"></li>
                <li class="">
                    <a href="admin/index">
                        <i class="fa fa-dashboard"></i><span class="link-title">&nbsp;Dashboard</span>
                    </a>
                </li>

                <li class="">

                {{--<ul class="">--}}
                <li>
                    <a href="{{route('pending')}}">
                        <i class="fa fa-angle-right"></i>&nbsp; Pending Loans </a>
                </li>
                <li>
                    <a href="fixed-header-boxed.html">
                        <i class="fa fa-angle-right"></i>&nbsp; Approved Loans </a>
                </li>
                <li>
                    <a href="fixed-header-fixed-mini-sidebar.html">
                        <i class="fa fa-angle-right"></i>&nbsp; Refused Loans </a>
                </li>

                <li>
                    <a href="fixed-header-fixed-mini-sidebar.html">
                        <i class="fa fa-angle-right"></i>&nbsp; All Loans </a>
                </li>
                {{--</ul>--}}
                </li>

                <li class="">
                {{--<a href="javascript:;">--}}
                {{--<i class="fa fa-tasks"></i>--}}
                {{--<span class="link-title">Manage Clients</span>--}}
                {{--<span class="fa arrow"></span>--}}
                {{--</a>--}}

                {{--<ul class="collapse">--}}
                <li>
                    <a href="bgimage.html">
                        <i class="fa fa-angle-right"></i>&nbsp; Edit Clients Details </a>
                </li>

                <li>
                    <a href="bgimage.html">
                        <i class="fa fa-angle-right"></i>&nbsp; Add New Admin </a>
                </li>

                {{--</ul>--}}
                </li>

                <ul class="collapse">
                    <li>
                        <a href="javascript:;">Level 1 <span class="fa arrow"></span> </a>
                        <ul class="collapse">
                            <li><a href="javascript:;">Level 2</a></li>
                            <li><a href="javascript:;">Level 2</a></li>
                            <li>
                                <a href="javascript:;">Level 2 <span class="fa arrow"></span> </a>
                                <ul class="collapse">
                                    <li><a href="javascript:;">Level 3</a></li>
                                    <li><a href="javascript:;">Level 3</a></li>
                                    <li>
                                        <a href="javascript:;">Level 3 <span class="fa arrow"></span> </a>
                                        <ul class="collapse">
                                            <li><a href="javascript:;">Level 4</a></li>
                                            <li><a href="javascript:;">Level 4</a></li>
                                            <li>
                                                <a href="javascript:;">Level 4 <span class="fa arrow"></span> </a>
                                                <ul class="collapse">
                                                    <li><a href="javascript:;">Level 5</a></li>
                                                    <li><a href="javascript:;">Level 5</a></li>
                                                    <li><a href="javascript:;">Level 5</a></li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </li>
                                    <li><a href="javascript:;">Level 4</a></li>
                                </ul>
                            </li>
                            <li><a href="javascript:;">Level 2</a></li>
                        </ul>
                    </li>
                    <li><a href="javascript:;">Level 1</a></li>
                    <li>
                        <a href="javascript:;">Level 1 <span class="fa arrow"></span> </a>
                        <ul class="collapse">
                            <li><a href="javascript:;">Level 2</a></li>
                            <li><a href="javascript:;">Level 2</a></li>
                            <li><a href="javascript:;">Level 2</a></li>
                        </ul>
                    </li>
                </ul>
                </li>
            </ul>
            <!-- /#menu -->
        </div>
        <!-- /#left -->
        <div id="content">
            <div class="outer">
                <div class="inner bg-light lter">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Surname</th>
                            <th>Firstname</th>
                            <th>Email</th>
                            <th>Telephone (Mobile)</th>
                            <th>Amount Requested</th>
                            <th></th>
                            <th></th>
                            {{--<th></th>--}}
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($pending as $pend)
                            <tr>
                                <form method="post" action="{{route('details')}}">
                                    {{csrf_field()}}
                                    <td>{{$pend->surname}}</td>
                                    <td>{{$pend->firstname}}</td>
                                    <td>{{$pend->email}}</td>
                                    <td>{{$pend->telephone_mobile}}</td>
                                    <td><span>GHC </span>{{$pend->amount_requested}}</td>
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
                    <hr>
                    <hr>
                </div>
                <!-- /.inner -->
            </div>
            <!-- /.outer -->
        </div>
        <!-- /#content -->

        <div id="right" class="onoffcanvas is-right is-fixed bg-light" aria-expanded=false>
            <a class="onoffcanvas-toggler" href="#right" data-toggle=onoffcanvas aria-expanded=false></a>
            <br>
            <br>
            <div class="alert alert-danger">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong>Warning!</strong> Best check yo self, you're not looking too good.
            </div>
            <!-- .well well-small -->
            <div class="well well-small dark">
                <ul class="list-unstyled">
                    <li>Visitor <span class="inlinesparkline pull-right">1,4,4,7,5,9,10</span></li>
                    <li>Online Visitor <span class="dynamicsparkline pull-right">Loading..</span></li>
                    <li>Popularity <span class="dynamicbar pull-right">Loading..</span></li>
                    <li>New Users <span class="inlinebar pull-right">1,3,4,5,3,5</span></li>
                </ul>
            </div>
            <!-- /.well well-small -->
            <!-- .well well-small -->
            <div class="well well-small dark">
                <button class="btn btn-block">Default</button>
                <button class="btn btn-primary btn-block">Primary</button>
                <button class="btn btn-info btn-block">Info</button>
                <button class="btn btn-success btn-block">Success</button>
                <button class="btn btn-danger btn-block">Danger</button>
                <button class="btn btn-warning btn-block">Warning</button>
                <button class="btn btn-inverse btn-block">Inverse</button>
                <button class="btn btn-metis-1 btn-block">btn-metis-1</button>
                <button class="btn btn-metis-2 btn-block">btn-metis-2</button>
                <button class="btn btn-metis-3 btn-block">btn-metis-3</button>
                <button class="btn btn-metis-4 btn-block">btn-metis-4</button>
                <button class="btn btn-metis-5 btn-block">btn-metis-5</button>
                <button class="btn btn-metis-6 btn-block">btn-metis-6</button>
            </div>
            <!-- /.well well-small -->
            <!-- .well well-small -->
            <div class="well well-small dark">
                <span>Default</span><span class="pull-right"><small>20%</small></span>

                <div class="progress xs">
                    <div class="progress-bar progress-bar-info" style="width: 20%"></div>
                </div>
                <span>Success</span><span class="pull-right"><small>40%</small></span>

                <div class="progress xs">
                    <div class="progress-bar progress-bar-success" style="width: 40%"></div>
                </div>
                <span>warning</span><span class="pull-right"><small>60%</small></span>

                <div class="progress xs">
                    <div class="progress-bar progress-bar-warning" style="width: 60%"></div>
                </div>
                <span>Danger</span><span class="pull-right"><small>80%</small></span>

                <div class="progress xs">
                    <div class="progress-bar progress-bar-danger" style="width: 80%"></div>
                </div>
            </div>
        </div>
        <!-- /#right -->
    </div>
    <!-- /#wrap -->
    <footer class="Footer bg-dark dker">
        <p>2017 &copy; Metis Bootstrap Admin Template v2.4.2</p>
    </footer>
    <!-- /#footer -->
    <!-- #helpModal -->
    <div id="helpModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Modal title</h4>
                </div>
                <div class="modal-body">
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut
                        labore
                        et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi
                        ut
                        aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                        cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in
                        culpa qui officia deserunt mollit anim id est laborum.
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
    <!-- /#helpModal -->
    <!--jQuery -->
    <script src="{{asset('js/jquery.js')}}"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.5/fullcalendar.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery.tablesorter/2.18.4/js/jquery.tablesorter.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery-sparklines/2.1.2/jquery.sparkline.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/flot/0.8.3/jquery.flot.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/flot/0.8.3/jquery.flot.selection.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/flot/0.8.3/jquery.flot.resize.min.js"></script>

    <!--Bootstrap -->
    <script src="{{asset('js/bootstrap.js')}}"></script>
    <!-- MetisMenu -->
    <script src="{{asset('js/metisMenu.js')}}"></script>
    <!-- onoffcanvas -->
    <script src="{{asset('js/onoffcanvas.js')}}"></script>
    <!-- Screenfull -->
    <script src="{{asset('js/screenfull.js')}}"></script>

    <!-- Metis core scripts -->
    <script src={{asset('js/core.js')}}></script>
    <!-- Metis demo scripts -->
    <script src="{{asset('js/app.js')}}"></script>

    <script>
        $(function () {
            Metis.dashboard();
        });
    </script>

    <script src="{{asset('js/style-switcher.js')}}"></script>
    {{--</body>--}}
@stop
