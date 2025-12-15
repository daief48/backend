# 🚀 Laravel Backend – Product Inventory API

A **RESTful API backend** built with **Laravel 12** for managing products and categories. The system uses **JWT authentication**, supports **image uploads**, and sends **queue-based email notifications** on product create/update.

---

## 🛠️ Tech Stack

* **Laravel 12**
* **JWT Authentication** (`tymon/jwt-auth`)
* **MySQL**
* **Laravel Queue** (Database driver)
* **Mail** (Product create/update notification)
* **File Storage** (Product images)

---

## ✨ Features

* User Registration & Login (JWT)
* Category CRUD
* Product CRUD
* Product Image Upload
* Email notification on product create/update
* Queue-based background jobs
* Pagination & Eloquent relationships
* Secure API routes with JWT

---

## ⚙️ Local Setup Instructions

### 1️⃣ Clone Repository

```bash
git clone https://github.com/daief48/backend.git
cd inventory-system/backend
```

### 2️⃣ Install Dependencies

```bash
composer install
```

### 3️⃣ Environment Configuration

```bash
cp .env.example .env
php artisan key:generate
php artisan jwt:secret
```

Update `.env` with your database and mail credentials.

### 4️⃣ Database Migration & Queue Table

```bash
php artisan migrate
php artisan queue:table
php artisan migrate
```

### 5️⃣ Storage Link (Image Upload)

```bash
php artisan storage:link
```

### 6️⃣ Start Queue Worker (Required)

```bash
php artisan queue:work
```

### 7️⃣ Run Application

```bash
php artisan serve
```

**Backend URL:**

```
http://127.0.0.1:8000
```

---

## 📘 Backend API Documentation

**Base URL:**

```
http://127.0.0.1:8000/api
```

**Authentication:** JWT (Bearer Token)

> All category & product routes require authentication.

---

## 🔐 Authentication APIs

### 1️⃣ Register User

**POST** `/register`

**Request Body (JSON)**

```json
{
  "name": "John Doe",
  "email": "john@example.com",
  "password": "password123",
  "password_confirmation": "password123"
}
```

**Success Response (201)**

```json
{
  "message": "User registered successfully",
  "token": "jwt_token_here",
  "user": {
    "id": 1,
    "name": "John Doe",
    "email": "john@example.com"
  }
}
```

---

### 2️⃣ Login

**POST** `/login`

**Request Body (JSON)**

```json
{
  "email": "john@example.com",
  "password": "password123"
}
```

**Success Response (200)**

```json
{
  "token": "jwt_token_here",
  "user": {
    "id": 1,
    "name": "John Doe",
    "email": "john@example.com"
  }
}
```

---

### 3️⃣ Logout

**POST** `/logout`

**Headers**

```
Authorization: Bearer jwt_token_here
```

**Response (200)**

```json
{
  "message": "Logged out successfully"
}
```

---

## 📂 Category APIs (Protected)

### 4️⃣ Get All Categories

**GET** `/categories`

**Response (200)**

```json
[
  {
    "id": 1,
    "name": "Electronics",
    "created_at": "2025-01-01",
    "updated_at": "2025-01-01"
  }
]
```

---

### 5️⃣ Create Category

**POST** `/categories`

**Request Body (JSON)**

```json
{
  "name": "Fashion"
}
```

**Response (201)**

```json
{
  "id": 2,
  "name": "Fashion",
  "created_at": "2025-01-01",
  "updated_at": "2025-01-01"
}
```

---

### 6️⃣ Update Category

**PUT** `/categories/{id}`

**Request Body (JSON)**

```json
{
  "name": "Home Appliances"
}
```

**Response (200)**

```json
{
  "id": 1,
  "name": "Home Appliances"
}
```

---

### 7️⃣ Delete Category

**DELETE** `/categories/{id}`

**Response (204)**

```
No Content
```

---

## 📦 Product APIs (Protected)

### 8️⃣ Get Products (Paginated)

**GET** `/products`

**Response (200)**

```json
{
  "data": [
    {
      "id": 1,
      "name": "Wireless Mouse",
      "description": "Ergonomic mouse",
      "price": 850,
      "image": "products/mouse.jpg",
      "category": {
        "id": 1,
        "name": "Electronics"
      }
    }
  ],
  "current_page": 1,
  "per_page": 10
}
```

---

### 9️⃣ Create Product

**POST** `/products`

**Request (multipart/form-data)**

```
name: Wireless Mouse
description: Ergonomic mouse
price: 850
category_id: 1
image: mouse.jpg
```

**Response (201)**

```json
{
  "id": 1,
  "name": "Wireless Mouse",
  "price": 850,
  "category_id": 1
}
```

📧 **Triggers email job** (`ProductMailJob`)

---

### 🔟 Update Product

**PUT** `/products/{id}`

**Request (multipart/form-data)**

```
name: Updated Mouse
price: 900
category_id: 1
```

**Response (200)**

```json
{
  "id": 1,
  "name": "Updated Mouse",
  "price": 900
}
```

📧 **Triggers email job** (`ProductMailJob`)

---

### 1️⃣1️⃣ Delete Product

**DELETE** `/products/{id}`

**Response (204)**

```
No Content
```

---

## ⚠️ Validation Error Response

```json
{
  "message": "The given data was invalid",
  "errors": {
    "name": ["The name field is required."]
  }
}
```

---

## 🔑 Authorization Header Example

```
Authorization: Bearer your_jwt_token_here
```

---

## ✅ Notes

* Images are stored in `storage/app/public/products`
* Products are paginated (10 per page)
* JWT token required for protected routes
* Email notification jobs run via Laravel Queue

---

🎯 **This README is production-ready and suitable for GitHub, portfolio, or technical assessments.**
