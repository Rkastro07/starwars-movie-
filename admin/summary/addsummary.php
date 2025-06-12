<?php
// admin/summary/addsummary.php
include_once('../../functions/functions.php');
$db = dbLink();

// Receive form data
$era_title    = $_POST['era_title'] ?? '';
$summary_text = $_POST['summary_text'] ?? '';

// Basic validation
if (empty($era_title) || empty($summary_text)) {
    echo "All fields are required.";
    exit;
}

// Insert into database
if (insertSummary($db, $era_title, $summary_text)) {
    echo "Summary successfully added!";
} else {
    echo "Error adding summary.";
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