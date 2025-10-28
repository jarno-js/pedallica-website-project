Laravel Logo
Build Status Total Downloads Latest Stable Version License

About Laravel
Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

Simple, fast routing engine.
Powerful dependency injection container.
Multiple back-ends for session and cache storage.
Expressive, intuitive database ORM.
Database agnostic schema migrations.
Robust background job processing.
Real-time event broadcasting.
Laravel is accessible, powerful, and provides tools required for large, robust applications.

Learning Laravel
Laravel has the most extensive and thorough documentation and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the Laravel Bootcamp, where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, Laracasts can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

Laravel Sponsors
We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the Laravel Partners program.

Premium Partners
Vehikl
Tighten Co.
Kirschbaum Development Group
64 Robots
Curotec
DevSquad
Redberry
Active Logic
Contributing
Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the Laravel documentation.

Code of Conduct
In order to ensure that the Laravel community is welcoming to all, please review and abide by the Code of Conduct.

Security Vulnerabilities
If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via taylor@laravel.com. All security vulnerabilities will be promptly addressed.

Pedallica - Wielerclub Website
Een dynamische website gebouwd met Laravel voor wielerclub Pedallica. Deze website biedt functionaliteiten voor leden, evenementen, ritten, nieuws en meer.

Inhoudsopgave
Over het Project
Features
Technische Requirements
Installatie
Database Setup
Standaard Admin Account
Project Structuur
Gebruikte Technologieën
Bronvermeldingen
Over het Project
Pedallica is een moderne webapplicatie voor een wielerclub waarbij leden zich kunnen registreren, ritten kunnen bekijken, evenementen kunnen volgen en nieuws kunnen lezen. Administrators hebben uitgebreide rechten om de hele website te beheren via een admin dashboard.

Features
Gebruikers Functionaliteiten
Account Registratie: Nieuwe gebruikers kunnen een account aanmaken
Login Systeem: Veilige authenticatie met 'Remember Me' functionaliteit
Profielbeheer:
Persoonlijke gegevens aanpassen
Profielfoto uploaden
Wachtwoord wijzigen
Evenementen Bekijken: Overzicht van komende en voorbije evenementen
Ritten per Ploeg: Bekijk ritten georganiseerd per wielerploeg
Nieuws: Lees de laatste nieuwsberichten van de club
Sponsors: Overzicht van clubsponsors
Admin Functionaliteiten
Gebruikersbeheer:
Nieuwe gebruikers goedkeuren
Gebruikers promoveren tot admin of rechten afnemen
Gebruikers verwijderen
Manueel nieuwe gebruikers aanmaken
Nieuwsbeheer: Nieuws toevoegen, bewerken en verwijderen
Evenementenbeheer: Evenementen aanmaken en beheren met posters
Rittenbeheer: Ritten toevoegen met GPX bestanden, foto's en routedetails
Sponsorbeheer: Sponsors toevoegen en beheren met logo's
Technische Requirements
PHP >= 8.2
Composer
MySQL/MariaDB
Node.js & NPM (voor frontend assets)
Installatie
Volg deze stappen om het project lokaal te installeren:

1. Clone de Repository
git clone <jouw-repository-url>
cd pedallica
2. Installeer Dependencies
# Install PHP dependencies
composer install

# Install NPM dependencies
npm install
3. Environment Setup
Kopieer het .env.example bestand naar .env:

copy .env.example .env
Genereer een applicatie key:

php artisan key:generate
4. Database Configuratie
Pas je .env bestand aan met je database gegevens:

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=pedallica
DB_USERNAME=jouw_database_gebruiker
DB_PASSWORD=jouw_database_wachtwoord
Maak de database aan in MySQL:

CREATE DATABASE pedallica;
5. Email Configuratie (Optioneel)
Voor email functionaliteiten (wachtwoord reset), configureer je mail settings in .env:

MAIL_MAILER=smtp
MAIL_HOST=jouw_mail_host
MAIL_PORT=587
MAIL_USERNAME=jouw_email
MAIL_PASSWORD=jouw_wachtwoord
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=noreply@pedallica.be
MAIL_FROM_NAME="Pedallica"
Database Setup
Voer de migrations en seeders uit om de database op te zetten met basisdata:

