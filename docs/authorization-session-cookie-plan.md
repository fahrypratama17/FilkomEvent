# FilkomEvent Backend Understanding and Next-Step Plan

Date: 2026-04-26

## 1) Current Backend State (Observed in Code)

- Stack: Laravel 13.2, PHP 8.4, default web routes.
- Current backend implementation is still early-stage and prototype-heavy.
- Active backend logic currently centers on:
  - AuthController for register and login.
  - User model for users table.
  - users migration.
- Most feature pages are currently direct routes to Blade views, not controller-service-repository flows yet.

### Route and Auth Observations

- Registered routes: 16 total.
- All routes currently only use web middleware group.
- No auth middleware route groups yet.
- No role middleware yet.
- No logout route yet.

### Session/Cookie/Auth Observations

- Login currently uses manual session storage: session(["user" => $user]).
- Laravel guard auth flow (Auth::attempt/Auth::login) is not yet used.
- Session driver in environment is currently file.
- Remember-me flow is not yet implemented.

### MySQL Observations

- Environment is configured for MySQL:
  - DB_CONNECTION=mysql
  - DB_HOST=127.0.0.1
  - DB_PORT=3306
  - DB_DATABASE=FilkomEvent
- MySQL server is currently down/unreachable, so migration status cannot be validated live right now.

### Schema Consistency Risks to Fix Early

- users migration currently has email unique syntax issue: unique method is missing parentheses.
- UserFactory references fields not present in users migration (email_verified_at, remember_token).
- This will matter once remember-me cookie flow is implemented.

## 2) ERD Understanding (From Your Mermaid)

You provided these main domains:

- Identity: users
- Event core: events, categories, event_goals, event_speakers, speakers
- Participation: registrations, payments, certificates, bookmarks
- Auditability: activity_log

Key relationship rules interpreted from ERD:

- One user can create many events.
- One event belongs to one category.
- One user can register many events through registrations.
- One registration can have payment records and a certificate.
- One event can have many goals and many speakers (through pivot event_speakers).
- One user can bookmark many events through bookmarks.
- One user can produce many activity log records.

## 3) Recommended MySQL Data Type/Length Plan

These are implementation-ready suggestions aligned to your ERD and Laravel + MySQL conventions.

### users

- user_id: BIGINT UNSIGNED PK AUTO_INCREMENT
- name: VARCHAR(100)
- nim: VARCHAR(16) UNIQUE
- email: VARCHAR(191) UNIQUE
- password: VARCHAR(255)
- role: VARCHAR(20) default Mahasiswa
- remember_token: VARCHAR(100) NULL
- created_at: TIMESTAMP default CURRENT_TIMESTAMP
- updated_at: TIMESTAMP NULL

### events

- event_id: BIGINT UNSIGNED PK AUTO_INCREMENT
- title: VARCHAR(150)
- description: TEXT
- event_start: DATETIME
- event_end: DATETIME
- location: VARCHAR(150)
- quota: INT UNSIGNED
- quota_filled: INT UNSIGNED default 0
- event_status: VARCHAR(30)
- registration_status: VARCHAR(30)
- price: DECIMAL(12,2) default 0
- is_paid: TINYINT(1) default 0
- category_id: BIGINT UNSIGNED FK
- created_by: BIGINT UNSIGNED FK -> users.user_id
- image_url: TEXT
- organizer: VARCHAR(120)
- contact_email: VARCHAR(191)
- contact_phone: VARCHAR(30)
- created_at: TIMESTAMP default CURRENT_TIMESTAMP
- updated_at: TIMESTAMP NULL

### registrations

- registration_id: BIGINT UNSIGNED PK AUTO_INCREMENT
- user_id: BIGINT UNSIGNED FK
- event_id: BIGINT UNSIGNED FK
- registration_status: VARCHAR(30)
- registration_date: DATETIME
- created_at: TIMESTAMP default CURRENT_TIMESTAMP
- updated_at: TIMESTAMP NULL
- UNIQUE KEY (user_id, event_id)

### payments

- payment_id: BIGINT UNSIGNED PK AUTO_INCREMENT
- registration_id: BIGINT UNSIGNED FK
- invoice_code: VARCHAR(50) UNIQUE
- method: VARCHAR(30)
- amount: DECIMAL(12,2)
- status: VARCHAR(30)
- transaction_id: VARCHAR(100) NULL
- created_at: TIMESTAMP default CURRENT_TIMESTAMP
- updated_at: TIMESTAMP NULL

