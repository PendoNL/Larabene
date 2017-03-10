<div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
    {!! Form::label('name', 'Naam:', ['class' => 'control-label col-sm-2']) !!}
    <div class="col-sm-10">
        {!! Form::text('name', $category->name, ['class' => 'form-control']) !!}
    </div>
</div>

{!! Form::submit( $buttonLabel , ['class' => 'btn btn-success']) !!}