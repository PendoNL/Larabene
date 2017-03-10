
@extends('admin/master')

@section('stylesheets')
@endsection

@section('content')
<div class="row">
    <div class="col-lg-12">

        <h3>Content pagina bewerken</h3>

        <hr />

        @include('flash::message')
        @include('partials.errors')

        <form method="POST" action="{{ route('admin.content.update', ['content' => $content->slug]) }}" enctype="multipart/form-data" class="form-horizontal">
            {!! csrf_field() !!}
            <input type="hidden" name="_method" value="put">
            @include('admin.content.form')
        </form>

        <hr />

    </div>
</div>
@endsection

@section('scripts')
    <script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
    <script src="/vendor/unisharp/laravel-ckeditor/adapters/jquery.js"></script>
    <script>
        $('#content').ckeditor({
            filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
            filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token={{csrf_token()}}',
            filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
            filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token={{csrf_token()}}'
        });
    </script>
@endsection