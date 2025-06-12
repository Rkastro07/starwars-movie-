<?php
// admin/aspects/editresponse.php
include_once('../../functions/functions.php');
$db = dbLink();

// Get POST data
$id = $_POST['id'] ?? null;
$aspect = $_POST['aspect'] ?? '';
$definition = $_POST['definition'] ?? '';

// Basic validation
if (empty($id) || empty($aspect) || empty($definition)) {
    echo "All fields are required.";
    exit;
}

// Update database
if (updateAspect($db, $id, $aspect, $definition)) {
    echo "Aspect successfully updated!";
} else {
    echo "Error updating aspect.";
}
session_start();

// Check if the user is logged in
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: ../dashboard.php");
    exit;
}
?>
<br>
<a href="index.php">Back to Aspects List</a>