### certificates

- certificate_id: BIGINT UNSIGNED PK AUTO_INCREMENT
- registration_id: BIGINT UNSIGNED FK
- file_path: TEXT
- date_generate: DATETIME
- created_at: TIMESTAMP default CURRENT_TIMESTAMP
- updated_at: TIMESTAMP NULL

### event_goals

- goal_id: BIGINT UNSIGNED PK AUTO_INCREMENT
- event_id: BIGINT UNSIGNED FK
- description: TEXT

### speakers

- speaker_id: BIGINT UNSIGNED PK AUTO_INCREMENT
- name: VARCHAR(100)
- title: VARCHAR(120)
- organization: VARCHAR(120)
- photo_url: TEXT

### event_speakers

- id: BIGINT UNSIGNED PK AUTO_INCREMENT
- event_id: BIGINT UNSIGNED FK
- speaker_id: BIGINT UNSIGNED FK
- UNIQUE KEY (event_id, speaker_id)

### categories

- category_id: BIGINT UNSIGNED PK AUTO_INCREMENT
- category_name: VARCHAR(100) UNIQUE

### bookmarks

- bookmark_id: BIGINT UNSIGNED PK AUTO_INCREMENT
- user_id: BIGINT UNSIGNED FK
- event_id: BIGINT UNSIGNED FK
- UNIQUE KEY (user_id, event_id)

### activity_log

- log_id: BIGINT UNSIGNED PK AUTO_INCREMENT
- user_id: BIGINT UNSIGNED FK
- action: VARCHAR(100)
- description: TEXT
- created_at: TIMESTAMP default CURRENT_TIMESTAMP

## 4) Next-Step Authorization Plan (Session + Cookies)

This is the sequence I recommend for implementation.

### Phase A: Baseline Hardening (Do First)

1. Normalize users migration and factory fields:
   - fix email unique syntax,
   - add remember_token,
   - align timestamps and optional updated_at.
2. Add missing auth routes:
   - POST logout,
   - route redirects for guest/auth users.
3. Wire login/register page links correctly to named routes.

### Phase B: Move to Laravel Session Auth

1. Replace manual session(["user" => $user]) with Auth::attempt.
2. On successful login:
   - regenerate session ID.
   - support remember-me boolean from form.
3. On logout:
   - Auth::logout,
   - invalidate session,
   - regenerate CSRF token.

### Phase C: Route Protection and Authorization

1. Protect user pages with auth middleware.
2. Keep auth pages (login/register) under guest middleware.
3. Add role middleware for admin pages.
4. Add ownership checks (policy or gate) for:
   - event edit/delete by creator or admin,
   - registration/payment access by event owner or related user.

### Phase D: Cookie Security Rules

1. Keep authentication state in Laravel session cookie only.
2. Do not store role/user data in plain custom cookies.
3. Configure secure cookie flags via environment:
   - SESSION_SECURE_COOKIE
   - SESSION_HTTP_ONLY
   - SESSION_SAME_SITE
4. Add remember_token support for persistent login.

### Phase E: Align Domain Models with ERD

1. Add migrations incrementally for ERD tables.
2. Add Eloquent models and relationships.
3. Add FK constraints and unique composite indexes.
4. Seed minimal roles, categories, and sample events.

### Phase F: Test Coverage Before Feature Expansion

1. Feature tests:
   - register,
   - login success/fail,
   - remember-me,
   - logout,
   - guest cannot access protected routes.
2. Authorization tests:
   - non-admin blocked from admin routes,
   - cross-user access denied for private resources.

## 5) Practical Execution Order When MySQL Is Up Again

1. Start MySQL and verify connection.
2. Run migration repair/new migrations.
3. Run seeders.
4. Implement auth refactor and middleware.
5. Run feature tests.
6. Then continue implementing the event-registration-payment flow from ERD.

## 6) Deliverables for the Next Work Session

- Updated migration set aligned with ERD baseline.
- Refactored AuthController using Laravel Auth guard + remember-me.
- New logout flow.
- Middleware-protected route groups for guest/auth/admin.
- Initial model relationships for users, events, registrations, payments, bookmarks.
- Feature tests for authentication and authorization paths.
