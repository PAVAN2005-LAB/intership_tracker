<?php // includes/admin_users.php ?>
<!-- Manage Users Section -->
<h2 id="users-section" class="mb-3">Manage Users</h2>
<div class="card shadow-sm mb-5">
    <div class="card-body">
        <table class="table table-hover table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>User ID</th><th>Name</th><th>Email</th><th>Role</th><th>Remove Account</th>
                </tr>
            </thead>
            <tbody>
                <?php if(empty($users)) echo "<tr><td colspan='5' class='text-center'>No students registered.</td></tr>"; ?>
                <?php foreach($users as $user): ?>
                <tr>
                    <td><?= $user['id'] ?></td>
                    <td><?= htmlspecialchars($user['name']) ?></td>
                    <td><?= htmlspecialchars($user['email']) ?></td>
                    <td><?= htmlspecialchars($user['role']) ?></td>
                    <td>
                        <a href="admin.php?delete_user=<?= $user['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Delete this user? All their applications will also be deleted!');">Delete User</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
