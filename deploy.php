<?php
// deploy.php - Acts as an isolated shell environment trigger
echo "<!DOCTYPE html><html><head><title>Git Auto-Deploy</title></head><body style='background:#1e1e1e; color:#0f0; font-family:monospace; padding: 20px;'>";
echo "<h2>Running Auto-Deployment Push...</h2>";

$commands = [
    'git init 2>&1',
    'git branch -M main 2>&1',
    'git add . 2>&1',
    'git commit -m "Finalized component-based architecture and dynamic profile system" 2>&1',
    'git remote add origin https://github.com/PAVAN2005-LAB/intership_tracker.git 2>&1',
    'git push -u origin main 2>&1'
];

echo "<pre>";
foreach ($commands as $cmd) {
    echo "<b>> $cmd</b><br>";
    $output = shell_exec($cmd);
    echo htmlspecialchars($output ? $output : "No output or command successful/failed silently.");
    echo "<br><br>";
}
echo "</pre>";
echo "<h3 style='color:cyan;'>Deployment script finished! You can close this page.</h3>";
echo "</body></html>";
?>
