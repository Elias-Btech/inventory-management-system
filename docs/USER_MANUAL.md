# User Manual — StockWise Pro

## Table of Contents

1. [Getting Started](#getting-started)
2. [Login & Registration](#login--registration)
3. [Dashboard](#dashboard)
4. [Products](#products)
5. [Categories](#categories)
6. [Suppliers](#suppliers)
7. [Stock Management](#stock-management)
8. [Orders](#orders)
9. [Sales (POS)](#sales-pos)
10. [Reports](#reports)
11. [User Profile](#user-profile)
12. [Admin Functions](#admin-functions)
13. [Troubleshooting](#troubleshooting)

---

## Getting Started

1. Open your browser and go to `http://localhost/inventory_system/`
2. Click **Login** in the top navigation
3. Use the demo credentials or your own account

**Demo accounts:**

| Role | Username | Password |
|------|----------|----------|
| Admin | `admin` | `admin123` |
| Staff | `staff` | `admin123` |

---

## Login & Registration

### Login

1. Enter your username or email
2. Enter your password
3. Click **Sign In**

### Register a New Account

New accounts require a **registration passcode** from an administrator.

1. On the login page, click **Create Account**
2. Fill in your name, email, username, and choose a role
3. Enter the passcode provided by your admin
4. Set a password (minimum 6 characters)
5. Click **Create Account**

### Forgot Password

1. Click **Forgot Password** on the login page
2. Enter your email address
3. A reset link will be shown (in production this would be emailed)
4. Click the link and enter your new password

---

## Dashboard

The dashboard shows a real-time overview of your inventory:

- **Total Products** — active products in the system
- **Low Stock Items** — products at or below minimum level
- **Active Suppliers** — suppliers with active status
- **Categories** — total product categories
- **Today's Sales** — revenue from today
- **Monthly Revenue** — revenue for the current month

Below the stats you'll see:
- **Recent Activities** — last 5 system actions
- **Low Stock Alert** — products that need restocking

---

## Products

### View Products

Go to **Products** in the sidebar. You'll see a table with all active products showing image, name, SKU, category, supplier, stock level, price, and status.

Use the **Search & Filter** section to find products by name/SKU, category, or stock status.

### Add a Product

1. Click **Add New Product**
2. Fill in:
   - Product Name (required)
   - SKU — auto-generated if left blank
   - Category and Supplier (optional dropdowns)
   - Description
   - Price
   - Initial Quantity
   - Minimum Stock Level — triggers low stock alert when reached
   - Product Image (JPG/PNG/GIF, max 5MB)
3. Click **Create Product**

### Edit a Product

Click the **edit icon** (pencil) on any product row. Update the fields and click **Update Product**.

> Note: To change stock quantity, use the **stock update button** (boxes icon), not the edit form.

### Delete a Product

Click the **trash icon**. Products are soft-deleted (status set to `inactive`) — they are not permanently removed, preserving transaction history.

---

## Categories

Go to **Categories** in the sidebar.

- **Add**: Click **Add New Category**, enter name and optional description
- **Edit**: Click the edit button on any row
- **Delete**: Only possible if no products are assigned to the category

---

## Suppliers

Go to **Suppliers** in the sidebar.

- **Add**: Click **Add New Supplier**, fill in company name, contact person, email, phone, address
- **Edit**: Click the edit button
- **Delete**: Only possible if no products are linked to the supplier

---

## Stock Management

### Update Stock

From the Products page, click the **boxes icon** on any product:

1. Choose **Stock In** (receiving goods) or **Stock Out** (removing goods)
2. Enter the quantity
3. Add optional notes
4. Submit

Every stock change is recorded in the transaction log.

### View Stock History

Go to **Stock History** in the sidebar. Filter by:
- Product
- Transaction type (in / out / adjustment)
- User
- Date range

Click **Export CSV** to download the filtered results.

---

## Orders

Go to **Orders** in the sidebar.

### Create an Order

1. Click **Create New Order**
2. Enter customer details (name required, email/phone/address optional)
3. Add products — click **Add Item** to add more lines
4. Each line shows product, quantity, and calculated total
5. Add notes if needed
6. Click **Create Order**

### Track Orders

Orders have statuses: `pending` → `processing` → `shipped` → `delivered` (or `cancelled`).

Click the status dropdown on any order row to update it.

Click **View** to see full order details or print.

---

## Sales (POS)

Go to **Sales** in the sidebar.

### Record a Sale

1. Click **New Sale**
2. Optionally enter customer details
3. Add products and quantities
4. Set payment method (cash, card, bank transfer)
5. Apply discount or tax amounts if needed
6. Click **Complete Sale**

Stock is automatically deducted when a sale is completed.

### Void a Sale

Click **Void** on any completed sale. This reverses the stock deduction and marks the sale as voided.

---

## Reports

> Reports are available to **Admin** users only.

Go to **Reports** in the sidebar. Available reports:

| Report | Description |
|--------|-------------|
| Inventory | All products with current stock and value |
| Low Stock | Products at or below minimum level |
| Stock Movements | Transaction history for a date range |
| Category Summary | Inventory grouped by category |
| Supplier Summary | Inventory grouped by supplier |

Click **View Report** to see it on screen, or **Export CSV** to download.

---

## User Profile

Click **My Profile** in the sidebar.

### Update Profile Info

Change your username or email address and click **Update Profile**.

### Change Password

Enter your current password, then your new password twice, and click **Change Password**.

### Upload Profile Photo

Click the camera icon on your profile photo. Select an image (JPG/PNG/GIF, max 5MB). It uploads automatically.

---

## Admin Functions

### User Management

Go to **Users** (admin only).

- **Add User**: Click **Add New User**, fill in username, email, password, and role
- **Edit User**: Click the edit button — you can change role, status, and optionally reset password
- **Delete User**: Permanently removes the user (cannot delete your own account)
- **Bulk Actions**: Select multiple users and activate, deactivate, or delete them

### Registration Passcodes

Go to **Passcode Management** (accessible from the sidebar when logged in as admin, or via direct URL `admin/passcode_management.php`).

1. Select a role (Staff or Admin)
2. Choose expiration period
3. Click **Generate Passcode**
4. Share the code with the new user — it can only be used once

### Activity Logs

Go to **Activity Logs** (admin only). Filter by user, action type, or date range to audit system usage. Export to CSV for record-keeping.

### Contact Messages

Go to **Messages** in the sidebar (admin only). View and manage inquiries submitted through the homepage contact form.

---

## Troubleshooting

| Problem | Solution |
|---------|----------|
| Can't log in | Check username/password. Use `admin`/`admin123` for demo. |
| Registration fails | Make sure you have a valid passcode from an admin. |
| Image won't upload | File must be JPG/PNG/GIF and under 5MB. |
| Report shows no data | Check your date range and filters. |
| Session expired | You were inactive for 30 minutes. Log in again. |
| Page not found | Make sure Apache is running in XAMPP. |
| Database error | Check that MySQL is running and the DB is imported. |

**Browser requirements**: Chrome, Firefox, Safari, or Edge (latest versions). JavaScript must be enabled.

---

**© 2026 StockWise Pro | User Manual v2.0**
