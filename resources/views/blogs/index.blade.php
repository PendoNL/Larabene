@extends('master')

@section('stylesheets')
@endsection

@section('content')
    <div class="page-title">
        <div class="row">
            <div class="col-md-9 col-xs-12">
                <h1><b>The best</b><br>is yet to come.</h1>
            </div>
        </div>
    </div>

    <div class="portfolio">

        @if(Route::currentRouteName() == 'blogs.index')
        <div class="filters">
            <span>Filter :</span>
            <ul id="filters">
                <li class="active" data-filter="*">Alles</li>
                @foreach(\App\ArticleCategory::alphabetical()->get() as $category)
                    @if(count($category->articles) > 0)
                        <li data-filter=".filter-{{ $category->slug }}">{{ $category->name }}</li>
                    @endif
                @endforeach
            </ul>
        </div>
        @endif

        <div class="row portfolio-masonry">
            @foreach($blogs as $item)
                <div class="selector col-md-4 col-sm-6 col-xs-12 filter-{{ $item->category->slug }}">
                    <a href="{{ route('blogs.show', [$item->category->slug, $item->slug]) }}">
                        <div class="item">
                            <div class="overlay">
                                <div class="inner-overlay">
                                    <h3>{{ $item->title }}</h3>
                                    <span>{{ $item->category->name }}</span>
                                </div>
                            </div>
                            <img src="uploads/articles/{{ $item->image }}" alt="{{ $item->title }}">
                        </div>
                    </a>
                </div>
            @endforeach
        </div>

        {!! $blogs->render() !!}
    </div>
@endsection

@section('scripts')
@endsection