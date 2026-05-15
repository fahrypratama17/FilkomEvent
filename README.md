# FILKOMEVENT

FILKOMEVENT is a Laravel web application for managing and discovering events at
the Faculty of Computer Science, Universitas Brawijaya. It gives students a
place to browse events, bookmark them, view details, start registration/payment
flows, and review participation history. It also includes an admin area for
dashboard access and event management.

This README is a project map for developers and AI coding assistants. Read it
alongside `routes/web.php` before making changes.

## Tech Stack

- Backend: Laravel 13, PHP 8.3+
- Frontend bundler: Vite 8 through `laravel-vite-plugin`
- Styling: Tailwind CSS 4
- JavaScript: ES modules in `resources/js`
- Icons: Lucide, registered in `resources/js/icon.js`
- Views: Blade templates
- Database layer: Eloquent models and Laravel query builder
- Mail: Laravel Mailables for contact and reset-password email
- Tests: PHPUnit through `php artisan test`

## Main Features

Student-facing features:

- Public landing page with contact email form
- Student registration using `@student.ub.ac.id`
- Login, logout, forgot-password, and reset-password flows
- Student dashboard with recent events, category stats, and summary counters
- Event list with search, category filter, status filter, and pagination
- Event detail page with speakers and goals
- Registration and payment pages for an event
- Bookmark toggle and bookmarked-event list
- Profile page with change-password form
- Participation history page backed by registrations

Admin-facing features:

- Admin dashboard route and page
- Event management table
- Search, category filter, status filter, and pagination for events
- Create-event form with validation and image upload
- Event deletion with cleanup for uploaded `storage/events/*` images

Still incomplete or placeholder-like:

- Admin edit/update events
- Admin user, participant, certificate, and category management
- Actual event-registration write flow
- Real payment processing
- Certificate generation/download workflow
- Database-backed admin dashboard statistics

## Project Structure

```text
FilkomEvent/
  app/
    Http/Controllers/     Request handlers
    Http/Middleware/      Role middleware
    Mail/                 Contact and reset-password mailables
    Models/               Eloquent models
    Service/              Menu and dashboard service classes
    View/Components/      Blade component classes
  database/
    migrations/           Database schema
    seeders/              Demo users, admin, events, speakers, goals, logs
    factories/            Test factories
  public/
    assets/events/        Seeded event poster images
    assets/profile/       Seeded speaker/profile images
    icon/                 Logo and UI/social assets
  resources/
    css/                  Tailwind and custom CSS entry files
    js/                   Browser behavior modules
    views/                Blade pages, components, partials, email views
  routes/
    web.php               Web routes
  tests/
    Feature/              Feature tests
    Unit/                 Unit tests
```

## Setup

Install PHP and Node dependencies:

```bash
composer install
npm install
```

Create or update `.env`, then generate an app key:

```bash
php artisan key:generate
```

Set the database values in `.env`, then migrate and seed:

```bash
php artisan migrate
php artisan db:seed
```

Start the app in two terminals:

```bash
php artisan serve
npm run dev
```

Or use the Composer helper that starts Laravel, the queue listener, and Vite:

```bash
composer dev
```

Build frontend assets:

```bash
npm run build
```

Run tests:

```bash
php artisan test
```

Notes:

- This repository currently has `.env` but no `.env.example`.
- `storage:link` may be needed if uploaded public images are not visible:

```bash
php artisan storage:link
```

## Seeded Accounts

Seeders create development users. Change these before any real deployment.

- Student: `helwa@student.ub.ac.id` / `1234567890`
- Admin: `admin@filkomevent2.com` / `admin12345`

`UserSeeder` also creates `adityaakbar@student.ub.ac.id` with role `Admin`, but
the active admin route middleware expects the exact role value `admin`.

## Routes

Routes are defined in `routes/web.php`.

Public and auth routes:

- `GET /` landing page
- `GET /login` login form
- `POST /login` authenticate user
- `POST /logout` logout
- `GET /register` registration form
- `POST /register` create student account
- `GET /forgot-password` forgot-password form
- `POST /forgot-password` send reset-password email
- `GET /reset-password/{token}` reset-password form
- `POST /reset-password` update password
- `POST /kirim-email` send landing-page contact email

