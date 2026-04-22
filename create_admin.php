<?php
require_once 'config/db.php';
$message = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['create_admin'])) {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    
    try {
        $stmt = $pdo->prepare("INSERT INTO users (name, email, password, role) VALUES (?, ?, ?, 'Admin')");
        $stmt->execute([$name, $email, $password]);
        $message = "<div class='alert alert-success'>Successfully created new Admin: <b>$email</b></div>";
    } catch (PDOException $e) {
        $message = "<div class='alert alert-danger'>Error: That email is already registered!</div>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Secure Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5" style="max-width: 500px;">
        <div class="card shadow-sm p-4">
            <h3 class="mb-3 text-center text-primary">⚙️ Create System Admin</h3>
            <p class="text-muted text-center small mb-4">Use this hidden portal to securely generate BCRYPT-hashed Administrators directly into your database.</p>
            
            <?= $message ?>
            
            <form method="POST">
                <input type="hidden" name="create_admin" value="1">
                <div class="mb-3">
                    <label class="form-label fw-bold">Admin Full Name</label>
                    <input type="text" name="name" class="form-control" required placeholder="e.g. Master Pavan">
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold">Admin Email Address</label>
                    <input type="email" name="email" class="form-control" required placeholder="admin@gecdahod.edu">
                </div>
                <div class="mb-4">
                    <label class="form-label fw-bold">Secret Password</label>
                    <input type="password" name="password" class="form-control" required placeholder="••••••••">
                </div>
                <button type="submit" class="btn btn-dark w-100 fw-bold">Inject Admin Credentials</button>
            </form>
            <div class="text-center mt-3">
                <a href="login.php" class="text-decoration-none">&larr; Return to Login Portal</a>
            </div>
        </div>
    </div>
</body>
</html>
