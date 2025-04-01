<h1 align="center">Real ASC</h1>

<p align="center">
    <img  src="storage/images/logo.ico"/>
</p>

Real ASC is a web application designed to manage a sports club. It allows users to add stadiums, create and manage events, comment on events, and handle payments using Stripe.

## Features
- Manage stadiums (add, edit, delete)
- Create and manage events
- Comment on events
- Role-based access control (admin, user)
- Payment system integrated with [Stripe](https://stripe.com/)

## Technologies
- [Laravel 9](https://laravel.com/)
- [Bootstrap 5](https://getbootstrap.com/)
- [MySQL](https://www.mysql.com/) (or other supported databases)
- [Stripe](https://stripe.com/) for payments

## Installation & Setup

### Clone the Repository
```bash
git clone https://github.com/albertmazur/real-asc.git
cd real-asc
```

### Install Dependencies
```bash
composer install
npm install && npm run dev
```

### Configure Environment
Copy the `.env.example` file and update database credentials.
```bash
cp .env.example .env
```

### Generate Application Key
```bash
php artisan key:generate
```

### Run Migrations and Seeders
```bash
php artisan migrate --seed
```

### Create Storage Link
```bash
php artisan storage:link
```

### Start the Application
```bash
php artisan serve
```

The application will be available at: `http://localhost`

## Payment System
The application integrates with [Stripe](https://stripe.com/) to handle event payments. Ensure you have a valid Stripe API key configured in your `.env` file:
```
STRIPE_KEY=your_stripe_public_key
STRIPE_SECRET=your_stripe_secret_key
```

## Admin Credentials
- **Email:** admin@example.com
- **Password:** Admin123

For any questions or suggestions, contact the project administrator!