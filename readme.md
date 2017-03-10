### Laravel Belgi&euml; en Nederland
##### Community portal

Wordt lid van de community op Slack, vraag [hier je invite aan](https://larabene.signup.team/)

Deze Github repo bevat de bronbestanden van Larabene.com, iedere Artisan uit Belgi&euml; of Nederland
is van harte welkom om lid te worden van deze community en zijn of haar steentje bij te dragen aan de
website die gebruikt wordt.

## Installatie

De installatie van de website gebeurd in een aantal eenvoudige stappen.

- Clone de repository
- Kopieer de .env.example file en vul deze *
- `composer install` en `npm install`
- `php artisan migrate`
- `php artisan vendor:publish`
- `php artisan key:generate`
- [to-do] `php artisan db:seed` **

*: Op dit moment worden enkel de [KrakenIO](https://kraken.io/) en [Recaptcha](https://www.google.com/recaptcha/intro/invisible.html) APIs gebruikt.
Beide zijn gratis te gebruiken, in geval van KrakenIO zit er wel een limiet op het gratis account maar dit is ruim voldoende om mee te testen. KrakenIO
wordt gebruikt om uploads te optimaliseren voor een betere PageSpeed.

**: Er zijn nog geen seeds beschikbaar die een standaard gebruiker en wat artikelen invoeren. Dit moet nog toegevoegd
worden.

## Registratie

Na installatie dien je via http://larabene.dev/gebruiker/aanmelden een account te maken, vervolgens via een
database tool als Sequel Pro inloggen en de volgende queries uitvoeren:

Administrator rol aanmaken:
```
INSERT INTO roles (name, display_name, description, created_at, updated_at) VALUES ('admin', 'Administrator', 'Beheerder van de website', NOW(), NOW())
```

Adminstrator koppelen aan je gebruiker:
```
INSERT INTO role_user (user_id, role_id) VALUES (1, 1)
```

Vervolgens kun je via http://larabene.dev/admin inloggen op het admin panel (accounts worden direct geactiveerd) om
de content beheren. De pagina's uit de pagina module worden automatisch in het menu geplaatst en categorie&euml;n uit
de artikelen module komen vanzelf in het menu zodra deze ten minste 1 artikel bevat.

## To-do

- Uitgebreider menu beheer voor de website
- Pagina module mogelijkheid geven tot subpagina's
- Bedrijvengids maken (bedrijfsnaam, logo, korte omschrijving, website)
- Sidebar als partial & voorzien van nuttige informatie (random bedrijf, laatste posts, e.d.)
- Mogelijkheid tot reageren op de berichten (enkel geregistreerde leden of Facebook/Disqus?)
- ... idee&euml;n?

## Template

De template is te vinden in de map `/resources/template/` dit is de volledige basis template waarmee gewerkt wordt.
Wees zo vrij er mee te stoeien en spelen en om het geheel misschien wat leuker aan te kleden, de template is nog erg
basic op dit moment.

Mijn eigen was om `single-project.html` te gebruiken om een bedrijvengids mee vorm te geven (detailpagina), op de
homepage zijn dan de kleinere blokken uit `home2.html`  te gebruiken om op de homepage random een 4-8 tal bedrijven
te laten langskomen die zijn aangesloten bij de community om elkaar zo ook nog een beetje exposure te kunnen geven.
