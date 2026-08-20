# FurHope

FurHope is a Symfony platform for animal adoption and care. It brings together shelter workflows, veterinary appointments, pet-hotel reservations, commerce, a community feed, and optional local AI assistants in one application.

## Highlights

- Animal listings, search, favorites, adoption requests, and management dashboards
- Veterinary discovery, availability, appointments, reviews, and signature verification
- Pet-hotel administration, booking, analytics, and reservation QR codes
- Product catalog, cart, promotions, currency conversion, and Stripe Checkout
- Social posts, comments, reactions, connections, notifications, reporting, and moderation
- Registration, email verification, password recovery, account support, and role-based access
- Optional face and voice authentication
- Optional local AI services for social moderation, animal recognition, and shop recommendations
- English and French translations

## Technology

- PHP 8.2+, Symfony 6.4, Twig, and AssetMapper
- Doctrine ORM and Doctrine Migrations with MySQL 8
- PHPUnit 11 and PHPStan
- Optional Python/FastAPI services for local ML features
- Docker Compose for MySQL and Mailpit

## Requirements

- PHP 8.2 or newer with `ctype`, `iconv`, and a MySQL PDO driver
- Composer 2
- MySQL 8.x, or Docker with the Compose plugin
- Symfony CLI for the recommended local web server
- Python 3.11+ only when using the optional AI or voice services

## Quick start

1. Install PHP dependencies:

   ```bash
   composer install
   ```

2. Create local configuration and replace development placeholders as needed:

   ```bash
   cp .env .env.local
   ```

   At minimum, choose a unique `APP_SECRET` and `JWT_PASSPHRASE`. Keep all real credentials in `.env.local`; it is ignored by Git.

3. Start MySQL and Mailpit:

   ```bash
   docker compose up -d
   ```

   MySQL is available on `127.0.0.1:3306`. Mailpit accepts SMTP on port `1025`, and its web interface is available at <http://127.0.0.1:8025>.

4. Generate the local JWT key pair:

   ```bash
   php bin/console lexik:jwt:generate-keypair
   ```

5. Create and migrate the database:

   ```bash
   php bin/console doctrine:database:create --if-not-exists
   php bin/console doctrine:migrations:migrate --no-interaction
   ```

6. Start the application:

   ```bash
   symfony server:start
   ```

   Open <http://127.0.0.1:8000>.

To create the first administrator after migrating the database:

```bash
php bin/console app:create-admin admin@example.com 'use-a-strong-password' Admin User
```

## Configuration

The committed `.env` contains non-sensitive development defaults. Override them in `.env.local` or through deployment environment variables.

| Area | Variables |
| --- | --- |
| Application | `APP_ENV`, `APP_SECRET`, `APP_TIMEZONE`, `DEFAULT_URI` |
| Database | `DATABASE_URL` |
| CAPTCHA | `HCAPTCHA_SITE_KEY`, `HCAPTCHA_SECRET` |
| JWT | `JWT_SECRET_KEY`, `JWT_PUBLIC_KEY`, `JWT_PASSPHRASE` |
| Email | `MAILER_DSN`, `MAILER_FROM_EMAIL`, `BREVO_API_KEY` |
| SMS | `TWILIO_ACCOUNT_SID`, `TWILIO_AUTH_TOKEN`, `TWILIO_FROM_NUMBER`, `TWILIO_VERIFY_SERVICE_SID`, `TWILIO_DEFAULT_COUNTRY_CODE`, `TWILIO_DSN` |
| Hosted AI | `GROQ_API_KEY`, `ANTHROPIC_API_KEY`, `ANTHROPIC_MODEL`, `ACCOUNT_SUPPORT_GROQ_MODEL` |
| Voice service | `VOICE_SERVICE_BASE_URL` |
| Payments | `STRIPE_SECRET_KEY`, `STRIPE_PUBLIC_KEY`, `STRIPE_CURRENCY` |

Integrations without credentials fall back to local behavior where supported, but their external features remain unavailable.

## Optional local services

The Symfony application uses these services only for their corresponding features:

| Service | Directory | Default address |
| --- | --- | --- |
| Social moderation and captions | `tools/social_ai` | `http://127.0.0.1:7861` |
| Animal species and breed prediction | `tools/animal_ai` | `http://127.0.0.1:7862` |
| Shop recommendations and descriptions | `tools/shopges_ai` | `http://127.0.0.1:7863` |
| Voice enrollment and comparison | `voice_service.py` | `http://127.0.0.1:5001` |

Each AI directory includes its own setup notes. Use a separate virtual environment for each service because their model dependencies can be large. For the voice service:

```bash
python3 -m venv tools/voice_service/.venv
tools/voice_service/.venv/bin/pip install -r requirements-voice.txt
tools/voice_service/.venv/bin/python voice_service.py --host 127.0.0.1 --port 5001
```

The first run can download model weights. Virtual environments, caches, generated models, and user uploads must remain outside version control.

## Quality checks

Run the main checks from the repository root:

```bash
php bin/phpunit
vendor/bin/phpstan analyse -c phpstan.neon
php bin/console lint:container
php bin/console lint:twig templates
php bin/console lint:yaml config
php bin/console doctrine:schema:validate
```

Python syntax can be checked without loading model weights:

```bash
python3 -m compileall -q voice_service.py tools/animal_ai tools/shopges_ai tools/social_ai
```

## Project layout

```text
assets/          Browser JavaScript and source styles
config/          Symfony, routes, packages, and service configuration
migrations/      Doctrine database migrations
public/          Web entry point and versioned static assets
src/             Application code
templates/       Twig views
tests/           PHPUnit test suite
tools/           Optional local AI services and developer utilities
translations/    English and French message catalogs
```

Runtime files belong in `var/` and `public/uploads/`; both are intentionally ignored. Database dumps, private JWT keys, generated reports, and backup archives must not be committed.

## Production checklist

- Set `APP_ENV=prod`, disable debug mode, and provide secrets through the deployment platform.
- Generate a production-only JWT key pair and protect the private key and passphrase.
- Run migrations with a database backup and compile assets during deployment.
- Make `var/` and `public/uploads/` writable by the application without making the source tree writable.
- Serve the `public/` directory as the document root and enforce HTTPS.
- Review [PERFORMANCE.md](PERFORMANCE.md) before performance testing or deployment.

This repository is currently marked as proprietary in `composer.json`; no open-source license is granted.
