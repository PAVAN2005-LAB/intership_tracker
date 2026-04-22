<?php
// includes/navbar_student.php
$current_page = basename($_SERVER['PHP_SELF']);
?>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm">
  <div class="container-fluid">
    <a class="navbar-brand fw-bold" href="student.php"><i class="bi bi-rocket-takeoff-fill me-2"></i>InternPortal</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav me-auto">
            <li class="nav-item">
                <a class="nav-link <?= $current_page == 'student.php' ? 'active fw-bold' : '' ?>" href="student.php">Available Internships</a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= $current_page == 'my_applications.php' ? 'active fw-bold' : '' ?>" href="my_applications.php">My Applications</a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= $current_page == 'profile.php' ? 'active fw-bold' : '' ?>" href="profile.php">My Profile</a>
            </li>
        </ul>
        <span class="navbar-text me-3 text-white fw-bold">
            <i class="bi bi-person-circle"></i> Hello, <?= htmlspecialchars($_SESSION['name'] ?? 'Student') ?>!
        </span>
        <a href="logout.php" class="btn btn-outline-light btn-sm fw-bold">Logout <i class="bi bi-box-arrow-right"></i></a>
    </div>
  </div>
</nav>
