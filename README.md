# FILKOMEVENT

FILKOMEVENT is a Laravel web application for centralized event information in
the Faculty of Computer Science, Universitas Brawijaya. The app helps students
find events, view details, bookmark events, register for activities, and track
their participation. It also has an early admin area intended for event and
participant management.

This README is written as a project map for humans and AI coding assistants. If
an AI reads this file before generating code, it should understand the current
application structure, existing patterns, and the safest places to make changes.

## Tech Stack

- Backend: Laravel 13, PHP 8.3
- Frontend build: Vite 8
- Styling: Tailwind CSS 4
- JavaScript: ES modules in `resources/js`
- Icons: Lucide, imported through `resources/js/icon.js`
- Database access: Laravel Eloquent models plus query builder for dashboard
  statistics
- Testing: PHPUnit through Laravel's `php artisan test`

## Project Purpose

The application is a digital event portal for FILKOM students.

Main user goals:

- See a public landing page.
- Register and log in using a UB student email.
- Browse the student dashboard.
- View upcoming events.
- Search and filter events.
- View event details.
- Bookmark and unbookmark events.
- View saved events.
- View profile and participation history pages.

Admin goals are planned but still limited in the current codebase:

- Access an admin dashboard route.
- Eventually manage events, participants, posters, and registrations.

## High Level Architecture

FILKOMEVENT follows a standard Laravel MVC structure.

- Routes are defined in `routes/web.php`.
- Controllers live in `app/Http/Controllers`.
- Models live in `app/Models`.
- Blade views live in `resources/views`.
- Reusable Blade components live in `resources/views/components`.
- AJAX-rendered view fragments live in `resources/views/partials`.
- Frontend JavaScript lives in `resources/js`.
- Tailwind and global app styles live in `resources/css`.
- Migrations and seeders live in `database/migrations` and `database/seeders`.
- Public images and icons live in `public/icon` and `public/assets/events`.

## Important Folders

```text
FilkomEvent/
  app/
    Http/
      Controllers/       Main request handlers
      Middleware/        Role middleware
    Models/              Eloquent models
    Service/             Dashboard data service
    View/Components/     Blade component classes
  database/
    migrations/          Database schema
    seeders/             Demo categories, events, and registrations
    factories/           Test factories
  public/
    assets/events/       Event poster images
    icon/                Logo, avatar, social, testimonial assets
  resources/
    css/                 Tailwind entry files and custom CSS
    js/                  Browser behavior modules
    views/               Blade pages, components, and partials
  routes/
    web.php              Web routes
  tests/
    Feature/             Feature tests
    Unit/                Unit tests
```

## Main Routes

Routes are declared in `routes/web.php`.

Public routes:

- `GET /` renders the landing page.
- `GET /login` renders the login page.
- `POST /login` authenticates a user.
- `POST /logout` logs out the authenticated user.
- `GET /register` renders registration.
- `POST /register` creates a student account.
- `GET /forgot-password` renders forgot password.
- `POST /forgot-password` creates a password reset token and sends email.
- `GET /reset-password/{token}` renders reset password.
- `POST /reset-password` updates the password.
- `POST /kirim-email` sends the contact form email.

Student routes use `auth` and `role:Mahasiswa` middleware:

- `GET /dashboard` shows student dashboard stats and recent events.
- `GET /profile` shows the profile page.
- `GET /events` shows the event list with search and filters.
- `GET /events/{id}` shows event details.
- `GET /bookmark` shows bookmarked events.
- `POST /bookmark/{id}` toggles an event bookmark.
- `GET /history` shows participation history.
- `GET /registration-event` currently renders a page directly.
- `GET /payment` currently renders a page directly.

Admin routes use `auth` and `role:admin` middleware:

- `GET /admin/dashboard` renders the admin dashboard page.

## Controllers

### `AuthController`

Handles:

- Student registration
- Login
- Logout
- Landing page contact email
- Forgot password
- Reset password

Notes for AI assistants:

- `User` has a password cast of `hashed`, so plain passwords passed to
  `User::create()` are automatically hashed.
- Login currently uses `Auth::attempt()` with only email and password.
- The login form does not currently send a remember-me value.
- Password reset uses custom `reset_token` fields on the `users` table.

