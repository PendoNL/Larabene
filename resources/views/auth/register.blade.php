@extends('master')

@section('content')
    <div id="content">
        <div class="secten-content contact-section">
            <div class="container">
                <div class="contact-info">
                    <div class="title-section">
                        <h1>Registreren</h1>
                        <span>Wordt lid van onze community</span>
                    </div>
                    <div class="row">

                        @include('flash::message')
                        @include('partials.errors')

                        <form method="POST" action="{{ route('auth.register') }}" class="form-horizontal">
                            {!! csrf_field() !!}
                            {!! Form::hidden('remember', 1) !!}

                            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                                <label for="name" class="col-sm-2 control-label">Email</label>
                                <div class="col-sm-10">
                                    <input type="text" name="name" value="{{ old('name') }}" class="form-control" id="name" placeholder="Je naam *">
                                </div>
                            </div>

                            <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                                <label for="email" class="col-sm-2 control-label">Email</label>
                                <div class="col-sm-10">
                                    <input type="email" name="email" value="{{ old('email') }}" class="form-control" id="email" placeholder="E-mail *">
                                </div>
                            </div>

                            <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
                                <label for="password" class="col-sm-2 control-label">Password</label>
                                <div class="col-sm-10">
                                    <input type="password" class="form-control" placeholder="Wachtwoord *" name="password" id="password">
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
                                    {!! Form::submit( 'Aanmelden' , ['class' => 'submit btn btn-primary btn-m']) !!}
                                    <a href="{{ route('auth.login') }}">Ik wil inloggen</a>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection