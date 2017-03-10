<!doctype html>


<html lang="en" class="no-js">
<head>
    <base href="{{ url() }}" />
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <link rel="stylesheet" type="text/css" href="{{ elixir("css/all.css") }}" />
    <link href='http://fonts.googleapis.com/css?family=Quicksand:300,400,700' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" type="text/css" href="//maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" />
    @yield('stylesheets')

    <!-- Page Title -->
    <title>{{ $meta['title'] or 'Laravel Belgi&euml; & Nederland' }}</title>
    <meta type="keywords" value="{{ $meta['keywords'] or 'Laravel, Community, Belgie, Nederland, Freelance, Opdrachten, Nieuws' }}" />
    <meta type="description" value="{{ $meta['description'] or 'Belgisch/Nederlandse Laravel Community' }}" />

    @yield('head-tags')
</head>
<body>

<!-- Container -->
<div id="container" class="skin-version">
    <!-- Header
        ================================================== -->
    <header class="clearfix">
        <!-- Static navbar -->
        <div class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#"><img alt="" src="images/white-logo.png"></a>
                </div>
                <div class="navbar-collapse collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="{{ url() }}" class="{{ is_active('content.home') }}">Home</a></li>
                        @foreach(\App\Content::all() as $page)
                        <li>
                            <a href="{{ route('content.show', [$page->slug]) }}" class="{{ is_active_url(route('content.show', [$page->slug])) }}">{{ $page->menu_text }}</a>
                        </li>
                        @endforeach
                        <li class="drop">
                            <a href="{{ route('blogs.index') }}" class="{{ is_active_url('blog') }}">Blog</a>
                            <ul class="dropdown">
                                @foreach(\App\ArticleCategory::alphabetical()->get() as $category)
                                    @if(count($category->articles) > 0)
                                        <li><a href="{{ route('blogs.index.category', [$category->slug]) }}">{{ $category->name }}</a></li>
                                    @endif
                                @endforeach
                            </ul>
                        </li>
                        <li><a href="{{ route('contact') }}" class="{{ is_active('contact') }}">Contact</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </header>
    <!-- End Header -->

    @yield('content')


    <!-- footer
        ================================================== -->
    <footer>


        <div class="container">
            <div class="footer-line">
                <p> &copy; {{ date("Y") }} - Laravel Belgi&euml; & Nederland - Website door <a href="https://pendo.nl" target="_blank">Pendo.</a></p>
                <ul class="footer-social-icons">
                    <li><a class="slack" href="https://larabene.slack.com"><i class="fa fa-slack"></i></a></li>
                </ul>
            </div>
        </div>

    </footer>
    <!-- End footer -->
</div>
<!-- End Container -->

<div class="preloader">
    <img alt="" src="images/preloader.gif">
</div>

<script async src="{{ elixir("js/all.js") }}"></script>
@yield('scripts')

@if(request()->header('User-Agent') != null && request()->header('User-Agent') != "Speed Insights")
<!-- Javascripts for users only (Analytics, Chatboxes, etc.)
@endif

</body>
</html>