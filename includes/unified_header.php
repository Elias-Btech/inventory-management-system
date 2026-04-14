<?php
/**
 * Unified Header - shared across all admin pages
 * StockWise Pro - Inventory Management System
 */
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user_id'])) {
    header('Location: ../auth/login.php');
    exit();
}

require_once '../config/db.php';

$current_page = basename($_SERVER['PHP_SELF']);

// Get user info
$user_info = null;
$stmt = $conn->prepare("SELECT username, role, profile_photo FROM users WHERE id = ?");
$stmt->bind_param("i", $_SESSION['user_id']);
$stmt->execute();
$result = $stmt->get_result();
$user_info = $result->fetch_assoc();

function isActive($pages) {
    $current = basename($_SERVER['PHP_SELF']);
    if (is_array($pages)) return in_array($current, $pages) ? 'active' : '';
    return $current === $pages ? 'active' : '';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($page_title) ? htmlspecialchars($page_title) . ' - StockWise Pro' : 'StockWise Pro'; ?></title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Times New Roman', Times, serif;
            background: linear-gradient(135deg, #1e40af 0%, #0f766e 50%, #059669 100%);
            min-height: 100vh;
        }
        .layout { display: flex; min-height: 100vh; }
        .sidebar {
            width: 260px; flex-shrink: 0;
            background: rgba(255,255,255,0.1);
            backdrop-filter: blur(20px);
            border-right: 1px solid rgba(255,255,255,0.2);
            color: white;
        }
        .sidebar-logo {
            padding: 25px 20px;
            font-size: 1.5rem; font-weight: 700;
            background: rgba(255,255,255,0.1);
            border-bottom: 1px solid rgba(255,255,255,0.2);
            display: flex; align-items: center; gap: 10px;
        }
        .sidebar-logo i {
            background: linear-gradient(135deg, #60a5fa, #34d399);
            -webkit-background-clip: text; -webkit-text-fill-color: transparent;
        }
        .sidebar-user {
            display: flex; align-items: center; gap: 10px;
            padding: 12px 16px; margin: 12px;
            background: rgba(255,255,255,0.1);
            border-radius: 10px;
            border: 1px solid rgba(255,255,255,0.1);
        }
        .sidebar-user-avatar {
            width: 38px; height: 38px; border-radius: 50%;
            background: linear-gradient(135deg, #1e40af, #0f766e);
            display: flex; align-items: center; justify-content: center;
            color: white; font-weight: 600; font-size: 1rem;
            border: 2px solid rgba(255,255,255,0.2);
            overflow: hidden; flex-shrink: 0;
        }
        .sidebar-user-avatar img { width: 100%; height: 100%; object-fit: cover; }
        .sidebar-user-info span { display: block; font-weight: 600; font-size: 0.85rem; color: white; }
        .sidebar-user-info small {
            font-size: 0.72rem; color: rgba(255,255,255,0.8);
            background: rgba(79,195,247,0.2); padding: 2px 7px; border-radius: 8px;
        }
        .nav-menu { list-style: none; padding: 10px 0; }
        .nav-item { margin: 3px 12px; border-radius: 10px; transition: all 0.3s; }
        .nav-item:hover { background: rgba(255,255,255,0.15); transform: translateX(5px); }
        .nav-item.active { background: rgba(255,255,255,0.2); border-left: 3px solid #60a5fa; }
        .nav-item a {
            color: rgba(255,255,255,0.9); text-decoration: none;
            display: flex; align-items: center; gap: 12px;
            padding: 13px 16px; font-weight: 500; font-size: 0.95rem;
        }
        .nav-item:hover a { color: white; }
        .nav-item i { width: 18px; text-align: center; }
        .nav-divider {
            font-size: 0.7rem; font-weight: 700; color: rgba(255,255,255,0.4);
            text-transform: uppercase; letter-spacing: 1px;
            padding: 10px 28px 4px;
        }
        .main-content { flex: 1; display: flex; flex-direction: column; overflow: hidden; }
        .top-bar {
            background: rgba(255,255,255,0.95);
            backdrop-filter: blur(20px);
            padding: 15px 30px;
            display: flex; justify-content: space-between; align-items: center;
            border-bottom: 1px solid rgba(0,0,0,0.08);
            box-shadow: 0 2px 10px rgba(0,0,0,0.08);
        }
        .top-bar h1 {
            font-size: 1.6rem; font-weight: 700;
            background: linear-gradient(135deg, #1e40af, #0f766e);
            -webkit-background-clip: text; -webkit-text-fill-color: transparent;
        }
        .top-bar-right { display: flex; align-items: center; gap: 15px; }
        .notif-btn {
            position: relative; background: none; border: none;
            font-size: 1.2rem; color: #6c757d; cursor: pointer; padding: 5px;
        }
        .notif-count {
            position: absolute; top: -2px; right: -4px;
            background: #dc3545; color: white;
            font-size: 0.65rem; font-weight: 700;
            width: 16px; height: 16px; border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
        }
        .page-content { flex: 1; padding: 30px; overflow-y: auto; }
        .alert {
            padding: 14px 20px; border-radius: 10px; margin-bottom: 20px;
            display: flex; align-items: center; gap: 10px; font-weight: 500;
        }
        .alert-success { background: #d4edda; color: #155724; border-left: 4px solid #28a745; }
        .alert-error   { background: #f8d7da; color: #721c24; border-left: 4px solid #dc3545; }
        .alert-info    { background: #d1ecf1; color: #0c5460; border-left: 4px solid #17a2b8; }
    </style>
</head>
<body>
<div class="layout">
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="sidebar-logo">
            <i class="fas fa-boxes"></i> StockWise Pro
        </div>

        <?php if ($user_info): ?>
        <div class="sidebar-user">
            <div class="sidebar-user-avatar">
                <?php
                $photo_path = '';
                if (!empty($user_info['profile_photo'])) {
                    $photo_path = '../' . $user_info['profile_photo'];
                }
                if ($photo_path && file_exists($photo_path)): ?>
                    <img src="<?php echo htmlspecialchars($photo_path); ?>" alt="Profile">
                <?php else: ?>
                    <?php echo strtoupper(substr($user_info['username'], 0, 1)); ?>
                <?php endif; ?>
            </div>
            <div class="sidebar-user-info">
                <span><?php echo htmlspecialchars($user_info['username']); ?></span>
                <small><?php echo ucfirst($user_info['role']); ?></small>
            </div>
        </div>
        <?php endif; ?>

        <ul class="nav-menu">
            <li class="nav-divider">Main</li>
            <li class="nav-item <?php echo isActive('dashboard.php'); ?>">
                <a href="dashboard.php"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
            </li>

            <li class="nav-divider">Inventory</li>
            <li class="nav-item <?php echo isActive(['products.php','add_product.php','edit_product.php']); ?>">
                <a href="products.php"><i class="fas fa-box"></i> Products</a>
            </li>
            <li class="nav-item <?php echo isActive('categories.php'); ?>">
                <a href="categories.php"><i class="fas fa-tags"></i> Categories</a>
            </li>
            <li class="nav-item <?php echo isActive('suppliers.php'); ?>">
                <a href="suppliers.php"><i class="fas fa-truck"></i> Suppliers</a>
            </li>
            <li class="nav-item <?php echo isActive('stock_transactions.php'); ?>">
                <a href="stock_transactions.php"><i class="fas fa-exchange-alt"></i> Stock History</a>
            </li>

            <li class="nav-divider">Sales</li>
            <li class="nav-item <?php echo isActive(['orders.php','add_order.php','view_order.php']); ?>">
                <a href="orders.php"><i class="fas fa-shopping-cart"></i> Orders</a>
            </li>
            <li class="nav-item <?php echo isActive(['sales.php','add_sale.php','view_sale.php']); ?>">
                <a href="sales.php"><i class="fas fa-cash-register"></i> Sales</a>
            </li>

            <?php if (isset($user_info['role']) && $user_info['role'] === 'admin'): ?>
            <li class="nav-divider">Admin</li>
            <li class="nav-item <?php echo isActive('reports.php'); ?>">
                <a href="reports.php"><i class="fas fa-chart-bar"></i> Reports</a>
            </li>
            <li class="nav-item <?php echo isActive('users.php'); ?>">
                <a href="users.php"><i class="fas fa-users"></i> Users</a>
            </li>
            <li class="nav-item <?php echo isActive('activity_logs.php'); ?>">
                <a href="activity_logs.php"><i class="fas fa-history"></i> Activity Logs</a>
            </li>
            <li class="nav-item <?php echo isActive('contact_messages.php'); ?>">
                <a href="contact_messages.php"><i class="fas fa-envelope"></i> Messages</a>
            </li>
            <?php endif; ?>

            <li class="nav-divider">Account</li>
            <li class="nav-item <?php echo isActive('profile.php'); ?>">
                <a href="profile.php"><i class="fas fa-user-circle"></i> My Profile</a>
            </li>
            <li class="nav-item">
                <a href="../auth/logout.php" onclick="return confirm('Logout?')">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </a>
            </li>
        </ul>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <div class="top-bar">
            <h1><?php echo isset($page_title) ? htmlspecialchars($page_title) : 'Dashboard'; ?></h1>
            <div class="top-bar-right">
                <button class="notif-btn" id="notifBtn" title="Notifications">
                    <i class="fas fa-bell"></i>
                    <span class="notif-count" id="notifCount" style="display:none">0</span>
                </button>
                <span style="color:#6c757d; font-size:0.9rem;">
                    Welcome, <strong><?php echo htmlspecialchars($user_info['username'] ?? ''); ?></strong>
                </span>
            </div>
        </div>

        <div class="page-content">
            <?php
            if (isset($_SESSION['success_message'])) {
                echo '<div class="alert alert-success"><i class="fas fa-check-circle"></i> ' . htmlspecialchars($_SESSION['success_message']) . '</div>';
                unset($_SESSION['success_message']);
            }
            if (isset($_SESSION['error_message'])) {
                echo '<div class="alert alert-error"><i class="fas fa-exclamation-triangle"></i> ' . htmlspecialchars($_SESSION['error_message']) . '</div>';
                unset($_SESSION['error_message']);
            }
            ?>
