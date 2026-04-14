# Role-Based Access Control — StockWise Pro

## Overview

The system has two roles: **Admin** and **Staff**. Access is enforced at the page level and within the navigation menu.

---

## Role Permissions

| Feature | Admin | Staff |
|---------|-------|-------|
| Dashboard | ✅ | ✅ |
| View products | ✅ | ✅ |
| Add product | ✅ | ✅ |
| Edit product | ✅ | ✅ |
| Delete product | ✅ | ❌ |
| Categories | ✅ | ✅ |
| Suppliers | ✅ | ✅ |
| Stock history | ✅ | ✅ |
| Orders | ✅ | ✅ |
| Sales / POS | ✅ | ✅ |
| Reports | ✅ | ❌ |
| User management | ✅ | ❌ |
| Activity logs | ✅ | ❌ |
| Passcode management | ✅ | ❌ |
| Contact messages | ✅ | ❌ |
| Own profile | ✅ | ✅ |

---

## Implementation

### Key Files

| File | Purpose |
|------|---------|
| `includes/role_check.php` | Core RBAC functions (`isAdmin()`, `canAccess()`, `requireAdmin()`) |
| `includes/role_permissions.php` | Extended helpers (`hasPermission()`, `checkPageAccess()`, `logActivity()`) |
| `includes/auth_check.php` | Session guard, timeout, low stock checker |
| `includes/unified_header.php` | Role-aware sidebar navigation |

### Core Functions

```php
// Check if current user is admin
isAdmin()           // returns bool

// Check if current user is staff
isStaff()           // returns bool

// Check a named permission
hasPermission($role, 'view_reports')   // returns bool

// Protect a page — redirects if not admin
requireAdmin()

// Protect a page by permission name
checkPageAccess('view_reports', $role, 'dashboard.php')
```

### Page Protection Example

```php
// Admin-only page
require_once '../includes/role_check.php';
requireAdmin();

// Permission-based page
require_once '../includes/role_permissions.php';
checkPageAccess('view_reports', getUserRole(), 'dashboard.php');
```

### Navigation Filtering

The sidebar in `unified_header.php` conditionally shows admin-only items:

```php
<?php if ($user_info['role'] === 'admin'): ?>
    <li><a href="reports.php">Reports</a></li>
    <li><a href="users.php">Users</a></li>
    <li><a href="activity_logs.php">Activity Logs</a></li>
<?php endif; ?>
```

---

## Visual Indicators

The sidebar user badge shows the role clearly:

- **Admin**: Red badge — `👑 Administrator`
- **Staff**: Green badge — `👤 Staff Member`

---

## Session & Timeout

- Session timeout: **30 minutes** of inactivity
- On timeout: session destroyed, redirected to login with `?timeout=1`
- Last activity timestamp updated on every page load via `auth_check.php`

---

## Default Credentials

| Role | Username | Password |
|------|----------|----------|
| Admin | `admin` | `admin123` |
| Staff | `staff` | `admin123` |

> Change these immediately after first login.

---

**© 2026 StockWise Pro**
