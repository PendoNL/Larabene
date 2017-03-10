@extends('emails.base')

@section('content')
    Welkom {{ $member->full_name }},

    bedankt voor je registratie op onze website. Je hebt gekozen voor een {{ $member->account_choice }} lidmaatschap. Wij nemen zo snel mogelijk contact met je op om je account te activeren.

    Ga naar de website: {{ url() }}
@endsection