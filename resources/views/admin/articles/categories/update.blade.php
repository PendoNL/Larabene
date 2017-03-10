@extends('admin/master')

@section('stylesheets')
@endsection

@section('content')
<div class="row">
    <div class="col-lg-12">

        <h3>Artikel categorie bewerken</h3>

        <hr />

        @include('flash::message')
        @include('partials.errors')

        <form method="POST" action="{{ route('admin.articles.categories.update', ['articlecategory' => $category->slug]) }}" enctype="multipart/form-data" class="form-horizontal">
            {!! csrf_field() !!}
            <input type="hidden" name="_method" value="put">
            @include('admin.articles.categories.form')
        </form>

        <hr />

    </div>
</div>
@endsection

@section('scripts')
@endsection