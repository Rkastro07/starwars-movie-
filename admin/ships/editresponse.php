<?php
// admin/ships/editresponse.php
include_once('../../functions/functions.php');
$db = dbLink();

$id          = $_POST['id'] ?? null;
$ship_name   = $_POST['ship_name'] ?? '';
$model       = $_POST['model'] ?? '';
$description = $_POST['description'] ?? '';

if (!$id) {
    echo "ID not provided.";
    exit;
}

if (updateShip($db, $id, $ship_name, $model, $description)) {
    echo "Ship successfully updated!";
} else {
    echo "Error updating ship.";
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
