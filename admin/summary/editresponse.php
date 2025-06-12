<?php
// admin/summary/editresponse.php
include_once('../../functions/functions.php');
$db = dbLink();

// Receive form data via POST
$id          = $_POST['id'] ?? null;
$era_title   = $_POST['era_title'] ?? '';
$summary_text = $_POST['summary_text'] ?? '';

// Basic validation
if (empty($id) || empty($era_title) || empty($summary_text)) {
    echo "All fields are required.";
    exit;
}

// Update database
if (updateSummary($db, $id, $era_title, $summary_text)) {
    echo "Summary successfully updated!";
} else {
    echo "Error updating summary.";
}
session_start();

// Check if the user is logged in
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: ../dashboard.php");
    exit;
}
?>
<br>
<a href="index.php">Back to Summaries List</a>
