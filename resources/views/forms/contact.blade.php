@extends('master')

@section('content')
    <div id="content">
        <div class="secten-content contact-section">
            <div class="container">
                <div class="contact-info">
                    <div class="title-section">
                        <h1>Contact</h1>
                        <span>Vragen, opmerkingen of suggesties? Shoot!</span>
                    </div>
                    <div class="row">

                        @include('flash::message')
                        @if (count($errors->contact) > 0)
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->contact->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form method="POST" action="{{ route('contact') }}" class="form-horizontal">
                            {!! csrf_field() !!}
                            {!! Form::hidden('remember', 1) !!}

                            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                                <label for="name" class="col-sm-2 control-label">Email</label>
                                <div class="col-sm-10">
                                    {!! Form::text('name', old('name'), ['class' => 'form-control', 'placeholder' => 'Uw naam *']) !!}
                                </div>
                            </div>

                            <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                                <label for="email" class="col-sm-2 control-label">Email</label>
                                <div class="col-sm-10">
                                    {!! Form::text('email', old('email'), ['class' => 'form-control', 'placeholder' => 'E-mailadres *']) !!}
                                </div>
                            </div>

                            <div class="form-group {{ $errors->has('telephone') ? 'has-error' : '' }}">
                                <label for="telephone" class="col-sm-2 control-label">Telefoonnummer</label>
                                <div class="col-sm-10">
                                    {!! Form::text('telephone', old('telephone'), ['class' => 'form-control', 'placeholder' => 'Telefoonnummer']) !!}
                                </div>
                            </div>

                            <div class="form-group {{ $errors->has('body') ? 'has-error' : '' }}">
                                <label for="body" class="col-sm-2 control-label">Vraag / opmerking</label>
                                <div class="col-sm-10">
                                    {!! Form::textarea('body', old('body'), ['class' => 'form-control', 'placeholder' => 'Uw bericht / vraag *']) !!}
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="captcha" class="col-sm-2 control-label">Beveiliging</label>
                                <div class="col-sm-10">
                                    {!! Recaptcha::render() !!}
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    {!! Form::submit( 'Verstuur uw bericht' , ['name' => 'send', 'class' => 'submit right']) !!}
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection