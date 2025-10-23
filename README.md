<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>
# ComplainApp

ComplainApp is a lightweight complaint tracking and management system built with Laravel. It allows clients to submit complaints, upload evidence, communicate with staff via threaded conversations, and track the status of their complaints. Staff members and department heads can review complaints, provide feedback, and escalate to senior boards.

## Key Features

- Multi-role system: Clients, Staff Members, Department Heads, Admin
- Complaint submission with multiple evidence files
- Secure file serving for previews and downloads
- Conversation/chat per complaint (client ↔ admin/staff)
- Status workflow (pending, in progress, resolved, closed)
- Staff feedback and complaint assignment
- Modern responsive UI with light/dark mode support

## Tech Stack

- Backend: PHP 8.x, Laravel 9.x
- Frontend: Blade templates, Tailwind CSS, vanilla JavaScript
- Database: MySQL (schema included under `database/schema`)
- Dev tools: Vite, NPM/Yarn, Composer

## Getting Started

These steps assume you already have PHP, Composer, Node.js and a MySQL server installed.

1. Clone the repository

	git clone <repo-url>

2. Install PHP dependencies

	composer install

3. Install frontend dependencies and build assets

	npm install
	npm run build

4. Copy the example environment file and configure

	cp .env.example .env
	php artisan key:generate

	Update `.env` with your DB credentials and other config.

5. Run database migrations and seeders

	php artisan migrate --seed

6. Serve the app locally

	php artisan serve

Open http://127.0.0.1:8000 in your browser.

## Routes of Interest

- Client complaint listing: `/client/past-complaints` (view)
- Client complaint form: `/client/complain` (create)
- Secure evidence preview/download routes are registered under `/client/complaint/{id}/evidence/{fileIndex}` and similar patterns for staff/admin

## Screenshots

Place two screenshots in the repository under `screenshots/` using these exact filenames:

- `screenshots/light-mode.png` — screenshot of the UI in light mode
- `screenshots/dark-mode.png` — screenshot of the UI in dark mode

You can add them to this README by placing the PNGs in `screenshots/` and the images will automatically render below.

### Light Mode

![Light Mode](/screenshots/light-mode.png)

### Dark Mode

![Dark Mode](/screenshots/dark-mode.png)

If you prefer a different folder layout, update the image paths accordingly.

## Notes & Troubleshooting

- If you see 404s when loading evidence files, ensure your storage link is created:

  php artisan storage:link

- When editing Blade templates or assets, clear caches if necessary:

  php artisan view:clear; php artisan cache:clear; php artisan route:clear

## Contributing

Contributions are welcome. Please open an issue to discuss major changes before sending a PR.

## License

Specify your license here (if any).

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Redberry](https://redberry.international/laravel-development)**
- **[Active Logic](https://activelogic.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
