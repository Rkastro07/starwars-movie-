<?php
// admin/movies/editresponse.php
include_once('../../functions/functions.php');
$db = dbLink();

$id            = $_POST['id'] ?? null;
$title         = $_POST['title'] ?? '';
$release_year  = $_POST['release_year'] ?? '';
$director      = $_POST['director'] ?? '';
$synopsis      = $_POST['synopsis'] ?? '';

if (!$id) {
    echo "ID not provided.";
    exit;
}

if (updateMovie($db, $id, $title, $release_year, $director, $synopsis)) {
    echo "Movie successfully updated!";
} else {
    echo "Error updating movie.";
}
session_start();

// Check if the user is logged in
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: ../dashboard.php");
    exit;
}
?>
<br>
<a href="index.php">Back to Movies List</a>