php artisan migrate:fresh --seed
Dit commando zal:

Alle database tabellen aanmaken
Een default admin account aanmaken
Basis ploegen (teams) aanmaken
Test data toevoegen
Upload Directories
Zorg ervoor dat de volgende directories bestaan en schrijfrechten hebben:

public/uploads/evenementen/posters
public/uploads/ritten/photos
public/uploads/ritten/gpx
public/uploads/sponsors/logos
public/uploads/profiles
Deze worden automatisch aangemaakt wanneer je bestanden upload, maar je kan ze ook manueel aanmaken.

Standaard Admin Account
Na het uitvoeren van de seeders is er een admin account beschikbaar:

Email: admin@pedallica.be
Wachtwoord: Pedalica1703!
Let op: Wijzig dit wachtwoord onmiddellijk in een productie omgeving!

Project Structuur
Models
User: Gebruikers van de website
News: Nieuwsberichten
Event: Evenementen
Rit: Wielerritten
Ploeg: Wielerploegen/teams
Sponsor: Sponsors
Controllers
Auth/RegisterController: Registratie functionaliteit
Auth/LoginController: Login/logout functionaliteit
ProfielController: Profielbeheer
DashboardController: Gebruiker dashboard
Admin/AdminDashboardController: Admin panel met alle CRUD operaties
HomepageController: Homepagina
EvenementenController: Evenementen overzicht
PloegenController: Ploegen overzicht
SponsorsController: Sponsors overzicht
Middleware
auth: Controleert of gebruiker ingelogd is
approved: Controleert of gebruiker goedgekeurd is door admin
admin: Controleert of gebruiker admin rechten heeft
Gebruikte Technologieën
Backend
Laravel 11.x: PHP Framework
MySQL: Database
Eloquent ORM: Database interacties
Frontend
Tailwind CSS: Utility-first CSS framework
Blade Templating: Laravel's templating engine
Alpine.js: Lichtgewicht JavaScript framework (voor interactieve componenten)
Dependencies
Laravel Breeze: Authentication scaffolding
Carbon: Datum/tijd manipulatie
Bronvermeldingen
Code & Documentatie
Laravel Documentatie: https://laravel.com/docs
Tailwind CSS Documentatie: https://tailwindcss.com/docs
Laravel Breeze: https://laravel.com/docs/starter-kits#laravel-breeze
Design Inspiratie
Hero Icons: https://heroicons.com/ (voor SVG iconen)
Tailwind UI: https://tailwindui.com/ (voor layout inspiratie)
Externe Bronnen
Stack Overflow: Voor het oplossen van specifieke technische problemen
Laravel Daily: Voor best practices en tips
Development
Run Development Server
php artisan serve
De applicatie is nu beschikbaar op http://localhost:8000

Compile Assets
Voor development met hot reload:

npm run dev
Voor productie build:

npm run build
Belangrijke Commando's
# Database migrations uitvoeren
php artisan migrate

# Database resetten met fresh data
php artisan migrate:fresh --seed

# Cache legen
php artisan cache:clear
php artisan config:clear
php artisan view:clear

# Storage link aanmaken (voor publieke uploads)
php artisan storage:link

# Event status updaten (controleert of events gepasseerd zijn)
php artisan events:update-status
Troubleshooting
Permissie Problemen
Als je permissie errors krijgt, zorg ervoor dat de storage en bootstrap/cache directories schrijfbaar zijn:

chmod -R 775 storage bootstrap/cache
Database Connection Failed
Controleer of:

MySQL service draait
Database credentials correct zijn in .env
Database bestaat
Upload Errors
Als uploads niet werken:

Controleer of upload directories bestaan
Controleer schrijfrechten op public/uploads
Controleer php.ini voor upload_max_filesize en post_max_size
Contact & Support
Voor vragen over dit project, neem contact op met de ontwikkelaar.

LicenseLicentie
The Laravel framework is open-sourced software licensed under the MIT license.

Dit project is ontwikkeld als schoolproject voor Erasmushogeschool Brussel.

Ontwikkeld met Laravel 11.x - 2025
