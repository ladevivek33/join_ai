# Join AI

A Laravel-based web application connecting users with AI products. This platform features a dual-interface system for Administrators to manage products and Users to request them.

## Features

### Admin Panel
- **Secure Authentication**: Dedicated admin login.
- **Dashboard**: Overview of registered users.
- **User Management**: View detailed user profiles.
- **Product Management**: Add new products with images, prices, and quantities.
- **Order Management**: View and manage product requests from users.

### User Panel
- **Registration & Login**: Secure user account creation and authentication.
- **Dashboard**: Browse available products.
- **Product Requests**: Request specific quantities of products.

## Technology Stack
- **Framework**: Laravel 11
- **Frontend**: Blade Templates, Bootstrap 5 (CDN)
- **Database**: MySQL

## Installation

1. **Clone the repository**
   ```bash
   git clone <repository-url>
   cd join_ai
   ```

2. **Install Dependencies**
   ```bash
   composer install
   npm install && npm run build
   ```

3. **Environment Setup**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```
   *Configure your database settings in the `.env` file.*

4. **Database Migration**
   ```bash
   php artisan migrate --seed
   ```
   *This will run migrations and seed a test user.*

5. **Serve Application**
   ```bash
   php artisan serve
   ```

## Usage

### Admin Access
- **URL**: `/admin/alogin`
- **Username**: `admin`
- **Password**: `admin123`

### User Access
- **Register**: `/register`
- **Login**: `/login` OR Root URL `/` (redirects to login)

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## Acknowledgements

This project was built with the assistance of Antigravity.
