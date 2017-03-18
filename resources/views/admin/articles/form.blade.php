<div class="form-group {{ $errors->has('category_id') ? 'has-error' : '' }}">
    {!! Form::label('category_id', 'Categorie:', ['class' => 'control-label col-sm-2']) !!}
    <div class="col-sm-10">
        {!! Form::select('category_id', $category_list, isset($article->category_id) ? $article->category_id : 0, ['class' => 'form-control']) !!}
    </div>
</div>

<div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
    {!! Form::label('title', 'Titel:', ['class' => 'control-label col-sm-2']) !!}
    <div class="col-sm-10">
        {!! Form::text('title', $article->title, ['class' => 'form-control']) !!}
    </div>
</div>

<div class="form-group {{ $errors->has('content') ? 'has-error' : '' }}">
    {!! Form::label('content', 'Blog:', ['class' => 'control-label col-sm-2']) !!}
    <div class="col-sm-10">
        {!! Form::textarea('content', $article->content, ['class' => 'ckeditor form-control', 'id' => 'about']) !!}
    </div>
</div>

<div class="form-group {{ $errors->has('tags') ? 'has-error' : '' }}">
    {!! Form::label('tags', 'Tags:', ['class' => 'control-label col-sm-2']) !!}
    <div class="col-sm-10">
        {!! Form::text('tags', $article->tags, ['class' => 'form-control']) !!}
    </div>
</div>

<div class="row">
    <div class="col-lg-6">
        <div class="form-group {{ $errors->has('image') ? 'has-error' : '' }}">
            {!! Form::label('image', 'Banner (800px breed):', ['class' => 'control-label']) !!}
            {!! Form::file('image') !!}
        </div>
    </div>
    <div class="col-lg-6">
        @if( file_exists( public_path('uploads/articles/' . $article->image)) && $article->image != "")
            <img src="uploads/articles/{{ $article->image }}" style="max-width: 100% !important;" />
            <a href="{{ route('admin.articles.edit.remove_banner', ['article' => $article->slug]) }}" class="btn red">X</a>
        @endif
    </div>
</div>

{!! Form::submit( $buttonLabel , ['class' => 'btn btn-primary']) !!}