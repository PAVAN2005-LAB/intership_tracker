<?php // includes/profile/form.php ?>
<form method="POST" action="profile.php" enctype="multipart/form-data">
    <input type="hidden" name="update_profile" value="1">
    
    <h5 class="text-primary border-bottom pb-2 mb-3 mt-3"><i class="bi bi-person-badge"></i> Basic Details</h5>
    
    <div class="row">
        <div class="col-md-6 mb-3">
            <label class="form-label text-muted">Account Email</label>
            <input type="email" class="form-control" value="<?= htmlspecialchars($user['email']) ?>" disabled>
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label fw-bold">Enrollment Number <span class="text-danger">*</span></label>
            <input type="text" name="enrollment_no" class="form-control" value="<?= htmlspecialchars($user['enrollment_no'] ?? '') ?>" required placeholder="e.g. 21BCA1024">
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 mb-3">
            <label class="form-label">Full Name <span class="text-danger">*</span></label>
            <input type="text" name="name" class="form-control" value="<?= htmlspecialchars($user['name']) ?>" required>
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label">Phone Number</label>
            <input type="text" name="phone" class="form-control" value="<?= htmlspecialchars($user['phone'] ?? '') ?>">
        </div>
    </div>

    <div class="mb-3">
        <label class="form-label">University / College</label>
        <input type="text" name="college" class="form-control" placeholder="e.g. Stanford University" value="<?= htmlspecialchars($user['college'] ?? '') ?>">
    </div>

    <div class="row">
        <div class="col-md-8 mb-3">
            <label class="form-label">Degree / Major</label>
            <input type="text" name="degree" class="form-control" placeholder="e.g. B.Tech Computer Science" value="<?= htmlspecialchars($user['degree'] ?? '') ?>">
        </div>
        <div class="col-md-4 mb-3">
            <label class="form-label">CGPA</label>
            <input type="number" step="0.01" max="10" name="cgpa" class="form-control" placeholder="e.g. 3.80" value="<?= htmlspecialchars($user['cgpa'] ?? '') ?>">
        </div>
    </div>

    <h5 class="text-primary border-bottom pb-2 mb-3 mt-4"><i class="bi bi-code-slash"></i> Coding & Social Profiles</h5>
    <p class="small text-muted mb-3">Please enter <strong>ONLY</strong> your exact username for each platform (Do not enter full URLs).</p>

    <div class="row">
        <div class="col-md-6 mb-3">
            <label class="form-label"><i class="bi bi-linkedin text-primary"></i> LinkedIn Username</label>
            <div class="input-group">
                <span class="input-group-text bg-light text-muted small">linkedin.com/in/</span>
                <input type="text" name="linkedin" class="form-control" placeholder="username" value="<?= htmlspecialchars($user['linkedin'] ?? '') ?>">
            </div>
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label"><i class="bi bi-github"></i> GitHub Username</label>
            <div class="input-group">
                <span class="input-group-text bg-light text-muted small">github.com/</span>
                <input type="text" name="github" class="form-control" placeholder="username" value="<?= htmlspecialchars($user['github'] ?? '') ?>">
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 mb-3">
            <label class="form-label text-warning fw-bold">{ } LeetCode Username</label>
            <input type="text" name="leetcode" class="form-control" placeholder="username" value="<?= htmlspecialchars($user['leetcode'] ?? '') ?>">
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label text-danger fw-bold">||| CodeForces Username</label>
            <input type="text" name="codeforces" class="form-control" placeholder="username" value="<?= htmlspecialchars($user['codeforces'] ?? '') ?>">
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 mb-3">
            <label class="form-label text-secondary fw-bold">★ CodeChef Username</label>
            <input type="text" name="codechef" class="form-control" placeholder="username" value="<?= htmlspecialchars($user['codechef'] ?? '') ?>">
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label text-success fw-bold">&lt;/&gt; GeeksForGeeks Username</label>
            <input type="text" name="geeksforgeeks" class="form-control" placeholder="username" value="<?= htmlspecialchars($user['geeksforgeeks'] ?? '') ?>">
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 mb-3">
            <label class="form-label text-success fw-bold">H HackerRank Username</label>
            <input type="text" name="hackerrank" class="form-control" placeholder="username" value="<?= htmlspecialchars($user['hackerrank'] ?? '') ?>">
        </div>
    </div>

    <h5 class="text-primary border-bottom pb-2 mb-3 mt-4"><i class="bi bi-file-earmark-pdf"></i> Resume Attachment</h5>
    <div class="mb-4 border p-3 rounded bg-white border-primary shadow-sm">
        <label class="form-label fw-bold">My Resume (PDF, DOCX)</label>
        <div class="mb-2">
            <?php if(!empty($user['resume_path']) && file_exists($user['resume_path'])): ?>
                <span class="badge bg-success mb-2"><i class="bi bi-check-circle"></i> Resume Active</span>
                <div><a href="<?= htmlspecialchars($user['resume_path']) ?>" target="_blank" class="btn btn-sm btn-outline-primary shadow-sm">Preview Uploaded Document</a></div>
            <?php else: ?>
                <span class="badge bg-danger mb-2"><i class="bi bi-x-circle"></i> No Resume Uploaded</span>
            <?php endif; ?>
        </div>
        <label class="form-label small text-muted mt-3">Upload new resume safely to overwrite existing file:</label>
        <input type="file" name="resume" class="form-control" accept=".pdf,.doc,.docx">
    </div>

    <button type="submit" class="btn btn-primary btn-lg w-100 fw-bold shadow-sm"><i class="bi bi-cloud-arrow-up-fill"></i> Save & Update Profile Data</button>
</form>
