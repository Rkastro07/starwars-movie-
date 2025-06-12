<?php
include_once('../../functions/functions.php');
$db = dbLink();

// Retrieve POST data
$title        = $_POST['title'] ?? '';
$release_year = $_POST['release_year'] ?? '';
$director     = $_POST['director'] ?? '';
$synopsis     = $_POST['synopsis'] ?? '';

// Initialize attachment variable
$attachment = null;

// Check if a file was uploaded without errors
if (isset($_FILES['attachment']) && $_FILES['attachment']['error'] == 0) {
    // Define the allowed file types and max file size (e.g., 2MB)
    $allowedTypes = ['image/jpeg', 'image/png', 'application/pdf'];
    $maxSize = 2 * 1024 * 1024; // 2MB in bytes

    if (in_array($_FILES['attachment']['type'], $allowedTypes) && $_FILES['attachment']['size'] <= $maxSize) {
        // Create an uploads directory if it doesn't exist
        $uploadDir = '../../uploads/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }

        // Generate a unique file name to avoid conflicts
        $filename = time() . '_' . basename($_FILES['attachment']['name']);
        $destination = $uploadDir . $filename;

        // Move the uploaded file to the destination directory
        if (move_uploaded_file($_FILES['attachment']['tmp_name'], $destination)) {
            // Store the file name/path in the $attachment variable
            $attachment = $filename;
        } else {
            echo "Error uploading the file.";
            exit;
        }
    } else {
        echo "Invalid file type or file too large.";
        exit;
    }
}

// Now, call the insertMovie function.
// Ensure that your movies table and function (insertMovie) have been updated to accept the new "attachment" field.
$sql = "INSERT INTO movies (title, release_year, director, synopsis, attachment)
        VALUES (:title, :release_year, :director, :synopsis, :attachment)";
$stmt = $db->prepare($sql);
$stmt->bindParam(':title', $title);
$stmt->bindParam(':release_year', $release_year);
$stmt->bindParam(':director', $director);
$stmt->bindParam(':synopsis', $synopsis);
$stmt->bindParam(':attachment', $attachment);

if ($stmt->execute()) {
    echo "Movie successfully added!";
} else {
    echo "Error adding movie.";
}

session_start();
// Check if the user is logged in
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: ../dashboard.php");
    exit;
}
?>
<br>
<a href="index.php">Back to Movies List</a>
