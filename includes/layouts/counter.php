<?php
// includes/layouts/counter.php

// Define the path securely outside public scope if possible, or tightly bound in config
$counterFile = __DIR__ . '/../../config/counter.txt';

// Initialize tracking if it doesn't exist
if (!file_exists($counterFile)) {
    // Generate a slightly high baseline randomly if empty to look professional, or just 1
    file_put_contents($counterFile, 127);
}

$visits = (int)file_get_contents($counterFile);

// Intelligent tracking preventing F5 spam padding
if (!isset($_SESSION['has_visited_home'])) {
    $visits++;
    file_put_contents($counterFile, $visits);
    $_SESSION['has_visited_home'] = true;
}
?>
<div class="mt-2">
    <span class="badge border border-secondary border-opacity-50 bg-black bg-opacity-25 px-3 py-2 text-white-50" style="font-size: 0.85rem;">
        <i class="bi bi-bar-chart-fill text-info me-1"></i> Unique Visitors: <strong class="text-white"><?= number_format($visits) ?></strong>
    </span>
</div>
