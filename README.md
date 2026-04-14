# StockWise Pro — Inventory Management System

A full-stack web-based inventory management system built with PHP, MySQL, HTML, CSS, and JavaScript.

## Features

- **Authentication** — Login, registration with admin-generated passcodes, password reset
- **Role-Based Access** — Admin (full access) and Staff (limited access) roles
- **Dashboard** — Real-time stats, low stock alerts, recent activity
- **Product Management** — Add, edit, soft-delete products with image upload
- **Categories & Suppliers** — Full CRUD with modal dialogs
- **Stock Tracking** — Stock in/out transactions with full history
- **Orders** — Create and track customer orders (multi-item)
- **Sales (POS)** — Point-of-sale with discount, tax, payment method
- **Reports** — Inventory, low stock, stock movements, category, supplier reports with CSV export
- **User Management** — Admin-only user CRUD with bulk actions
- **Activity Logs** — Full audit trail of all system actions
- **Notifications** — Real-time low stock alerts
- **Profile Management** — Photo upload, password change, extended info

## Tech Stack

| Layer | Technology |
|-------|-----------|
| Backend | PHP 8.0+ |
| Database | MySQL 8.0+ |
| Frontend | HTML5, CSS3, Vanilla JavaScript |
| Icons | Font Awesome 6 |
| Server | Apache (XAMPP) |

## Requirements

- PHP 8.0+
- MySQL 8.0+ or MariaDB 10.4+
- Apache 2.4+ with `mod_rewrite`
- XAMPP (recommended for local development)

## Installation

1. **Clone the repository**
   ```bash
   git clone https://github.com/your-username/stockwise-pro.git
   ```

2. **Move to your web server root**
   ```
   C:\xampp\htdocs\inventory_system\
   ```

3. **Import the database**
   - Open `http://localhost/phpmyadmin`
   - Create a database named `inventory_system`
   - Import `database/inventory_system.sql`

4. **Configure the database connection**

   Edit `config/db.php` if needed (defaults work with XAMPP out of the box):
   ```php
   define('DB_HOST', 'localhost');
   define('DB_USER', 'root');
   define('DB_PASS', '');
   define('DB_NAME', 'inventory_system');
   ```

5. **Access the application**
   ```
   http://localhost/inventory_system/
   ```

## Documentation
- [`docs/USER_MANUAL.md`](docs/USER_MANUAL.md) — Complete end-user guide
- [`docs/TECHNICAL_DOCUMENTATION.md`](docs/TECHNICAL_DOCUMENTATION.md) — Developer reference, API docs, deployment
- [`docs/PROJECT_SUMMARY.md`](docs/PROJECT_SUMMARY.md) — Feature checklist and project info
- [`docs/PROJECT_STRUCTURE.md`](docs/PROJECT_STRUCTURE.md) — Full folder and file map
- [`docs/ROLE_BASED_ACCESS_CONTROL.md`](docs/ROLE_BASED_ACCESS_CONTROL.md) — RBAC permissions reference
- [`docs/MARKET_ANALYSIS.md`](docs/MARKET_ANALYSIS.md) — Business case and target users
- [`docs/PROJECT_BRANDING.md`](docs/PROJECT_BRANDING.md) — Design system and color palette
- [`docs/PROJECT_PRESENTATION.md`](docs/PROJECT_PRESENTATION.md) — Academic presentation materials
- [`database/README.md`](database/README.md) — Database import instructions

## Default Credentials

| Role | Username | Password |
|------|----------|----------|
| Admin | `admin` | `admin123` |
| Staff | `staff` | `admin123` |

> **Change these immediately after first login.**

## Project Structure

```
inventory_system/
├── admin/                      # Admin panel pages
│   ├── dashboard.php
│   ├── products.php
│   ├── add_product.php
│   ├── edit_product.php
│   ├── delete_product.php
│   ├── update_stock.php
│   ├── categories.php
│   ├── suppliers.php
│   ├── stock_transactions.php
│   ├── orders.php
│   ├── add_order.php
│   ├── view_order.php
│   ├── sales.php
│   ├── add_sale.php
│   ├── view_sale.php
│   ├── reports.php
│   ├── users.php
│   ├── activity_logs.php
│   ├── passcode_management.php
│   ├── contact_messages.php
│   ├── profile.php
│   ├── upload_profile_photo.php
│   ├── export_users.php
│   └── reports/                # Report sub-pages
│       ├── inventory_report.php
│       ├── low_stock_report.php
│       ├── stock_movements_report.php
│       ├── category_report.php
│       └── supplier_report.php
├── api/                        # JSON API endpoints
│   ├── get_notifications.php
│   ├── mark_notifications_read.php
│   ├── get_chart_data.php
│   ├── export_report.php
│   ├── check_passcode.php
│   └── generate_passcode.php
├── assets/
│   ├── css/
│   │   └── style.css
│   ├── js/
│   │   └── script.js
│   └── images/
│       ├── homepage/
│       └── products/
├── auth/                       # Authentication
│   ├── login.php
│   ├── register.php
│   ├── logout.php
│   ├── forgot_password.php
│   ├── reset_password.php
│   └── verify_email.php
├── config/
│   └── db.php                  # Database connection
├── database/
│   ├── inventory_system.sql    # Full schema + sample data
│   └── README.md
├── docs/                       # Project documentation
│   ├── README.md
│   ├── USER_MANUAL.md
│   ├── TECHNICAL_DOCUMENTATION.md
│   ├── PROJECT_SUMMARY.md
│   ├── PROJECT_STRUCTURE.md
│   ├── ROLE_BASED_ACCESS_CONTROL.md
│   ├── MARKET_ANALYSIS.md
│   ├── PROJECT_BRANDING.md
│   └── PROJECT_PRESENTATION.md
├── includes/                   # Shared PHP components
│   ├── auth_check.php
│   ├── role_check.php
│   ├── role_permissions.php
│   ├── unified_header.php
│   ├── unified_footer.php
│   ├── header.php
│   └── footer.php
├── uploads/
│   └── profiles/               # User-uploaded profile photos
├── .gitignore
├── .htaccess
├── 404.html
├── contact_handler.php
├── index.php
├── REPORT.md
└── README.md
```

## Security Notes

- All passwords are hashed with `password_hash()` (bcrypt)
- All queries use prepared statements (no SQL injection)
- CSRF tokens on sensitive forms
- Session timeout after 30 minutes of inactivity
- File uploads restricted to images only (JPG, PNG, GIF, max 5MB)
- `.htaccess` blocks direct access to `.sql` files

## Registration Passcode System

New users require a passcode generated by an admin to register. This prevents unauthorized account creation.

1. Admin goes to **Passcode Management** in the sidebar
2. Generates a passcode for the desired role (Staff or Admin)
3. Shares the passcode with the new user
4. New user enters it during registration

## License

This project was developed as a university 3rd year project (2024–2025).

---

**© 2026 StockWise Pro**
