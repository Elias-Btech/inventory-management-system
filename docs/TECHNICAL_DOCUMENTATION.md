# Technical Documentation — StockWise Pro

## Table of Contents

1. [Architecture](#architecture)
2. [Database Schema](#database-schema)
3. [API Reference](#api-reference)
4. [Security](#security)
5. [Configuration](#configuration)
6. [Deployment](#deployment)

---

## Architecture

### Tech Stack

| Layer | Technology |
|-------|-----------|
| Backend | PHP 8.0+ |
| Database | MySQL 8.0+ / MariaDB 10.4+ |
| Frontend | HTML5, CSS3, Vanilla JavaScript ES6+ |
| Icons | Font Awesome 6 (CDN) |
| Web Server | Apache 2.4+ |

### Request Flow

```
Browser → Apache → PHP page → MySQLi query → MySQL
                ↓
         includes/auth_check.php  (session guard)
         includes/role_check.php  (permission check)
         config/db.php            (DB connection)
```

### Folder Responsibilities

| Folder | Purpose |
|--------|---------|
| `admin/` | All authenticated management pages |
| `api/` | JSON endpoints (charts, notifications, exports) |
| `auth/` | Login, register, password reset |
| `config/` | Database connection and helper functions |
| `includes/` | Shared components (header, footer, auth, RBAC) |
| `assets/` | CSS, JS, images |
| `uploads/` | User-uploaded files |

---

## Database Schema

### Tables Overview

| Table | Purpose |
|-------|---------|
| `users` | Accounts, roles, auth |
| `categories` | Product categories |
| `suppliers` | Supplier info |
| `products` | Inventory items |
| `stock_transactions` | Stock in/out/adjustment history |
| `orders` | Customer orders |
| `order_items` | Line items per order |
| `sales` | POS sales records |
| `sale_items` | Line items per sale |
| `activity_logs` | Audit trail |
| `notifications` | Low stock and system alerts |
| `registration_passcodes` | Admin-generated registration codes |

### Key Relationships

```
users          ──< activity_logs
users          ──< stock_transactions
users          ──< notifications
users          ──< orders
users          ──< sales
categories     ──< products
suppliers      ──< products
products       ──< stock_transactions
orders         ──< order_items
sales          ──< sale_items
```

### products table

```sql
CREATE TABLE products (
    id              INT AUTO_INCREMENT PRIMARY KEY,
    name            VARCHAR(200) NOT NULL,
    category_id     INT,
    supplier_id     INT,
    sku             VARCHAR(50) UNIQUE,
    description     TEXT,
    price           DECIMAL(10,2) NOT NULL,
    quantity        INT DEFAULT 0,
    min_stock_level INT DEFAULT 10,
    image           VARCHAR(255) DEFAULT NULL,
    status          ENUM('active','inactive') DEFAULT 'active',
    created_at      TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at      TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (category_id) REFERENCES categories(id) ON DELETE SET NULL,
    FOREIGN KEY (supplier_id) REFERENCES suppliers(id) ON DELETE SET NULL
);
```

### sales table

```sql
CREATE TABLE sales (
    id                  INT AUTO_INCREMENT PRIMARY KEY,
    sale_number         VARCHAR(50) UNIQUE NOT NULL,
    customer_name       VARCHAR(100),
    customer_email      VARCHAR(100),
    customer_phone      VARCHAR(20),
    user_id             INT NOT NULL,
    status              ENUM('completed','voided','refunded') DEFAULT 'completed',
    subtotal            DECIMAL(10,2) NOT NULL DEFAULT 0.00,
    discount_percentage DECIMAL(5,2) NOT NULL DEFAULT 0.00,
    discount_amount     DECIMAL(10,2) NOT NULL DEFAULT 0.00,
    tax_percentage      DECIMAL(5,2) NOT NULL DEFAULT 0.00,
    tax_amount          DECIMAL(10,2) NOT NULL DEFAULT 0.00,
    final_amount        DECIMAL(10,2) NOT NULL DEFAULT 0.00,
    payment_method      ENUM('cash','card','bank_transfer') DEFAULT 'cash',
    sale_date           TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    notes               TEXT,
    voided_at           TIMESTAMP NULL,
    voided_by           INT NULL,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);
```

### orders table

```sql
CREATE TABLE orders (
    id               INT AUTO_INCREMENT PRIMARY KEY,
    order_number     VARCHAR(50) UNIQUE NOT NULL,
    customer_name    VARCHAR(100) NOT NULL,
    customer_email   VARCHAR(100),
    customer_phone   VARCHAR(20),
    customer_address TEXT,
    user_id          INT NOT NULL,
    status           ENUM('pending','processing','shipped','delivered','cancelled') DEFAULT 'pending',
    subtotal         DECIMAL(10,2) NOT NULL DEFAULT 0.00,
    total_amount     DECIMAL(10,2) NOT NULL DEFAULT 0.00,
    order_date       TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    notes            TEXT,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);
```

---

## API Reference

All API endpoints are in `api/` and return JSON unless noted.

### GET /api/get_notifications.php

Returns notifications for the logged-in user.

**Query params:**
- `count_only=1` — returns only the unread count

**Response:**
```json
{
  "success": true,
  "notifications": [...],
  "count": 3
}
```

### POST /api/mark_notifications_read.php

Marks all notifications as read for the current user.

**Response:**
```json
{ "success": true }
```

### GET /api/get_chart_data.php

Returns data for dashboard charts.

**Query params:**
- `type=stock` — top 10 products by quantity
- `type=category` — product count per category
- `type=stock_status` — in stock / low stock / out of stock counts
- `type=monthly_movements` — last 6 months stock in/out

### GET /api/export_report.php

Downloads a CSV file.

**Query params:**
- `type` — `inventory`, `low_stock`, `stock_transactions`, `category`, `supplier`, `products`, `activity_logs`
- `start_date`, `end_date` — date range filter (YYYY-MM-DD)

### POST /api/check_passcode.php

Validates a registration passcode.

**Request body (JSON):**
```json
{ "passcode": "ABC12345", "role": "staff" }
```

**Response:**
```json
{ "valid": true, "message": "Valid passcode for staff registration" }
```

### POST /api/generate_passcode.php

Generates preview passcodes (admin only, AJAX).

**Request body (JSON):**
```json
{ "count": 5 }
```

**Response:**
```json
{ "success": true, "passcodes": ["ABC12345", ...], "count": 5 }
```

---

## Security

### Password Hashing

```php
// Store
$hash = password_hash($password, PASSWORD_DEFAULT); // bcrypt

// Verify
password_verify($input, $hash);
```

### Prepared Statements

All database queries use MySQLi prepared statements:

```php
$stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
```

### CSRF Protection

```php
// Generate (in config/db.php)
function generate_csrf_token() {
    if (!isset($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

// Verify
function verify_csrf_token($token) {
    return isset($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], $token);
}
```

### Session Timeout

```php
// In includes/auth_check.php
if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > 1800)) {
    session_destroy();
    header('Location: ../auth/login.php?timeout=1');
    exit();
}
$_SESSION['last_activity'] = time();
```

### File Upload Validation

```php
$allowed_types = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif'];
$max_size = 5 * 1024 * 1024; // 5MB

if (!in_array($file['type'], $allowed_types)) { /* reject */ }
if ($file['size'] > $max_size) { /* reject */ }
if (!getimagesize($file['tmp_name'])) { /* reject */ }
```

---

## Configuration

### Database (`config/db.php`)

```php
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'inventory_system');

$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
$conn->set_charset("utf8");
```

### PHP Requirements

```ini
memory_limit = 128M
upload_max_filesize = 5M
post_max_size = 8M
max_execution_time = 30
session.gc_maxlifetime = 1800
```

---

## Deployment

### Local (XAMPP)

1. Copy project to `C:\xampp\htdocs\inventory_system\`
2. Start Apache + MySQL in XAMPP Control Panel
3. Import `database/inventory_system.sql` via phpMyAdmin
4. Visit `http://localhost/inventory_system/`

### Production Checklist

- [ ] Change default admin/staff passwords
- [ ] Update `config/db.php` with production credentials
- [ ] Set `display_errors = 0` in PHP config
- [ ] Enable HTTPS / SSL certificate
- [ ] Set file permissions: `755` for directories, `644` for files
- [ ] Set `777` (or `775`) for `uploads/` and `assets/images/products/`
- [ ] Set up automated database backups
- [ ] Configure firewall to block direct DB access

### Database Backup

```bash
# Backup
mysqldump -u root -p inventory_system > backup_$(date +%Y%m%d).sql

# Restore
mysql -u root -p inventory_system < backup_20260101.sql
```

---

**© 2026 StockWise Pro | Technical Documentation v2.0**
