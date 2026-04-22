<?php
session_start();
require_once 'config/db.php';

// Check if user is logged in
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'Student') {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];
$success = '';
$error = '';

// Handle Profile Update Logic
require_once 'includes/profile/logic.php';

// Fetch Current Profile
$stmt = $pdo->prepare("SELECT name, email, phone, college, degree, cgpa, enrollment_no, linkedin, github, leetcode, codeforces, codechef, geeksforgeeks, hackerrank, resume_path FROM users WHERE id = ?");
$stmt->execute([$user_id]);
$user = $stmt->fetch();
?>
<?php
$title = 'My Profile';
include 'includes/layouts/header.php';
include 'includes/layouts/navbar_student.php';
?>

<div class="container mt-5 mb-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm p-4">
                <h3 class="mb-4 text-center">Manage Profile</h3>
                
                <?php if($success): ?>
                    <div class="alert alert-success"><i class="bi bi-check-circle-fill"></i> <?= htmlspecialchars($success) ?></div>
                <?php endif; ?>
                <?php if($error): ?>
                    <div class="alert alert-danger"><i class="bi bi-exclamation-triangle-fill"></i> <?= htmlspecialchars($error) ?></div>
                <?php endif; ?>

                <?php include 'includes/profile/form.php'; ?>
            </div>
        </div>
    </div>
<?php include 'includes/layouts/footer.php'; ?>
