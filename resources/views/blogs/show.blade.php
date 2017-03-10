@extends('master')

@section('stylesheets')
@endsection

@section('head-tags')
<meta property="og:title" content="{{ $blog->title }}" />
<meta property="og:url" content="{{ route('blogs.show', ['articlecategory' => $blog->category->slug, 'article' => $blog->slug]) }}" />
@if($blog->image != "" && file_exists(public_path('uploads/articles/'.$blog->image)))
<meta property="og:image" content="{{ url('uploads/articles/'.$blog->image) }}" />
@endif
<meta property="og:description" content="{{ truncate_nonhtml($blog->content, 140) }}" />
<meta property="og:site_name" content="Pendo." />
@endsection

@section('content')
    <div id="content">
        <div class="secten-content blog-section">
            <div class="container">
                <div class="row">
                    <div class="col-md-9">
                        <div class="blog-box">
                            <div class="title-section">
                                <h1>Blog & nieuws</h1>
                                <span>verse van de pers</span>
                            </div>
                            <div class="blog-post">
                                <img src="uploads/articles/thumb.{{ $blog->image }}" alt="{{ $blog->title }}" />
                                <div class="blog-title">
                                    <h2><a href="{{ route('blogs.show', [$blog->category->slug, $blog->slug]) }}">{{ $blog->title }}</a></h2>
                                    <ul class="post-tags">
                                        <li><i class="fa fa-calendar-o"></i> {{ $blog->date->format('d-m-Y') }}</li>
                                        <li><i class="fa fa-folder"></i> <a href="#">{{ $blog->category->name }}</a></li>
                                        <li><i class="fa fa-user"></i> <a href="#">{{ $blog->user->name }}</a></li>
                                    </ul>
                                </div>
                                {!! $blog->content !!}
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="sidebar">

                            <div class="sidebar-widget social-widget">
                                <h2>Delen</h2>
                                <div class="addthis_sharing_toolbox"></div>
                            </div>

                            <div class="sidebar-widget social-widget">
                                <h2>Social Icons</h2>
                                <ul class="sidebar-social">
                                    <li><a class="google" href="https://larabene.slack.com"><i class="fa fa-slack"></i></a></li>
                                </ul>
                            </div>

                            <div class="sidebar-widget tag-widget">
                                <h2>Onderwerpen</h2>
                                <ul class="tag-list">
                                    @foreach(\App\ArticleCategory::alphabetical()->get() as $category)
                                        @if(count($category->articles) > 0)
                                            <li><a href="{{ route('blogs.index.category', [$category->slug]) }}">{{ $category->name }}</a></li>
                                        @endif
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-51a3c16657264aef"></script>
@endsection