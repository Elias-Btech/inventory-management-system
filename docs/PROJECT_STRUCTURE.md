# Project Structure — StockWise Pro

```
inventory_system/
│
├── admin/                          # Admin panel pages
│   ├── dashboard.php               # Main dashboard with stats
│   ├── products.php                # Product list + search/filter
│   ├── add_product.php             # Add new product with image upload
│   ├── edit_product.php            # Edit existing product
│   ├── delete_product.php          # Soft-delete product (sets status=inactive)
│   ├── update_stock.php            # Stock in/out handler
│   ├── categories.php              # Category CRUD (modal-based)
│   ├── suppliers.php               # Supplier CRUD (modal-based)
│   ├── stock_transactions.php      # Stock history with filters
│   ├── orders.php                  # Customer orders management
│   ├── add_order.php               # Create new order (multi-item)
│   ├── view_order.php              # Order detail / print view
│   ├── sales.php                   # Sales / POS management
│   ├── add_sale.php                # Create new sale (multi-item POS)
│   ├── view_sale.php               # Sale receipt / print view
│   ├── reports.php                 # Reports hub (admin only)
│   ├── users.php                   # User management (admin only)
│   ├── activity_logs.php           # Audit trail (admin only)
│   ├── passcode_management.php     # Registration passcode generator
│   ├── contact_messages.php        # Contact form inbox (admin only)
│   ├── profile.php                 # User profile settings
│   ├── upload_profile_photo.php    # AJAX profile photo upload handler
│   ├── export_users.php            # Export users to CSV
│   ├── role_management.php         # Redirects to users.php
│   └── reports/                    # Report sub-pages (included by reports.php)
│       ├── inventory_report.php
│       ├── low_stock_report.php
│       ├── stock_movements_report.php
│       ├── category_report.php
│       └── supplier_report.php
│
├── api/                            # JSON API endpoints
│   ├── get_notifications.php       # Fetch notifications + unread count
│   ├── mark_notifications_read.php # Mark all notifications as read
│   ├── get_chart_data.php          # Dashboard chart data (stock, category, etc.)
│   ├── export_report.php           # CSV export for all report types
│   ├── check_passcode.php          # Validate registration passcode
│   └── generate_passcode.php       # AJAX passcode generation (admin only)
│
├── assets/
│   ├── css/
│   │   └── style.css               # Main stylesheet
│   ├── js/
│   │   └── script.js               # Sidebar, modals, charts, export, notifications
│   └── images/
│       ├── homepage/               # Landing page images
│       ├── products/               # Product images (uploaded via admin)
│       └── profiles/               # Legacy profile photo location
│
├── auth/
│   ├── login.php                   # Animated login + inline registration form
│   ├── register.php                # Simple registration fallback
│   ├── logout.php                  # Session destroy + activity log
│   ├── forgot_password.php         # Password reset request (generates token)
│   ├── reset_password.php          # Password reset form (validates token)
│   └── verify_email.php            # Email verification via token
│
├── config/
│   └── db.php                      # Database connection + helper functions
│
├── database/
│   ├── inventory_system.sql        # Full schema + sample data
│   └── README.md                   # Import instructions
│
├── docs/
│   ├── README.md                   # Documentation index
│   ├── USER_MANUAL.md              # End-user guide
│   ├── TECHNICAL_DOCUMENTATION.md  # Developer reference
│   ├── PROJECT_SUMMARY.md          # Feature checklist + project info
│   ├── PROJECT_STRUCTURE.md        # This file
│   ├── ROLE_BASED_ACCESS_CONTROL.md # RBAC documentation
│   ├── MARKET_ANALYSIS.md          # Business case
│   ├── PROJECT_BRANDING.md         # Design system
│   └── PROJECT_PRESENTATION.md     # Academic presentation
│
├── includes/
│   ├── auth_check.php              # Session guard, timeout, low stock checker
│   ├── role_check.php              # Core RBAC: isAdmin(), canAccess(), requireAdmin()
│   ├── role_permissions.php        # Extended helpers: hasPermission(), logActivity()
│   ├── unified_header.php          # Shared sidebar + topbar (used by 8 admin pages)
│   ├── unified_footer.php          # Shared footer + notification JS
│   ├── header.php                  # Legacy header (used by older admin pages)
│   └── footer.php                  # Legacy footer
│
├── uploads/
│   └── profiles/                   # User-uploaded profile photos
│
├── index.php                       # Public homepage / landing page
├── contact_handler.php             # Contact form POST handler (returns JSON)
├── .htaccess                       # Apache config: security headers, caching, compression
├── .gitignore                      # Git ignore rules
├── 404.html                        # Custom 404 error page
└── README.md                       # Main project README (GitHub-ready)
```

---

## Notes

- `admin/reports/` sub-pages are PHP partials — they are included inside `admin/reports.php`, not accessed directly
- `uploads/profiles/` is where profile photos are stored (gitignored)
- `assets/images/products/` stores product images uploaded via the admin panel (gitignored except placeholder)
- `role_management.php` is a stub that redirects to `users.php` — role management is handled there

---

**© 2026 StockWise Pro**
