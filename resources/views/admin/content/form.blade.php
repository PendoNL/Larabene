<div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
    {!! Form::label('title', 'Titel:', ['class' => 'control-label col-sm-2']) !!}
    <div class="col-sm-10">
        {!! Form::text('title', $content->title, ['class' => 'form-control']) !!}
    </div>
</div>

<div class="form-group {{ $errors->has('menu_text') ? 'has-error' : '' }}">
    {!! Form::label('menu_text', 'Menuknop:', ['class' => 'control-label col-sm-2']) !!}
    <div class="col-sm-10">
        {!! Form::text('menu_text', $content->menu_text, ['class' => 'form-control']) !!}
    </div>
</div>

<div class="form-group {{ $errors->has('content') ? 'has-error' : '' }}">
    {!! Form::label('content', 'Pagina Inhoud:', ['class' => 'control-label col-sm-2']) !!}
    <div class="col-sm-10">
        {!! Form::textarea('content', $content->content, ['class' => 'form-control ckeditor']) !!}
    </div>
</div>

{!! Form::submit( $buttonLabel , ['class' => 'btn btn-success']) !!}