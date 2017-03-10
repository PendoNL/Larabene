
@extends('admin.master')

@section('stylesheets')
    @include('admin.articles.styles')
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h3>Blog maken</h3>

            @include('partials.errors')

            <form method="POST" action="{{ route('admin.articles.store') }}" enctype="multipart/form-data" class="form-horizontal">
                {!! csrf_field() !!}
               @include('admin.articles.form')
            </form>

        </div>
    </div>
@endsection

@section('scripts')
    @include('admin.articles.scripts')
@endsection