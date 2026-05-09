# Codex Change Log

This file summarizes the main changes made to sync the JavaFX project with the Symfony project and fix the issues found during testing.

## Database Sync

- Pointed the Java project to the same Symfony database: `integration1`.
- Updated Java database defaults to use:
  - host: `127.0.0.1`
  - database: `integration1`
  - user: `root`
  - password: empty
- Improved the shared Java database connection so it automatically reconnects if MySQL/MariaDB restarts and the old connection becomes closed.
- Verified the Symfony tables used by Java exist:
  - `user`
  - `disponibilite`
  - `rendezvous`
  - `review`
  - `reclamation`
  - `reponse`

## XAMPP / MariaDB Repair

- Investigated the XAMPP error where MySQL stopped immediately.
- Found MariaDB Aria corruption in the MySQL logs.
- Backed up corrupted Aria log files to:
  - `C:\xampp\mysql\data\aria_recovery_backup_20260508_133146`
- Repaired crashed MariaDB system tables with `aria_chk`.
- Verified that `integration1` became reachable again.

## User Authentication

- Fixed Java login so it works with Symfony users.
- Added support for Symfony BCrypt passwords in Java login.
- Kept support for old plain-text passwords where they still exist.
- Fixed signup so Java-created users are inserted with Symfony-compatible columns.
- Java signup now hashes passwords in a Symfony-compatible BCrypt format.
- Fixed face login mapping for Symfony user columns.
- Normalized user roles between Java and Symfony.

## Profile Sync

- Improved the Java profile page design.
- Removed the `Account Pulse` panel and the `Synced with integration1` pill.
- Fixed Java profile editing.
- Synced Java profile picture handling with Symfony profile image fields.
- Profile images now use the Symfony upload location:
  - `public/uploads/profiles`

## Java UI / Design

- Matched Java colors more closely with the Symfony warm FurHope style.
- Updated shared theme styling.
- Centered the sign-in form.
- Made sign-in buttons consistent in size.
- Improved the welcome/accueil page to feel more alive.
- Improved navigation speed by avoiding heavy reload behavior where possible.
- Redesigned the dashboard into a clearer command-center style.
- Improved the profile page layout so it feels less empty.

## Reclamations

- Fixed dashboard routing for client reclamations.
- Improved error messages so real causes are easier to see.
- Added Java-side schema creation for missing reclamation tables when needed:
  - `reclamation`
  - `reponse`
- Delayed `ReponseService` creation so response-table issues do not block opening the reclamation page.

## Vet Approvals

- Fixed pending-vet loading.
- Updated vet approval logic to match Symfony fields:
  - `roles`
  - `is_active`
  - `is_verified`
  - `is_veteran_applicant`
  - `is_veteran_approved`
  - `updated_at`
- Approval now ensures the user has `ROLE_VETERINAIRE`.
- Java pending-vet queries now understand both old Java role fields and Symfony role fields.

## Vet Care Sync

- Synced Java vet-care with Symfony vet-care database structure.
- Fixed Java availability creation to write Symfony's required `date` column in `disponibilite`.
- Java availability now uses:
  - `date`
  - `start_time`
  - `end_time`
  - `is_available`
  - `vet_id`
- Java bookings now use Symfony-compatible rendezvous statuses:
  - `pending`
  - `confirmed`
  - `cancelled`
- Java still displays friendly labels like `EN_ATTENTE`, `CONFIRME`, and `ANNULE`.
- Booking now uses 1-hour slots like Symfony.
- Accepting a rendezvous marks the availability unavailable.
- Refusing a rendezvous marks the availability available again.
- Vet list now loads approved Symfony veterinarians using `ROLE_VETERINAIRE` and `is_veteran_approved`.
- Vet availability list now shows only the logged-in veterinarian's slots.
- Reviews now write Symfony-required fields:
  - `note`
  - `created_at`
- Review statistics now read `note` first and fall back to `rating` if needed.

## Build / Run Scripts

- Updated root JavaFX compile/run scripts to point to the nested Java project folder.
- Verified the project compiles successfully with:
  - `.\compile-javafx.ps1`

## Verification Done

- Ran Java compilation multiple times.
- Latest compile result:
  - `BUILD SUCCESS`
- Verified database connection to `integration1`.
- Verified `integration1.user` had records after MariaDB repair.

