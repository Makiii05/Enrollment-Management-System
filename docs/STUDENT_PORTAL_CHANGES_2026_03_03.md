# Student Portal Module - Changes Made on March 3, 2026

## Overview

Created a new **Student Portal** module for students to access their account ledger, examination permits, and manage their passwords.

---

## New Files Created

### Controllers

- `app/Http/Controllers/Auth/StudentPortalAuthController.php` - Handles authentication, dashboard, ledger, exam permit, and password change

### Middleware

- `app/Http/Middleware/StudentPortalAuth.php` - Custom session-based authentication middleware for student portal

### Models

- `app/Models/StudentAccount.php` - Model for student accounts with password hashing and verification

### Migrations

- `database/migrations/2026_03_03_002338_create_student_accounts_table.php` - Creates `student_accounts` table

### Seeders

- `database/seeders/StudentAccountSeeder.php` - Populates student accounts with default password

### Views

- `resources/views/student_portal/login.blade.php` - Login page using student number
- `resources/views/student_portal/dashboard.blade.php` - Student dashboard with info and quick links
- `resources/views/student_portal/ledger.blade.php` - Account ledger showing fees and payments
- `resources/views/student_portal/examination_permit.blade.php` - Placeholder for exam permit feature
- `resources/views/student_portal/change_password.blade.php` - Password change form
- `resources/views/components/student_portal_sidebar.blade.php` - Sidebar navigation component

### Routes

- `routes/modules/student_portal.php` - All student portal routes

---

## Modified Files

### `app/Models/Student.php`

- Added `account()` relationship to `StudentAccount`

### `app/Providers/AppServiceProvider.php`

- (Gate definition removed - using custom middleware instead)

### `bootstrap/app.php`

- Registered `student.portal.auth` middleware alias
- Added student portal to guest redirect logic
- Added CSRF `TokenMismatchException` handler for "Page Expired" errors

### `routes/web.php`

- Added require for `student_portal.php` routes

### `resources/views/index.blade.php`

- Added Student Portal card to the home page

---

## Database Changes

### New Table: `student_accounts`

| Column         | Type             | Description                                |
| -------------- | ---------------- | ------------------------------------------ |
| id             | bigint           | Primary key                                |
| student_id     | bigint (FK)      | References students.id                     |
| account_status | enum('on','off') | Account activation status (default: 'off') |
| password       | string           | Hashed password (default: '123')           |
| created_at     | timestamp        |                                            |
| updated_at     | timestamp        |                                            |

---

## Authentication Flow

1. **Login**: Uses student number + password (NOT email)
2. **Session**: Stores `student_portal_student_id` in session (separate from Laravel Auth)
3. **Middleware**: `StudentPortalAuth` checks session and account status
4. **Account Activation**: Cashier must set `account_status = 'on'` before student can login
5. **Portal Status**: Respects global student portal on/off toggle from Accounting dashboard

---

## Routes Summary

| Method | URI                                | Name                                  | Description             |
| ------ | ---------------------------------- | ------------------------------------- | ----------------------- |
| GET    | /student-portal                    | student_portal.login                  | Login page              |
| POST   | /student-portal/login              | student_portal.login.submit           | Process login           |
| POST   | /student-portal/logout             | student_portal.logout                 | Logout                  |
| GET    | /student-portal/dashboard          | student_portal.dashboard              | Dashboard               |
| GET    | /student-portal/ledger             | student_portal.ledger                 | Account ledger          |
| GET    | /student-portal/api/ledger/{id}    | student_portal.api.ledger             | Ledger API              |
| GET    | /student-portal/examination-permit | student_portal.examination_permit     | Exam permit             |
| GET    | /student-portal/change-password    | student_portal.change_password        | Change password form    |
| POST   | /student-portal/change-password    | student_portal.change_password.submit | Process password change |

---

## Default Credentials

- **Password**: `123` (hashed with bcrypt)
- **Account Status**: `off` (requires activation by cashier)

---

## Testing Instructions

1. Run migration: `php artisan migrate`
2. Run seeder: `php artisan db:seed --class=StudentAccountSeeder`
3. Activate an account:
    ```sql
    UPDATE student_accounts SET account_status = 'on' WHERE student_id = 1;
    ```
4. Enable portal via Accounting dashboard toggle
5. Login at `/student-portal` with student number and password `123`

---

## CSRF "Page Expired" Fix

Added global exception handler in `bootstrap/app.php` that catches `TokenMismatchException` and redirects users back to the form with a friendly error message instead of showing the ugly 419 error page.