### `DashboardController`

Handles:

- Student dashboard
- Profile page
- History page

The dashboard loads:

- Latest 3 events
- Popular categories by event count
- Student registration statistics
- Category participation statistics through `DashboardService`
- Sidebar menu items and setting links

### `EventController`

Handles:

- Event listing
- Event search
- Event category and status filters
- AJAX rendering for the event list partial
- Event detail page
- Bookmark toggle endpoint

Important behavior:

- `/events` loads events with category and current-user bookmark relation.
- Search filters by event title.
- Category filter uses `category_id`.
- Status filter supports:
  - `akan_datang`
  - `berlangsung`
  - `selesai`
  - `dibatalkan`
- AJAX requests return `resources/views/partials/event-list.blade.php`.

### `BookmarkController`

Handles:

- Bookmark page
- Bookmark search
- AJAX rendering for bookmarked events

Important behavior:

- Bookmarks are queried through the `events` table with a `whereHas` on
  `bookmarkedBy`.
- AJAX requests return `resources/views/partials/bookmark-list.blade.php`.

## Models And Relationships

### `User`

File: `app/Models/User.php`

- Table: `users`
- Primary key: `user_id`
- Timestamps: disabled
- Fillable fields include name, nim, email, password, role, and reset token
  fields.
- Passwords are automatically hashed through model casts.

Relationships:

- `bookmarks()` is a many-to-many relationship to `Event` through the
  `bookmarks` pivot table.

### `Event`

File: `app/Models/Event.php`

- Table: `events`
- Primary key: `event_id`
- Uses default timestamps.
- Date casts: `event_start`, `event_end`
- Boolean cast: `is_paid`
- Decimal cast: `price`

Relationships:

- `category()` belongs to `Category`.
- `bookmarkedBy()` is a many-to-many relationship to `User` through the
  `bookmarks` pivot table.

### `Category`

File: `app/Models/Category.php`

- Table: `categories`
- Primary key: `category_id`

Relationships:

- `events()` has many `Event`.

### `Registration`

File: `app/Models/Registration.php`

- Table: `registrations`
- Primary key: `registration_id`
- Timestamps: disabled
- Stores student event participation status and registration date.

### `Bookmark`

File: `app/Models/Bookmark.php`

- Currently empty.
- Bookmark behavior is mostly implemented through the many-to-many
  relationships on `User` and `Event`.

## Database Tables

### `users`

Stores registered users.

Important columns:

- `user_id`
- `name`
- `nim`
- `email`
- `password`
- `remember_token`
- `role`
- `reset_token`
- `reset_token_expired_at`
- `created_at`

### `categories`

Stores event categories.

Important columns:

- `category_id`
- `category_name`
- timestamps

Seeded categories:

- Workshop
- Lomba
- Webinar
- Seminar

### `events`

Stores event data.

Important columns:

- `event_id`
- `title`
- `description`
- `short_description`
- `event_start`
- `event_end`
- `location`
- `quota`
- `quota_filled`
- `event_status`
- `registration_status`
- `price`
- `is_paid`
- `category_id`
- `created_by`
- `image_url`
- `organizer`
- `contact_email`
- `contact_phone`
- timestamps

Seeded event images are stored in `public/assets/events`.

### `registrations`

Stores user participation in events.

Important columns:

- `registration_id`
- `user_id`
- `event_id`
- `registration_status`
- `registration_date`

### `bookmarks`

Pivot table connecting users and events.

Important columns:

- `id`
- `user_id`
- `event_id`
- timestamps

## Seeders

Seeders live in `database/seeders`.

- `DatabaseSeeder.php` calls category, event, and registration seeders.
- `CategorySeeder.php` inserts the four main category names.
- `EventSeeder.php` inserts demo events with poster paths.
- `RegistrationSeeder.php` inserts demo registrations for `user_id = 1`.

Important note:

- The current `DatabaseSeeder` does not create a demo user. If the database is
  empty, `RegistrationSeeder` assumes a user with `user_id = 1` already exists.
  Add or seed a user first if you need fresh database setup to work smoothly.

## Blade Views

### Public And Auth Views

