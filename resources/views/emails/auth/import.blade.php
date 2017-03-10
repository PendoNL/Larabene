@extends('emails.base')

@section('content')
    <tr>
        <td align="left" style="color: #414655; font-size: 24px; font-family: 'Questrial', sans-serif; mso-line-height-rule: exactly; line-height: 32px;" class="main-header title_color">
            <div style="line-height: 32px;">
                Beste {{ $member->first_name }},<br><br>
                Vol trots sturen we je de inloggegevens van Rumbold.

            </div>
        </td>
    </tr>

    <tr><td height="25" style="font-size: 25px; line-height: 25px;">&nbsp;</td></tr>

    <tr>
        <td align="left" style="color: #848999; font-size: 14px; font-family: 'Questrial', sans-serif; mso-line-height-rule: exactly; line-height: 26px;" class="text_color">
            <div style="line-height: 26px">
                Het nieuwe portaal biedt via jouw <b>persoonlijke dashboard</b> een duidelijk overzicht van <b>alle activiteiten</b> binnen de RUMBOLD community. Het is daarnaast makkelijker geworden om je aan te melden voor bijeenkomsten, vragen te stellen aan andere Rumbold-leden en je hebt tevens de mogelijkheid om <b>zelf een verdiepingssessie</b> te organiseren.<br><br>

                <h1><b>Uw Inloggegevens</b><br></h1><br>
                Gebruikersnaam: {{ $member->email }}<br><br>
                U kunt uw wachtwoord zelf kiezen via de volgende link:<br>
                <a href="{{ route('auth.resetpw', ['token' => $token]) }}">{{ route('auth.resetpw', ['token' => $token]) }}</a><br><br>

                Wij werken aan nieuwe features, zoals de bibliotheek, die ook snel geactiveerd zullen worden. Mocht je vragen hebben, gelieve contact op te nemen met <a href="mailto:esther.smeets@rumbold.nl">esther.smeets@rumbold.nl</a>  of 0629623004<br><br>
                Veel plezier!
            </div>
        </td>
    </tr>
@endsection