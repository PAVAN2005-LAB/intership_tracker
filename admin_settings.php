<?php
session_start();
require_once 'config/db.php';

// Prevent Student or Guest Access strictly
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'Admin') {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];
$success = '';
$error = '';

/** Logic to process Admin Settings Update **/
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_admin'])) {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    try {
        if (!empty($password)) {
            // Update everything including Password Algorithm
            $hashed = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $pdo->prepare("UPDATE users SET name=?, email=?, password=? WHERE id=?");
            $stmt->execute([$name, $email, $hashed, $user_id]);
        } else {
            // Only update System Email and Name strings
            $stmt = $pdo->prepare("UPDATE users SET name=?, email=? WHERE id=?");
            $stmt->execute([$name, $email, $user_id]);
        }
        
        // Refresh active cached session name mapping
        $_SESSION['name'] = $name;
        $success = "Administrator System Credentials Updated Successfully!";
    } catch (PDOException $e) {
         $error = "Error: That Email is already securely tracked globally by another memory account.";
    }
}

// Fetch Latest Admin Memory State
$stmt = $pdo->prepare("SELECT name, email FROM users WHERE id = ?");
$stmt->execute([$user_id]);
$admin = $stmt->fetch();

$title = 'Admin Security Portal';
include 'includes/layouts/header.php';
include 'includes/layouts/navbar_admin.php';
?>

<div class="container mt-5 mb-5" style="min-height: 70vh;">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow border-0 border-top border-danger border-5">
                <div class="card-body p-5 bg-white rounded">
                    <h3 class="mb-4 text-center text-danger fw-bold"><i class="bi bi-shield-lock-fill"></i> Security Override Portal</h3>
                    <p class="text-center text-muted mb-4 small">Update your root system credentials dynamically without requiring database interventions.</p>
                    
                    <?php if($success): ?>
                        <div class="alert alert-success shadow-sm"><i class="bi bi-check-circle-fill"></i> <?= htmlspecialchars($success) ?></div>
                    <?php endif; ?>
                    <?php if($error): ?>
                        <div class="alert alert-danger shadow-sm"><i class="bi bi-x-circle-fill"></i> <?= htmlspecialchars($error) ?></div>
                    <?php endif; ?>

                    <form method="POST">
                        <input type="hidden" name="update_admin" value="1">
                        
                        <div class="mb-3">
                            <label class="form-label fw-bold text-dark">Admin Display Name</label>
                            <input type="text" name="name" class="form-control bg-light" value="<?= htmlspecialchars($admin['name']) ?>" required>
                        </div>
                        
                        <div class="mb-4">
                            <label class="form-label fw-bold text-dark">System Email <span class="text-danger">*</span></label>
                            <input type="email" name="email" class="form-control bg-light" value="<?= htmlspecialchars($admin['email']) ?>" required>
                        </div>
                        
                        <div class="mb-4 p-3 border rounded bg-light border-danger border-opacity-25 shadow-sm">
                            <label class="form-label fw-bold text-danger"><i class="bi bi-key-fill"></i> New Security Encryption Password</label>
                            <input type="password" name="password" class="form-control border-secondary" placeholder="Leave completely blank to keep current password">
                            <small class="text-muted d-block mt-2">Entering text will instantly overwrite your old password using a BCRYPT re-hashing trigger.</small>
                        </div>
                        
                        <button type="submit" class="btn btn-danger btn-lg w-100 fw-bold shadow"><i class="bi bi-sim-fill"></i> Execute Credential Override</button>
                    </form>
                </div>
            </div>
            <div class="text-center mt-3">
                 <a href="admin.php" class="btn btn-sm btn-outline-secondary fw-bold">&larr; Return to Dashboard Frame</a>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/layouts/footer.php'; ?>
