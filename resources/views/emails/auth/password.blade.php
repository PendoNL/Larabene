@extends('emails.base')

@section('content')
    Klik op deze link om uw wachtwoord te herstellen: {{ route('auth.resetpw', ['token' => $token]) }}
@endsection