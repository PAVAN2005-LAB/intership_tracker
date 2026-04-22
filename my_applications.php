<?php
session_start();
require_once 'config/db.php';

// Check if user is logged in
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'Student') {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];

// Fetch user's applications
$stmt = $pdo->prepare("
    SELECT a.id, a.status, a.applied_at, i.title, i.company, i.location 
    FROM applications a 
    JOIN internships i ON a.intern_id = i.id 
    WHERE a.user_id = ? 
    ORDER BY a.applied_at DESC
");
$stmt->execute([$user_id]);
$applications = $stmt->fetchAll();
?>
<?php
$title = 'My Applications';
include 'includes/layouts/header.php';
include 'includes/layouts/navbar_student.php';
?>

<div class="container mt-4">
    <h2>My Applications</h2>
    
    <div class="card shadow-sm mt-4">
        <div class="card-body">
            <?php if(count($applications) > 0): ?>
            <table class="table table-hover table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>Internship Title</th>
                        <th>Company</th>
                        <th>Location</th>
                        <th>Date Applied</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($applications as $app): ?>
                    <tr>
                        <td><?= htmlspecialchars($app['title']) ?></td>
                        <td><?= htmlspecialchars($app['company']) ?></td>
                        <td><?= htmlspecialchars($app['location']) ?></td>
                        <td><?= $app['applied_at'] ?></td>
                        <td>
                            <span class="badge <?= $app['status'] == 'Approved' ? 'bg-success' : ($app['status'] == 'Rejected' ? 'bg-danger' : 'bg-warning text-dark') ?>">
                                <?= $app['status'] ?>
                            </span>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <?php else: ?>
            <p class="text-muted">You have not applied to any internships yet.</p>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php include 'includes/layouts/footer.php'; ?>