- `resources/views/Home/home.blade.php`
- `resources/views/Auth/login.blade.php`
- `resources/views/Auth/register.blade.php`
- `resources/views/Auth/forgot-password.blade.php`
- `resources/views/Auth/reset-password.blade.php`

### Student Views

- `resources/views/Mahasiswa/dashboard.blade.php`
- `resources/views/Mahasiswa/list-event.blade.php`
- `resources/views/Mahasiswa/detail-event.blade.php`
- `resources/views/Mahasiswa/bookmark.blade.php`
- `resources/views/Mahasiswa/history.blade.php`
- `resources/views/Mahasiswa/profile.blade.php`
- `resources/views/Mahasiswa/registration-event.blade.php`
- `resources/views/Mahasiswa/payment.blade.php`

### Admin Views

- `resources/views/Admin/admin-dashboard.blade.php`

### Shared Components

- `resources/views/components/sidebar-mahasiswa.blade.php`
- `resources/views/components/event-card.blade.php`
- `resources/views/components/search-bar.blade.php`
- `resources/views/components/toast.blade.php`
- `resources/views/components/certificate-processing-modal.blade.php`

### AJAX Partials

- `resources/views/partials/event-list.blade.php`
- `resources/views/partials/bookmark-list.blade.php`

These partials are returned by controllers when `X-Requested-With:
XMLHttpRequest` is present.

## Frontend JavaScript

Main entry: `resources/js/app.js`

It imports:

- `bootstrap.js`
- `icon.js`
- `toast.js`
- `counter.js`
- `whatsapp.js`
- `chart.js`
- `togglePassword.js`
- `toggleBookmark.js`
- `debounce.js`
- `eventFilter.js`

Important modules:

- `icon.js` registers Lucide icons used by Blade views.
- `toggleBookmark.js` exposes `window.toggleBookmark(eventId, el)` for event
  card buttons.
- `search.js` handles AJAX search on `/events` and `/bookmark`.
- `filter.js` handles category and status filter requests.
- `eventFilter.js` initializes search and filter behavior when `#eventList`
  exists.
- `chart.js` renders the dashboard donut chart using `data-stats`.
- `counter.js` animates numeric counters.
- `togglePassword.js` handles password visibility icons.
- `whatsapp.js` builds a WhatsApp contact URL from the landing form.
- `toast.js` displays validation and success messages.

## Styling

Main CSS files:

- `resources/css/app.css`
- `resources/css/auth.css`

The project uses Tailwind CSS 4 with custom theme colors in `app.css`.

Common color tokens:

- `primary-dark`
- `primary-lighter`
- `secondary-dark`
- `secondary-lighter`
- `tertiary`
- `orange-550`
- `blue-950`

Most pages use utility classes directly in Blade. When adding UI, follow the
existing visual style unless intentionally redesigning a page.

## Common Development Commands

Install PHP dependencies:

```bash
composer install
```

Install Node dependencies:

```bash
npm install
```

Create app key:

```bash
php artisan key:generate
```

Run migrations:

```bash
php artisan migrate
```

Run seeders:

```bash
php artisan db:seed
```

Start Laravel server:

```bash
php artisan serve
```

Start Vite:

```bash
npm run dev
```

Build frontend assets:

```bash
npm run build
```

Run tests:

```bash
php artisan test
```

The `composer dev` script starts Laravel, the queue listener, and Vite together.

```bash
composer dev
```

## Environment

Configuration is read from `.env`.

Common values to check:

- `APP_KEY`
- `APP_URL`
- `DB_CONNECTION`
- `DB_HOST`
- `DB_PORT`
- `DB_DATABASE`
- `DB_USERNAME`
- `DB_PASSWORD`
- Mail settings for password reset and contact email

Do not commit real secrets from `.env`.

## Authentication And Roles

The app uses Laravel session authentication.

Role handling:

- Student users use role value `Mahasiswa`.
- Admin routes currently check for role value `admin`.

Middleware:

- `app/Http/Middleware/RoleMiddleware.php`
- Registered as alias `role` in `bootstrap/app.php`

Important note:

- Be consistent with role casing. Some older tests use `Admin`, while current
  routes use `role:admin`.

## Current Feature Status

Implemented or mostly implemented:

