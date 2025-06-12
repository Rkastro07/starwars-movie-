<?php
// admin/skills/editresponse.php
include_once('../../functions/functions.php');
$db = dbLink();

// Get POST data
$id = $_POST['id'] ?? null;
$name = $_POST['name'] ?? '';
$skill = $_POST['skill'] ?? '';
$about = $_POST['about'] ?? '';

// Basic validation
if (empty($id) || empty($name) || empty($skill) || empty($about)) {
    echo "All fields are required.";
    exit;
}

// Update database
if (updateSkill($db, $id, $name, $skill, $about)) {
    echo "Skill successfully updated!";
} else {
    echo "Error updating skill.";
}
session_start();

// Check if the user is logged in
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: ../dashboard.php");
    exit;
}
?>
<br>
<a href="index.php">Back to Skills List</a>