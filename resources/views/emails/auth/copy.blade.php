Onderstaande gebruiker heeft een profiel geregistreerd op Rumbold.

Naam: {{ $member->full_name }} ({{ $member->sex }})
Account keuze: {{ $member->account_choice }}
Groep keuze: {{ $groupname }}

Woonplaats: {{ $member->city }}
E-mailadres: {{ $member->email }}
Telefoonnummer: {{ $member->telephone }}
Bedrijf: {{ $member->company }}
Functie: {{ $member->function }}

<strong>Factuurgegevens</strong>
Bedrijfsnaam: {{ $member->inv_company }}
Contact: {{ $member->inv_contact }}
Telefoonnummer: {{ $member->inv_telephone }}
PO Bus: {{ $member->inv_po }}
Adres: {{ $member->inv_address }}

Bekijk het profiel van de gebruiker <a href="{{ route('member.profile', ['user' => $member->slug]) }}">hier</a>.