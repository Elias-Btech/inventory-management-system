# Database — StockWise Pro

## File

`inventory_system.sql` — complete schema with sample data (10 products, 3 suppliers, 4 categories, 2 default users).

## Database Info

| Setting | Value |
|---------|-------|
| Database name | `inventory_system` |
| Engine | InnoDB |
| Charset | UTF-8 |
| Tables | 12 |

## Import via phpMyAdmin

1. Open `http://localhost/phpmyadmin`
2. Click **New** → create database named `inventory_system`
3. Select the database
4. Click **Import** tab
5. Choose `database/inventory_system.sql`
6. Click **Go**

## Import via Command Line

```bash
mysql -u root -p -e "CREATE DATABASE inventory_system;"
mysql -u root -p inventory_system < database/inventory_system.sql
```

## Tables

| Table | Description |
|-------|-------------|
| `users` | User accounts, roles, auth |
| `categories` | Product categories |
| `suppliers` | Supplier contact info |
| `products` | Inventory items |
| `stock_transactions` | Stock in/out/adjustment history |
| `orders` | Customer orders |
| `order_items` | Line items per order |
| `sales` | POS sales records |
| `sale_items` | Line items per sale |
| `activity_logs` | Audit trail |
| `notifications` | Low stock and system alerts |
| `registration_passcodes` | Admin-generated registration codes |

## Default Users

| Role | Username | Password |
|------|----------|----------|
| Admin | `admin` | `admin123` |
| Staff | `staff` | `admin123` |

> Change these immediately after first setup.

## Connection Config

`config/db.php` defaults (works with XAMPP out of the box):

```php
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'inventory_system');
```

---

**© 2026 StockWise Pro**
