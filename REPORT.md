# Project Report — StockWise Pro

**Developer**: Elias Araya
**Course**: Web Development
**Academic Year**: 2024–2025
**Submission Date**: January 2026

---

## 1. Introduction

StockWise Pro is a full-stack web-based inventory management system developed as a university final year project. The system is designed to help small and medium businesses manage their products, track stock levels, process customer orders and sales, and generate reports — all through a browser-based interface.

The project demonstrates practical application of server-side web development using PHP and MySQL, combined with a modern, responsive frontend built with HTML, CSS, and JavaScript.

---

## 2. Objectives

- Build a complete, working inventory management system from scratch
- Implement secure user authentication with role-based access control
- Design a normalized relational database with proper foreign key relationships
- Create a clean, modern UI that works on both desktop and mobile
- Provide data export and reporting functionality
- Follow real-world security practices (password hashing, prepared statements, CSRF protection)

---

## 3. System Features

### 3.1 Authentication & Access Control

- Login with username or email
- Registration requires an admin-generated passcode (prevents unauthorized accounts)
- Two roles: **Admin** (full access) and **Staff** (limited access)
- Password reset via secure token
- Session timeout after 30 minutes of inactivity

### 3.2 Inventory Management

- Add, edit, and soft-delete products with image upload
- Organize products by categories and suppliers
- Set minimum stock levels — triggers automatic low stock alerts
- Full stock transaction history (in / out / adjustment)

### 3.3 Orders & Sales

- Create multi-item customer orders with status tracking (pending → delivered)
- Point-of-sale system with discount, tax, and multiple payment methods
- Automatic inventory deduction on sale completion
- Void sales with automatic stock restoration

### 3.4 Reports & Analytics

- 5 report types: Inventory, Low Stock, Stock Movements, Category Summary, Supplier Summary
- CSV export for all report types
- Dashboard charts (bar chart for stock levels, pie chart for categories)
- Real-time notification badge for unread alerts

### 3.5 Administration

- User management with bulk actions (activate, deactivate, delete)
- Registration passcode generator (single-use, role-specific, time-limited)
- Full activity audit log
- Contact messages inbox from the public homepage

---

## 4. Technical Implementation

### 4.1 Architecture

The application follows a simple MVC-inspired structure without a framework:

| Layer | Implementation |
|-------|---------------|
| Model | MySQLi prepared statements in PHP scripts |
| View | HTML templates with inline PHP |
| Controller | PHP page scripts handling GET/POST logic |
| API | JSON endpoints in `api/` folder |

### 4.2 Database Design

12 normalized tables with InnoDB foreign key constraints:

```
users, categories, suppliers, products
stock_transactions, activity_logs, notifications
registration_passcodes
orders, order_items, sales, sale_items
```

### 4.3 Security Measures

| Threat | Mitigation |
|--------|-----------|
| SQL Injection | MySQLi prepared statements on all queries |
| XSS | `htmlspecialchars()` on all output |
| CSRF | Token-based form validation |
| Brute force | Activity logging of all login attempts |
| Unauthorized access | Session guard + role checks on every page |
| Weak passwords | Minimum 6 characters enforced |
| File upload attacks | Type validation + `getimagesize()` check |
| Session hijacking | 30-minute timeout, session regeneration on login |

### 4.4 File Structure

```
admin/      — 24 management pages
api/        — 6 JSON endpoints
auth/       — 6 authentication pages
config/     — database connection
includes/   — shared header, footer, auth, RBAC helpers
assets/     — CSS, JS, images
database/   — SQL schema file
docs/       — 9 documentation files
```

---

## 5. Challenges & Solutions

| Challenge | Solution |
|-----------|----------|
| Column name mismatches between code and DB schema | Audited all SQL queries against the actual schema and fixed `image_path` → `image`, `created_by` → `user_id`, `unit_price`/`selling_price` → `price` |
| Missing shared includes causing fatal errors | Recreated `unified_header.php`, `unified_footer.php`, and `role_permissions.php` |
| Orders table designed for supplier orders but code used it for customer orders | Updated the SQL schema to match the actual application behavior |
| Duplicate sidebar code in every admin page | Consolidated into `unified_header.php` used by all pages that needed it |
| Empty documentation files | Rewrote all 9 documentation files with accurate, useful content |

---

## 6. Testing

The system was tested manually across the following areas:

| Area | Test Cases |
|------|-----------|
| Authentication | Login, logout, wrong password, session timeout, password reset |
| Products | Add, edit, delete, image upload, stock update |
| Categories & Suppliers | Add, edit, delete with and without linked products |
| Orders & Sales | Create, update status, void, CSV export |
| Reports | All 5 report types, date range filters, CSV download |
| Access Control | Staff attempting admin-only pages (should be blocked) |
| Notifications | Low stock alert creation and dismissal |

---

## 7. Conclusion

StockWise Pro is a complete, functional inventory management system that meets all the original objectives. It demonstrates full-stack web development skills including database design, server-side programming, frontend development, security implementation, and documentation.

The system is ready for academic submission and could be deployed to a real web server with minimal configuration changes (updating `config/db.php` credentials and enabling HTTPS).

---

## 8. References

- PHP Documentation — https://www.php.net/docs.php
- MySQL Documentation — https://dev.mysql.com/doc/
- Font Awesome Icons — https://fontawesome.com
- OWASP Security Guidelines — https://owasp.org
- MDN Web Docs (HTML/CSS/JS) — https://developer.mozilla.org

---

**© 2026 StockWise Pro — Elias Araya**
