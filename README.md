# Simple Marketplace System

## Project Overview
This is a robust **Simple Marketplace System** built with **Laravel 12**. It is designed to facilitate interactions between **Admins** (who manage the platform) and **Customers** (who browse and purchase products).

The project was built to satisfy specific requirements including full CRUD operations, Role-Based Access Control (RBAC), RESTful APIs, and several advanced features like SSO and Reporting.

## Tech Stack
- **Framework**: Laravel 12
- **Language**: PHP 8.2+
- **Frontend**: Blade Templates, Tailwind CSS
- **Database**: SQLite (Default) or MySQL
- ** Authentication**: Laravel Breeze (Session) & Laravel Sanctum (API)

### Key Packages Used
- `laravel/socialite`: Google SSO Login
- `barryvdh/laravel-dompdf`: PDF Generation for reports
- `maatwebsite/excel`: Excel Export for reports
- `laravel/sanctum`: API Token Authentication

---

## Features
### 1. User Roles & Permissions
- **Admin**:
  - Full access to the **Admin Panel**.
  - Manage **Users**, **Roles**, **Categories**, and **Products**.
  - View and manage **Transactions** (update status).
  - Generate **Reports** (PDF/Excel).
- **Customer**:
  - Access to the **Public Marketplace**.
  - View product details.
  - **Checkout** products (creates a transaction).
  - View order history.

### 2. Bonus Tasks Implemented
- **Middleware Role-Based Access**:
  - Custom `RoleMiddleware` ensures only Admins can access `/admin/*` routes.
- **SSO Login**:
  - Integrated **Google Login** using Laravel Socialite.
  - Automatically registers new users with the 'customer' role.
- **Reporting**:
  - **PDF Export**: Download product lists and transaction histories.
  - **Excel Export**: Export data for analysis.
- **Email Notifications**:
  - Automated transactional emails sent via SMTP when a new order is placed using Laravel Mailables.

---

## Installation Requirements

### Prerequisites
- PHP >= 8.2
- Composer
- Node.js & NPM

### Setup Steps
1. **Clone the Repository**
   ```bash
   git clone <repository-url>
   cd simple_marketplace_system
   ```

2. **Install Backend Dependencies**
   ```bash
   composer install
   ```

3. **Install Frontend Dependencies**
   ```bash
   npm install && npm run build
   ```

4. **Environment Configuration**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```
   
   **Important .env Settings:**
   - **Database**: Set `DB_CONNECTION=sqlite` (or configure MySQL).
   - **Google SSO**: Set `GOOGLE_CLIENT_ID` and `GOOGLE_CLIENT_SECRET`.
   - **Email**: Configure `MAIL_MAILER=smtp` and related `MAIL_*` settings for notifications.

5. **Run Migrations & Seeders**
   ```bash
   php artisan migrate --seed
   ```
   *This commands sets up the database and creates default users.*

6. **Start the Server**
   ```bash
   php artisan serve
   ```
   Access the app at `http://localhost:8000`

---

## Default Credentials
Use these accounts to test the application immediately after seeding:

| Role | Email | Password |
| :--- | :--- | :--- |
| **Admin** | `admin@example.com` | `password` |
| **Customer** | `customer@example.com` | `password` |

---

## API Documentation
The application provides a RESTful API for external consumption.

### Authentication
The API uses **Laravel Sanctum**. Protected routes require a Bearer Token.

### Endpoints

#### Products
| Method | Endpoint | Description | Auth Required |
| :--- | :--- | :--- | :--- |
| `GET` | `/api/products` | Youtube list of all products | No |
| `GET` | `/api/products/{id}` | Get details of a specific product | No |

#### Transactions
| Method | Endpoint | Description | Auth Required |
| :--- | :--- | :--- | :--- |
| `GET` | `/api/transactions` | List authenticated user's transactions | Yes |
| `POST` | `/api/transactions` | Create a new transaction | Yes |

**Payload for POST /api/transactions:**
```json
{
    "product_id": 1,
    "quantity": 2
}
```

---

## Project Structure Highlights
- `app/Models`: Eloquent models (User, Product, Transaction, etc.) with relationships.
- `app/Http/Controllers/Admin`: Controllers for backend management logic.
- `app/Http/Controllers/Api`: API specific controllers.
- `app/Exports`: Classes for Excel export logic.
- `resources/views/admin`: Blade templates for the admin dashboard.
