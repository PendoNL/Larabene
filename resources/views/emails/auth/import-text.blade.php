Beste {{ $member->first_name }},

Vol trots sturen we je de inloggegevens van Rumbold.

Het nieuwe portaal biedt via jouw persoonlijke dashboard een duidelijk overzicht van alle activiteiten binnen de RUMBOLD community. Het is daarnaast makkelijker geworden om je aan te melden voor bijeenkomsten, vragen te stellen aan andere Rumbold-leden en je hebt tevens de mogelijkheid om zelf een verdiepingssessie te organiseren.

[Uw Inloggegevens]

Gebruikersnaam: {{ $member->email }}

U kunt uw wachtwoord zelf kiezen via de volgende link:
[Wachtwoord instellen]({{ route('auth.resetpw', ['token' => $token]) }})

Wij werken aan nieuwe features, zoals de bibliotheek, die ook snel geactiveerd zullen worden. Mocht je vragen hebben, gelieve contact op te nemen met esther.smeets@rumbold.nl  of 0629623004

Veel plezier!