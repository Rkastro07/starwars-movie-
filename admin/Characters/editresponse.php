<?php
// admin/characters/editresponse.php
include_once('../../functions/functions.php');
$db = dbLink();

// Get POST data
$id          = $_POST['id'] ?? null;
$name        = $_POST['name'] ?? '';
$affiliation = $_POST['affiliation'] ?? '';
$details     = $_POST['details'] ?? '';

// Basic validation
if (empty($id) || empty($name) || empty($affiliation) || empty($details)) {
    echo "All fields are required.";
    exit;
}

// Update database
if (updateCharacter($db, $id, $name, $affiliation, $details)) {
    echo "Character successfully updated!";
} else {
    echo "Error updating character.";
}
session_start();

// Check if the user is logged in
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: ../dashboard.php");
    exit;
}
?>
<br>
<a href="index.php">Back to Characters List</a>