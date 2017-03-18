### Laravel Belgi&euml; en Nederland
##### Community portal

Wordt lid van de community op Slack, vraag [hier je invite aan](https://larabene.signup.team/)

Deze Github repo bevat de bronbestanden van Larabene.com, iedere Artisan uit Belgi&euml; of Nederland
is van harte welkom om lid te worden van deze community en zijn of haar steentje bij te dragen aan de
website die gebruikt wordt.

De uiteindelijke website komt, zodra afgerond, op [http://www.larabene.com](http://www.larabene.com)

## Installatie

De installatie van de website gebeurd in een aantal eenvoudige stappen.

- Clone de repository
- Kopieer de .env.example file en vul deze *
- `php artisan key:generate`
- `composer install` en `npm install`
- `php artisan migrate`
- `php artisan db:seed`
- `php artisan vendor:publish`

*: Op dit moment worden enkel de [KrakenIO](https://kraken.io/) en [Recaptcha](https://www.google.com/recaptcha/intro/invisible.html) APIs gebruikt.
Beide zijn gratis te gebruiken, in geval van KrakenIO zit er wel een limiet op het gratis account maar dit is ruim voldoende om mee te testen. KrakenIO
wordt gebruikt om uploads te optimaliseren voor een betere Page Speed.

## Website gebruiken

Na installatie dien je via http://larabene.dev/gebruiker/inloggen met de standaard gebruiker die wordt toegevoegd:

- E-mail: info@larabene.dev
- Wachtwoord: welkom

Vervolgens kun je naar http://larabene.dev/admin gaan om de content beheren. De pagina's uit de pagina module worden 
automatisch in het menu geplaatst en categorie&euml;n uit de artikelen module komen vanzelf in het menu zodra deze 
ten minste 1 artikel bevat.

## To-do

Alle to-do's (bugs en uitbreidingen, zowel technisch als grafisch) zijn terug te vinden bij de [Github Issues](https://github.com/PendoNL/Larabene/issues) van dit project. Iedereen mag het project forken en deze issues oppakken, graag zelfs!

## Template

De template is te vinden in de map `/resources/template/` dit is de volledige basis template waarmee gewerkt wordt.
Wees zo vrij er mee te stoeien en spelen en om het geheel misschien wat leuker aan te kleden, de template is nog erg
basic op dit moment.

Mijn eigen was om `single-project.html` te gebruiken om een bedrijvengids mee vorm te geven (detailpagina), op de
homepage zijn dan de kleinere blokken uit `home2.html`  te gebruiken om op de homepage random een 4-8 tal bedrijven
te laten langskomen die zijn aangesloten bij de community om elkaar zo ook nog een beetje exposure te kunnen geven.
