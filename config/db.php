<?php
// db.php
$host = 'localhost';
$dbname = 'internship_system';
$username = 'root'; // Change if your MySQL uses a different username
$password = ''; // Change if your MySQL has a password

try {
    // 1. Connect without specifying the database
    $pdo = new PDO("mysql:host=$host;charset=utf8", $username, $password);
    // Set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // Set default fetch mode to associative array
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

    // 2. Create the database if it doesn't exist
    $pdo->exec("CREATE DATABASE IF NOT EXISTS `$dbname`");
    
    // 3. Switch to use the specific database
    $pdo->exec("USE `$dbname`");

    // 4. Create Tables if they are missing
    $pdo->exec("CREATE TABLE IF NOT EXISTS users (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(100) NOT NULL,
        email VARCHAR(100) NOT NULL UNIQUE,
        password VARCHAR(255) NOT NULL,
        role ENUM('Admin', 'Student') DEFAULT 'Student',
        resume_path VARCHAR(255) DEFAULT NULL
    )");

    // Safe alter just in case table exists from before this update
    $alters = [
        "ALTER TABLE users ADD COLUMN resume_path VARCHAR(255) DEFAULT NULL",
        "ALTER TABLE users ADD COLUMN phone VARCHAR(20) DEFAULT NULL",
        "ALTER TABLE users ADD COLUMN college VARCHAR(150) DEFAULT NULL",
        "ALTER TABLE users ADD COLUMN degree VARCHAR(100) DEFAULT NULL",
        "ALTER TABLE users ADD COLUMN cgpa DECIMAL(3,2) DEFAULT NULL",
        "ALTER TABLE users ADD COLUMN enrollment_no VARCHAR(50) DEFAULT NULL",
        "ALTER TABLE users ADD COLUMN linkedin VARCHAR(100) DEFAULT NULL",
        "ALTER TABLE users ADD COLUMN github VARCHAR(100) DEFAULT NULL",
        "ALTER TABLE users ADD COLUMN leetcode VARCHAR(100) DEFAULT NULL",
        "ALTER TABLE users ADD COLUMN codeforces VARCHAR(100) DEFAULT NULL",
        "ALTER TABLE users ADD COLUMN codechef VARCHAR(100) DEFAULT NULL",
        "ALTER TABLE users ADD COLUMN geeksforgeeks VARCHAR(100) DEFAULT NULL",
        "ALTER TABLE users ADD COLUMN hackerrank VARCHAR(100) DEFAULT NULL"
    ];
    foreach($alters as $q) {
        try { $pdo->exec($q); } catch(PDOException $e) { /* Column already exists, swallow exception */ }
    }

    $pdo->exec("CREATE TABLE IF NOT EXISTS internships (
        id INT AUTO_INCREMENT PRIMARY KEY,
        title VARCHAR(150) NOT NULL,
        company VARCHAR(150) NOT NULL,
        location VARCHAR(150) NOT NULL,
        description TEXT NOT NULL,
        posted_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )");

    $pdo->exec("CREATE TABLE IF NOT EXISTS applications (
        id INT AUTO_INCREMENT PRIMARY KEY,
        user_id INT NOT NULL,
        intern_id INT NOT NULL,
        status ENUM('Pending', 'Approved', 'Rejected') DEFAULT 'Pending',
        applied_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
        FOREIGN KEY (intern_id) REFERENCES internships(id) ON DELETE CASCADE
    )");

    // 5. Insert default Admin account if users table is empty
    $stmt = $pdo->query("SELECT COUNT(*) FROM users");
    if ($stmt->fetchColumn() == 0) {
        $hash = password_hash('admin123', PASSWORD_DEFAULT);
        $pdo->exec("INSERT INTO users (name, email, password, role) VALUES ('System Admin', 'admin@example.com', '$hash', 'Admin')");
    }
    $stmt->closeCursor();

} catch(PDOException $e) {
    die("Database connection/setup failed: " . $e->getMessage());
}
?>
