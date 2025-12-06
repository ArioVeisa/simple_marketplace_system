# Simple Marketplace System

A simple marketplace system built with Laravel 12, featuring product listings, transactions, user roles (Admin/Customer), and reporting.

## Features
- **Authentication**: Laravel Breeze + Google SSO.
- **Roles**: Admin (manage everything) and Customer (browse & buy).
- **Admin Panel**:
    - Manage Categories & Products.
    - View Transactions & Update Status.
    - Export Reports (PDF/Excel).
- **Marketplace**: Public product listing, search, and checkout.
- **API**: RESTful endpoints for products and transactions.

## Installation Steps

1. **Clone the repository**
   ```bash
   git clone <repository-url>
   cd simple_marketplace_system
   ```

2. **Install Dependencies**
   ```bash
   composer install
   npm install
   ```

3. **Environment Setup**
   Copy `.env.example` to `.env` and configure your database and credentials.
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```
   
   **Important**: Update the following in `.env`:
   - `DB_CONNECTION` (default: sqlite)
   - `GOOGLE_CLIENT_ID` & `GOOGLE_CLIENT_SECRET` (for SSO)
   - `MAIL_*` settings (for emails)

4. **Run Migrations & Seeders**
   This will create the database tables and seed default users (Admin & Customer).
   ```bash
   php artisan migrate --seed
   ```

5. **Build Frontend**
   ```bash
   npm run build
   ```

6. **Run the Application**
   ```bash
   php artisan serve
   ```
   Visit `http://localhost:8000`

## Default Credentials
- **Admin**: `admin@example.com` / `password`
- **Customer**: `customer@example.com` / `password`

## API Documentation

### Authentication
The API uses Laravel Sanctum. To access protected routes, you need a Bearer Token.
- **Login**: (You can implement an API login route or use the web login to get a token if needed, currently setup for Sanctum cookie-based or token-based if extended).
- *Note*: The current implementation focuses on Web Auth for the frontend. For API testing, ensure you are authenticated or extend `LoginController` to issue tokens.

### Endpoints

#### 1. List Products
- **URL**: `/api/products`
- **Method**: `GET`
- **Response**: JSON array of products with category details.

#### 2. Get Product Details
- **URL**: `/api/products/{id}`
- **Method**: `GET`
- **Response**: JSON object of product.

#### 3. List Transactions (Auth Required)
- **URL**: `/api/transactions`
- **Method**: `GET`
- **Headers**: `Authorization: Bearer <token>`
- **Response**: JSON array of user's transactions.

#### 4. Create Transaction (Auth Required)
- **URL**: `/api/transactions`
- **Method**: `POST`
- **Headers**: `Authorization: Bearer <token>`
- **Body**:
    ```json
    {
        "product_id": 1,
        "quantity": 2
    }
    ```
- **Response**: JSON object of created transaction.

## Tech Stack
- **Framework**: Laravel 12
- **Frontend**: Blade, Tailwind CSS
- **Database**: SQLite (configurable to MySQL)
- **Packages**:
    - `laravel/breeze` (Auth)
    - `laravel/socialite` (Google SSO)
    - `barryvdh/laravel-dompdf` (PDF Export)
    - `maatwebsite/excel` (Excel Export)
