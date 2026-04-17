# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Project

**NCIEPortal** — Management platform for NCIE (Núcleo de Capacitación e Innovación Empresarial). Handles courses, projects, enrollments, and role-based user management.

**Repo**: https://github.com/Joshua-Velasco/NCIEPortal.git  
**Stack**: PHP 8.1 / Laravel 10 / MySQL 8.0 / Bootstrap 5 + Tailwind CSS 3 / Vite / Laravel Sail (Docker)

---

## Commands

### Docker (required for tests)

```bash
# Start environment
./vendor/bin/sail up -d

# First-time setup
./vendor/bin/sail artisan migrate --seed

# Run all tests
./vendor/bin/sail test

# Run single test file
./vendor/bin/sail test tests/Feature/BasicFlowTest.php

# Run single test method
./vendor/bin/sail test --filter test_login_page_is_accessible

# Static analysis (PHPStan level 5)
./vendor/bin/sail bin phpstan analyze

# Code style (Laravel Pint)
./vendor/bin/sail bin pint

# Reset DB with seed data
./vendor/bin/sail artisan migrate:fresh --seed
```

### Without Docker (no tests)

```bash
composer install
npm install && npm run build
php artisan key:generate
php artisan migrate --seed
php artisan serve          # http://localhost:8000
npm run dev                # Vite dev server (hot reload)
```

### CI pipeline (GitHub Actions)

Runs on push/PR to `main` and `develop`: PHPStan → PHPUnit with MySQL service container.

---

## Architecture

### Request Flow

```
HTTP → public/index.php → app/Http/Kernel.php → routes/web.php → Controller → Model → Blade view
```

All web routes are in `routes/web.php` (~23KB). The admin section sits behind `auth`, `verified`, and Spatie permission middleware (`can:permission`). `routes/api.php` is minimal — only a Sanctum-protected `/user` endpoint.

### Role-Based Access Control

Four roles via **Spatie Laravel Permission**: `admin`, `administrativo`, `gestor`, `alumno`. Seeded in `database/seeders/RoleSeeder.php`. Route middleware uses `can:` prefix gates. The `User` model relates to role-specific profile models (`Alumno`, `Gestor`, `Administrativo`) — a user always has exactly one profile type.

### Core Domain Models

| Model | Purpose |
|-------|---------|
| `User` + `Alumno`/`Gestor`/`Administrativo` | Auth + role-specific profiles |
| `Curso` | Courses with dates, modality, capacity |
| `Proyecto` | Projects (with photo uploads to `public/uploads/`) |
| `Inscripcion` | Student ↔ Course enrollment pivot |
| `AlumnoProyecto` | Student ↔ Project (residencias/servicio social) |
| `GestorCurso` / `GestorProyecto` | Instructor assignments |
| `Area` | Technology categories (IOT, etc.) |
| `Horario` | Instructor availability by area |
| `Presupuesto` | Budget tracking |
| `Post` | Announcements |

### Controllers Pattern

Controllers in `app/Http/Controllers/Admin/` follow standard Laravel resource conventions. Authentication controllers live in `app/Http/Controllers/Admin/Auth/`. Each domain module (cursos, proyectos, alumnos, gestores, etc.) has its own controller and corresponding Blade views under `resources/views/admin/{module}/`.

### Frontend

Blade templates with Bootstrap 5 + Tailwind CSS 3. Vite compiles `resources/sass/app.scss`, `resources/js/app.js`, and `resources/css/tailwind.css`. Built output goes to `public/dist/`. `index.blade.php` loads Tailwind via `@vite(['resources/css/tailwind.css'])`.

**Tailwind config**: `tailwind.config.js` — prefix `tw-` (all utilities are `tw-flex`, `tw-text-xl`, etc.), `preflight: false` (Bootstrap handles base reset). Use `tw-` prefix for all new Tailwind utilities to avoid Bootstrap conflicts. `group-hover:tw-*` works with `tw-group` on parent. FullCalendar and other vendor plugins are in `public/plugins/` and `public/fullcalendar/` (not npm-managed).

### Database

Migrations in `database/migrations/`. See `database/DATABASE.md` for full schema. Key relationships use CASCADE on delete. Testing database is created automatically by the Sail MySQL container script at `vendor/laravel/sail/database/mysql/create-testing-database.sh`.

---

## Dev Credentials (local only)

```
Email:    sistemancie@gmail.com
Password: 123456789
```

---

## Git Workflow

- `main` — production-ready (PRs only)
- `develop` — integration branch
- CI runs on push/PR to both branches
