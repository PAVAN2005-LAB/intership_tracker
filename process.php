<?php
session_start();
require_once 'config/db.php';

header('Content-Type: application/json');

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['error' => 'Unauthorized access.']);
    exit;
}

$action = isset($_POST['action']) ? $_POST['action'] : '';

if ($action == 'fetch') {
    // Fetch all internships
    $stmt = $pdo->prepare("SELECT * FROM internships ORDER BY posted_date DESC");
    $stmt->execute();
    $internships = $stmt->fetchAll();
    
    // Check which ones the user has already applied for
    $user_id = $_SESSION['user_id'];
    $appliedStmt = $pdo->prepare("SELECT intern_id FROM applications WHERE user_id = ?");
    $appliedStmt->execute([$user_id]);
    $applied_interns = $appliedStmt->fetchAll(PDO::FETCH_COLUMN, 0);

    // Add has_applied flag
    foreach ($internships as &$intern) {
        $intern['has_applied'] = in_array($intern['id'], $applied_interns);
    }
    
    echo json_encode(['status' => 'success', 'data' => $internships]);
    exit;
}

if ($action == 'apply') {
    $intern_id = isset($_POST['intern_id']) ? intval($_POST['intern_id']) : 0;
    $user_id = $_SESSION['user_id'];

    if ($intern_id <= 0) {
        echo json_encode(['status' => 'error', 'message' => 'Invalid internship ID.']);
        exit;
    }

    // Check if already applied
    $check = $pdo->prepare("SELECT id FROM applications WHERE user_id = ? AND intern_id = ?");
    $check->execute([$user_id, $intern_id]);
    if ($check->fetch()) {
        $check->closeCursor();
        echo json_encode(['status' => 'error', 'message' => 'You have already applied for this internship.']);
        exit;
    }
    $check->closeCursor();

    // Handle New Resume Upload if provided
    if (isset($_FILES['resume']) && $_FILES['resume']['error'] == UPLOAD_ERR_OK) {
        $uploadDir = 'uploads/resumes/';
        if (!file_exists($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }
        $fileNameCmps = explode(".", $_FILES['resume']['name']);
        $fileExtension = strtolower(end($fileNameCmps));
        $dest_path = $uploadDir . md5(time() . $_FILES['resume']['name']) . '.' . $fileExtension;
        
        $allowedfileExtensions = array('pdf', 'doc', 'docx');
        if (in_array($fileExtension, $allowedfileExtensions)) {
            if(move_uploaded_file($_FILES['resume']['tmp_name'], $dest_path)) {
                // Update User table with new resume
                $stmt = $pdo->prepare("UPDATE users SET resume_path = ? WHERE id = ?");
                $stmt->execute([$dest_path, $user_id]);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Failed to execute file upload to server.']);
                exit;
            }
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Upload failed. Allowed formats: PDF, DOC, DOCX.']);
            exit;
        }
    } else {
        // If not uploading a NEW resume, check if they have one already recorded
        $userStmt = $pdo->prepare("SELECT resume_path FROM users WHERE id = ?");
        $userStmt->execute([$user_id]);
        $u = $userStmt->fetch();
        if(empty($u['resume_path'])) {
            echo json_encode(['status' => 'error', 'message' => 'Error: You must upload a resume to process this application!']);
            exit;
        }
        $userStmt->closeCursor();
    }

    // Finally, insert the application
    $insert = $pdo->prepare("INSERT INTO applications (user_id, intern_id, status) VALUES (?, ?, 'Pending')");
    if ($insert->execute([$user_id, $intern_id])) {
        echo json_encode(['status' => 'success', 'message' => 'Application submitted successfully!']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Database error.']);
    }
    exit;
}

echo json_encode(['status' => 'error', 'message' => 'Invalid action.']);
?>
