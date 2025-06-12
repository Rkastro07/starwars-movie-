<?php
// admin/skills/addskill.php
include_once('../../functions/functions.php');
$db = dbLink();

// Get form data
$name = $_POST['name'] ?? '';
$skill = $_POST['skill'] ?? '';
$about = $_POST['about'] ?? '';

// Basic validation
if (empty($name) || empty($skill) || empty($about)) {
    echo "All fields are required.";
    exit;
}

// Insert into database
if (insertSkill($db, $name, $skill, $about)) {
    echo "Skill successfully added!";
} else {
    echo "Error adding skill.";
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
