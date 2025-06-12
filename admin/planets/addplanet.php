<?php
// admin/planets/addplanet.php
include_once('../../functions/functions.php');
$db = dbLink();

// Get form data
$planet_name = $_POST['planet_name'] ?? '';
$region      = $_POST['region'] ?? '';
$description = $_POST['description'] ?? '';

if (insertPlanet($db, $planet_name, $region, $description)) {
    echo "Planet successfully added!";
} else {
    echo "Error adding planet.";
}
session_start();

// Check if the user is logged in
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: ../dashboard.php");
    exit;
}
?>
<br>
<a href="index.php">Back to Planets List</a>
