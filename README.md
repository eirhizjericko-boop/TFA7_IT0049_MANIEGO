# Counterboard POS TFA7

This Laravel project extends the TFA6 POS application with editable customer and user accounts, validation, and prepared avatar uploads.

## Required pages and forms

- `/customers` - customer account list
- `/customers/create` - validated customer creation form
- `/customers/{id}/edit` - customer edit form
- `/users` - user account list with avatar or placeholder image
- `/users/create` - validated user creation form
- `/users/{id}/edit` - user edit form with avatar upload
- `/about` - project information

## Run in Visual Studio Code

Open this folder in Visual Studio Code, then run:

```powershell
composer install
copy .env.example .env
php artisan key:generate
New-Item database/database.sqlite -ItemType File
php artisan migrate --seed
php artisan storage:link
php artisan serve
```

If the SQLite file already exists, skip the `New-Item` command. Open `http://127.0.0.1:8000` in a browser.

If PHP is not on your PATH, use the XAMPP PHP executable:

```powershell
C:\xampp\php\php.exe artisan migrate --seed
C:\xampp\php\php.exe artisan storage:link
C:\xampp\php\php.exe artisan serve
```

## Avatar upload requirement

TFA7 uses the Intervention Image package to prepare uploaded images as square JPEG thumbnails. The upload is validated as an image no larger than 2MB, stored through `Storage::disk('public')`, and the resulting path is saved in the `avatar` column.

Enable the GD extension in XAMPP if image processing is unavailable:

1. Open `C:\xampp\php\php.ini`.
2. Find `;extension=gd`.
3. Remove the semicolon so it becomes `extension=gd`.
4. Save the file and restart the PHP server.

## Project structure

```text
app/Http/Controllers/       customer and user form workflows
app/Models/                 Customer and User Eloquent models
database/migrations/        users, customers, and avatar schema
database/seeders/           sample account records
resources/views/            lists, forms, and shared layout
public/images/              avatar placeholder
routes/web.php              page, create, edit, and update routes
```

## Verification commands

```powershell
php artisan route:list
php artisan migrate:status
php artisan test
```

The repository is prepared for local VS Code use and GitHub submission. No hosting setup is included.
