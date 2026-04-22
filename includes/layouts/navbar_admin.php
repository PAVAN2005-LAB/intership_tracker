<?php
// includes/navbar_admin.php
?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm border-bottom border-primary border-3">
  <div class="container-fluid">
    <a class="navbar-brand fw-bold text-info" href="admin.php"><i class="bi bi-shield-lock-fill me-2"></i>Admin Core</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#adminNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="adminNav">
        <ul class="navbar-nav me-auto">
            <li class="nav-item"><a class="nav-link" href="#report-section"><i class="bi bi-bar-chart-fill"></i> Dashboard Report</a></li>
            <li class="nav-item"><a class="nav-link" href="#intern-section"><i class="bi bi-briefcase-fill"></i> Internships</a></li>
            <li class="nav-item"><a class="nav-link" href="#app-section"><i class="bi bi-file-earmark-text-fill"></i> Applications</a></li>
            <li class="nav-item"><a class="nav-link" href="#users-section"><i class="bi bi-people-fill"></i> Users</a></li>
        </ul>
        <span class="navbar-text me-3 text-white">
            <i class="bi bi-person-badge-fill text-warning"></i> Welcome, <?= htmlspecialchars($_SESSION['name'] ?? 'Admin') ?>
        </span>
        <a href="logout.php" class="btn btn-outline-danger btn-sm fw-bold">Logout</a>
    </div>
  </div>
</nav>
