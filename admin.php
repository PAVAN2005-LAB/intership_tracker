<?php
session_start();
require_once 'config/db.php';

// Check if user is logged in and is an Admin
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'Admin') {
    header("Location: login.php");
    exit;
}

// 1. Process all Admin Logic (Creates, Updates, Deletions)
require_once 'includes/admin/logic.php';

// 2. Fetch Core Data for Reports/Tables
$internships = $pdo->query("SELECT * FROM internships ORDER BY posted_date DESC")->fetchAll();
$users = $pdo->query("SELECT * FROM users WHERE role = 'Student' ORDER BY id DESC")->fetchAll();
$applications = $pdo->query("
    SELECT a.id, a.status, a.applied_at, u.name as student_name, u.email, u.resume_path, i.title as intern_title 
    FROM applications a 
    JOIN users u ON a.user_id = u.id 
    JOIN internships i ON a.intern_id = i.id 
    ORDER BY a.applied_at DESC
")->fetchAll();

// Dashboard Report Stats
$totalInternships = count($internships);
$totalApplications = count($applications);
$totalUsers = count($users);

// 3. Render Structural HTML
$title = 'Admin Dashboard';
include 'includes/layouts/header.php';
include 'includes/layouts/navbar_admin.php';
?>

<div class="container mt-4">
    <?php if(isset($_GET['success'])): ?>
        <div class="alert alert-success alert-dismissible fade show">
            <i class="bi bi-check-circle-fill"></i> <?= htmlspecialchars($_GET['success']) ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <?php 
        // Component Injection Architecture
        include 'includes/admin/report.php'; 
        include 'includes/admin/internships.php'; 
        include 'includes/admin/applications.php'; 
        include 'includes/admin/users.php'; 
        include 'includes/admin/modals.php'; 
    ?>
</div>

<?php 
$extra_scripts = '<script src="assets/js/admin.js"></script>';
include 'includes/layouts/footer.php'; 
?>