- Landing page
- Register
- Login
- Logout
- Forgot password and reset password flow
- Student dashboard
- Event list
- Event search
- Event category and status filters
- Event detail page
- Bookmark toggle
- Bookmark list and bookmark search
- Dashboard counters and donut chart

Partially implemented or placeholder-like:

- Admin dashboard
- Profile page data is currently mostly hardcoded in the Blade view.
- History page data is currently hardcoded in the Blade view.
- Registration event page
- Payment page
- Actual event registration workflow
- Certificate download workflow
- Full admin CRUD for events and participants

## Known Issues And Gotchas

These are important for AI assistants before generating code:

- `php` may not be available in every local terminal PATH. If Artisan commands
  fail, verify PHP installation or PATH first.
- `vite.config.js` may have local environment changes. Avoid editing it unless
  the task is specifically about Vite.
- `DatabaseSeeder` currently assumes `user_id = 1` exists for registrations.
- The first users migration includes `reset_token` and a column named
  `reset_token_expired-at`, while a later migration adds `reset_token` and
  `reset_token_expired_at`. This can cause migration conflicts on a fresh
  database.
- `create_registration_table` creates `registrations` but its `down()` method
  drops `registration`, singular.
- Event cards expect `$event->bookmarkedBy` to be loaded. If you pass events to
  `<x-event-card>`, eager load `bookmarkedBy` or adjust the component to handle
  unloaded relations safely.
- `components/event-card.blade.php` includes `@vite(...)`, even though parent
  pages also include Vite. This can duplicate asset tags.
- Some tests appear to reference older routes such as `/profile-design`.
- Admin role casing is inconsistent between route middleware and some tests.

## AI Coding Assistant Guide

When helping with this project:

1. Read `routes/web.php` first to understand the active request flow.
2. Check the relevant controller before editing a Blade page.
3. Check the relevant model relationships before changing queries.
4. Keep student-facing pages under `resources/views/Mahasiswa`.
5. Use existing Blade components when showing event cards, sidebars, search
   bars, toast messages, or modal UI.
6. If adding event list behavior, update both the full Blade page and the AJAX
   partial when needed.
7. If adding icons, import them in `resources/js/icon.js`.
8. If adding routes that require login, apply `auth` and the correct `role`
   middleware.
9. If adding database-backed UI, prefer controller queries or a small service
   class rather than hardcoding data in Blade.
10. If modifying bookmarks, preserve the many-to-many relation through the
    `bookmarks` pivot table.
11. If modifying dashboard stats, check `DashboardController` and
    `DashboardService`.
12. If changing migrations, consider fresh database setup and existing local
    data. Avoid destructive migration changes unless the task explicitly asks
    for them.

## Suggested Patterns For New Code

Backend:

- Put request handling in controllers.
- Put reusable query/stat logic in services when it grows beyond a simple
  controller query.
- Use Eloquent relationships for `users`, `events`, `categories`, and
  `bookmarks`.
- Return Blade partials for AJAX list updates, matching the current pattern.

Frontend:

- Use Blade and Tailwind utility classes.
- Keep browser behavior in `resources/js` modules.
- Initialize behavior on `DOMContentLoaded`.
- Re-run Lucide `createIcons()` after replacing AJAX HTML.
- Use existing IDs such as `#eventList`, `#searchInput`, `#categoryFilter`, and
  `#statusFilter` when extending the event list page.

UI:

- Match the existing blue/orange FILKOMEVENT style.
- Use Lucide icons instead of custom inline SVG when possible.
- Keep event card behavior consistent across dashboard, list, and bookmark
  pages.

## Recommended Next Improvements

Good next tasks for this codebase:

- Fix migration conflicts for reset token columns.
- Seed a demo user before demo registrations.
- Make role casing consistent for admin users.
- Update tests to match current routes.
- Move hardcoded profile data to authenticated user data.
- Replace hardcoded history data with registrations from the database.
- Implement actual event registration.
- Add admin CRUD for events and categories.
- Add pagination rendering for the event list.
- Remove duplicate `@vite` usage from nested components.

## Project Summary

FILKOMEVENT is already a useful Laravel event portal prototype with a working
student dashboard, event browsing, filters, and bookmarks. The next major work
is to make the placeholder pages database-driven, clean up migration/test
inconsistencies, and expand the admin and registration workflows.
