
@extends('admin.master')

@section('stylesheets')
    @include('admin.articles.styles')
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">

            <h3>Blog bewerken</h3>
            @include('flash::message')
            @include('partials.errors')

            <form method="POST" action="{{ route('admin.articles.update', ['article' => $article->slug]) }}" enctype="multipart/form-data" class="form-horizontal">
                {!! csrf_field() !!}
                <input type="hidden" name="_method" value="put">
                @include('admin.articles.form')
            </form>

        </div>
    </div>
@endsection

@section('scripts')
    @include('admin.articles.scripts')
@endsection