Student routes use `auth` and `role:Mahasiswa`:

- `GET /dashboard`
- `GET /profile`
- `POST /profile`
- `GET /events`
- `GET /events/{id}`
- `GET /events/{id}/registration`
- `GET /events/{id}/payment`
- `GET /bookmark`
- `POST /bookmark/{id}`
- `GET /history`

Admin routes use `auth`, `role:admin`, the `/admin` URL prefix, and the
`admin.` route-name prefix:

- `GET /admin/dashboard`
- `GET /admin/events`
- `GET /admin/events/create`
- `POST /admin/events`
- `DELETE /admin/events/{event}`

## Controllers

`AuthController`

- Registers students with `ends_with:@student.ub.ac.id`
- Logs users in and redirects admins to `admin.dashboard`
- Logs users out and regenerates the session token
- Sends contact email with `ContactMail`
- Creates custom password reset tokens and sends `ResetPassword`

`DashboardController`

- Builds the student dashboard
- Loads the latest three events
- Computes registration, certificate, upcoming-event, and category stats
- Uses local menu helpers instead of `MenuService`

`EventController`

- Lists events with category and current-user bookmark state
- Supports title search, category filter, and status filter
- Uses date-based filters for `akan_datang`, `berlangsung`, and `selesai`
- Uses `event_status = Dibatalkan` for `dibatalkan`
- Returns `partials.event-list` for AJAX requests
- Shows event detail with category, speakers, and goals
- Renders registration and payment pages for an event
- Toggles bookmarks through the `bookmarks` pivot table

`BookmarkController`

- Lists events bookmarked by the authenticated student
- Supports title search
- Returns `partials.bookmark-list` for AJAX requests

`HistoryController`

- Lists the authenticated student's registrations
- Eager-loads each registration's event and category
- Supports event-title search and category filter
- Paginates registrations by six per page

`UserController`

- Shows the authenticated student's profile
- Changes password after validating the current password

`AdminEventController`

- Lists admin events and guards against missing `events` or `categories` tables
- Supports event title, category, and raw status filters
- Paginates by ten events per page
- Renders the create-event form
- Validates and stores new events
- Uploads event images to the public disk under `events`
- Deletes events and removes uploaded image files when applicable

## Database

Main migrated tables:

- `users`
- `categories`
- `events`
- `registrations`
- `bookmarks`
- `speakers`
- `event_speakers`
- `event_goals`
- `activity_log`

Important table notes:

- `users` uses `user_id` as the primary key and stores roles as strings.
- `events` uses `event_id` as the primary key and has no model timestamps.
- `events.created_by` references `users.user_id`.
- `bookmarks` is a pivot table between `users` and `events`; the migration uses
  the default `id` column, while `Bookmark` currently declares
  `bookmark_id` as its primary key.
- `registrations` connects students to events and stores
  `registration_status` plus `registration_date`.
- `speakers` connect to events through `event_speakers`.
- `event_goals` stores bullet-style goals for detail pages.
- `payments` and `certificates` models exist, but matching migrations are not
  present in the current codebase.

## Models

Core relationships:

- `User` has many `Registration` and belongs to many `Event` through
  `bookmarks`.
- `Event` belongs to `Category` and creator `User`.
- `Event` has many `Registration` and `EventGoal`.
- `Event` belongs to many `Speaker` through `event_speakers`.
- `Event` belongs to many bookmarked `User` records through `bookmarkedBy`.
- `Category` has many `Event`.
- `Registration` belongs to `User` and `Event`; it also defines `payment()` and
  `certificate()` relationships.
- `Speaker` belongs to many `Event`.
- `ActivityLog` belongs to `User`.

## Seeders

`DatabaseSeeder` calls:

- `UserSeeder`
- `AdminSeeder`
- `CategorySeeder`
- `EventSeeder`
- `SpeakerSeeder`
- `EventSpeakerSeeder`
- `EventGoalSeeder`
- `RegistrationSeeder`
- `ActivityLogSeeder`

Seeded data includes:

