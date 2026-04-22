<?php // includes/admin_applications.php ?>
<!-- Manage Applications Section -->
<h2 id="app-section" class="mb-3">Manage Applications</h2>
<div class="card shadow-sm mb-5">
    <div class="card-body">
        <table class="table table-hover table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>ID</th><th>Student</th><th>Email</th><th>Resume</th><th>Internship</th><th>Date</th><th>Status</th><th>Update</th>
                </tr>
            </thead>
            <tbody>
                <?php if(empty($applications)) echo "<tr><td colspan='8' class='text-center'>No applications yet.</td></tr>"; ?>
                <?php foreach($applications as $app): ?>
                <tr>
                    <td><?= $app['id'] ?></td>
                    <td><?= htmlspecialchars($app['student_name']) ?></td>
                    <td><?= htmlspecialchars($app['email']) ?></td>
                    <td>
                        <?php if(!empty($app['resume_path']) && file_exists($app['resume_path'])): ?>
                            <a href="<?= htmlspecialchars($app['resume_path']) ?>" target="_blank" class="btn btn-sm btn-outline-info fw-bold">View PDF</a>
                        <?php else: ?>
                            <span class="text-danger small fw-bold">No Resume</span>
                        <?php endif; ?>
                    </td>
                    <td><?= htmlspecialchars($app['intern_title']) ?></td>
                    <td><?= $app['applied_at'] ?></td>
                    <td>
                        <span class="badge <?= $app['status'] == 'Approved' ? 'bg-success' : ($app['status'] == 'Rejected' ? 'bg-danger' : 'bg-warning text-dark') ?>">
                            <?= $app['status'] ?>
                        </span>
                    </td>
                    <td>
                        <form method="POST" action="admin.php" class="d-flex">
                            <input type="hidden" name="action" value="update_status">
                            <input type="hidden" name="application_id" value="<?= $app['id'] ?>">
                            <select name="status" class="form-select form-select-sm me-2" required>
                                <option value="Pending" <?= $app['status'] == 'Pending' ? 'selected' : '' ?>>Pending</option>
                                <option value="Approved" <?= $app['status'] == 'Approved' ? 'selected' : '' ?>>Approved</option>
                                <option value="Rejected" <?= $app['status'] == 'Rejected' ? 'selected' : '' ?>>Rejected</option>
                            </select>
                            <button type="submit" class="btn btn-sm btn-primary">Update</button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
