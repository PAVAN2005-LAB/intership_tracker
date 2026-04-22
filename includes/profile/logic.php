<?php
// includes/profile/logic.php

// Handle Profile Update Request
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_profile'])) {
    
    // Create uploads directory if it doesn't exist
    $uploadDir = 'uploads/resumes/';
    if (!file_exists($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    $name = trim($_POST['name']);
    $phone = trim($_POST['phone'] ?? '');
    $college = trim($_POST['college'] ?? '');
    $degree = trim($_POST['degree'] ?? '');
    $cgpa = isset($_POST['cgpa']) && is_numeric($_POST['cgpa']) ? $_POST['cgpa'] : null;
    
    // Coding fields
    $enrollment = trim($_POST['enrollment_no'] ?? '');
    $linkedin = trim($_POST['linkedin'] ?? '');
    $github = trim($_POST['github'] ?? '');
    $leetcode = trim($_POST['leetcode'] ?? '');
    $codeforces = trim($_POST['codeforces'] ?? '');
    $codechef = trim($_POST['codechef'] ?? '');
    $gfg = trim($_POST['geeksforgeeks'] ?? '');
    $hackerrank = trim($_POST['hackerrank'] ?? '');

    if(empty($enrollment)) {
         $error = "Enrollment Number is required!";
    } else {
        // File upload logic securely implemented
        if (isset($_FILES['resume']) && $_FILES['resume']['error'] == UPLOAD_ERR_OK) {
            $fileTmpPath = $_FILES['resume']['tmp_name'];
            $fileName = $_FILES['resume']['name'];
            $fileNameCmps = explode(".", $fileName);
            $fileExtension = strtolower(end($fileNameCmps));
            
            // Sanitize file name
            $newFileName = md5(time() . $fileName) . '.' . $fileExtension;
            $dest_path = $uploadDir . $newFileName;
            
            $allowedfileExtensions = array('pdf', 'doc', 'docx');
            
            if (in_array($fileExtension, $allowedfileExtensions)) {
                if(move_uploaded_file($fileTmpPath, $dest_path)) {
                    $stmt = $pdo->prepare("UPDATE users SET name=?, phone=?, college=?, degree=?, cgpa=?, enrollment_no=?, linkedin=?, github=?, leetcode=?, codeforces=?, codechef=?, geeksforgeeks=?, hackerrank=?, resume_path=? WHERE id=?");
                    $stmt->execute([$name, $phone, $college, $degree, $cgpa, $enrollment, $linkedin, $github, $leetcode, $codeforces, $codechef, $gfg, $hackerrank, $dest_path, $user_id]);
                    $_SESSION['name'] = $name;
                    $success = "Profile and Resume updated successfully!";
                } else {
                    $error = "Error moving the uploaded file.";
                }
            } else {
                $error = "Upload failed. Allowed file types: PDF, DOC, DOCX.";
            }
        } else {
            // Update pure Text Details only
            $stmt = $pdo->prepare("UPDATE users SET name=?, phone=?, college=?, degree=?, cgpa=?, enrollment_no=?, linkedin=?, github=?, leetcode=?, codeforces=?, codechef=?, geeksforgeeks=?, hackerrank=? WHERE id=?");
            $stmt->execute([$name, $phone, $college, $degree, $cgpa, $enrollment, $linkedin, $github, $leetcode, $codeforces, $codechef, $gfg, $hackerrank, $user_id]);
            $_SESSION['name'] = $name;
            $success = "Profile updated successfully!";
        }
    }
}
?>
