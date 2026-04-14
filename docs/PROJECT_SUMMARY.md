# Project Summary — StockWise Pro

## Overview

StockWise Pro is a full-stack web-based inventory management system built with PHP and MySQL. It provides businesses with a complete solution for tracking products, managing suppliers, processing sales and orders, and generating reports — all through a modern, responsive web interface.

## Completed Features

| Feature | Status |
|---------|--------|
| User authentication (login, register, logout) | ✅ |
| Registration passcode system | ✅ |
| Password reset via token | ✅ |
| Role-based access control (Admin / Staff) | ✅ |
| Dashboard with real-time statistics | ✅ |
| Product management (add, edit, soft-delete, image upload) | ✅ |
| Category management (full CRUD) | ✅ |
| Supplier management (full CRUD) | ✅ |
| Stock transactions (in / out / adjustment) | ✅ |
| Stock history with filters | ✅ |
| Low stock alerts and notifications | ✅ |
| Orders management (create, track, status updates) | ✅ |
| Sales / POS (multi-item, discount, tax, payment method) | ✅ |
| Reports (inventory, low stock, stock movements, category, supplier) | ✅ |
| CSV export for all report types | ✅ |
| User management (admin only) | ✅ |
| Activity logs / audit trail (admin only) | ✅ |
| Contact messages inbox (admin only) | ✅ |
| User profile (photo upload, password change) | ✅ |
| Responsive design (mobile + desktop) | ✅ |

## Tech Stack

- **Backend**: PHP 8.0+
- **Database**: MySQL 8.0+
- **Frontend**: HTML5, CSS3, Vanilla JavaScript
- **Icons**: Font Awesome 6
- **Server**: Apache via XAMPP

## Database

11 tables: `users`, `categories`, `suppliers`, `products`, `stock_transactions`, `activity_logs`, `notifications`, `registration_passcodes`, `orders`, `order_items`, `sales`, `sale_items`

## User Roles

| Role | Access |
|------|--------|
| Admin | Full system access including users, reports, activity logs |
| Staff | Products, categories, suppliers, orders, sales, own profile |

## Security

- bcrypt password hashing
- Prepared statements (no SQL injection)
- CSRF token protection
- Session timeout (30 min)
- File upload validation (type + size)
- `.htaccess` blocks direct SQL file access

## Project Info

- **Developer**: Elias Araya
- **Type**: University 3rd Year Final Project
- **Academic Year**: 2024–2025
- **Version**: 1.0.0
- **Status**: Complete ✅
