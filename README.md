# Pedallica - Wielerclub Website

Een moderne webapplicatie voor wielerclub Pedallica waarbij leden zich kunnen registreren, ritten kunnen bekijken, evenementen kunnen volgen en sponsors kunnen raadplegen. Administrators hebben uitgebreide rechten om de hele website te beheren via een admin dashboard.

![Laravel](https://img.shields.io/badge/Laravel-11.x-FF2D20?style=flat&logo=laravel)
![PHP](https://img.shields.io/badge/PHP-8.2+-777BB4?style=flat&logo=php)
![MySQL](https://img.shields.io/badge/MySQL-8.0+-4479A1?style=flat&logo=mysql)
![TailwindCSS](https://img.shields.io/badge/TailwindCSS-3.x-38B2AC?style=flat&logo=tailwind-css)

---

## 📋 Inhoudsopgave

- [Over het Project](#over-het-project)
- [Features](#features)
- [Technische Requirements](#technische-requirements)
- [Installatie](#installatie)
- [Database Setup](#database-setup)
- [Standaard Admin Account](#standaard-admin-account)
- [Project Structuur](#project-structuur)
- [Gebruikte Technologieën](#gebruikte-technologieën)
- [Development](#development)
- [Troubleshooting](#troubleshooting)
- [Bronvermeldingen](#bronvermeldingen)
- [Licentie](#licentie)

---

## 📖 Over het Project

Pedallica is een full-stack webapplicatie gebouwd met Laravel 11 voor een Belgische wielerclub. De applicatie biedt een complete oplossing voor clubbeheer waarbij leden zich kunnen registreren, ritten kunnen inschrijven, evenementen kunnen volgen en contact kunnen opnemen met de club. Administrators kunnen via een centraal dashboard alle aspecten van de website beheren.

Dit project is ontwikkeld als schoolopdracht voor **Erasmushogeschool Brussel** en demonstreert moderne webontwikkeling technieken met focus op:
- Veilige authenticatie en autorisatie
- CRUD operaties
- Many-to-many database relaties
- File uploads en beheer
- Responsive design
- Component-based architecture

---

## ✨ Features

### Gebruikers Functionaliteiten

- **Account Registratie**: Nieuwe gebruikers kunnen een account aanmaken met profielfoto
- **Login Systeem**: Veilige authenticatie met 'Remember Me' functionaliteit
- **Profielbeheer**:
  - Persoonlijke gegevens aanpassen (inclusief username en about me)
  - Profielfoto uploaden/verwijderen
  - Wachtwoord wijzigen
  - Publieke profielpagina's (toegankelijk via username)
- **Ritten per Ploeg**:
  - Bekijk ritten georganiseerd per wielerploeg (A, B, C, MTB, VA)
  - Download GPX bestanden voor routeplanning
  - Bekijk ritdetails (afstand, hoogtemeters, startlocatie, tijdstip)
  - Inschrijven voor ritten (many-to-many relatie)
- **Evenementen**: Overzicht van komende en voorbije evenementen met posters
- **Sponsors**: Dynamische sponsor bar met alle actieve clubsponsors
- **FAQ Pagina**: Veelgestelde vragen georganiseerd per categorie
- **Contact Formulier**: Stuur berichten naar de club via email

### Admin Functionaliteiten

**Gebruikersbeheer**:
- Nieuwe gebruikers goedkeuren (approval systeem)
- Gebruikers promoveren tot admin of rechten afnemen
- Gebruikers verwijderen
- Overzicht van alle leden

**Rittenbeheer**:
- Ritten toevoegen met volledige details
- GPX bestanden uploaden
- Rit foto's uploaden
- Afstand en hoogtemeters bijhouden
- Per ploeg organiseren

**Evenementenbeheer**:
- Evenementen aanmaken en beheren
- Event posters uploaden
- Automatische detectie van gepasseerde evenementen

**Sponsorbeheer**:
- Sponsors toevoegen met logo's
- Sponsor websites koppelen
- Actief/inactief status beheren

**FAQ Beheer**:
- FAQ categorieën aanmaken
- Vragen en antwoorden toevoegen/bewerken
- Volgorde bepalen

---

## 🔧 Technische Requirements

- **PHP** >= 8.2
- **Composer** (latest)
- **MySQL/MariaDB** >= 8.0
- **Node.js** >= 18.x
- **NPM** >= 9.x
- **Git**

---

## 🚀 Installatie

### 1. Clone de Repository

```bash
git clone https://github.com/jarno-js/pedallica-website-project.git
cd pedallica
```

### 2. Installeer Dependencies

```bash
# Install PHP dependencies
composer install

# Install NPM dependencies
npm install
```

### 3. Environment Setup

Kopieer het `.env.example` bestand naar `.env`:

```bash
copy .env.example .env
```

Genereer een applicatie key:

```bash
php artisan key:generate
```

### 4. Database Configuratie

Pas je `.env` bestand aan met je database gegevens:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=pedallica
DB_USERNAME=root
DB_PASSWORD=jouw_database_wachtwoord
```

Maak de database aan in MySQL:

```sql
CREATE DATABASE pedallica CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

### 5. Email Configuratie (voor Contact Formulier)

Configureer je mail settings in `.env`:

```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=jouw_email@gmail.com
MAIL_PASSWORD=jouw_app_wachtwoord
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=noreply@pedallica.be
MAIL_FROM_NAME="Pedallica VZW"
```

---

## 💾 Database Setup

Voer de migrations en seeders uit om de database op te zetten met basisdata:

```bash
php artisan migrate:fresh --seed
```

Dit commando zal:
- ✅ Alle database tabellen aanmaken
- ✅ Een default admin account aanmaken
- ✅ Basis ploegen (A, B, C, MTB, VA) aanmaken
- ✅ Test FAQ data toevoegen
- ✅ Sponsor data toevoegen
- ✅ Evenement data toevoegen

### Upload Directories

De volgende directories worden automatisch aangemaakt bij eerste gebruik:

```
public/uploads/
├── leden/
│   └── profielfoto/          # Profielfotos van leden
├── sponsors/
│   └── logos/                # Sponsor logo's
├── evenementen/
│   └── posters/              # Evenement posters
└── ritten/
    ├── gpx/                  # GPX route bestanden
    └── photos/               # Rit foto's
```

Je kan deze ook manueel aanmaken:

```bash
mkdir -p public/uploads/leden/profielfoto
mkdir -p public/uploads/sponsors/logos
mkdir -p public/uploads/evenementen/posters
mkdir -p public/uploads/ritten/gpx
mkdir -p public/uploads/ritten/photos
```

---

## 🔐 Standaard Admin Account

Na het uitvoeren van de seeders zijn er twee admin accounts beschikbaar:

**Voor schoolopdracht (EHB vereiste):**
- **Email**: `admin@ehb.be`
- **Wachtwoord**: `Password!321`

**Voor clubgebruik:**
- **Email**: `admin@pedallica.be`
- **Wachtwoord**: `Pedalica1703!`

⚠️ **Belangrijk**: Wijzig deze wachtwoorden onmiddellijk in een productie omgeving!

---

## 📁 Project Structuur

### Models

| Model | Beschrijving | Relaties |
|-------|--------------|----------|
| `User` | Gebruikers van de website | belongsToMany: Rit |
| `Rit` | Wielerritten | belongsTo: Ploeg, belongsToMany: User |
| `Ploeg` | Wielerploegen/teams | hasMany: Rit |
| `Event` | Evenementen | - |
| `Sponsor` | Sponsors | - |
| `Faq` | FAQ vragen | belongsTo: FaqCategory |
| `FaqCategory` | FAQ categorieën | hasMany: Faq |

### Controllers

**Authentication:**
- `Auth/RegisterController` - Registratie functionaliteit
- `Auth/LoginController` - Login/logout functionaliteit

**User:**
- `ProfielController` - Profielbeheer (privé en publiek)
- `DashboardController` - Gebruiker dashboard

**Public:**
- `HomepageController` - Homepagina
- `EvenementenController` - Evenementen overzicht
- `PloegenController` - Ploegen en ritten overzicht
- `SponsorsController` - Sponsors overzicht
- `FaqController` - FAQ pagina
- `ContactController` - Contact formulier met email

**Admin:**
- `Admin/AdminDashboardController` - Centraal admin panel met alle CRUD operaties

### Middleware

- `auth` - Controleert of gebruiker ingelogd is
- `approved` - Controleert of gebruiker goedgekeurd is door admin
- `admin` - Controleert of gebruiker admin rechten heeft

### Blade Components

- `components/alert.blade.php` - Herbruikbare alert component (success, error, warning, info)

### View Composers

- `SponsorComposer` - Maakt sponsors globaal beschikbaar voor sponsor bar

---

## 🛠️ Gebruikte Technologieën

### Backend
- **Laravel 11.x** - PHP Framework
- **MySQL 8.0+** - Relationele database
- **Eloquent ORM** - Database abstractielaag
- **Laravel Mail** - Email functionaliteit
- **Blade Templating** - Laravel's template engine

### Frontend
- **Tailwind CSS** - Utility-first CSS framework
- **Vanilla JavaScript** - Interactiviteit (modals, dropdowns)
- **Hero Icons** - SVG iconen

### Development Tools
- **Composer** - PHP dependency manager
- **NPM** - Node package manager
- **Vite** - Frontend build tool

---

## 💻 Development

### Run Development Server

```bash
php artisan serve
```

De applicatie is nu beschikbaar op `http://localhost:8000`

### Compile Assets

Voor development met hot reload:

```bash
npm run dev
```

Voor productie build:

```bash
npm run build
```

### Belangrijke Commando's

```bash
# Database migrations uitvoeren
php artisan migrate

# Database resetten met fresh data
php artisan migrate:fresh --seed

# Cache legen
php artisan cache:clear
php artisan config:clear
php artisan view:clear
php artisan route:clear

# View cache opbouwen (productie)
php artisan view:cache
php artisan config:cache
php artisan route:cache
```

---

## 🐛 Troubleshooting

### Permissie Problemen

Als je permissie errors krijgt, zorg ervoor dat de storage en bootstrap/cache directories schrijfbaar zijn:

**Linux/Mac:**
```bash
chmod -R 775 storage bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache
```

**Windows:**
- Rechtsklik op `storage` en `bootstrap/cache` folders
- Ga naar Properties → Security
- Geef volledige rechten aan je gebruiker

### Database Connection Failed

Controleer of:
- ✅ MySQL service draait
- ✅ Database credentials correct zijn in `.env`
- ✅ Database bestaat (run `CREATE DATABASE pedallica;`)
- ✅ Database gebruiker heeft de juiste rechten

### Upload Errors

Als uploads niet werken:
- ✅ Controleer of upload directories bestaan
- ✅ Controleer schrijfrechten op `public/uploads`
- ✅ Controleer `php.ini` voor `upload_max_filesize` (min 10M) en `post_max_size` (min 10M)

### View/Cache Issues

Als je wijzigingen niet ziet:

```bash
php artisan view:clear
php artisan cache:clear
```

### Migration Errors

Als migrations falen:

```bash
# Reset database volledig
php artisan migrate:fresh --seed

# Of specifieke migration terugdraaien
php artisan migrate:rollback --step=1
```

---

## 📚 Bronvermeldingen

### Code & Documentatie
- [Laravel Documentatie](https://laravel.com/docs/11.x) - Laravel framework
- [Tailwind CSS Documentatie](https://tailwindcss.com/docs) - CSS styling
- [Laravel Breeze](https://laravel.com/docs/11.x/starter-kits#laravel-breeze) - Authentication scaffolding
- [Eloquent Relationships](https://laravel.com/docs/11.x/eloquent-relationships) - Database relaties

### Design & Assets
- [Hero Icons](https://heroicons.com/) - SVG iconen
- [Tailwind UI](https://tailwindui.com/) - Layout inspiratie
- [Unsplash](https://unsplash.com/) - Placeholder images

### Externe Bronnen
- [Stack Overflow](https://stackoverflow.com/) - Technische problemsolving
- [Laravel Daily](https://laraveldaily.com/) - Best practices en tips
- [Laracasts](https://laracasts.com/) - Video tutorials

### Logo & Branding
- Pedallica logo's zijn eigendom van Wielerclub Pedallica VZW

---

## 📄 Licentie

Dit project is ontwikkeld als **schoolproject** voor Erasmushogeschool Brussel (EHB).

**Ontwikkelaar**: Jarno JS
**School**: Erasmushogeschool Brussel
**Jaar**: 2024-2025
**Framework**: Laravel 11.x

Het project is gebouwd met open-source technologieën. De Laravel framework is gelicenseerd onder de [MIT license](https://opensource.org/licenses/MIT).

---

## 📞 Contact & Support

Voor vragen over dit project:

- **Email**: info@pedallica.be
- **Website**: [www.pedallica.be](https://www.pedallica.be)
- **GitHub**: [jarno-js/pedallica-website-project](https://github.com/jarno-js/pedallica-website-project)

---

<div align="center">

**Ontwikkeld met ❤️ voor Wielerclub Pedallica**

*Laravel 11.x • PHP 8.2 • MySQL • Tailwind CSS*

</div>
