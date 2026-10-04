# TFA3 POS Accounts

A CodeIgniter 4 application for viewing, adding, and editing customer and user accounts. It extends the earlier POS accounts project with validated forms and user profile picture uploads.

## Features

- View customer and user accounts
- Add and edit customers
- Add and edit users
- Reject duplicate usernames and invalid form entries
- Upload a JPG or PNG profile picture of up to 2 MB when editing a user
- Prepare a 160 × 160 profile picture and save only its generated filename in the database
- Show a placeholder when a user has no available profile picture

## Requirements

- PHP 8.2 or newer
- Composer
- MySQL or MariaDB
- PHP extensions required by CodeIgniter 4, including `intl`, `mbstring`, and `mysqli`
- PHP GD extension for preparing profile pictures

This project was developed locally using XAMPP.

## Local setup

1. Clone or download the repository.
2. Open a terminal in the project folder containing `composer.json` and `spark`.
3. Install dependencies:

   ```powershell
   composer install
   ```

4. Create a MySQL database named `tfa3`.
5. Import `database/tfa3.sql` into the `tfa3` database using phpMyAdmin.
6. Copy the included `env` file to a new file named `.env`.
7. In `.env`, set the base URL and database connection for your computer. For example:

   ```ini
   CI_ENVIRONMENT = development
   app.baseURL = 'http://localhost:8080/'

   database.default.hostname = localhost
   database.default.database = tfa3
   database.default.username = root
   database.default.password =
   database.default.DBDriver = MySQLi
   ```

   Your MySQL username or password may differ. The `.env` file is intentionally excluded from Git.

8. Make sure PHP's GD extension is enabled. In XAMPP's `php.ini`, the line should be `extension=gd` without a leading semicolon.
9. Start MySQL in XAMPP. From the project folder, run:

   ```powershell
   C:\xampp\php\php.exe spark serve
   ```

10. Open `http://localhost:8080` in your browser.

## Pages

| URL | Purpose |
| --- | --- |
| `/customers` | View customer accounts |
| `/customers/new` | Add a customer |
| `/customers/{id}/edit` | Edit a customer |
| `/users` | View user accounts and avatars |
| `/users/new` | Add a user |
| `/users/{id}/edit` | Edit a user and optionally upload an avatar |

Replace `{id}` with an existing record's numeric ID.

## Database and uploads

The database export is stored at `database/tfa3.sql`. The `customers` and `users` tables must be imported before using the forms.

Prepared avatars are saved under `public/uploads/avatars`. Uploaded images are excluded from Git, so a fresh checkout will not contain images uploaded on another computer. Users without a locally available avatar display the placeholder at `public/images/avatar-placeholder.svg`. A new avatar can be uploaded from that user's Edit page.

## Validation checks

- Customer full name and valid email are required.
- User username and full name are required; usernames must be unique.
- Invalid form entries show errors while preserving typed values.
- An avatar upload is optional when editing. Accepted files are JPG or PNG images up to 2 MB.
- Editing a user without choosing another picture keeps their existing avatar.