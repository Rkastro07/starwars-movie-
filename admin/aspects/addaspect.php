<?php
// admin/aspects/addaspect.php
include_once('../../functions/functions.php');
$db = dbLink();

// Get form data
$aspect = $_POST['aspect'] ?? '';
$definition = $_POST['definition'] ?? '';

// Basic validation
if (empty($aspect) || empty($definition)) {
    echo "All fields are required.";
    exit;
}

// Insert into database
if (insertAspect($db, $aspect, $definition)) {
    echo "Aspect successfully added!";
} else {
    echo "Error adding aspect.";
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