- Four categories: Workshop, Lomba, Webinar, Seminar
- Eight demo events using images from `public/assets/events`
- Five speakers using images from `public/assets/profile`
- Event-speaker pivot records
- Event goals for the first few events
- Three demo registrations for `user_id = 1`
- Activity log records

Status gotcha:

- `EventSeeder` stores `event_status` as `Aktif`.
- `AdminEventController@store` validates new event statuses as lowercase:
  `berlangsung`, `akan_datang`, `selesai`, `dibatalkan`.
- Student filtering calculates most statuses from event dates, but uses
  `Dibatalkan` with uppercase `D` for cancelled events.

## Views

Public/auth views:

- `resources/views/Home/home.blade.php`
- `resources/views/Auth/login.blade.php`
- `resources/views/Auth/register.blade.php`
- `resources/views/Auth/forgot-password.blade.php`
- `resources/views/Auth/reset-password.blade.php`

Student views:

- `resources/views/Mahasiswa/dashboard.blade.php`
- `resources/views/Mahasiswa/list-event.blade.php`
- `resources/views/Mahasiswa/detail-event.blade.php`
- `resources/views/Mahasiswa/registration-event.blade.php`
- `resources/views/Mahasiswa/payment.blade.php`
- `resources/views/Mahasiswa/bookmark.blade.php`
- `resources/views/Mahasiswa/history.blade.php`
- `resources/views/Mahasiswa/profile.blade.php`

Admin views:

- `resources/views/Admin/admin-dashboard.blade.php`
- `resources/views/Admin/events-management.blade.php`
- `resources/views/Admin/form-upload-admin.blade.php`

Shared components and partials:

- `components/sidebar-mahasiswa.blade.php`
- `components/event-card.blade.php`
- `components/search-bar.blade.php`
- `components/toast.blade.php`
- `components/modal-change-password.blade.php`
- `components/terms-modal.blade.php`
- `partials/event-list.blade.php`
- `partials/bookmark-list.blade.php`

## Frontend

Vite inputs are configured in `vite.config.js`:

- `resources/css/app.css`
- `resources/js/app.js`

`resources/js/app.js` imports:

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
- `changePasswordModal.js`
- `countDown.js`
- `termsModal.js`
- `buttonTerm.js`
- `accordion.js`

Important frontend patterns:

- `eventFilter.js` initializes search/filter behavior when `#eventList` exists.
- `search.js` and `filter.js` fetch updated list HTML over AJAX.
- `toggleBookmark.js` exposes `window.toggleBookmark(eventId, el)`.
- `chart.js` renders the dashboard chart from DOM data.
- `icon.js` must be updated when adding new Lucide icons.
- Admin event management uses Alpine.js through a CDN script in
  `resources/views/Admin/events-management.blade.php`, not through
  `package.json`.

## Development Gotchas

- Role checks are case-sensitive in `RoleMiddleware`.
- Admin routes require role `admin`, but some seeded/test users use `Admin`.
- `EnsureUserIsAdmin` exists and checks roles case-insensitively, but routes
  currently use `role:admin`, not the `admin` middleware alias.
- `AuthController@login` does not pass the request's `remember` value into
  `Auth::attempt()`.
- Some feature tests reference older routes such as `/profile-design`.
- `Bookmark` declares `bookmark_id`, but the migration creates `id`.
- `components/event-card.blade.php` includes `@vite(...)`; parent pages also
  include Vite, so nested event cards may duplicate asset tags.
- Admin create-event fields and event status values should be kept aligned with
  the `events` migration, `Event::$fillable`, and controller validation.
- If you add or rename routes, update sidebar route names in `MenuService`,
  `DashboardController`, and relevant Blade components.

## Good Next Improvements

- Normalize admin role casing across seeders, middleware, tests, and login.
- Decide one event-status vocabulary and update seeders, filters, views, and
  validation together.
- Fix tests so they match the current routes and authentication behavior.
- Add admin edit/update routes and controller methods.
- Implement real event registration and payment persistence.
- Add migrations or remove unused models for payments and certificates.
- Move admin dashboard numbers from hardcoded Blade content into queries or a
  service class.
- Remove duplicate `@vite` usage from nested components.
- If admin interactivity grows, decide whether Alpine should stay CDN-loaded or
  move into the Vite dependency graph.
