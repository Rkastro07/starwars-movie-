<?php
// admin/ships/addship.php
include_once('../../functions/functions.php');
$db = dbLink();

$ship_name  = $_POST['ship_name'] ?? '';
$model      = $_POST['model'] ?? '';
$description = $_POST['description'] ?? '';

if (insertShip($db, $ship_name, $model, $description)) {
    echo "Ship successfully added!";
} else {
    echo "Error adding ship.";
}
session_start();

// Check if the user is logged in
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: ../dashboard.php");
    exit;
}
?>
<br>
<a href="index.php">Back to Ships List</a>
