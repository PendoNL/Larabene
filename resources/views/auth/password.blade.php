@extends('master')

@section('content')
    <div id="content">
        <div class="secten-content contact-section">
            <div class="container">
                <div class="contact-info">
                    <div class="title-section">
                        <h1>Wachtwoord vergeten</h1>
                        <p>Vul onderstaand formulier in om je wachtwoord te herstellen</p>
                    </div>
                    <div class="row">

                        @include('flash::message')
                        @include('partials.errors')

                        <form method="POST" action="{{ route('auth.reset') }}" class="form-horizontal">
                            {!! csrf_field() !!}

                            <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                                <label for="email" class="col-sm-2 control-label">Email</label>
                                <div class="col-sm-10">
                                    <input type="email" name="email" value="{{ old('email') }}" class="form-control" id="email" placeholder="E-mail *">
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    {!! Form::submit( 'Wachtwoord herstellen' , ['class' => 'submit btn btn-primary btn-m']) !!}
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection