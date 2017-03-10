
@extends('admin/master')

@section('stylesheets')
@endsection

@section('content')
<div class="row">
    <div class="col-lg-12">
        <h3>Artikel categorie toevoegen</h3>

        <hr />

        @include('partials.errors')

        <form method="POST" action="{{ route('admin.articles.categories.store') }}" enctype="multipart/form-data" class="form-horizontal">
            {!! csrf_field() !!}
           @include('admin.articles.categories.form')
        </form>

        <hr />

    </div>
</div>
@endsection

@section('scripts')
@endsection