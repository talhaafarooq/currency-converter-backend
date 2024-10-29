# Currency Converter Backend (Laravel)

## Overview
This is the backend application built with Laravel for the Currency Converter project. It provides RESTful API endpoints to manage currencies and perform currency conversions.

## Requirements
- PHP >= 8.0
- Composer
- MySQL or any compatible database

## Installation

1. Clone the repository:
   git clone https://github.com/talhaafarooq/currency-converter-backend.git
   cd currency-converter-backend

2. Install Composer dependencies:
    composer install

3. Create a .env file from the example:
    cp .env.example .env

4. Set up your database configuration in the .env file:
    Update the database connection details (DB_DATABASE, DB_USERNAME, DB_PASSWORD).

5. Generate the application key:
    php artisan key:generate

6. Run database migrations to create the necessary tables:
    php artisan migrate

7. Seed the database with predefined currencies:
    php artisan db:seed

8. Run the Laravel development server:
    php artisan serve

The backend will be available at http://localhost:8000