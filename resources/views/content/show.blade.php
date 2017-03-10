@extends('master')

@section('content')
    <div id="content">
        <div class="secten-content about-section">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="history">
                            <div class="title-section">
                                <h1>{{ $content->menu_text }}</h1>
                                <span>{{ $content->title }}</span>
                            </div>
                            {!! $content->content !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection