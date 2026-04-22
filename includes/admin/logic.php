<?php
// includes/admin_logic.php

// 1. Handle Internship Creation
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action']) && $_POST['action'] == 'create_internship') {
    $title = $_POST['title'];
    $company = $_POST['company'];
    $location = $_POST['location'];
    $description = $_POST['description'];

    $stmt = $pdo->prepare("INSERT INTO internships (title, company, location, description) VALUES (?, ?, ?, ?)");
    $stmt->execute([$title, $company, $location, $description]);
    header("Location: admin.php?success=Internship Created");
    exit;
}

// 2. Handle Internship Edit
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action']) && $_POST['action'] == 'edit_internship') {
    $id = $_POST['intern_id'];
    $title = $_POST['title'];
    $company = $_POST['company'];
    $location = $_POST['location'];
    $description = $_POST['description'];

    $stmt = $pdo->prepare("UPDATE internships SET title = ?, company = ?, location = ?, description = ? WHERE id = ?");
    $stmt->execute([$title, $company, $location, $description, $id]);
    header("Location: admin.php?success=Internship Updated");
    exit;
}

// 3. Handle Internship Deletion
if (isset($_GET['delete_intern'])) {
    $id = $_GET['delete_intern'];
    $stmt = $pdo->prepare("DELETE FROM internships WHERE id = ?");
    $stmt->execute([$id]);
    header("Location: admin.php?success=Internship Deleted");
    exit;
}

// 4. Handle Application Status Update
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action']) && $_POST['action'] == 'update_status') {
    $app_id = $_POST['application_id'];
    $status = $_POST['status'];

    $stmt = $pdo->prepare("UPDATE applications SET status = ? WHERE id = ?");
    $stmt->execute([$status, $app_id]);
    header("Location: admin.php?success=Status Updated");
    exit;
}

// 5. Handle User Deletion
if (isset($_GET['delete_user'])) {
    $id = $_GET['delete_user'];
    $stmt = $pdo->prepare("DELETE FROM users WHERE id = ?");
    $stmt->execute([$id]);
    header("Location: admin.php?success=User Deleted");
    exit;
}
?>
