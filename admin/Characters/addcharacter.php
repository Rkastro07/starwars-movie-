<?php
// admin/characters/addcharacter.php
include_once('../../functions/functions.php');
$db = dbLink();

// Get form data
$name        = $_POST['name'] ?? '';
$affiliation = $_POST['affiliation'] ?? '';
$details     = $_POST['details'] ?? '';

// Basic validation
if (empty($name) || empty($affiliation) || empty($details)) {
    echo "All fields are required.";
    exit;
}

// Insert into database
if (insertCharacter($db, $name, $affiliation, $details)) {
    echo "Character successfully added!";
} else {
    echo "Error adding character.";
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
