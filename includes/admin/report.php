<?php // includes/admin_report.php ?>
<!-- Dashboard Report Section -->
<h2 id="report-section" class="mb-3">Overview Report</h2>
<div class="row mb-5">
    <div class="col-md-4">
        <div class="card text-white bg-primary shadow">
            <div class="card-body">
                <h5 class="card-title">Total Internships</h5>
                <p class="card-text fs-2"><?= $totalInternships ?></p>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card text-white bg-success shadow">
            <div class="card-body">
                <h5 class="card-title">Total Applications</h5>
                <p class="card-text fs-2"><?= $totalApplications ?></p>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card text-white bg-warning shadow">
            <div class="card-body">
                <h5 class="card-title">Registered Students</h5>
                <p class="card-text fs-2 text-dark"><?= $totalUsers ?></p>
            </div>
        </div>
    </div>
</div>
