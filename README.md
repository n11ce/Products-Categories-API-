# 📦 Laravel Products & Categories API  

A simple **RESTful API** built with Laravel that demonstrates **Products and Categories management** with authentication and authorization.  
The project follows the **MVC structure** and includes validation, migrations, and seeders.  

---

## 🚀 Features  

- **Authentication** with Laravel Sanctum (register, login, logout)  
- **Products CRUD**  
  - Stock must be greater than `0` when creating/updating  
  - Price is stored in both **TL** and **EUR**  
- **Categories CRUD**  
  - When a category is deleted, its products are automatically moved to the **General** category  
- **Authorization**  
  - Only **Admin** users can delete products or categories  
- **JSON Responses** for all API requests  
- **Migration & Seeder** included  
- Well-commented code for clarity  

---

## ⚙️ Installation  

1. Clone the repository  
   ```bash
   git clone https://github.com/your-username/laravel-products-api.git
   cd laravel-products-api
   ```

2. Install dependencies  
   ```bash
   composer install
   ```

3. Copy `.env.example` to `.env` and update database credentials  
   ```bash
   cp .env.example .env
   ```

4. Generate application key  
   ```bash
   php artisan key:generate
   ```

5. Run migrations and seeders  
   ```bash
   php artisan migrate --seed
   ```

6. Start the development server  
   ```bash
   php artisan serve
   ```

---

## 🔑 Authentication  

This project uses **Sanctum** for API authentication.  
You need to register or login first to get an API token.  

### Register  
'POST /api/register'  
```json
{
  "name": "Test User",
  "email": "test@example.com",
  "password": "password",
  "role": "admin"
}
```

### Login  
'POST /api/login'  
```json
{
  "email": "test@example.com",
  "password": "password"
}
```

Response:  
```json
{
  "user": { "id": 1, "name": "Test User", "role": "admin" },
  "token": "YOUR_API_TOKEN"
}
```

For all subsequent requests, send the token in the header:  
```
Authorization: Bearer YOUR_API_TOKEN
```

---

## 📚 API Endpoints  

### Products  
- `GET /api/products` – List products  
- `POST /api/products` – Create a product (stock > 0 required)  
- `GET /api/products/{id}` – Show product details  
- `PUT /api/products/{id}` – Update product  
- `DELETE /api/products/{id}` – Delete product (**admin only**)  

### Categories  
- `GET /api/categories` – List categories  
- `POST /api/categories` – Create a category  
- `GET /api/categories/{id}` – Show category  
- `PUT /api/categories/{id}` – Update category  
- `DELETE /api/categories/{id}` – Delete category (**admin only, products moved to “General”)**  

---

## 👨‍💻 Tech Stack  
- **Laravel 10+**  
- **MySQL**  
- **Sanctum** (API Authentication)  
- **PHP 8.1+**  

---

## 📤 Contribution  

Feel free to fork this repository and submit pull requests. 🚀  
