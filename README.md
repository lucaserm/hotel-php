# Openlab Hotel

A hotel booking and reservation management system built with PHP and MySQL.

## Features

- User registration, login, and profile management
- Browse room catalog with pricing by type (Standard, Deluxe, Suite)
- Real-time room availability search
- Create and cancel reservations
- Dashboard with recent bookings for authenticated users

## Tech Stack

- **Backend:** PHP 8+
- **Database:** MySQL 8.0
- **Frontend:** Bootstrap 5, vanilla JS
- **Routing:** Custom `router.php`

## Project Structure

```
hotel-php/
├── api/            # JSON API endpoints (room availability)
├── assets/         # CSS and static files
├── components/     # Reusable components (navbar, footer)
├── includes/       # Database connection
├── Models/         # PHP classes and SQL schema
├── pages/          # Page routes
│   └── reservas/   # Reservation pages
└── router.php      # URL router
```

## Getting Started

### 1. Start the database

```bash
docker compose up -d
```

This starts a MySQL 8.0 container with:
- **Host:** 127.0.0.1:3306
- **User:** root / **Password:** root
- **Database:** hotel
- Schema is auto-imported from `Models/txt.sql`

### 2. Run the PHP server

```bash
php -S localhost:8000 router.php
```

Then open [http://localhost:8000](http://localhost:8000).

### Without Docker

1. Create a MySQL database named `hotel`
2. Import `Models/txt.sql`
3. Update credentials in `includes/conexao.php`
4. Run the PHP server as above
