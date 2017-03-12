@extends('master')

@section('content')
    <div id="content">

        <!-- contact section -->
        <div class="secten-content blog-section">
            <div class="container">

                <div class="row">
                    <div class="col-md-12">
                        <div class="blog-box">

                            @foreach(\App\Article::highlighted()->get() as $item)
                                <div class="col-md-6 col-sm-12">
                                    <div class="blog-post">
                                        <img src="uploads/articles/thumb.{{ $item->image }}" alt="{{ $item->title }}" />
                                        <div class="blog-title">
                                            <h2><a href="{{ route('blogs.show', [$item->category->slug, $item->slug]) }}">{{ $item->title }}</a></h2>
                                            <ul class="post-tags">
                                                <li><i class="fa fa-calendar-o"></i> {{ $item->created_at->format('d-m-Y') }}</li>
                                                <li><i class="fa fa-folder"></i> <a href="{{ route('blogs.index.category', [$item->category->slug]) }}">{{ $item->category->name }}</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection