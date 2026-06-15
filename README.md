# Energym Fitness Tracker

Energym is a simple PHP 8 school project based on an existing static fitness website. The original HTML, CSS, JavaScript, and images were kept, and the Services section was converted into dynamic content loaded from a MySQL/MariaDB database.

## Requirements

- PHP 8.0 or newer
- MySQL 8.0+ or MariaDB 10.5+
- Web server such as Apache, XAMPP, Laragon, or PHP built-in server
- No PHP framework and no CMS

## Technologies Used

- Pure PHP with a simple custom autoloader
- OOP classes in `app/`
- PDO database access
- Prepared statements for CRUD queries
- PHP sessions for admin protection
- `password_hash` compatible hashes and `password_verify`
- MySQL/MariaDB SQL dump in `database/schema.sql`

## Project Structure

- `app/bootstrap.php` starts sessions, registers the autoloader, and defines the `e()` escaping helper.
- `app/Core/Database.php` creates the PDO database connection.
- `app/Core/Auth.php` handles admin session login/logout checks.
- `app/Core/Csrf.php` creates and verifies form tokens.
- `app/Models/Admin.php` reads admin users from the database.
- `app/Models/Service.php` handles service CRUD database queries.
- `app/Controllers/AuthController.php` handles login form logic.
- `app/Controllers/ServiceController.php` connects service pages to the model.
- `app/Views/admin/service-form.php` contains the reusable admin service form.
- `admin/` contains the protected administration interface.
- `config/config.php` contains database connection settings.
- `database/schema.sql` creates tables and inserts seed data.
- `sections/service-section.php` displays public services dynamically.
- `defense-docs/` contains the separate study page for project defense.
- `public/index.php` is a simple public entry point for environments that expect a `public` folder.

## Database Setup

1. Open phpMyAdmin, Adminer, MySQL Workbench, or the MySQL command line.
2. Import `database/schema.sql`.
3. Check `config/config.php` and update the database username/password if needed.

Default database settings:

```php
database: fitness_tracker
username: root
password: empty
host: 127.0.0.1
```

## Admin Login

- URL: `login.php`
- Email: `admin@example.com`
- Password: `password`

The password stored in the SQL file is a bcrypt hash. The login form verifies it with `password_verify`.
The `Admin` model also contains a `create()` method that uses `password_hash` when a new admin password is saved from PHP.

## Running Locally

With XAMPP or Laragon, place this project in your web root and open:

```text
http://localhost/fitness_tracker/
```

With PHP's built-in server from the project root:

```bash
php -S localhost:8000
```

Then open:

```text
http://localhost:8000
```

## CRUD Functionality

The main dynamic entity is `services`.

- Create: `admin/service-create.php`
- Read: `admin/services.php` and public `sections/service-section.php`
- Update: `admin/service-edit.php`
- Delete: `admin/service-delete.php`

All database writes use PDO prepared statements.

## Security Notes

- Admin pages call `Auth::requireLogin()`.
- Login uses sessions and regenerates the session ID.
- Passwords are verified with `password_verify`.
- Service forms include CSRF tokens.
- User output is escaped with `e()`, which uses `htmlspecialchars`.
- SQL queries use PDO prepared statements.

## Suggested Logical Commits

No commits were created automatically. Suggested commit groups:

1. Initial PHP project structure
2. Add database configuration and PDO connection
3. Add OOP models and controllers
4. Implement services CRUD
5. Add admin authentication
6. Connect public Services section to database
7. Add schema and seed data
8. Add README and defense documentation
9. Final syntax cleanup
