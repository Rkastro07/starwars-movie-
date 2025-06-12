<?php
// admin/planets/editresponse.php
include_once('../../functions/functions.php');
$db = dbLink();

$id          = $_POST['id'] ?? null;
$planet_name = $_POST['planet_name'] ?? '';
$region      = $_POST['region'] ?? '';
$description = $_POST['description'] ?? '';

if (!$id) {
    echo "ID not provided.";
    exit;
}

if (updatePlanet($db, $id, $planet_name, $region, $description)) {
    echo "Planet successfully updated!";
} else {
    echo "Error updating planet.";
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
