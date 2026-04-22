<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sitemap - Internship Portal</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .sitemap-list {
            list-style-type: none;
            padding-left: 0;
        }
        .sitemap-list ul {
            list-style-type: none;
            padding-left: 20px;
            border-left: 2px solid #primary;
        }
        .sitemap-list li {
            margin: 10px 0;
        }
        .sitemap-list a {
            text-decoration: none;
            color: #0d6efd;
            font-size: 1.1rem;
        }
        .sitemap-list a:hover {
            color: #0a58ca;
            text-decoration: underline;
        }
    </style>
</head>
<body class="bg-light">

<nav class="navbar navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.php">Internship Portal Sitemap</a>
  </div>
</nav>

<div class="container mt-5">
    <div class="card shadow-sm p-4">
        <h2 class="mb-4 text-center">Project Sitemap Architecture</h2>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <ul class="sitemap-list">
                    <li>
                        <strong>🌍 Entry Points</strong>
                        <ul>
                            <li><a href="index.php">Main Route (index.php)</a> - Redirects users based on session.</li>
                        </ul>
                    </li>
                    <li>
                        <strong>🔐 Authentication</strong>
                        <ul>
                            <li><a href="login.php">Login Page (login.php)</a></li>
                            <li><a href="register.php">Student Registration (register.php)</a></li>
                            <li><a href="logout.php">Logout Script (logout.php)</a></li>
                        </ul>
                    </li>
                    <li>
                        <strong>👨‍🎓 Student Portal (Requires Student Login)</strong>
                        <ul>
                            <li><a href="student.php">Dashboard & Search (student.php)</a> - Browse & apply via AJAX.</li>
                            <li><a href="profile.php">Advanced Profile (profile.php)</a> - Manage variables and Resume uploading.</li>
                            <li><a href="my_applications.php">My Applications (my_applications.php)</a> - Track status.</li>
                        </ul>
                    </li>
                    <li>
                        <strong>🛠️ Admin Portal (Requires Admin Login)</strong>
                        <ul>
                            <li><a href="admin.php">Admin Dashboard (admin.php)</a> - Manage users, applications, and postings.</li>
                        </ul>
                    </li>
                        <strong>⚙️ Backend & Architecture (Structural Scripts)</strong>
                        <ul>
                            <li><strong>config/db.php</strong> - Handles MySQL PDO Connections.</li>
                            <li><strong>process.php</strong> - Processes core AJAX Application Requests.</li>
                            <li><strong>assets/</strong> - Isolated global UI definitions and Javascript logic.</li>
                            <li><strong>includes/</strong> - Deeply structured internal component architecture.</li>
                        </ul>
                </ul>
            </div>
        </div>
        <div class="text-center mt-4">
             <a href="login.php" class="btn btn-primary">Go to Application Home</a>
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
