<?php
// admin/alienraces/addalienrace.php
include_once('../../functions/functions.php');
$db = dbLink();
session_start();

// Check if the user is logged in
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: ../dashboard.php");
    exit;
}

// Get form data
$race_name = $_POST['race_name'] ?? '';
$homeworld = $_POST['homeworld'] ?? '';
$traits    = $_POST['traits'] ?? '';

// Basic validation (can be expanded)
if (empty($race_name) || empty($homeworld) || empty($traits)) {
    echo "All fields are required.";
    exit;
}

// Insert into database
if (insertAlienRace($db, $race_name, $homeworld, $traits)) {
    echo "Alien race successfully added!";
} else {
    echo "Error adding alien race.";
}
?>
<br>
<a href="index.php">Back to Alien Races List</a>