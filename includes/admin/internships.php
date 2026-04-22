<?php // includes/admin_internships.php ?>
<!-- Manage Internships Section -->
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2 id="intern-section">Manage Internships</h2>
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createModal">Create New Internship</button>
</div>

<div class="card shadow-sm mb-5">
    <div class="card-body">
        <table class="table table-hover table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>ID</th><th>Title</th><th>Company</th><th>Location</th><th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($internships as $intern): ?>
                <tr>
                    <td><?= $intern['id'] ?></td>
                    <td><?= htmlspecialchars($intern['title']) ?></td>
                    <td><?= htmlspecialchars($intern['company']) ?></td>
                    <td><?= htmlspecialchars($intern['location']) ?></td>
                    <td>
                        <button class="btn btn-info btn-sm edit-btn text-white" 
                            data-id="<?= $intern['id'] ?>"
                            data-title="<?= htmlspecialchars($intern['title']) ?>"
                            data-company="<?= htmlspecialchars($intern['company']) ?>"
                            data-location="<?= htmlspecialchars($intern['location']) ?>"
                            data-description="<?= htmlspecialchars($intern['description']) ?>"
                            data-bs-toggle="modal" data-bs-target="#editModal">Edit</button>
                        <a href="admin.php?delete_intern=<?= $intern['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Delete this internship?');">Delete</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
