<?php
/**
 * Role Permissions Helper
 * Thin wrapper — delegates to role_check.php
 * StockWise Pro - Inventory Management System
 */
require_once __DIR__ . '/role_check.php';

/**
 * Get current user's role from session
 */
function getUserRole() {
    return $_SESSION['user_role'] ?? 'staff';
}

/**
 * Check if role is admin
 */
function isAdmin($role = null) {
    if ($role === null) $role = getUserRole();
    return $role === 'admin';
}

/**
 * Check if role is staff
 */
function isStaff($role = null) {
    if ($role === null) $role = getUserRole();
    return $role === 'staff';
}

/**
 * Check a named permission for a given role
 */
function hasPermission($role, $permission) {
    if ($role === 'admin') return true;

    $staffPermissions = [
        'view_dashboard'    => true,
        'view_products'     => true,
        'add_product'       => true,
        'edit_product'      => true,
        'view_categories'   => true,
        'view_suppliers'    => true,
        'view_orders'       => true,
        'add_order'         => true,
        'view_sales'        => true,
        'add_sale'          => true,
        'view_profile'      => true,
        // Admin-only
        'view_users'        => false,
        'manage_users'      => false,
        'delete_product'    => false,
        'view_reports'      => false,
        'view_activity_logs'=> false,
        'manage_passcodes'  => false,
        'system_settings'   => false,
    ];

    return $staffPermissions[$permission] ?? false;
}

/**
 * Redirect with error if permission denied
 */
function requirePermission($role, $permission, $redirect = 'dashboard.php') {
    if (!hasPermission($role, $permission)) {
        $_SESSION['error_message'] = 'Access denied. You do not have permission to perform this action.';
        header("Location: $redirect");
        exit();
    }
}

/**
 * Page-level access check
 */
function checkPageAccess($permission, $role, $redirect = 'dashboard.php') {
    requirePermission($role, $permission, $redirect);
}

/**
 * Get current logged-in user info from DB
 */
function getCurrentUser($conn) {
    if (!isset($_SESSION['user_id'])) return null;
    $stmt = $conn->prepare("SELECT id, username, email, role, status, profile_photo FROM users WHERE id = ?");
    $stmt->bind_param("i", $_SESSION['user_id']);
    $stmt->execute();
    return $stmt->get_result()->fetch_assoc();
}

/**
 * Log activity helper (standalone version)
 */
function logActivity($conn, $user_id, $action, $details = null, $ip_address = null) {
    if (!$ip_address) $ip_address = $_SERVER['REMOTE_ADDR'] ?? '127.0.0.1';
    $stmt = $conn->prepare("INSERT INTO activity_logs (user_id, action, details, ip_address) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("isss", $user_id, $action, $details, $ip_address);
    $stmt->execute();
}
