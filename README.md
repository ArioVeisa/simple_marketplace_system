# Simple Marketplace System

A robust marketplace platform built with **Laravel 12** that facilitates interactions between **Admins** and **Customers**. Features full CRUD operations, Role-Based Access Control (RBAC), RESTful APIs, SSO authentication, and advanced reporting capabilities.

---

## 📋 Table of Contents
- [Tech Stack](#-tech-stack)
- [Features](#-features)
- [Installation](#-installation)
- [Default Credentials](#-default-credentials)
- [API Documentation](#-api-documentation)
- [Project Structure](#-project-structure)

---

## 🚀 Tech Stack

- **Framework**: Laravel 12
- **Language**: PHP 8.2+
- **Frontend**: Blade Templates, Tailwind CSS
- **Database**: SQLite (Default) / MySQL
- **Authentication**: 
  - Laravel Breeze (Web Sessions)
  - Laravel Sanctum (API Tokens)

### Key Dependencies
- `laravel/socialite` - Google SSO Login
- `barryvdh/laravel-dompdf` - PDF Generation
- `maatwebsite/excel` - Excel Export
- `laravel/sanctum` - API Token Authentication

---

## ✨ Features

### User Roles & Permissions
#### Admin
- Full access to Admin Panel
- Manage Users, Roles, Categories, and Products
- View and manage Transactions (update status)
- Generate Reports (PDF/Excel)

#### Customer
- Browse Public Marketplace
- View product details
- Checkout products (creates transactions)
- View order history

### Bonus Features
- ✅ **Role-Based Middleware**: Restrict `/admin/*` routes to admins only
- ✅ **Google SSO**: OAuth login with automatic customer role assignment
- ✅ **Advanced Reporting**: Export data as PDF or Excel
- ✅ **Email Notifications**: Automated emails for new orders via SMTP

---

## 📦 Installation

### Prerequisites
Ensure you have the following installed:
- **PHP** >= 8.2
- **Composer** >= 2.0
- **Node.js** >= 18.x & **NPM** >= 9.x
- **SQLite** or **MySQL**

### Step-by-Step Setup

#### 1️⃣ Clone the Repository
```bash
git clone https://github.com/ArioVeisa/simple_marketplace_system.git
cd simple_marketplace_system
```

#### 2️⃣ Install PHP Dependencies
```bash
composer install
```

#### 3️⃣ Install JavaScript Dependencies
```bash
npm install
```

#### 4️⃣ Environment Configuration
Create your `.env` file from the example:
```bash
cp .env.example .env
```

Generate application key:
```bash
php artisan key:generate
```

**Configure Important Settings in `.env`:**

**Database Configuration (SQLite - Default)**
```env
DB_CONNECTION=sqlite
```
> **Note**: SQLite database file will be created automatically at `database/database.sqlite`

**OR MySQL Configuration**
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=marketplace_db
DB_USERNAME=root
DB_PASSWORD=your_password
```

**Google SSO (Optional but Recommended)**
```env
GOOGLE_CLIENT_ID=your_google_client_id
GOOGLE_CLIENT_SECRET=your_google_client_secret
GOOGLE_REDIRECT_URL=http://localhost:8000/auth/google/callback
```

**Email Configuration (For Notifications)**
```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your_email@gmail.com
MAIL_PASSWORD=your_app_password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=your_email@gmail.com
MAIL_FROM_NAME="${APP_NAME}"
```

#### 5️⃣ Database Setup
If using SQLite, create the database file:
```bash
touch database/database.sqlite
```

Run migrations and seed the database:
```bash
php artisan migrate --seed
```

This will:
- Create all necessary tables
- Generate default roles (Admin, Customer)
- Create test users and sample products

#### 6️⃣ Build Frontend Assets
For development:
```bash
npm run dev
```

For production:
```bash
npm run build
```

#### 7️⃣ Start the Application
```bash
php artisan serve
```

The application will be available at: **http://localhost:8000**

### 🎉 Installation Complete!

---

## 🔐 Default Credentials

After seeding, use these credentials to test the application:

| Role | Email | Password | Access |
|------|-------|----------|--------|
| **Admin** | `admin@example.com` | `password` | Full admin panel access |
| **Customer** | `customer@example.com` | `password` | Marketplace and checkout |

> **Security Note**: Change these passwords immediately in production!

---

## 📡 API Documentation

### Base URL
```
http://localhost:8000/api
```

### Authentication
This API uses **Laravel Sanctum** for token-based authentication.

#### Obtaining an API Token

**Use the Login Endpoint (Recommended)**

Simply call the login API with your credentials:

```bash
curl -X POST "http://localhost:8000/api/login" \
  -H "Accept: application/json" \
  -H "Content-Type: application/json" \
  -d '{
    "email": "customer@example.com",
    "password": "password"
  }'
```

Response:
```json
{
  "message": "Login successful",
  "token": "1|abcdefghijklmnopqrstuvwxyz1234567890",
  "user": {
    "id": 2,
    "name": "Customer User",
    "email": "customer@example.com"
  }
}
```

Copy the `token` value and use it as Bearer token in subsequent requests.

**Alternative: Via Tinker (Development Only)**
```bash
php artisan tinker
```
```php
$user = User::where('email', 'customer@example.com')->first();
$token = $user->createToken('api-token')->plainTextToken;
echo $token;
```

---

## 📍 API Endpoints Reference

### 1. Login
Authenticate and receive an API token.

**Endpoint**
```
POST /api/login
```

**Authentication**: Not Required

**Request Headers**
```
Accept: application/json
Content-Type: application/json
```

**Request Body**
```json
{
  "email": "customer@example.com",
  "password": "password"
}
```

**Body Parameters**
| Parameter | Type | Required | Description |
|-----------|------|----------|-------------|
| `email` | string | Yes | User email address |
| `password` | string | Yes | User password |

**cURL Example**
```bash
curl -X POST "http://localhost:8000/api/login" \
  -H "Accept: application/json" \
  -H "Content-Type: application/json" \
  -d '{
    "email": "customer@example.com",
    "password": "password"
  }'
```

**Success Response (200 OK)**
```json
{
  "message": "Login successful",
  "token": "1|abcdefghijklmnopqrstuvwxyz1234567890",
  "user": {
    "id": 2,
    "name": "Customer User",
    "email": "customer@example.com"
  }
}
```

**Error Response (401 Unauthorized)**
```json
{
  "message": "Invalid credentials"
}
```

**Validation Error (422 Unprocessable Entity)**
```json
{
  "message": "The email field is required. (and 1 more error)",
  "errors": {
    "email": [
      "The email field is required."
    ],
    "password": [
      "The password field is required."
    ]
  }
}
```

---

### 2. Get All Products
Retrieve a list of all available products with their categories.

**Endpoint**
```
GET /api/products
```

**Authentication**: Not Required

**Request Headers**
```
Accept: application/json
Content-Type: application/json
```

**cURL Example**
```bash
curl -X GET "http://localhost:8000/api/products" \
  -H "Accept: application/json"
```

**Success Response (200 OK)**
```json
[
  {
    "id": 1,
    "name": "Laptop Gaming",
    "description": "High-performance gaming laptop",
    "price": 15000000,
    "stock": 10,
    "category_id": 1,
    "image": "products/laptop.jpg",
    "created_at": "2025-12-07T01:00:00.000000Z",
    "updated_at": "2025-12-07T01:00:00.000000Z",
    "category": {
      "id": 1,
      "name": "Electronics",
      "description": "Electronic devices and gadgets"
    }
  },
  {
    "id": 2,
    "name": "Wireless Mouse",
    "description": "Ergonomic wireless mouse",
    "price": 250000,
    "stock": 50,
    "category_id": 1,
    "image": "products/mouse.jpg",
    "created_at": "2025-12-07T01:00:00.000000Z",
    "updated_at": "2025-12-07T01:00:00.000000Z",
    "category": {
      "id": 1,
      "name": "Electronics",
      "description": "Electronic devices and gadgets"
    }
  }
]
```

---

### 3. Get Single Product
Retrieve details of a specific product by ID.

**Endpoint**
```
GET /api/products/{id}
```

**Authentication**: Not Required

**URL Parameters**
| Parameter | Type | Required | Description |
|-----------|------|----------|-------------|
| `id` | integer | Yes | Product ID |

**Request Headers**
```
Accept: application/json
Content-Type: application/json
```

**cURL Example**
```bash
curl -X GET "http://localhost:8000/api/products/1" \
  -H "Accept: application/json"
```

**Success Response (200 OK)**
```json
{
  "id": 1,
  "name": "Laptop Gaming",
  "description": "High-performance gaming laptop",
  "price": 15000000,
  "stock": 10,
  "category_id": 1,
  "image": "products/laptop.jpg",
  "created_at": "2025-12-07T01:00:00.000000Z",
  "updated_at": "2025-12-07T01:00:00.000000Z",
  "category": {
    "id": 1,
    "name": "Electronics",
    "description": "Electronic devices and gadgets"
  }
}
```

**Error Response (404 Not Found)**
```json
{
  "message": "Product not found"
}
```

---

### 4. Get User Transactions
Retrieve all transactions for the authenticated user.

**Endpoint**
```
GET /api/transactions
```

**Authentication**: **Required** (Bearer Token)

**Request Headers**
```
Accept: application/json
Content-Type: application/json
Authorization: Bearer {your_token_here}
```

**cURL Example**
```bash
curl -X GET "http://localhost:8000/api/transactions" \
  -H "Accept: application/json" \
  -H "Authorization: Bearer 1|abcdefghijklmnopqrstuvwxyz1234567890"
```

**Success Response (200 OK)**
```json
[
  {
    "id": 1,
    "user_id": 2,
    "total_amount": 30000000,
    "status": "pending",
    "created_at": "2025-12-07T02:30:00.000000Z",
    "updated_at": "2025-12-07T02:30:00.000000Z",
    "details": [
      {
        "id": 1,
        "transaction_id": 1,
        "product_id": 1,
        "quantity": 2,
        "price": 15000000,
        "created_at": "2025-12-07T02:30:00.000000Z",
        "updated_at": "2025-12-07T02:30:00.000000Z",
        "product": {
          "id": 1,
          "name": "Laptop Gaming",
          "description": "High-performance gaming laptop",
          "price": 15000000,
          "stock": 8,
          "category_id": 1,
          "image": "products/laptop.jpg"
        }
      }
    ]
  }
]
```

**Error Response (401 Unauthorized)**
```json
{
  "message": "Unauthenticated."
}
```

---

### 5. Create New Transaction
Create a new transaction (purchase) for a product.

**Endpoint**
```
POST /api/transactions
```

**Authentication**: **Required** (Bearer Token)

**Request Headers**
```
Accept: application/json
Content-Type: application/json
Authorization: Bearer {your_token_here}
```

**Request Body**
```json
{
  "product_id": 1,
  "quantity": 2
}
```

**Body Parameters**
| Parameter | Type | Required | Description |
|-----------|------|----------|-------------|
| `product_id` | integer | Yes | ID of the product to purchase |
| `quantity` | integer | Yes | Quantity to purchase (min: 1) |

**cURL Example**
```bash
curl -X POST "http://localhost:8000/api/transactions" \
  -H "Accept: application/json" \
  -H "Content-Type: application/json" \
  -H "Authorization: Bearer 1|abcdefghijklmnopqrstuvwxyz1234567890" \
  -d '{
    "product_id": 1,
    "quantity": 2
  }'
```

**Success Response (201 Created)**
```json
{
  "id": 2,
  "user_id": 2,
  "total_amount": 30000000,
  "status": "pending",
  "created_at": "2025-12-07T03:00:00.000000Z",
  "updated_at": "2025-12-07T03:00:00.000000Z",
  "details": [
    {
      "id": 2,
      "transaction_id": 2,
      "product_id": 1,
      "quantity": 2,
      "price": 15000000,
      "created_at": "2025-12-07T03:00:00.000000Z",
      "updated_at": "2025-12-07T03:00:00.000000Z"
    }
  ]
}
```

**Error Responses**

**Validation Error (422 Unprocessable Entity)**
```json
{
  "message": "The product id field is required. (and 1 more error)",
  "errors": {
    "product_id": [
      "The product id field is required."
    ],
    "quantity": [
      "The quantity must be at least 1."
    ]
  }
}
```

**Insufficient Stock (400 Bad Request)**
```json
{
  "message": "Insufficient stock"
}
```

**Unauthorized (401 Unauthorized)**
```json
{
  "message": "Unauthenticated."
}
```

**Product Not Found (422 Unprocessable Entity)**
```json
{
  "message": "The selected product id is invalid.",
  "errors": {
    "product_id": [
      "The selected product id is invalid."
    ]
  }
}
```

---

### 6. Get Authenticated User
Retrieve details of the currently authenticated user.

**Endpoint**
```
GET /api/user
```

**Authentication**: **Required** (Bearer Token)

**Request Headers**
```
Accept: application/json
Authorization: Bearer {your_token_here}
```

**cURL Example**
```bash
curl -X GET "http://localhost:8000/api/user" \
  -H "Accept: application/json" \
  -H "Authorization: Bearer 1|abcdefghijklmnopqrstuvwxyz1234567890"
```

**Success Response (200 OK)**
```json
{
  "id": 2,
  "name": "Customer User",
  "email": "customer@example.com",
  "email_verified_at": null,
  "created_at": "2025-12-07T00:00:00.000000Z",
  "updated_at": "2025-12-07T00:00:00.000000Z"
}
```

---

## 📊 Postman Collection

A ready-to-use Postman collection is included: **`Simple_Marketplace_API.postman_collection.json`**

### Import to Postman

1. **Open Postman**
2. **Click "Import"** button (top left)
3. **Select file**: `Simple_Marketplace_API.postman_collection.json`
4. **Click "Import"**

### Features

✅ **Auto-save Token**: Login request automatically saves the token to collection variables  
✅ **Pre-configured Endpoints**: All 6 API endpoints ready to test  
✅ **Environment Variables**: Uses `{{base_url}}` and `{{api_token}}`

### Quick Start

1. **Update base_url** (if needed):
   - Click collection → Variables tab
   - Set `base_url` to `http://localhost:8000`

2. **Login to get token**:
   - Run `Authentication → Login` request
   - Token automatically saved! ✨

3. **Test other endpoints**:
   - All authenticated endpoints will use the saved token automatically

### Example Requests

1. **Login** ⭐
   - Method: POST
   - URL: `{{base_url}}/api/login`
   - Body: `{"email": "customer@example.com", "password": "password"}`
   - 🔥 Token auto-saved after successful login!

2. **Get All Products**
   - Method: GET
   - URL: `{{base_url}}/api/products`

3. **Get Product by ID**
   - Method: GET
   - URL: `{{base_url}}/api/products/1`

4. **Get My Transactions**
   - Method: GET
   - URL: `{{base_url}}/api/transactions`
   - Auth: Bearer Token (auto-applied)

5. **Create Transaction**
   - Method: POST
   - URL: `{{base_url}}/api/transactions`
   - Auth: Bearer Token (auto-applied)
   - Body (JSON):
     ```json
     {
       "product_id": 1,
       "quantity": 2
     }
     ```

6. **Get Current User**
   - Method: GET
   - URL: `{{base_url}}/api/user`
   - Auth: Bearer Token (auto-applied)

---

## 🗂️ Project Structure

```
simple_marketplace_system/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Admin/          # Admin panel controllers
│   │   │   └── Api/            # API controllers
│   │   └── Middleware/         # Custom middleware (RoleMiddleware)
│   ├── Models/                 # Eloquent models with relationships
│   ├── Exports/                # Excel export classes
│   └── Mail/                   # Email notification classes
├── database/
│   ├── migrations/             # Database schema
│   ├── seeders/                # Database seeders
│   └── factories/              # Model factories
├── resources/
│   ├── views/
│   │   ├── admin/              # Admin panel Blade templates
│   │   ├── marketplace/        # Public marketplace views
│   │   └── auth/               # Authentication views
│   └── css/                    # Tailwind CSS styles
└── routes/
    ├── web.php                 # Web routes
    └── api.php                 # API routes
```

---

## 🛠️ Development

### Run Development Server
```bash
php artisan serve
```

### Run Frontend Build (Watch Mode)
```bash
npm run dev
```

### Run Tests
```bash
php artisan test
```

### Clear Cache
```bash
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
```

---

## 📝 Notes

### Regarding API Requirements
**Q: "The requirement uses API but we only have a few endpoints, is that okay?"**

**A:** Yes, it's perfectly fine! The current API implementation covers the essential marketplace operations:
- **Product Browsing** (GET /api/products, GET /api/products/{id})
- **Transaction Management** (GET /api/transactions, POST /api/transactions)

This minimal API follows REST principles and provides the core functionality needed for a simple marketplace. If you need additional endpoints in the future (e.g., user registration, product search, cart management), they can be easily added following the same pattern.

### Production Checklist
Before deploying to production:
- [ ] Change default user passwords
- [ ] Configure Google OAuth credentials
- [ ] Set up SMTP for email notifications
- [ ] Switch `APP_ENV` to `production`
- [ ] Set `APP_DEBUG` to `false`
- [ ] Configure SSL/TLS for HTTPS
- [ ] Set up proper database backups
- [ ] Review and adjust rate limiting

---

## 📄 License
This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

---

## 🤝 Support
For issues, questions, or contributions, please create an issue in the repository.
