@extends('emails.base')

@section('content')
    Beste {{ $member->full_name }}

    Uw account is geactiveerd, u kunt inloggen met onderstaande gegevens:

    E-mailadres: {{ $member->email }}
    Wachtwoord: {{ $password }}
@endsection