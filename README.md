<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

# About This Project

My Blog adalah project full stack menggunakan teknologi Laravel Inertia dengan Vue.js dan Tailwind.css

## Prerequisites

Before starting, ensure you have the following installed:

- **PHP** (>= 8.3 recommended)
- **Composer**
- **Node.js** (>= 18.x) & **NPM**
- **MySQL** (or any preferred database engine)

---

## Local Setup Instructions

Follow these step-by-step instructions to get the application running.

### 1. Clone the Repository

Clone the project from GitHub and navigate into the project directory:

```bash
git clone https://github.com/AlifRJ/inertia-vue-blog
cd YOUR_REPO_NAME
```

### 2. Install PHP Dependencies

Install the required Laravel packages using Composer:

```bash
composer install
```

### 3. Install Frontend Dependencies

Install the required Node.js packages for Vue and Inertia:

```bash
npm install
```

### 4. Environment Configuration

Copy the template environment file to create your local configurations:

```bash
cp .env.example .env
```

Open the newly created `.env` file in your code editor and update your database credentials:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_database_user
DB_PASSWORD=your_database_password
```

_(Make sure you create an empty database in your local database manager matching the `DB_DATABASE` name above)._

### 5. Generate Application Key

Generate a secure application key for Laravel:

```bash
php artisan key:generate
```

### 6. Run Database Migrations

Run the migrations to create tables. You can optionally add `--seed` if you need dummy seed data:

```bash
php artisan migrate
```

### 7. Link Storage (Optional)

Create the storage symlink:

```bash
php artisan storage:link
```

---

## Running the Application

You need to run two separate processes simultaneously to develop locally: the backend PHP server and the Vite frontend compiler.

### Step A: Start the Backend Server

In your terminal, run the following command to start Laravel's local development server:

```bash
php artisan serve
```

Your backend will now be accessible at `http://127.0.0.1:8000`.

### Step B: Start the Frontend Compilation (Vite)

Open a **new terminal window or tab**, navigate to the project folder, and run:

```bash
npm run dev
```

This starts the Vite development server, which enables Hot Module Replacement (HMR) for your Vue components.

Now, open your browser and navigate to **`http://127.0.0.1:8000`** to view the application.
