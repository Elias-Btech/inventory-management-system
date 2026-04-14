# StockWise Pro — Project Presentation

**Developer**: Elias Araya
**Course**: Web Development
**Academic Year**: 2024–2025
**Submission**: January 2026

---

## What Is This Project?

StockWise Pro is a complete web-based inventory management system. It allows businesses to track products, manage suppliers, process customer orders and sales, monitor stock levels, and generate detailed reports — all through a browser.

---

## Problem It Solves

Most small businesses manage inventory with spreadsheets or paper. This leads to:
- Stock running out without warning
- No visibility into who changed what
- No easy way to generate reports
- No access control between staff and managers

StockWise Pro solves all of these.

---

## Main Features

### For All Users
- Secure login with role-based access
- Dashboard with live statistics
- Product, category, and supplier management
- Stock in/out tracking with full history
- Customer orders and point-of-sale
- Profile management with photo upload

### Admin Only
- User management (add, edit, deactivate)
- Registration passcode system
- Full reports with CSV export
- Activity logs / audit trail
- Contact messages inbox

---

## Technical Details

| Layer | Technology |
|-------|-----------|
| Backend | PHP 8.0+ |
| Database | MySQL 8.0+ (11 tables) |
| Frontend | HTML5, CSS3, Vanilla JavaScript |
| Icons | Font Awesome 6 |
| Server | Apache (XAMPP) |

### Security Implemented
- bcrypt password hashing
- Prepared statements (SQL injection prevention)
- CSRF token protection
- 30-minute session timeout
- File upload type and size validation

---

## System Architecture

```
Browser (HTML/CSS/JS)
        ↕
Apache Web Server
        ↕
PHP Application Layer
        ↕
MySQL Database
```

Pages are organized into:
- `auth/` — login, register, password reset
- `admin/` — all management pages
- `api/` — JSON endpoints for charts, notifications, exports
- `includes/` — shared header, footer, auth middleware

---

## Database Design

11 normalized tables with foreign key relationships:

```
users ──── activity_logs
users ──── stock_transactions
users ──── notifications
users ──── orders
users ──── sales

categories ──── products
suppliers  ──── products

products ──── stock_transactions
orders   ──── order_items
sales    ──── sale_items
```

---

## Skills Demonstrated

1. Full-stack PHP/MySQL web development
2. Relational database design and normalization
3. Role-based access control implementation
4. RESTful API design (JSON endpoints)
5. Secure coding practices
6. Responsive UI/UX design
7. File upload handling
8. Session management
9. CSV data export
10. Git version control

---

## Project Statistics

| Metric | Value |
|--------|-------|
| PHP files | 35+ |
| Database tables | 11 |
| API endpoints | 6 |
| Report types | 5 |
| Lines of code | ~5,000+ |
| Development time | 3+ months |

---

## Real-World Applications

This system is suitable for:
- Retail stores tracking product stock
- Small warehouses managing inventory
- Restaurants tracking supplies
- Any business needing sales + inventory tracking

---

*This project demonstrates practical full-stack web development applied to a real-world business problem.*
