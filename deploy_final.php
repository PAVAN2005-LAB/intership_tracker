<?php
// deploy_final.php
echo "<h2>Running Auto-Deployment Push...</h2><pre>";
$commands = [
    'git init 2>&1',
    'git branch -M main 2>&1',
    'git add . 2>&1',
    'git commit -m "Finalized component-based architecture and dynamic profile system" 2>&1',
    'git remote add origin https://github.com/PAVAN2005-LAB/intership_tracker.git 2>&1',
    'git push -u origin main 2>&1'
];
foreach ($commands as $cmd) {
    echo "<b>> $cmd</b><br>";
    $output = shell_exec($cmd);
    echo htmlspecialchars($output ? $output : "No output.") . "<br><br>";
}
echo "</pre><h3>Deployment script finished!</h3>";
unlink(__FILE__);
?>
