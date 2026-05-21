# Rately — Product Review Marketplace

A modern Laravel 12 web application for browsing products, placing orders, and submitting verified buyer reviews.

## Overview

Rately is a full-stack product review system built with Laravel, Tailwind CSS, Vite, and Alpine.js. It supports:

- Product catalog browsing
- Authenticated shopping cart and checkout flows
- Payment simulation for demo mode
- Verified review submission
- Admin moderation for reviews
- User order history

## Key Features

- Responsive public product listing and product detail pages
- Cart management with add/remove item support
- Secure checkout flow behind authentication
- Payment page with polished UI and simulated processing
- Review creation for logged-in users
- Admin dashboard for review approvals and moderation
- Modern dark-themed UI with premium visual design

## Technology Stack

- PHP 8.2
- Laravel 12
- Tailwind CSS
- Vite
- Alpine.js
- Laravel Breeze for authentication
- Pest for testing

## Requirements

- PHP 8.2+
- Composer
- Node.js / npm
- MySQL, SQLite, or another supported database

## Installation

1. Clone the repository:

```bash
git clone <repository-url> rately
cd rately
```

2. Install PHP dependencies:

```bash
composer install
```

3. Install JavaScript dependencies:

```bash
npm install
```

4. Copy environment settings and generate an application key:

```bash
cp .env.example .env
php artisan key:generate
```

5. Configure your `.env` database settings and migrate:

```bash
php artisan migrate
```

6. Build assets:

```bash
npm run build
```

## Local Development

Run the Vite development server:

```bash
npm run dev
```

Or run the full application locally with Laravel:

```bash
php artisan serve
```

## Common Scripts

- `composer install` — install PHP dependencies
- `npm install` — install frontend dependencies
- `npm run build` — compile Tailwind and JavaScript assets
- `npm run dev` — start Vite development server
- `php artisan migrate` — run database migrations
- `php artisan view:clear` — clear compiled view cache
- `php artisan test` — run automated tests

## Routes and Pages

The main application routes include:

- `/` — home / product listing
- `products/*` — product browsing and detail pages
- `/cart` — shopping cart
- `/checkout` — checkout page (auth required)
- `/payment` — payment page (auth required)
- `/my-orders` — order history (auth required)
- `/products/{product}/review` — add review (auth required)
- `/admin/dashboard` — admin overview (admin required)
- `/admin/reviews` — review moderation (admin required)

## Authentication

The app uses Laravel Breeze for login and registration flows. Authenticated users can:

- add items to cart
- complete checkout
- submit reviews
- view order history

## Admin Access

Admin users can access review moderation and dashboard stats under `/admin`. The user model includes an `is_admin` field to distinguish admin accounts.

## Project Structure

- `app/` — application models, controllers, middleware, providers
- `resources/views/` — Blade templates and page views
- `resources/css/` — Tailwind configuration and CSS
- `resources/js/` — Alpine.js frontend interactions
- `routes/web.php` — primary route definitions
- `database/migrations/` — schema setup
- `tests/` — automated test suites

## Notes

- The project is currently styled around a premium dark UI experience.
- Payment is simulated for demo/testing purposes; no real gateway integration is included.
- Review posting is gated by login and admin review approval is required for moderation.

## License

This project is released under the MIT License.
