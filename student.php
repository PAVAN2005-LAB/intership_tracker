<?php
session_start();
require_once 'config/db.php';

// Check if user is logged in
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'Student') {
    header("Location: login.php");
    exit;
}

// Check exactly if the user has a resume uploaded globally
$userStmt = $pdo->prepare("SELECT resume_path FROM users WHERE id = ?");
$userStmt->execute([$_SESSION['user_id']]);
$userData = $userStmt->fetch();
$hasResume = !empty($userData['resume_path']);
$userStmt->closeCursor();
?>
<?php
$title = 'Student Dashboard';
include 'includes/layouts/header.php';
include 'includes/layouts/navbar_student.php';
?>

<div class="container mt-4">
    <div class="row mb-4">
        <div class="col-md-6">
            <h2>Available Internships</h2>
        </div>
        <div class="col-md-6">
            <input type="text" id="searchInput" class="form-control" placeholder="Search by title, company or location...">
        </div>
    </div>

    <!-- Container for AJAX fetched internships -->
    <div class="row" id="internshipsContainer">
        <!-- Dynamically populated via jQuery -->
    </div>
</div>

<!-- Dynamic Apply Modal Form -->
<div class="modal fade" id="applyModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Confirm Application</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
         <form id="applyForm" enctype="multipart/form-data">
             <input type="hidden" name="action" value="apply">
             <input type="hidden" name="intern_id" id="modal_intern_id">
             
             <!-- Resume Logic Engine -->
             <?php if($hasResume): ?>
                <div class="alert alert-success">
                    <strong>Excellent!</strong> We found your existing Resume safely stored. It will be sent automatically.
                </div>
                <p class="text-muted small">If you want to use a different resume for this specific position, upload it below (this will overwrite your profile layout):</p>
             <?php else: ?>
                <div class="alert alert-warning">
                    <strong>Missing Document!</strong> You have not uploaded a resume yet.
                </div>
                <p class="text-danger small fw-bold">You MUST attach a valid resume (PDF/DOC/DOCX) below to apply:</p>
             <?php endif; ?>
             
             <input type="file" name="resume" class="form-control" accept=".pdf,.doc,.docx" <?= !$hasResume ? 'required' : '' ?>>
         </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="submit" form="applyForm" class="btn btn-primary" id="confirmApplyBtn">Submit Application</button>
      </div>
    </div>
  </div>
<?php 
$extra_scripts = '<script src="assets/js/student.js"></script>';
include 'includes/layouts/footer.php'; 
?>
