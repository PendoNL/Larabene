@extends('master')

@section('content')
    <div id="content">
        <div class="secten-content contact-section">
            <div class="container">
                <div class="contact-info">
                    <div class="title-section">
                        <h1>Wachtwoord</h1>
                        <span>Vul onderstaand formulier in om je wachtwoord te herstellen</span>
                    </div>
                    <div class="row">

                        @include('flash::message')
                        @include('partials.errors')

                        <form method="POST" action="{{ route('auth.resetpw') }}" class="form-horizontal">
                            {!! csrf_field() !!}
                            {!! Form::hidden('remember', 1) !!}

                            <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                                <label for="email" class="col-sm-2 control-label">Email</label>
                                <div class="col-sm-10">
                                    <input type="email" name="email" value="{{ old('email') }}" class="form-control" id="email" placeholder="E-mail *">
                                </div>
                            </div>

                            <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
                                <label for="password" class="col-sm-2 control-label">Password</label>
                                <div class="col-sm-10">
                                    <input type="password" class="form-control" placeholder="Nieuw wachtwoord *" name="password" id="password">
                                </div>
                            </div>

                            <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
                                <label for="password" class="col-sm-2 control-label">Password</label>
                                <div class="col-sm-10">
                                    <input type="password" class="form-control" placeholder="Herhaal wachtwoord *" name="password_confirmation" id="password">
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    {!! Form::submit( 'Herstellen' , ['class' => 'submit btn btn-primary btn-m']) !!}
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection