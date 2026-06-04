# RSKK PPID — Agent Guide

## Stack
- Laravel 11 + PHP 8.2+ + MySQL
- Vite (only for `resources/css/app.css` + `resources/js/app.js`)
- Frontend assets: `public/assets/` (not Vite-managed), AdminLTE in `public/dist/`, plugins in `public/plugins/`

## Key Commands
```bash
npm run dev          # Vite dev server
npm run build        # Vite build
php artisan serve    # Laravel dev server
```

## Auth & Roles
- Custom login (no Breeze/Jetstream). Route: `GET/POST /login`, controller: `PenggunaController`
- Three roles: `super_admin`, `admin`, `operator` (checked via `CheckRoleMiddleware`)
- Middleware alias: `role` → `CheckRoleMiddleware`
- Session driver: `database`, cache: `database`, queue: `database`

## App Structure
- Routes: all in `routes/web.php` — no API routes
- Frontend layout: `resources/views/layouts/app.blade.php` (user), `layouts/admin.blade.php` (admin)
- Blade components in `resources/views/components/`
- Nav menu is **dynamic** — fetched from `App\Models\Menu` with `child` submenus (no caching yet)
- Image storage: `public/storage/` (disk `local`), accessed via `/storage/` URL

## Database
- Migrations in `database/migrations/`
- Key models: `PermohonanInformasi`, `PengajuanKeberatan`, `InformasiPublik`, `BackgroundImage` (slugs: logo, banner, thumbnail, q&a)
- Reference system: `Reference` model with `slug` field used as category key (e.g. `informasi`, `memperoleh`, `mendapat`)
- Status: `Status` model, values: 0=reject, 1=accept, 2=send, 3=process

## Notable Packages
- `mews/captcha` — captcha for public forms
- `barryvdh/laravel-debugbar` (dev)
- `laravel/pint` (dev) — PHP code style
- `laravel/reverb` — WebSocket (installed but not configured in .env)

## Conventions
- Controllers use `$guarded = ['id']` (not `$fillable`)
- Views use `@extends('layouts.app')` for user, `@extends('layouts.admin')` for admin
- Models eager-load relationships via `$with` property
- `BackgroundImage` images stored as: `<img src="/storage/{{ $item->image }}">`
- WhatsApp number in floating button at `app.blade.php:73` — update for production
