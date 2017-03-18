<!DOCTYPE html>
<html lang="en">

<head>
    <base href="{{ url('/') }}" />

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Pendo Admin</title>

    <!-- Bootstrap Core CSS -->
    <link href="admintpl/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="admintpl/bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">
    <link href="admintpl/dist/css/timeline.css" rel="stylesheet">
    <link href="admintpl/dist/css/sb-admin-2.css" rel="stylesheet">
    <link href="admintpl/bower_components/morrisjs/morris.css" rel="stylesheet">
    <link href="admintpl/bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    @yield('stylesheets')

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

<div id="wrapper">

    <!-- Navigation -->
    <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{ route('admin.dashboard') }}">Pendo Admin</a>
        </div>
        <!-- /.navbar-header -->

        <ul class="nav navbar-top-links navbar-right">
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                </a>
                <ul class="dropdown-menu dropdown-user">
                    <li><a href="{{ route('auth.logout') }}"><i class="fa fa-sign-out fa-fw"></i> Uitloggen</a>
                    </li>
                </ul>
            </li>
        </ul>

        <div class="navbar-default sidebar" role="navigation">
            <div class="sidebar-nav navbar-collapse">
                <ul class="nav" id="side-menu">
                    <li>
                        <a href="{{ url('/') }}"><i class="fa fa-globe fa-fw"></i> Naar de website</a>
                    </li>
                    <!-- Log Viewer -->
                    <li>
                        <a href="{{ route('admin.logs') }}"><i class="fa fa-file-text fa-fw"></i> Logviewer</a>
                    </li>
                    <!-- Content Menu -->
                    <li>
                        <a href="#"><i class="fa fa-user fa-fw"></i> Content<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li><a href="{{ route('admin.content') }}">Overzicht</a></li>
                            <li><a href="{{ route('admin.content.create') }}">Toevoegen</a></li>
                        </ul>
                    </li>
                    <!-- Blog / Kennis Menu -->
                    <li>
                        <a href="#"><i class="fa fa-rss fa-fw"></i> Artikelen<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li><a href="{{ route('admin.articles') }}">Overzicht</a></li>
                            <li><a href="{{ route('admin.articles.create') }}">Toevoegen</a></li>
                            <li><a href="{{ route('admin.articles.categories') }}">Categoriebeheer</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
            <!-- /.sidebar-collapse -->
        </div>
        <!-- /.navbar-static-side -->
    </nav>

    <div id="page-wrapper">

        @yield('content')

    </div>
    <!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->

<!-- Javascript -->
<script src="admintpl/bower_components/jquery/dist/jquery.min.js"></script>
<script src="admintpl/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="admintpl/bower_components/metisMenu/dist/metisMenu.min.js"></script>
<script src="admintpl/bower_components/raphael/raphael-min.js"></script>
<script src="admintpl/dist/js/sb-admin-2.js"></script>
@yield('scripts')

</body>

</html>